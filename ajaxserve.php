<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="design_exercise.css" type="text/css">
    </head>
</html>

<?php

$searchval="";

if(isset($_GET['uid'])){
    $searchval=$_GET['uid'];
}


try{
    $conn=new PDO("mysql:host=localhost:3306;dbname=moviereview",'root','');
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $ex){

}

try{
    $searchquery=
    "SELECT * FROM reviewer WHERE name LIKE '%$searchval%'";
    $object=$conn->query($searchquery);
    $table=$object->fetchAll();
    
    if($object->rowCount()==0){
        echo "<p>User name is Unique</p>";
    }
    else{
        $tablerows="";
        foreach($table as $row){
            if($row[1]==$searchval){
                $tablerows.="<p>$row[1] user name already exists </p>";
            }
            
//                "<tr>  <td>$row[0]</td>  <td>$row[1]</td>     <td>$row[2]</td>    <td>$row[3]</td><td>$row[4]</td>     
            
//            <td><input type='button' value='Update' onclick='updatedata($row[0]);'><input type='button' value='Delete' onclick='deleterow($row[0]);'></td></tr>";
        }
        
        echo $tablerows;
    }
    
}
catch(PDOException $e){
    
}

?>