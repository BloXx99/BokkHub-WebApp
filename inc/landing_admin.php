<?php
session_start();
if(!isset($_SESSION['username'])){
  header("Location: ../index.php");
  
}

require_once("../connect.php");
require_once("display.php");
$connection = @new mysqli($host,$db_user,$db_password,$db_name);
if($connection){
}
else{
  die(mysqli_error($connection));
}

$sql = "SELECT COUNT(*) AS entries FROM propositions";
$result = $connection->query($sql);
$count = $result->fetch_assoc();
$count = $count['entries'];
mysqli_free_result($result);
$connection->close();

?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookHub - Logged in</title>
    <link rel="stylesheet" href="../styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/70082227f2.js" crossorigin="anonymous"></script>
    </head>
    <body>
        
        <div id = "topbanner">
            <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <div class="container-fluid">
              <a class="navbar-brand" href="../index.php">BookHub</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="navbar-nav me-auto">
                  <li class="nav-item">
                    <a class="nav-link" href="../account_view.php"><i class="fa-solid fa-user"></i> Account</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="../search_db_page.php"> <i class="fa-solid fa-database"></i> Search in Database</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="../user_modifies_data.php"> <i class="fa-solid fa-person-booth"></i> Modify my data</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="adminview_users.php"> <i class="fa-solid fa-user-group"></i> Users table</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="adminview_books.php"> <i class="fa-solid fa-book-bookmark"></i> Books table</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="adminview_authors.php"> <i class="fa-solid fa-feather-pointed"></i> Authors table</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="adminview_propositions.php"> <i class="fa-solid fa-bell"></i> Propositions</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="statistics.php"> <i class="fa-solid fa-chart-simple"></i> Statistics</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="logout.php"> <i class="fa-solid fa-arrow-right-from-bracket"></i> Log Out</a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
        </div>

        <div class = "container-fluid">
            <p class="text-center display-3 text-primary" id = "subtitle"> <i class="fa-solid fa-handshake"></i> Welcome, <?php echo $_SESSION['username'];?> </p><br>
            <p class="text-center display-5" id = "subtitle">  Nice to meet you today! </p>
        </div>

        <br><br><br>

        <div class = "container-fluid">
        <p class="text-center display-6 text-primary" id = "subtitle"> <i class="fa-solid fa-lightbulb"></i>  You have awaiting propositions to review: <?php echo $count; ?>  </p>
        </div>


        <div class = "d-flex">    
          <footer class="bg-dark py-1">
  

            <p class = "text-center text-white"> <i class="fa-solid fa-user-tie"></i> Made at TU Gdansk by Konrad Block  </p>


          </footer>
        </div>   



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>   
    </body>
</html>