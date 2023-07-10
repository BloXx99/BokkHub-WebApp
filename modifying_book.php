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
$book_id = $_SESSION['update_book_id'];
//get current data on selected book.
$previous_data_sql = "SELECT * FROM books WHERE id = '{$book_id}';";
$result = $connection->query($previous_data_sql);
if(!$result){
  echo "Query error!";
  header("Location: index.php");
}
if($result){
  $row = $result->fetch_assoc();
  $previous_title = $row['title'];
  echo "$previous_title" . " is a selected title";
  $result->free_result();
  unset($row);

}


if(isset($_POST['modify_title'])){

  $active_user = $_SESSION['username'];
  $modify_title = $_POST['modify_title'];
  $modify_author = $_POST['modify_author'];
  $modify_genre = $_POST['modify_genre'];
  
  $safe_modify_title= strip_tags($connection->real_escape_string($modify_title));
  $safe_modify_author = strip_tags($connection->real_escape_string($modify_author));
  $safe_modify_genre = strip_tags($connection->real_escape_string($modify_genre));
  
  

  $change_title = false;
  $change_author = false;
  $change_genre = false;
  

  if(strlen($safe_modify_title) != 0){
    $change_title = true;
  }

  if(strlen($safe_modify_author) != 0){
    $change_author = true;
  }

  if(strlen($safe_modify_genre) != 0){
    $change_genre = true;
  }
  
  if(strlen($safe_modify_title) == 0 && strlen($safe_modify_author) == 0 && strlen($safe_modify_genre) == 0)
  {
    echo "No data field were modified.";
    sleep(2);
    header("Location: inc/adminview_books.php");
  }

  else{
    $update_query = "UPDATE books SET";

    if($change_title == true){
      $update_query = $update_query . " title = '$safe_modify_title'";

    }

    if($change_title == false){
      $update_query = $update_query . " title = '$previous_title'";

    }

    if($change_author == true){

      $update_query = $update_query . " ,author = '{$safe_modify_author}'";

    }

    if($change_genre == true){

      $update_query = $update_query . " ,genre = '{$safe_modify_genre}'";

    }

    $update_query = $update_query . " WHERE id = {$book_id};";
    

    $success = $connection->query($update_query);
    if($success){
      $connection->close();
      unset($_SESSION['update_book_id']);
      header('Location: inc/adminview_books.php');
    }

    if(!$success){
      unset($_SESSION['update_book_id']);
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

    <p class="text-center display-6 text-primary" id = "subtitle"> Modify this books's data. </p>

</div>

<div class = "container-fluid">

<header class = " h5 text-center text-nowrap"> If you don't want to modify a field - leave it empty.</header>

</div>
<form class = "text-center" method='post'>

 <label for="username_change">New 'title' value: </label><br>
 <input type="text" id="title_change" name="modify_title"><br>
 
 <label for="password_change">New 'author' value: </label><br>
 <input type="text" id="author_change" name="modify_author"><br>
 

 <label for="email_change">New 'genre' value: </label><br>
 <input type="text" id="genre_change" name="modify_genre">
 <br><br>
 <input type = "submit" class="btn btn-primary" value = "Submit">

</form>
<br>
<div class = "container-fluid">


</div>

















    
        



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>