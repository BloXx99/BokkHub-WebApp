<?php
    require_once("connect.php");
    $connection = @new mysqli($host,$db_user,$db_password,$db_name);
    if ($connection->connect_error){
        die("Connection failed: ".$connection->connect_error);
    }

    if(isset($_GET['delete_book_id'])){
        $book_to_delete = $_GET['delete_book_id'];
        $sql = "DELETE FROM books WHERE id = {$book_to_delete}";
        $result = $connection->query($sql);
        if($result){
            header("Location: inc/adminview_books.php");

        }
        else{
            echo "Something went wrong";
        }

    }
    if(isset($_GET['delete_user_id'])){
        $user_to_delete = $_GET['delete_user_id'];
        $sql = "DELETE FROM user_list WHERE id = {$user_to_delete}";
        $result = $connection->query($sql);
        if($result){
            header("Location: inc/adminview_users.php");

        }
        else{
            echo "Something went wrong";
        }


    }
    else{
        //header("Location: inc/adminview_books.php");
        echo "blad";
    }




    if(isset($_GET['delete_author_id'])){
        $author_to_delete = $_GET['delete_author_id'];
        $sql = "DELETE FROM authors WHERE id = {$author_to_delete}";
        $result = $connection->query($sql);
        if($result){
            header("Location: inc/adminview_authors.php");

        }
        else{
            echo "Something went wrong";
        }


    }

    if(isset($_GET['delete_propo_id'])){
        $propo_to_delete = $_GET['delete_propo_id'];
        $sql = "DELETE FROM propositions WHERE id = {$propo_to_delete}";
        $result = $connection->query($sql);
        header("Location: inc/adminview_propositions.php");

        


    }




    else{
        //header("Location: inc/adminview_authors.php");
        echo "blad";
    }




?>