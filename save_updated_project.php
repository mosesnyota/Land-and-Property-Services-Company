<?php
include('dao/connect.php');

$projecttype= mysqli_real_escape_string($connection, $_POST['projecttype']);
$customer = mysqli_real_escape_string($connection, $_POST['customer']);
$startingdate = date('Y-m-d',strtotime(mysqli_real_escape_string($connection, $_POST['startingdate'])));
$completiondate = date('Y-m-d',strtotime(mysqli_real_escape_string($connection, $_POST['completiondate'])));
$description = mysqli_real_escape_string($connection, $_POST['description']);
$project_id = mysqli_real_escape_string($connection, $_POST['id']);



$update ="UPDATE `project`
SET 
  `project_type_id` = '$projecttype',
  `starting_date` = '$startingdate',
  `expected_end_date` = '$completiondate',
  `description` = '$description',
  `customer_id` = '$customer'
WHERE `project_id` = '$project_id'";

 $state = $connection->query($update);
 
 if ($state) {
            
            echo "<script language=javascript>window.location='projects.php';</script>";
          
        } else {
           $err =  $connection->error;
            echo "<script type= 'text/javascript'>alert('Error: '.$err);</script>";
            echo "<script language=javascript>window.location='projects.php';</script>";
        }