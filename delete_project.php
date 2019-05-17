<?php
$cust_id = $_GET['id'];

$qry = "DELETE FROM `project` WHERE `project_id` = '$cust_id'";

include('dao/connect.php');
 $state = $connection->query($qry);
 
 if ($state) {
            echo "<script type= 'text/javascript'>alert('Project Deleted Successfully');</script>";

            echo "<script language=javascript>window.location='projects.php';</script>";
          
        } else {
            $error = $connection->error;
            echo "<script type= 'text/javascript'>alert('Error! Project not deleted $error');</script>";
            echo "<script language=javascript>window.location='projects.php';</script>";
        }