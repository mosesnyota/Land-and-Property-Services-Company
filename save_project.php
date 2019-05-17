<?php
include('dao/connect.php');

$projecttype= mysqli_real_escape_string($connection, $_POST['projecttype']);
$customer = mysqli_real_escape_string($connection, $_POST['customer']);
$startingdate = date('Y-m-d',strtotime(mysqli_real_escape_string($connection, $_POST['startingdate'])));
$completiondate = date('Y-m-d',strtotime(mysqli_real_escape_string($connection, $_POST['completiondate'])));

$description = mysqli_real_escape_string($connection, $_POST['description']);




$qry ="INSERT INTO `project`
            (
             `project_type_id`,
             `starting_date`,
             `expected_end_date`,
             `description`,
             `customer_id`)
VALUES (
        '$projecttype',
        '$startingdate',
        '$completiondate',
        '$description',
        '$customer')";


 $state = $connection->query($qry);
 
 if ($state) {
            
            echo "<script language=javascript>window.location='projects.php';</script>";
          
        } else {
           $err =  $connection->error;
            echo "<script type= 'text/javascript'>alert('Error: '.$err);</script>";
            echo "<script language=javascript>window.location='projects.php';</script>";
        }