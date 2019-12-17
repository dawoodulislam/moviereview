<!DOCTYPE html>
<html>
    <head>
<!--        <link rel="stylesheet" href="design_exercise.css" type="text/css">-->
    </head>
</html>

<?php

$searchval="";

if(isset($_GET['mid'])){
    $searchval=$_GET['mid'];
}


try{
    $conn=new PDO("mysql:host=localhost:3306;dbname=moviereview",'root','');
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $ex){

}

try{
    $searchquery=
    "SELECT * FROM movie WHERE m_name LIKE '%$searchval%'";
    $object=$conn->query($searchquery);
    $table=$object->fetchAll();
    
    if($object->rowCount()==0){
//        echo "<p></p>";
    }
    else{
        $tablerows="";
        foreach($table as $row){
            if($row[1]==$searchval){
            $tablerows.="<p>Genre: $row[2]</p>";
            }
        }
        
        echo $tablerows;
    }
    
}
catch(PDOException $e){
    
}

?>