<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: index.php");
}
require_once("connect.php");
$connection = @new mysqli($host,$db_user,$db_password,$db_name);
if($connection->connect_error){
    die("Connection failed: ".$connection->connect_error);
    sleep(5);
    header("Location: index.php");
}
$name = $_SESSION['username'];
$sql = "SELECT username, email, user_status, created_at FROM user_list WHERE username = '$name'";

$result = $connection->query($sql);
if(!$result){
    echo "Database error";
    sleep(3);
    header("Location: index.php");
}
else{
    $row = $result->fetch_assoc();
    $username = $row['username'];
    if($row['email'] == NULL){
        $email = "Not given";
    }
    else{
        $email = $row['email'];
    }
    if($row['user_status'] == 0){
        $user_status = "User";
    }
    else{
        $user_status = "Admin";
    }
    $date = new DateTime($row['created_at']);
    $result->free_result();
    $connection->close();
}

?>




<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookHub - Logged in</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/70082227f2.js" crossorigin="anonymous"></script>
    </head>
    <body>
        
        <div id = "topbanner">
            <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <div class="container-fluid">
              <a class="navbar-brand" href="../index.php"> <i class="fa-solid fa-arrow-left"></i> Return to main page</a>
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

        <p class="text-center display-6 text-primary"> <i class="fa-solid fa-user"></i> Username: <?php echo $username;?>  </p>
            
        </div>

        <div class = "container-fluid">

        <p class="text-center display-6 text-primary"> <i class="fa-solid fa-at"></i>  Email: <?php echo $email; ?>  </p>
            
        </div>

        <div class = "container-fluid">

        <p class="text-center display-6 text-primary"> <i class="fa-solid fa-circle-exclamation"></i> Status: <?php echo $user_status; ?>  </p>
            
        </div>

        <div class = "container-fluid">

        <p class="text-center display-6 text-primary"> <i class="fa-solid fa-calendar-days"></i>  Created at: <?php echo $date->format('Y-m-d'); ?>  </p>
            
        </div>



        <div class = "d-flex">    
          <footer class="bg-dark py-1">
  

            <p class = "text-center text-white"> <i class="fa-solid fa-user-tie"></i> Made at TU Gdansk by Konrad Block  </p>


          </footer>
        </div>   














        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>   
    </body>
</html>