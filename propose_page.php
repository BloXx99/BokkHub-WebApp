<?php
session_start();
require_once("connect.php");
$connection = @new mysqli($host,$db_user,$db_password,$db_name);
if ($connection->connect_errno){
    die("Connection failed: ".$connection->connect_error);  
    sleep(5);
    header("Location: index.php");
}

if(isset($_POST['value'])){
  //get current user ID
  $active_user_id = $_SESSION['logged_id'];
  $safe_value = stripslashes($_POST['value']);
  $safe_value = $connection->real_escape_string($safe_value);
  $sql = "INSERT INTO propositions (user_id,proposition_type,comment) VALUES";

  if(isset($_POST['book_propo'])){

    $sql = $sql . " ($active_user_id , 0 , '$safe_value');";
    $result = $connection->query($sql);
    if($result){
      $connection->close();
      header("Location: index.php");
    }



  }


  if(isset($_POST['author_propo'])){

    $sql = $sql . " ($active_user_id , 1 , '$safe_value');";
    $result = $connection->query($sql);
    if($result)
    $connection->close();
    header("Location: index.php");
  }

}



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="stylesheet" href="./styles/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/70082227f2.js" crossorigin="anonymous"></script>

</head>
<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand text-center" href="index.php"> <i class="fa-solid fa-arrow-left"></i> Return to main page</a>
        </div>
    </nav>

    <div class = "container-fluid" id = "LoginPageHello">

        <header class = " h5 text-center text-nowrap">
      
        <p class="text-center display-4 text-primary" id = "subtitle"> Propose Author/Book to add. </p> 
        <p class="text-center display-8 text-primary" id = "subtitle"> Make sure to select just ONE field. Reset if necesssary. </p> 
      
        </header>
      <div class="form-check">
      <form  class = "text-center" method = "post">
        <label for = 'book'> Book </label>
        <input id = 'book' type="radio" name ="book_propo" value="0">
        <br>
        <label for = 'author'> Author </label>
        <input id = 'author' type="radio" name ="author_propo" value="1">
        <br>
        <label for = "value"> Your text: </value>
        <br>
        <textarea id="value" name="value" maxlength ="250" cols = "60"></textarea> 
        <br>
        <input type="reset" class = "btn btn-danger" value = "Reset fields">
        <br><br>
        <input type = "submit" class = "btn btn-primary" value = "Submit">
      </form>
      </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>