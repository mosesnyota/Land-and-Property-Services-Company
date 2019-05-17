<?php
include('dao/connect.php');

$projecttype = mysqli_real_escape_string($connection, $_POST['ptype']);
$id = mysqli_real_escape_string($connection, $_POST['id']);

$qry ="UPDATE `project_types`
SET `project_type` = '$projecttype'
WHERE `project_type_id` = '$id'";


 $state = $connection->query($qry);
 
 if ($state) {
            
            echo "<script language=javascript>window.location='project_types.php';</script>";
          
        } else {
           $err =  $connection->error;
            echo "<script type= 'text/javascript'>alert('Error: '.$err);</script>";
            echo "<script language=javascript>window.location='project_types.php';</script>";
        }