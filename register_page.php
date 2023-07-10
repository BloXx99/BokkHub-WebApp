<?php
session_start();
require_once('connect.php');
if(isset($_POST['reg_username'])){

  $connection = @new mysqli($host,$db_user,$db_password,$db_name);
  if ($connection->connect_error){
    die("Connection failed: ".$connection->connect_error);  
    sleep(5);
    header("Location: index.php");
  }

  $reg_nickname = $_POST['reg_username'];
  $reg_pass = $_POST['reg_password'];
  $reg_pass_confirm = $_POST['reg_confirm_password'];
  $safe_reg_nickname = strip_tags($connection->real_escape_string($reg_nickname));
  $safe_reg_password = strip_tags($connection->real_escape_string($reg_pass));
  $safe_reg_pass_confirm = strip_tags($connection->real_escape_string($reg_pass_confirm));
  

  $all_ok = true;
  $user_exists_check_sql= "SELECT * FROM user_list WHERE username = '$safe_reg_nickname'";
  if($result = $connection->query($user_exists_check_sql)){
    $num_users = $result->num_rows;
    if($num_users != 0){
      $all_ok = false;
      $error_string = "User with that name already exists!";
      $_SESSION['e_user_exists'] = $error_string;
      $result->free_result();
      }
    }
    if(strlen($safe_reg_nickname)< 3 || strlen($safe_reg_nickname) >25){
      $all_ok = false;
      $error_string = 'Username needs to have between 3 and 25 characters';
      $_SESSION['e_nick'] = $error_string;
    }

    if(strlen($safe_reg_password) < 6 || strlen($safe_reg_password) > 40){
      $all_ok = false;
      $error_string = 'Password needs to be between 7 and 40 characters!';
      $_SESSION['e_password'] = $error_string;
    }

    if($safe_reg_password != $safe_reg_pass_confirm){
      $all_ok = false;
      $error_string = 'Passwords are different!';
      $_SESSION['e_password_mismatch'] = $error_string;
    }
    if(!isset($_SESSION['e_nick']) && !isset($_SESSION['e_password'])&& !isset($_SESSION['e_password_mismatch']) && $all_ok)
    {
      $query = "INSERT INTO user_list(username,password) VALUES ('$safe_reg_nickname',MD5('$safe_reg_password'));";
      if(!$result2 = $connection->query($query)){
      }
      else{
        $_SESSION['reg_success'] = "Account created! We are moving you to login page. Hold on tight...";
      }
    }
    








$connection->close();
}

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create your account</title>
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

    <div class = "container-fluid" id = "RegisterPageHello">

        <header class = " h5 text-center text-nowrap">
      
          We're glad you want to join! <br>
          Create your brand new account. Yes, it's completely free.   
      
        </header>

    <form class = "text-center" method='post'>
        <label for="username">Username: </label><br>
        <input type="text" id="username" name="reg_username"><br>
        <?php 
          if(isset($_SESSION['e_nick'])){
            echo "<p class='alert alert-primary' role='alert'>". $_SESSION['e_nick']. "</p>";
            unset($_SESSION['e_nick']);
          }
        ?>
        <label for="password">Password: </label><br>
        <input type="password" id="password" name="reg_password"><br>
        <?php 
          if(isset($_SESSION['e_password'])){
            echo "<p class='alert alert-primary' role='alert'>". $_SESSION['e_password']. "</p><br>";
            unset($_SESSION['e_password']);
          }
        ?>
        <label for="confirm_password">Confirm password: </label><br>
        <input type="password" id="confirm_password" name="reg_confirm_password"><br>
        <?php
          if(isset($_SESSION['e_user_exists'])){
            echo "<p class='alert alert-primary' role='alert'>". $_SESSION['e_user_exists']. "</p><br>";
            unset($_SESSION['e_user_exists']);
          } 
          elseif(isset($_SESSION['e_password_mismatch'])){
            echo "<p class='alert alert-primary' role='alert'>". $_SESSION['e_password_mismatch']. "</p><br>";
            unset($_SESSION['e_password_mismatch']);
          }
          elseif(isset($_SESSION['reg_success'])){
            echo "<p class='alert alert-primary' role='alert'>". $_SESSION['reg_success'] . "</p><br>";
            unset($_SESSION['reg_success']);
            sleep(3);
            header("Location: login_page.html");   
          }
        ?>
        <div class="form-check mb-3">
          <label class="form-check-label">
            <input class="form-check-input" type="checkbox" name="remember"> Accept all Terms and Conditions.
          </label>
        </div>
        <input type = "submit" value = "Submit" class = "btn btn-primary">
        
      </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>