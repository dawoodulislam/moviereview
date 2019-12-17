<?php
$mid="";
$uid="";
$midt="";
$uidt="";
$rat="";
$post="";
$point="";
$app="";
$p=0;

$a=0;
?>

<!DOCTYPE html>
<html>
    <head>
        
        <style>
            table, th, td{
                border: 1.5px solid blue;
                border-collapse: collapse;
            }
            td{
                text-align: center;
            }
        </style>

    </head>
    <body>
        <h1 style="text-align:center;">Admin Panel</h1>

        <table style="width:100%;">
            <form method="post">
                <thead>
                    <tr>
                        <th>Reviewer Name</th>
                        <th>Movie Review</th>
                        <th>Movie Name</th>
                        <th>Approve/Disapprove</th>

                    </tr>
                </thead>
                <tbody id="tablebody">
                    <?php
                    try{
                        $conn=new PDO("mysql:host=localhost:3306;dbname=moviereview",'root','');

                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    }
                    catch(PDOException $ex){
                        echo "<script>window.alert('db connection errror')</script>";
                    }


                    try{
                        $sqlquery="Select * from review WHERE point='$p' AND approve='$a'";
                        $object=$conn->query($sqlquery);
                        //                    $table=$object->fetchAll();
                        if($object->rowCount() == 0){ /// 0 meaning no data exists in the database
                    ?>
                    <tr>
                        <td colspan="6" style="text-align:center;">
                            No Data Found!!!
                        </td>
                    </tr>
                    <?php  
                        }
                        else{
                            $table=$object->fetchAll();
                            foreach($table as $row){
                                $rat=$row[1];
                                $s=$conn->prepare("SELECT * FROM reviewer WHERE u_id='$rat'");

                                $s->setFetchMode(PDO::FETCH_ASSOC);

                                $s->execute();

                                $data=$s->fetch();
                                if($data['u_id']==$rat){
                                    $mid=$data['name'];
                                }
                                $midt=$row[6];
                                $s1=$conn->prepare("SELECT * FROM movie WHERE m_id='$midt'");

                                $s1->setFetchMode(PDO::FETCH_ASSOC);

                                $s1->execute();

                                $data1=$s1->fetch();
                                if($data1['m_id']==$row[6]){
                                    $midt=$data1['m_name'];
                                }

                    ?>
                    <tr>    
                        <td><?php echo $mid ?></td>    
                        <td><?php echo $row[2] ?></td>    
                        <td><?php echo $midt ?></td>    
                        <td>
                            <input type="button" value="Approve" onclick="updatedata(<?php echo $row[0]  ?>);">
                            <input type="button" value="Disapprove" onclick="updatedata1(<?php echo $row[0]  ?>);">
                            <!--                            <button id="disapp" value="Disapprove">Disapprove</button>-->



                            <!--
<input type="button" id="approve" value="Approve">
<input type="button" id="disapp" value="Disapprove">
-->
                        </td>
                    </tr>
                    <?php
                            }
                        } 

                    }

                    catch(PDOException $e){
                        echo "<script>window.alert('query errror')</script>";
                    }
                    ?>

                </tbody>
            </form>
        </table>


        <script>
            //            function updatedata(id){
            //                
            //                ///reloading this page again with an extra parameter passed through get method named "delete"
            //                //                location.assign('showdata.php?delete='+id);
            //            }

            function updatedata(id){
                ///loading the update.php page to perform the update operation
                location.assign('approve.php?uid='+id);
            }
            function updatedata1(id){
                ///loading the update.php page to perform the update operation
                location.assign('approve1.php?uaid='+id);
            }
        </script>
    </body>
</html>