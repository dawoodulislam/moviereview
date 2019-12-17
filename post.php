<?php
session_start();
echo "welcome". $_SESSION['name'];
if(isset($_POST['logout'])){
    session_start();
    session_destroy();
    
    header('location: home.php');
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Logged In</title>
    </head>
    <body>
        <form method="post" name="logout">
            <input type="submit" name="logout" value="Log Out">
        </form>
    </body>
</html>