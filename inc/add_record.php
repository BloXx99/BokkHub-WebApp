<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: index.php");
}
if(isset($_GET['add_book'])){

    $_SESSION['add_book'] = $_GET['add_book'];
    header("Location: book_adder.php");

}

if(isset($_GET['add_author'])){

    $_SESSION['add_author'] = $_GET['add_author'];
    header("Location: author_adder.php");

}

?>