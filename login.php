

<?php
session_start();
require_once("connect.php");
$connection = @new mysqli($host,$db_user,$db_password,$db_name);
if ($connection->connect_error){
    die("Connection failed: ".$connection->connect_error);
}
else{

    $username = $_POST['username'];
    $password = $_POST['password'];
    $safe_username = $connection->real_escape_string($username);
    $safe_password = $connection->real_escape_string($password);
    $sql= "SELECT * FROM user_list WHERE username = '$safe_username' AND password = MD5('$safe_password')";

    if($result = $connection->query($sql))
    {
        $num_users = $result->num_rows;
        if($num_users == 1)
        {   
            $row = $result->fetch_assoc();
            $_SESSION['username'] = $row['username'];
            $_SESSION['status'] = $row['user_status'];
            $_SESSION['logged_id'] = $row['id'];
            echo "User found!"."<br>";
            echo "<a href = 'index.php'> Return to main page</a>";
            unset($_POST['username']);
            unset($_POST['password']);

        }
        else if($num_users > 1)
        {

            echo "More than 1 user found. Contact admin."."<br>";
            echo "<a href = 'login_page.html'> Return to login page </a>";
            unset($_POST['username']);
            unset($_POST['password']);

        }
        else if($num_users == 0)
        {

            echo "No users found"."<br>";
            echo "<a href = 'login_page.html'> Return to login page</a>";
            unset($_POST['username']);
            unset($_POST['password']);

        }



        $result->free_result();
    }



    $connection->close();

}

?>