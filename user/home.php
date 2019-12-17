

<?php
$po=1;
$uid="";
$rat="";
//session_start();
//$uuid=$_SESSION['name'];

if(empty($_SESSION)) // if the session not yet started 
    session_start();

if(!isset($_SESSION['name'])) { //if not yet logged in
    header("Location: ../home.php");// send to login page
    exit;
}

try{
    $conn=new PDO("mysql:host=localhost:3306;dbname=moviereview",'root','');
    echo "<script>console.log('database connected');</script>";

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
}
catch(PDOException $ex){
    echo "<script>window.alert('database connection error');</script>";
}




?>
<!DOCTYPE html>
<html>
    <head>
        <title>Movie Review</title>
        <link rel="stylesheet" href="design_exercise1.css" type="text/css">
        <!--        <meta name="viewport" content="width=device-width, initial-scale=1">-->


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

//                        $s1=$conn->prepare("SELECT * FROM review ORDER BY RAND() LIMIT 1");
//
//                        $s1->setFetchMode(PDO::FETCH_ASSOC);
//                        $s1->execute();
//                        $data1=$s1->fetch();
////                        if($data1['name']==$uuid){
//                            $uid=$data1['u_id'];
////                            //            $uidt=$_POST[$uid];
////                        }
                    
                    try{
                        $sqlquery="Select * from review WHERE point='$po' ORDER BY RAND() LIMIT 2";
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
                    <div style="height:250px;width:150px;"><img src="../image/<?php echo $data['poster']?>" height="100%" width="100%"></div>
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
            
        </div>


        <script>
            // Get the modal
            var modal = document.getElementById('id01');

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        </script>



    </body>
</html>
