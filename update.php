<?php
session_start();



if (isset($_GET['update_author_id'])){
    $_SESSION['update_author_id'] = $_GET['update_author_id'];
    header("Location: modifying_author.php");
}

elseif (isset($_GET['update_book_id'])){
    $_SESSION['update_book_id'] = $_GET['update_book_id'];
    header("Location: modifying_book.php");
    
}
elseif (isset($_GET['update_user_id'])){
    $_SESSION['update_user_id'] = $_GET['update_user_id'];
    header("Location: modifying_user.php");
}
else{
    echo "GET header error. Check links in Table view."."<br>";
    sleep(3);
    header("Location: index.php");
}
?>