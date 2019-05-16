<?php
$category = $_POST['category'];

$qry = "INSERT INTO `project_category`(`category`)VALUES ('$category')";
try {
include('dao/connect.php');
 $state = $connection->query($qry);
 
 if ($state) {
            echo "<script language=javascript>window.location='project_categories.php';</script>";
        } else {
            echo "<script type= 'text/javascript'>alert('Error! Project Category not saved');</script>";
            echo "<script language=javascript>window.location='project_categories.php';</script>";
        }
} catch (Exception $e) {
            echo $e->getMessage();
        }



