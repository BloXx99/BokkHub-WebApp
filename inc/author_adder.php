<?php

session_start();
require_once("../connect.php");

if(!isset($_SESSION['username'])){
    header("Location: index.php");
}

if($_SESSION['status'] != 1 ){
    header("Location: index.php");
}


if(isset($_POST['add_name_surname'])){

    $connection = @new mysqli($host,$db_user,$db_password,$db_name);
    $safe_name_surname = stripslashes($connection->real_escape_string($_POST['add_name_surname']));
    $safe_born = stripslashes($connection->real_escape_string($_POST['add_born']));
    $safe_nation = stripslashes($connection->real_escape_string($_POST['add_nation']));

    $sql = "INSERT INTO authors (name_surname,born,nationality) VALUES ('$safe_name_surname','$safe_born','$safe_nation');";

    if($result = $connection->query($sql)){
        unset($_SESSION['add_author']);
        unset($_POST['add_name_surname']);
        //$result->free_result();
        $connection->close();
        header("Location: adminview_authors.php");


    }

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
          <a class="navbar-brand text-center" href="../index.php"> <i class="fa-solid fa-arrow-left"></i> Return to main page</a>
        </div>
    </nav>

    <div class = "container-fluid">

        <header class = " h5 text-center text-nowrap">
      
         Add new author to database <br>
           
      
        </header>

    <form class = "text-center" method='post'>
        <label for="title"> Name/Surname: </label><br>
        <input type="text" id="title" name="add_name_surname" required><br>
        
        <label for="born"> Born: </label><br>
        <input type="text" id="born" name="add_born"><br>

        
        <label for="nation">Nationality: </label><br>
        <input type="text" id="nation" name="add_nation"><br>
        
        <input type = "submit" value = "Submit">
        
      </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>


