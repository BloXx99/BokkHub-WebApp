<?php
session_start();
if(!isset($_SESSION['username'])){
  header("Location: index.php");
}

if(isset($_SESSION['query'])){
  unset($_SESSION['query']);
}

require_once('connect.php');
$connection = @new mysqli($host,$db_user,$db_password,$db_name);
if ($connection->connect_errno){
    die("Connection failed: ".$connection->connect_error);  
    sleep(5);
    header("Location: index.php");
}

// get selected author's data.
$author_id = $_SESSION['update_author_id'];
//get current data on author.
$previous_data_sql = "SELECT * FROM authors WHERE id = '{$author_id}';";
$result = $connection->query($previous_data_sql);
if(!$result){
  echo "Query error!";
  header("Location: index.php");
}
if($result){
  $row = $result->fetch_assoc();
  $previous_name = $row['name_surname'];
  echo "$previous_name" . " is the selected author";
  $result->free_result();
  unset($row);

}


if(isset($_POST['modify_name'])){

  $active_user = $_SESSION['username'];
  $modify_name = $_POST['modify_name'];
  $modify_born = $_POST['modify_born'];
  $modify_nationality = $_POST['modify_nationality'];
  $safe_modify_name= strip_tags($connection->real_escape_string($modify_name));
  $safe_modify_born = strip_tags($connection->real_escape_string($modify_born));
  $safe_modify_nationality = strip_tags($connection->real_escape_string($modify_nationality));
  $safe_modify_born = strval($safe_modify_born);

  $change_name = false;
  $change_born = false;
  $change_nat = false;

  if(strlen($safe_modify_name) != 0){
    $change_name = true;
  }

  if(strlen($safe_modify_born) != 0){
    $change_born = true;
  }

  if(strlen($safe_modify_nationality) != 0){
    $change_nat = true;
  }
  
  if(strlen($safe_modify_name) == 0 && strlen($safe_modify_born) == 0 && strlen($safe_modify_nationality) == 0)
  {
    echo "No data field were modified.";
    sleep(2);
    header("Location: inc/adminview_authors.php");
  }

  else{
    $update_query = "UPDATE authors SET";

    if($change_name == true){
      $update_query = $update_query . " name_surname = '$safe_modify_name'";

    }

    if($change_name == false){
      $update_query = $update_query . " name_surname = '$previous_name'";

    }

    if($change_born == true){

      $update_query = $update_query . " ,born = '{$safe_modify_born}'";

    }

    if($change_nat == true){

      $update_query = $update_query . " ,nationality = '{$safe_modify_nationality}'";

    }

    $update_query = $update_query . " WHERE id = {$author_id};";
    

    $success = $connection->query($update_query);
    if($success){
      $connection->close();
      unset($_SESSION['update_author_id']);
      header('Location: inc/adminview_authors.php');
    }

    if(!$success){
      unset($_SESSION['update_author_id']);
      $connection->close();
      echo "SQL Update error!!!";
    }



  }














  connection->close();

}







?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookHub - Welcome!</title>
    <link rel="stylesheet" href="./styles/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

</head>
<body>

    

  <div id = "topbanner">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">BookHub</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="mynavbar">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php"> Return to home page</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</div>
    



<div class = "container-fluid">

    <p class="text-center display-6 text-primary" id = "subtitle"> Modify this author's data. </p>

</div>

<div class = "container-fluid">

<header class = " h5 text-center text-nowrap"> If you don't want to modify a field - leave it empty.</header>

</div>
<form class = "text-center" method='post'>

 <label for="username_change">New 'name + surname' value: </label><br>
 <input type="text" id="name_change" name="modify_name"><br>
 
 <label for="password_change">New 'born' value: </label><br>
 <input type="text" id="born_change" name="modify_born"><br>
 

 <label for="email_change">New 'nationality" value': </label><br>
 <input type="text" id="nationality_change" name="modify_nationality">
 <br><br>
 <input type = "submit" class="btn btn-primary" value = "Submit">

</form>
<br>
<div class = "container-fluid">


</div>

















    
        



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>