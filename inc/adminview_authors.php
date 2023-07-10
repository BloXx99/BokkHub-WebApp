<?php
session_start();
require_once("../connect.php");
require_once("display.php");
$connection = @new mysqli($host,$db_user,$db_password,$db_name);
if($connection){
}
else{
  die(mysqli_error($connection));
}
$query = "SELECT * FROM authors";
$result = $connection->query($query);





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
              <a class="navbar-brand" href="../index.php"> <i class="fa-solid fa-arrow-left"></i> Return to main page</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="navbar-nav me-auto">
                  <li class="nav-item">
                    <a class="nav-link" href="add_record.php?add_author=true"> <i class="fa-solid fa-plus"></i> Add record</a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
        </div>

        <div class = "container-fluid">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Author ID</th>
                <th>Name + Surname</th>
                <th>Born</th>
                <th>Nationality</th>
              </tr>
            </thead>



            <tbody>

              <?php


                if($result){
                  while($row = $result->fetch_assoc()){
                    $id = display($row['id']);
                    $name = display($row['name_surname']);
                    $born = display($row['born']);
                    $nationality = display($row['nationality']);

                    echo '<tr>
                    <th scope = "row">'.$id.'</th>
                    <td>'.$name.'</td>
                    <td>'.$born.'</td>
                    <td>'.$nationality.'</td>
                    <td>
                    <button class="btn btn-primary"><a href = "../update.php?update_author_id='.$id.'" class="text-light"> Update data </a></button>
                    <button class="btn btn-danger"><a href = "../delete.php?delete_author_id='.$id.'" class="text-light"> Delete record </a></button>
                    </td>
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