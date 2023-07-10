<?php
session_start();
if(isset($_SESSION['username'])){
    header("Location: account_page.php");
}
else{
    echo "Something went wrong. Moving you to main page..."."<br>";
    sleep(3);
    header("Location: index.php");
}













?>