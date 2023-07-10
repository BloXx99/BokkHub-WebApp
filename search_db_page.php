<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: ../index.php");
  }





?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/70082227f2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles.css">

    <title>Search page</title>
</head>

<body>

<div id = "topbanner">
            <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <div class="container-fluid">
              <a class="navbar-brand" href="../index.php">  <i class="fa-solid fa-arrow-left"></i>   Return to main page</a>
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


<div class = "container-fluid" id = "page-prompt"> 


<p class="text-center display-3 text-primary" id = "subtitle"> <i class="fa-solid fa-magnifying-glass"></i>  Search for something  </p>

</div>


<p class = "text-center text-black fs-3 p-2">    Look for authors, genres and books!         </p>









<div class="form-check">
      <form  class = "text-center" method = "post" action = "search_junction.php">
        
        <div class="d-flex justify-content-center">
            <input type="text" class="form-control w-50" id="exampleFormControlTextarea1" placeholder = "Type here" name = "db_search_value" required ></textarea>
        </div>

        
        <label for = 'book'> Book </label>
        <input id = 'book' type="radio" name ="search_for" value="1">
        <label for = 'author'> Author </label>
        <input id = 'author' type="radio" name ="search_for" value="2">
        <label for = 'genre'> Genre </label>
        <input id = 'genre' type="radio" name ="search_for" value="3">
        <br>

        <input type="reset" value = "Reset fields" class = "btn btn-danger">
        <br>
        <input type = "submit" value = "Submit" class = "btn btn-primary">
      </form>
</div>


<div class = "d-flex justify-content-center p-3">
<img class="img-rounded" style = "max-width:60%; max-height:60%;" src="img/search_img.jpg" alt="Search photo">
</div>










<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script> 
</body>

</html>