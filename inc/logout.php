<?php
    session_start();
    unset($_SESSION['username']);
    unset($_SESSION['status']);
    unset($_SESSION['logged_id']);
    header("location: ../index.php");
?>