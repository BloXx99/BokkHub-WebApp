<?php
session_start();

require_once('connect.php');
$connection = @new mysqli($host,$db_user,$db_password,$db_name);
if ($connection->connect_errno){
    die("Connection failed: ".$connection->connect_error);  
    sleep(5);
    header("Location: index.php");
  }
  if(isset($_POST['modify_nickname'])){

    $modify_nickname = $_POST['modify_nickname'];
    $modify_password = $_POST['modify_password'];
    $modify_email = $_POST['modify_email'];
    $safe_modify_nickname= strip_tags($connection->real_escape_string($modify_nickname));
    $safe_modify_password = strip_tags($connection->real_escape_string($modify_password));
    $safe_modify_email = strip_tags($connection->real_escape_string($modify_email));
    $active_user = $_SESSION['username'];

    $all_ok = true;
    $change_nick = false;
    $change_pass = false;
    $change_mail = false;
    $user_exists_check_sql= "SELECT * FROM user_list WHERE username = '{$safe_modify_nickname}'";
    if($result = $connection->query($user_exists_check_sql)){
        $num_users = $result->num_rows;
        if($num_users != 0){
            $all_ok = false;
            $error_string = "User with that name already exists!";
            $_SESSION['e_user_exists'] = $error_string;
            $result->free_result();
            //return 0;
        }
        else{
            $result->free_result();
        }
        
    }

    if(strlen($safe_modify_nickname) != 0){
        if(strlen($safe_modify_nickname) > 3 && strlen($safe_modify_nickname) < 25){
          
            $change_nick = true;  
        }
        else{
            $all_ok = false;
            $error_string = 'Username needs to have between 3 and 25 characters';
            $_SESSION['e_nick'] = $error_string;
        }
       
    }
    if(strlen($safe_modify_nickname) == 0){
        
        $change_nick = false;

    }

    if(strlen($safe_modify_password) != 0){
        if(strlen($safe_modify_password) > 6 && strlen($safe_modify_password) < 40 ){
           
            $change_pass = true; 
        }
        else{
            $all_ok = false;
            $error_string = 'Password needs to be between 7 and 40 characters!';
            $_SESSION['e_password'] = $error_string;
        }
        
    }

    if(strlen($safe_modify_password) == 0){

        
        $change_pass = false;

    }

    if(strlen($safe_modify_email) == 0){
        
        $change_mail = false;

    }

    if(strlen($safe_modify_email) != 0){
        
        $change_mail = true;

    }

    if($all_ok){
        if($change_mail == false && $change_pass == false && $change_nick == false){
            $connection->close();
            echo "No changes to user data were made.";
            sleep(2);
            unset($_POST['modify_nickname']);
            header("Location: index.php");
        }
        else{
            $update_query = "UPDATE user_list SET";
            //echo "$update_query";

            if($change_nick){
                $update_query = $update_query . " username = '{$safe_modify_nickname}'";
            }
            if(!$change_nick){
                $update_query = $update_query . " username = '{$active_user}'";
            }
            if($change_pass){
                $update_query = $update_query . ", password = MD5('{$safe_modify_password}')";
            }
            if($change_mail){
                $update_query = $update_query . ", email ='{$safe_modify_email}'";
            }
            echo $update_query;
            $update_query = $update_query . " WHERE username = '{$_SESSION['username']}';";
            $result = $connection->query($update_query);
            if(!$result){
                echo "Update error";
            }
            if($result){
                $_SESSION['change_success'] = "Data change succesfull. You will be log out and sent to main page.";
                unset($_SESSION['username']);
                header("Location: index.php");
            }
        }  
    }
    




  } //isset post end
  
  $connection->close();
  



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
    <script src="https://kit.fontawesome.com/70082227f2.js" crossorigin="anonymous"></script>

</head>
<body>

    

  <div id = "topbanner">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php"><i class="fa-solid fa-arrow-left"></i> Return to home page</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="mynavbar">
        <ul class="navbar-nav me-auto">
        </ul>
      </div>
    </div>
  </nav>
</div>
    



<div class = "container-fluid">

    <p class="text-center display-6 text-primary" id = "subtitle"> Modify your account data. </p>

</div>

<div class = "container-fluid">

<header class = " h5 text-center text-nowrap"> If you don't want to modify a field - leave it empty.</header>
<header class = " h5 text-center text-nowrap"> You will be logged out after successful data change.</header>

</div>
<form class = "text-center" method='post'>

 <label for="username_change">New username: </label><br>
 <input type="text" id="username_change" name="modify_nickname"><br>
 <?php 
          if(isset($_SESSION['e_nick'])){
            echo "<p class='alert alert-primary' role='alert'>". $_SESSION['e_nick']. "</p>";
            unset($_SESSION['e_nick']);
          }
          if(isset($_SESSION['e_user_exists'])){
            echo "<p class='alert alert-primary' role='alert'>". $_SESSION['e_user_exists']. "</p><br>";
            unset($_SESSION['e_user_exists']);
          } 
    ?>
 <label for="password_change">New password: </label><br>
 <input type="password" id="password_change" name="modify_password"><br>
 <?php 
          if(isset($_SESSION['e_password'])){
            echo "<p class='alert alert-primary' role='alert'>". $_SESSION['e_password']. "</p><br>";
            unset($_SESSION['e_password']);
          }
    ?>

 <label for="email_change">New e-mail: </label><br>
 <input type="text" id="email_change" name="modify_email">
 <br><br>
 <input type = "submit" class="btn btn-primary" value = "Submit">

</form>
<br>
<div class = "container-fluid">


<?php
    if(isset($_SESSION['change_success']))
    {
        echo "<header class = ' h5 text-center text-nowrap'>".$_SESSION['change_success']."</header>";
        unset($_SESSION['change_success']);
    }
?>

</div>

















    
        



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>
