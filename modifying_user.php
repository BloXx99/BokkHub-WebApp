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

// get selected book's data.
$user_id = $_SESSION['update_user_id'];


if(isset($_POST['modify_status'])){

  $active_user = $_SESSION['username'];
  $modify_status = $_POST['modify_status'];
  
  $safe_modify_status= strip_tags($connection->real_escape_string($modify_status));
  
  

  $change_status = false;
  

  if(strlen($safe_modify_status) != 0){
    $change_status = true;
  }


  if($change_status == true){

    $sql = "UPDATE user_list SET user_status = $safe_modify_status WHERE id = '$user_id';";
    $result = $connection->query($sql);
    if(!$result){
        echo " Error";
        unset($_SESSION['update_user_id']);
        $connection->close();
    }
    else{
        $connection->close();
        unset($_SESSION['update_user_id']);
        header("Location: inc/adminview_users.php");

    }


  }
  if($change_status == false){

    connection->close();
    unset($_SESSION['update_user_id']);
    header("Location: inc/adminview_users.php");

  }


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

    <p class="text-center display-6 text-primary" id = "subtitle"> Set this user's status. </p>

</div>

<div class = "container-fluid">

<header class = " h5 text-center text-nowrap"> If you don't want to modify the field - leave it empty.</header>

</div>
<form class = "text-center" method='post'>

 <label for="status_change">New 'status' value: </label><br>
 <input type="text" id="status_change" name="modify_status"><br>
 
 <br><br>
 <input type = "submit" class="btn btn-primary" value = "Submit">

</form>
<br>
<div class = "container-fluid">


</div>

















    
        



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>