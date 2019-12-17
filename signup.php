
<?php

try{
    $conn=new PDO("mysql:host=localhost:3306;dbname=moviereview",'root','');
    echo "<script>console.log('database connected');</script>";

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(isset($_POST["sbmt"])) {	
        $usern=$_POST["uname"];
        $upass=$_POST["pdw"];
        $s=$conn->prepare("select * from reviewer where name = '$usern' AND pwd = '$upass'");

        $s->setFetchMode(PDO::FETCH_ASSOC);
        $s->execute();
        $data=$s->fetch();
        if($data['name']==$usern)
        {
            session_start();
            $_SESSION['name']=$usern;
            header('location: user/home.php');
        }
        else
        {
            header('location: home.php');
            echo "<script>alert('Invalid User Name Or Password');</script>";
        }

    }
    if(isset($_POST["signup"])){
        $name=$_POST['u_name'];
        $email=$_POST['email'];
        $psw=$_POST['psw'];

        $insert=$conn->prepare("INSERT INTO reviewer (name,email,pwd) values(:name,:email,:pwd) ");
        $insert->bindParam(':name',$name);
        $insert->bindParam(':email',$email);
        $insert->bindParam(':pwd',$psw);
        $insert->execute();

        if($insert!=0){
            header('location: user/home.php');
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
        <title>SignUp Page</title>

    </head>
    <body>

        <div style="width: 150px; height: 40px;text-align: center;display: inline-block;float: right;">
            <a href="home.php">Home</a>

        </div>

        <form method="post">
            <div class="container">
                <h1>Sign Up</h1>
                <p>Please fill in this form to create an account.</p>
                <hr>

                <label for="name"><b>Name</b></label>
                <input type="text" placeholder="Enter Name" name="u_name" id="uid" required  pattern="[a-zA-Z _ .]{3,15}">
                <p id="ajaxbody">
                    <?php
                    $searchval="";
                    $sqlq="SELECT * FROM reviewer";
                    if(isset($_GET['uid'])){
                        $searchval=$_GET['uid'];
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
                            if($row[1]==$searchval){
                    ?>
                    <!--                    <h4>User name already exists</h4>-->
                    <?php
                            }
                        }
                    }

                    ?>
                </p>
                <hr>

                <label for="email"><b>Email</b></label>
                <input type="text" placeholder="Enter Email" name="email" id="mid" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">

                <p id="body1">
                    <?php
                    $mval="";
                    $sqlq1="SELECT * FROM reviewer";
                    if(isset($_GET['mid'])){
                        $mval=$_GET['mid'];
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
                            if($row[2]==$mval){
                    ?>
                    <!--                    <h4>User name already exists</h4>-->
                    <?php
                            }
                        }
                    }

                    ?>
                </p>

                <hr>
                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" id="psw" name="psw" required pattern="[a-zA-Z0-9]{2,10}" onkeyup='check();'>
                <hr>

                <label for="psw-repeat"><b>Repeat Password</b></label>
                <input type="password" placeholder="Repeat Password" id="psw-repeat" name="psw-repeat" required pattern="[a-zA-Z0-9]{2,10}" onkeyup='check();'>
                <span id='message'></span>
                <hr>
                <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>

                <button type="submit" class="registerbtn" name="signup">Sign Up</button>
            </div>

            <div class="container signin">
                <p>Already have an account? <a onclick="document.getElementById('id01').style.display='block'" style="color:blue">Sign in</a>.</p>
            </div>
        </form>

        <!--    LOG IN PAGE IN SIGN UP-->

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

        </script>

        <script>

            var searchbtn=document.getElementById("uid");
            searchbtn.addEventListener("keyup",ajaxfn);


            function ajaxfn(){
                var searchvalue=searchbtn.value;
                var ajaxreq=new XMLHttpRequest();
                ajaxreq.open('GET','ajaxserve.php?uid='+searchvalue);

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
        
        <script>
        var check = function() {

        if (document.getElementById('psw').value ==
        document.getElementById('psw-repeat').value) {
        document.getElementById('message').style.color = 'green';
        document.getElementById('message').innerHTML = 'Password matched';
        } else {
        document.getElementById('message').style.color = 'red';
        document.getElementById('message').innerHTML = 'Password not matching';
        }
        }
        </script>
        <script>

            var mbtn=document.getElementById("mid");
            mbtn.addEventListener("keyup",ajaxfn1);


            function ajaxfn1(){
                var mvalue=mbtn.value;
                var ajaxreq1=new XMLHttpRequest();
                ajaxreq1.open('GET','ajaxserve1.php?mid='+mvalue);

                ajaxreq1.onreadystatechange=function (){
                    if(ajaxreq1.readyState==4 && ajaxreq1.status==200){
                        var responsecode1=ajaxreq1.responseText;
                        var tablebody1=document.getElementById('body1');

                        tablebody1.innerHTML=responsecode1;

                    }
                };


                ajaxreq1.send();
            }
        </script>
    </body>
</html>
