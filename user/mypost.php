<?php
if(empty($_SESSION)) // if the session not yet started 
    session_start();

if(!isset($_SESSION['name'])) { //if not yet logged in
    header("Location: ../home.php");// send to login page
    exit;
}

$mid="";

$midt="";
$uidt="";

$post="";
$point="";
$app="";
//used
$rat="";
$uid="";
$uuid=$_SESSION['name'];
$p1="1";
$p=0;
$a=0;
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="design_exercise1.css" type="text/css">

    </head>
    <body>

        <div>
            <div class="logo">
                <a href="home.php">Movie Review</a>
            </div>
            <nav id="navbar">
                <ul>
                    <li><a href="home.php">Home</a> </li>
                    <li><a href="post.php">Post Review</a> </li>
                    <li><a href="mypost.php">My Post</a> </li>

                    <!--                   <li> <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Post Review</button></li>-->
                    <!--
<li><input type="search" id="search" name="search" placeholder="Enter movie name"></li>
<li><input type="button" id="bttn" value="Search" ></li>
-->
                </ul>
                <ul>
                    <input type="search" id="search" name="search" placeholder="Enter movie name">
                    <input type="button" id="bttn" value="Search" >
                </ul>
                <ul>
                    <li><a href="logout.php">LogOut</a> </li>
                </ul>
            </nav>
        </div>

        <div class="row">
            <div class="leftcolumn">
                <div class="card">
                    <?php
                    try{
                        $conn=new PDO("mysql:host=localhost:3306;dbname=moviereview",'root','');

                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        $s1=$conn->prepare("SELECT * FROM reviewer WHERE name = '$uuid'");

                        $s1->setFetchMode(PDO::FETCH_ASSOC);
                        $s1->execute();
                        $data1=$s1->fetch();
                        if($data1['name']==$uuid){
                            $uid=$data1['u_id'];
                            //            $uidt=$_POST[$uid];
                        }
                    }
                    catch(PDOException $ex){
                        echo "<script>window.alert('db connection errror')</script>";
                    }
                    try{
                        $sqlquery="Select * from review WHERE u_id='$uid' AND point='$p1'";
                        $object=$conn->query($sqlquery);
                        //                    $table=$object->fetchAll();
                        if($object->rowCount() == 0){ /// 0 meaning no data exists in the database
                    ?>
                    
                         <h3 style="text-align:center;"> No Data Found!!!</h3>  
                        
                    <?php  
                        }
                        else{
                            $table=$object->fetchAll();
                            foreach($table as $row){
                                $rat=$row[6];
                                $s=$conn->prepare("SELECT * FROM movie WHERE m_id='$rat'");

                                $s->setFetchMode(PDO::FETCH_ASSOC);

                                $s->execute();

                                $data=$s->fetch();

                    ?>
                    
                    
                    <h2><?php echo $data['m_name'] ?></h2>
                    <h4>Genre:<?php echo $data['genre'] ?></h4>
                    <div style="height:400px;width:200px;"><img src="../image/<?php echo $data['poster']?>" height="100%" width="100%"></div>
                    <h4>Review:</h4>
                    <p><?php echo $row[2] ?></p>
                    
                </div>
                
                <?php
                            }
                        } 

                    }

                    catch(PDOException $e){
                        echo "<script>window.alert('query errror')</script>";
                    }
                    ?>
            

            </div>
            <div class="rightcolumn">



            </div>
        </div>

    </body>
</html>