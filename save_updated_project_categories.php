<?php
$category = $_POST['category'];
$category_id = $_POST['id'];

$qry = "UPDATE `project_category`
SET `category` = '$category'
WHERE `category_id` = '$category_id'";
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



