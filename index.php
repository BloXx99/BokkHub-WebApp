<?php
    session_start();
    if(!isset($_SESSION['username']))
    {
        header("Location: landing.html");
    }
    if(isset($_SESSION['username']))
    {
        header("Location: inc/landing_logged.php");
    }

?>