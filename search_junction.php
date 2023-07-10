<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: ../index.php");
  }


if(isset($_POST['search_for']) && ($_POST['search_for'] == "1") ){

    $_SESSION['search_book'] = true;
    $_SESSION['db_search_value'] = $_POST['db_search_value'];
    unset($_POST['db_search_value']);
    header("Location: search_book.php");


}


if(isset($_POST['search_for']) && ($_POST['search_for'] == "2") ){

    $_SESSION['search_author'] = true;
    $_SESSION['db_search_value'] = $_POST['db_search_value'];
    unset($_POST['db_search_value']);
    header("Location: search_author.php");

}



if(isset($_POST['search_for']) && ($_POST['search_for'] == "3" )){

    $_SESSION['search_genre'] = true;
    $_SESSION['db_search_value'] = $_POST['db_search_value'];
    unset($_POST['db_search_value']);
    header("Location: search_book.php");



}



if(isset($_POST['search_for']) && ($_POST['search_for'] == "4" )){

    unset($_POST['db_search_value']);
    header("Location: search_book.php");


}





?>

