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

if(!isset($_GET['author_id'])){

  header("Location: db_search_page.php");
}

$author_id = $_GET['author_id'];

$sql = "SELECT * FROM authors where id = $author_id;";
$result = $connection->query($sql);
unset($_GET['author_id']);
$row = $result->fetch_assoc();

$author = $row['name_surname'];
$born = $row['born'];
$nation = $row['nationality'];
mysqli_free_result($result);

$sql = "SELECT * FROM books WHERE author ='$author';";
$count_sql = "SELECT COUNT(*) AS entries FROM books WHERE author ='$author';";

$result2 = $connection->query($sql);
$result_count = $connection->query($count_sql);
$count = $result_count->fetch_assoc();
$count = $count['entries'];
echo $count;
mysqli_free_result($result_count);

?>





<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookPage</title>
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


        <div class="container-fluid">
            
        <p class="text-center display-3 text-danger"> <i class="fa-solid fa-feather-pointed"></i> Author Page  </p>


        </div>

        <div class="container-fluid">
            
        <p class="text-center h3 text-primary"> <i class="fa-solid fa-minus"></i>  <?php echo $author; ?>  </p>

        </div>


        <div class="container-fluid">
            
        <p class="text-center h3 text-primary"> <i class="fa-solid fa-minus"></i> Born:  <?php echo display($born); ?>   </p>

        </div>


        <div class="d-flex  justify-content-center">
            
        <p class="text-center h3 text-primary"> <i class="fa-solid fa-minus"></i>  Nationality:  <?php echo display($nation); ?>   </p>

        </div>
        <br>
        <br>
        <p class="text-center display-5 text-primary"> <a href = "search_db_page.php"> <i class="fa-solid fa-database"></i>  Return to search page  </a></p>
        <br>
        <div class="container-fluid">
            
        <p class="text-center h3 text-primary"> <i class="fa-solid fa-minus"></i>Books by:  <?php echo $author; ?>   </p>

        </div>
        <br>
        
        <div class = "container-fluid">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Book ID</th>
                <th>Title</th>
                <th>Genre</th>
                
              </tr>
            </thead>



            <tbody>

              <?php


                if($result2){
                  while($row = $result2->fetch_assoc()){
                    $id = $row['id'];
                    $title = display($row['title']);
                    $genre = display($row['genre']);
                    

                    echo '<tr>
                    <th scope = "row">'.display($id).'</th>
                    <td><a href ="display_book.php?book_id='.$id.'">'.$title.'</a></td>
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