<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="design_exercise.css" type="text/css">
    </head>
</html>

<?php

$val="";

if(isset($_GET['mid'])){
    $val=$_GET['mid'];
}


try{
    $conn=new PDO("mysql:host=localhost:3306;dbname=moviereview",'root','');
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $ex){

}

try{
    $query= "SELECT * FROM reviewer WHERE email LIKE '%$val%'";
    $obj=$conn->query($query);
    $tabl=$obj->fetchAll();
    
    if($obj->rowCount()==0){
        echo "<p>Email is unique</p>";
    }
    else{
        $tablerows1="";
        foreach($tabl as $row){
            if($row[2]==$val){
                $tablerows1.="<p>$row[2] email already exists </p>";
            }
            
//                "<tr>  <td>$row[0]</td>  <td>$row[1]</td>     <td>$row[2]</td>    <td>$row[3]</td><td>$row[4]</td>     
            
//            <td><input type='button' value='Update' onclick='updatedata($row[0]);'><input type='button' value='Delete' onclick='deleterow($row[0]);'></td></tr>";
        }
        
        echo $tablerows1;
    }
    
}
catch(PDOException $e){
    
}

?>