<?php
include('dao/connect.php');

$projecttype = mysqli_real_escape_string($connection, $_GET['id']);

$qry ="DELETE FROM `project_types`
WHERE `project_type_id` = '$projecttype'";


 $state = $connection->query($qry);
 
 if ($state) {
            echo "<script language=javascript>window.location='project_types.php';</script>";
          
        } else {
            $err =  $connection->error;
            
            echo "<script type= 'text/javascript'>alert('Error: '.$err);</script>";
     
            echo "<script language=javascript>window.location='project_types.php';</script>";
        }