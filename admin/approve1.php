<?php

if(isset($_GET['uaid'])){
    $updateid=$_GET['uaid'];
}
try{
    $conn=new PDO("mysql:host=localhost:3306;dbname=moviereview",'root','');

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $ex){
    echo "<script>window.alert('db connection errror')</script>";
}

try{
    $updatequery="UPDATE review SET point='0', approve='1' WHERE r_id='$updateid'";

    $conn->exec($updatequery);
    echo "<script>window.alert('update successful.');</script>";
    header('location: admin.php');


}
catch(PDOException $e){
    echo "<script>window.alert('update error');</script>";
}
?>