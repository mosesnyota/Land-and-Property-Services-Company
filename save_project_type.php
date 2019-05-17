<?php
include('dao/connect.php');

$projecttype = mysqli_real_escape_string($connection, $_POST['projecttype']);

$qry ="INSERT INTO `project_types`
            (`project_type`)
VALUES ('$projecttype')";


 $state = $connection->query($qry);
 
 if ($state) {
            
            echo "<script language=javascript>window.location='project_types.php';</script>";
          
        } else {
           $err =  $connection->error;
            echo "<script type= 'text/javascript'>alert('Error: '.$err);</script>";
            echo "<script language=javascript>window.location='project_types.php';</script>";
        }