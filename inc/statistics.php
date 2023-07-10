<?php
require_once('../connect.php');
session_start();
if(!isset($_SESSION['username'])){
  header("Location: ../index.php");
}

$users_total_query = "SELECT COUNT(*) as entries FROM user_list;";
$users_7days_query = "SELECT COUNT(*) as entries FROM user_list
WHERE created_at > DATE_SUB(NOW(), INTERVAL 7 DAY);";

$books_total_query = "SELECT COUNT(*) as entries FROM books;";


$authors_total_query = "SELECT COUNT(*) as entries FROM authors;";


$propositions_query_total = "SELECT COUNT(*) as entries FROM propositions;";

$admins = "SELECT COUNT(*) as entries FROM user_list WHERE user_status = 1 ;";


$connection = @new mysqli($host,$db_user,$db_password,$db_name);
if ($connection->connect_errno){
    die("Connection failed: ".$connection->connect_error);  
    sleep(5);
    header("Location: ../index.php");
}


$users_result = $connection->query($users_total_query);
$users_7days_result = $connection->query($users_7days_query);
$books_result = $connection->query($books_total_query);
$authors_result = $connection->query($authors_total_query);
$propositions_result = $connection->query($propositions_query_total);
$admins_result = $connection->query($admins);

$row1 = mysqli_fetch_assoc($users_result);
$result1 = $row1['entries'];
$row2 = mysqli_fetch_assoc($users_7days_result);
$result2 = $row2['entries'];
$row3 = mysqli_fetch_assoc($books_result);
$result3 = $row3['entries'];
$row4 = mysqli_fetch_assoc($authors_result);
$result4 = $row4['entries'];
$row5 = mysqli_fetch_assoc($propositions_result);
$result5 = $row5['entries'];
$row6 = mysqli_fetch_assoc($admins_result);
$result6 = $row6['entries'];




$connection->close();


?>


<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistics page</title>
    <link rel="stylesheet" href="./styles/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/70082227f2.js" crossorigin="anonymous"></script>
    </head>
    <body>
        
        <div id = "topbanner">
            <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <div class="container-fluid">
              <a class="navbar-brand" href="../index.php">Return to main page</a>
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

          <p class="text-center display-3 text-primary" id = "subtitle"> <i class="fa-solid fa-chart-simple"></i>  Statistics page </p>
      
        </div>
        
        <br>

        <div class = 'container-fluid'>
          <p class = 'h3 text-center'>  USERS INFO  </p>
          <p class = 'h5 text-center'>  Total users:      <?php echo $result1;    ?>  </p>
          <p class = 'h5 text-center'>  New users this week:      <?php  echo $result2;   ?>  </p>
          <p class = 'h5 text-center'>  Administrators:      <?php  echo $result6;   ?>  </p>
          <br>
          <p class = 'h3 text-center'>  BOOKS INFO  </p>
          <p class = 'h5 text-center'>  Total books:      <?php echo $result3;    ?>  </p>
          <br>
          <p class = 'h3 text-center'>  AUTHORS INFO  </p>
          <p class = 'h5 text-center'>  Total authors:      <?php echo $result4;    ?>  </p>
          <br>
          <p class = 'h3 text-center'>  PROPOSITIONS INFO  </p>
          <p class = 'h5 text-center'>  Total propositions:      <?php echo $result5;    ?>  </p>
        
        </div>



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>   
    </body>
</html>