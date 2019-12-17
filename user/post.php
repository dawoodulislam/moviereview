<?php

if(empty($_SESSION)) // if the session not yet started 
    session_start();

if(!isset($_SESSION['name'])) { //if not yet logged in
    header("Location: ../home.php");// send to login page
    exit;
}

$mid="";
$uid="";
$midt="";
$uidt="";
$rat="";
$post="";
$point="";
$app="";
$uuid=$_SESSION['name'];

echo $uuid;



try{
    $conn=new PDO("mysql:host=localhost:3306;dbname=moviereview",'root','');
    echo "<script>console.log('database connected');</script>";

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



    if(isset($_POST["pst"])){
        $post=$_POST['mname'];
        $rat=$_POST['urev'];

        //        echo $post;

        //        $mid="SELECT m_id FROM movie WHERE m_name = '%$post%'";
        //        $uid="SELECT u_id FROM reviewer WHERE name = '%$uuid%'";


        //        $s=$conn->query("SELECT m_id FROM movie WHERE m_name = '$uid' limit 1");
        $s=$conn->prepare("SELECT * FROM movie WHERE m_name='$post'");

        $s->setFetchMode(PDO::FETCH_ASSOC);

        $s->execute();

        $data=$s->fetch();
        if($data['m_name']==$post){
            $mid=$data['m_id'];
            $midt=$_POST[$mid];
        }


        //        $sql = "SELECT m_id FROM movie WHERE m_name = '$post' limit 1";
        //        $result = mysql_query($sql);
        //        $value = mysql_fetch_array($result);
        //        $mid = $value[0];
        //        $midt=$_POST[$mid];


        $s1=$conn->prepare("SELECT * FROM reviewer WHERE name = '$uuid'");

        $s1->setFetchMode(PDO::FETCH_ASSOC);
        $s1->execute();
        $data1=$s1->fetch();
        if($data1['name']==$uuid){
            $uid=$data1['u_id'];
            //            $uidt=$_POST[$uid];
        }
        //        $uid=$data1[0];
        //        echo $uid;
        //        $uidt=$_POST[$uid];

        //        $email=$_POST['email'];
        //        $psw=$_POST['psw'];

        $insert=$conn->prepare("INSERT INTO review (u_id,post,rating,point,approve,m_id) values(:u_id,:post,:rating,:point,:approve,:m_id) ");
        $insert->bindParam(':u_id',$uid);
        $insert->bindParam(':post',$rat);
        $insert->bindParam(':rating',$rat);
        $insert->bindParam(':point',$point);
        $insert->bindParam(':approve',$app);
        $insert->bindParam(':m_id',$mid);
        $insert->execute();
        if($insert!=0){
            header('location: welcome.php');
            echo "<script>colsole.log('Data insert successful');</script>";
        }
        else{
            echo "<script>alert('Invalid ');</script>";
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
        <link rel="stylesheet" href="design_exercise.css" type="text/css">
        <title>Review Post Page</title>
        <style>
            #navbar {
                margin: 0px;
                padding: 10px 2px;
                height: 60px;
                /*    width: 220px;*/
                float:left;
                display: inline-block;
            }

            #navbar>a {
                margin: 0px;
                padding: 0px;
                list-style-type: none;
                height: 60px;
                display: inline-block;
                text-align: center;

            }
        </style>
    </head>
    <body>
        <div id="navbar" style="width: 150px; height: 40px;text-align: center;display: inline-block;float: right;">
            <a href="home.php">Home</a>&nbsp;&nbsp;<a href="logout.php">LogOut</a>

        </div>

        <form class="modal-content" method="post">
            <div class="container">
                <h1>Post a Movie Review</h1>
                <p>Please fill in this form to post a review.</p>
                <hr>
                <label for="mname"><b>Enter Movie Name</b></label>
                <input type="text" placeholder="Enter movie name" id="mid" name="mname" required>
                <p id="ajaxbody">
                    <?php
                    $mval="";
                    $mog="";
                    echo $midt;
                    echo $uidt;
                    $sqlq="SELECT * FROM movie";

                    if(isset($_GET['mid'])){
                        $mval=$_GET['mid'];
                    }
                    $ob=$conn->query($sqlq);
                    if($ob->rowCount() == 0){
                    ?>
                    <!--                    <h4>User name unique</h4>-->
                    <?php
                    }
                    else{
                        $table=$ob->fetchAll();
                        foreach($table as $row){
                            //                            $mog=$row[2];
                            //                            echo $mog;
                            if($row[1]==$mval){
                    ?>
                    <!--                    <h4>User name already exists</h4>-->
                    <?php
                            }
                        }
                    }

                    ?>
                </p>

                <hr>

                <label for="mname" ><b>
                    <p id="ajaxb">
                        <?php
                        $mval1="";
                        $sqlq1="SELECT * FROM movie";

                        if(isset($_GET['mid'])){
                            $mval1=$_GET['mid'];
                        }
                        $ob1=$conn->query($sqlq1);
                        if($ob1->rowCount() == 0){
                        ?>
                        <!--                    <h4>User name unique</h4>-->
                        <?php
                        }
                        else{
                            $table1=$ob1->fetchAll();
                            foreach($table1 as $row){
                                //                            $mog=$row[2];
                                //                            echo $mog;
                                if($row[2]==$mval1){
                        ?>
                        <!--                    <h4>User name already exists</h4>-->
                        <?php
                                }
                            }
                        }

                        ?>
                    </p>
                    </b></label>

                <!--
<select name="genre" id="soflow" required >
<option value="Action">Action</option>
<option value="	Adventure">	Adventure</option>
<option value="Animation">Animation</option>
<option value="Comedy">Comedy</option>
<option value="Crime">Crime</option>
<option value="Drama">Drama</option>
<option value="Horror">Horror</option>
<option value="Mystery">Mystery</option>
<option value="Romance">Romance</option>
<option value="Science fiction">Science fiction</option>
<option value="Thriller">Thriller</option>
<option value="Western">Western</option>
</select>

<hr>
-->              
                <hr>

                <label for="urev"><b>Review</b></label>
                <input type="textarea" placeholder="Post review" id="urev" name="urev" required>
                <hr>

                <div class="clearfix">
                    <button type="button" onclick="document.getElementById('id01').style.display='none'"  class="cancelbtn"><a href="home.php">Cancel</a></button>
                    <button type="submit" class="signupbtn" name="pst">Post</button>
                </div>
            </div>
        </form>

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

        <script>

            var searchbtn=document.getElementById("mid");
            searchbtn.addEventListener("keyup",ajaxfn);
            searchbtn.addEventListener("keyup",ajaxfn1);


            function ajaxfn1(){
                var searchvalue1=searchbtn.value;
                var ajaxreq1=new XMLHttpRequest();
                ajaxreq1.open('GET','ajaxservem1.php?mid='+searchvalue1);

                ajaxreq1.onreadystatechange=function (){
                    if(ajaxreq1.readyState==4 && ajaxreq1.status==200){
                        var responsecode1=ajaxreq1.responseText;
                        var tablebody1=document.getElementById('ajaxb');

                        tablebody1.innerHTML=responsecode1;

                    }
                };
                ajaxreq1.send();
            }


            function ajaxfn(){
                var searchvalue=searchbtn.value;
                var ajaxreq=new XMLHttpRequest();
                ajaxreq.open('GET','ajaxservem.php?mid='+searchvalue);

                ajaxreq.onreadystatechange=function (){
                    if(ajaxreq.readyState==4 && ajaxreq.status==200){
                        var responsecode=ajaxreq.responseText;
                        var tablebody=document.getElementById('ajaxbody');

                        tablebody.innerHTML=responsecode;

                    }
                };
                ajaxreq.send();
            }


        </script>

    </body>
</html>
