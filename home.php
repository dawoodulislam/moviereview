

<?php
$po=1;
$rat="";
$uid="";

//            $updateid=-1;
//            $_SESSION['reviewers']="";

//            if(isset($_GET['uid'])) $updateid=$_GET['uid'];

try{
    $conn=new PDO("mysql:host=localhost:3306;dbname=moviereview",'root','');
    echo "<script>console.log('database connected');</script>";

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(isset($_POST["sbmt"])) {	
        $usern=$_POST["uname"];
        $upass=$_POST["pdw"];
        $s=$conn->prepare("select * from reviewer where name = '$usern' AND pwd = '$upass'");
        //                        $s->execute();
        //		$object=$conn->query($s);
        //          console.log($object);              
        //	$q=mysqli_query($conn,$s);
        //	$r=mysqli_num_rows($q);
        //	mysqli_close($conn);
        //                        $count=$s->rowCount();
        //                        print(" $count rows.\n");

        $s->setFetchMode(PDO::FETCH_ASSOC);
        $s->execute();
        $data=$s->fetch();
        if($data['name']==$usern)
        {
            session_start();
            $_SESSION['name']=$usern;
            //       $_SESSION['reviewrers']="yes";
            //header("location:donor/index.php");
            // echo "<script>location.assign('post.php');</script>";
            header('location: user/post.php');
        }
        else
        {
            echo "<script>alert('Invalid User Name Or Password');</script>";
        }

    }	
}
catch(PDOException $ex){
    echo "<script>window.alert('database connection error');</script>";
}




?>
<!DOCTYPE html>
<html>
    <head>
        <title>Movie Review</title>
        <link rel="stylesheet" href="design_exercise.css" type="text/css">
<!--        <link rel="stylesheet" href="css.css" type="text/css">-->
        <!--        <meta name="viewport" content="width=device-width, initial-scale=1">-->


    </head>
    <body>
        <div style="width=100%;">
            <div class="logo">
                <a href="home.php">Movie Review</a>
            </div>
            <div>
            <nav id="navbar">
                <ul>
                    <li><a href="home.php">Home</a> </li>
                    <li><a onclick="document.getElementById('id01').style.display='block'">Post Review</a> </li>
                    <li><a href="login.php">Sign In</a> </li>
                    <li><a href="signup.php">Sign Up</a> </li>
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
            </nav>
            </div>
        </div>
         <div>
             <h1>Movie Review Post</h1>
        </div>
        <div id="id01" class="modal">

            <form class="modal-content animate" method="post">
                <div class="imgcontainer">
                    <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                    <!--      <img src="img_avatar2.png" alt="Avatar" class="avatar">-->
                    <h4>Login To Post Review</h4>
                </div>

                <div class="container">
                    <label for="uname"><b>Username</b></label>
                    <input type="text" placeholder="Enter Username" name="uname" required>

                    <label for="pdw"><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="pdw" required>

                    <button type="submit" name="sbmt">Login</button>
                    <label>
                        <input type="checkbox" checked="checked" name="remember"> Remember me
                    </label>
                </div>

                <div class="container" style="background-color:#f1f1f1">
                    <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                    <span class="psw">Don't have an account? <a href="signup.php">SignUp</a></span>
                </div>
            </form>
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
                        $sqlquery="Select * from review WHERE point='$po' ORDER BY RAND() LIMIT 2 ";
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
                    <div>
                    <h2><?php echo $data['m_name'] ?></h2>
                        </div>
                    <h4>Genre:<?php echo $data['genre'] ?></h4>
                    <div style="height:250px;width:150px;"><img src="image/<?php echo $data['poster']?>" height="100%" width="100%"></div>
                    <h4>Review:</h4>
                    <p><?php echo $row[2] ?></p>

                

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
