<?php
session_start();
require_once("connect.php");
require_once("inc/display.php");
$connection = @new mysqli($host,$db_user,$db_password,$db_name);
if($connection){
}
else{
  die(mysqli_error($connection));
}


 if(!isset($_SESSION['search_book']) && !isset($_SESSION['search_genre']) && !isset($_SESSION['search_author']) ){
  header("Location: search_db_page.php");
} 


if(isset($_SESSION['search_book'])){

    $input = $_SESSION['db_search_value'];
    unset($_SESSION['db_search_value']);
    $input = strip_tags($connection->real_escape_string($input));
    $sql = "SELECT * FROM books WHERE title LIKE '%{$input}%';";
    $how_many = "SELECT COUNT(*) as entries FROM books WHERE title LIKE '%{$input}%';";
    $result = $connection->query($sql);
    $result_num = $connection->query($how_many);
    $result_num = mysqli_fetch_assoc($result_num);
    if($result_num['entries'] != 0){
        $empty = false;
    }
    elseif($result_num['entries'] == 0){
        $empty = true;
        $prompt_empty = "Sorry, no results! Maybe you should try again?";
    }
    unset($_SESSION['search_book']);


}



if(isset($_SESSION['search_genre'])){

    $input = $_SESSION['db_search_value'];
    unset($_SESSION['db_search_value']);
    $input = strip_tags($connection->real_escape_string($input));
    $sql = "SELECT * FROM books WHERE genre LIKE '%{$input}%';";
    $how_many = "SELECT COUNT(*) as entries FROM books WHERE genre LIKE '%{$input}%';";
    $result = $connection->query($sql);
    $result_num = $connection->query($how_many);

    $result_num = mysqli_fetch_assoc($result_num);
    if($result_num['entries'] != 0){
        $empty = false;
    }
    elseif($result_num['entries'] == 0){
        $empty = true;
        $prompt_empty = "Sorry, no results! Maybe you should try again?";
    }
    unset($_SESSION['search_genre']);

}




?>









<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookHub - Logged in</title>
    <link rel="stylesheet" href="./styles/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/70082227f2.js" crossorigin="anonymous"></script>
    </head>
    <body>
        
        <div id = "topbanner">
            <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <div class="container-fluid">
              <a class="navbar-brand" href="index.php"> <i class="fa-solid fa-arrow-left"></i> Return to main page</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="navbar-nav me-auto">
                  <li class="nav-item">
                  
                  </li>
                </ul>
              </div>
            </div>
          </nav>
        </div>

        <div class = "container-fluid p-3 justify-content-center">


        <?php if($empty){

           echo '<p class="text-center display-3 text-danger"> <i class="fa-solid fa-triangle-exclamation"></i>'. $prompt_empty .' </p> ';
        } 

        ?>
        
        <p class="text-center display-5 text-primary"> <a href = "search_db_page.php"> <i class="fa-solid fa-database"></i>  Return to search page  </a></p>

        </div>


        <div class = "container-fluid">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Book ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Genre</th>
                
              </tr>
            </thead>



            <tbody>

              <?php


                if($result){
                  while($row = $result->fetch_assoc()){
                    $id = $row['id'];
                    $title = display($row['title']);
                    $author = display($row['author']);
                    $genre = display($row['genre']);
                    

                    echo '<tr>
                    <th scope = "row">'.display($id).'</th>
                    <td><a href ="display_book.php?book_id='.$id.'">'.$title.'</a></td>
                    <td>'.$author.'</td>
                    <td>'.$genre.'</td>
                    </tr>';

                  }
                }

                $connection->close();

              ?>
              
            </tbody>




          </table>
            
        </div>

        










        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>   
    </body>
</html>