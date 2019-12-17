<?php

if(empty($_SESSION)) // if the session not yet started 
    session_start();

if(!isset($_SESSION['name'])) { //if not yet logged in
    header("Location: ../home.php");// send to login page
    exit;
}

$uuid=$_SESSION['name'];
?>

<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <body>
        <h3 style="text-align:center;color:#0066ff;">Thanks for the movie review</h3>
        <h4  style="text-align:center;color:#339933">Wait for Admin Approval!!</h4>
        <h4  style="text-align:center;color:#339933"><a href="home.php">Home</a></h4>
        <h4  style="text-align:center;color:#339933"><a href="logout.php">LogOut</a></h4>
<!--
        <div style="width: 150px; height: 40px;text-align: center;display: inline-block;float: center;">
            <a href="home.php">Home</a>

        </div>
-->
    </body>
</html>