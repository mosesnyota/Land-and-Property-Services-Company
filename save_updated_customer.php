<?php
if(isset($_POST['mname'])){
$fname = $_POST['fname'];
$mname = $_POST['mname'];
$lname = $_POST['lname'];
$cust_id = $_POST['id'];
$idno = $_POST['idno'];
$phone = $_POST['phone'];

$emailadd = $_POST['emailadd'];

$todate =date("Y-m-d");

$qry = "UPDATE `customer`
SET 
  `fname` = '$fname',
  `mname` = '$mname',
  `lname` = '$lname',
  `idno` = '$idno',
  `phone` = '$phone',
   email = '$emailadd'
WHERE `cust_id` = '$cust_id'";





try {
include('dao/connect.php');
 $state = $connection->query($qry);
 
 if ($state) {
            echo "<script type= 'text/javascript'>alert('Customer Updated Successfully');</script>";
            echo "<script language=javascript>window.location='customers.php';</script>";
          
        } else {
            echo $connection->error;
            echo "<script type= 'text/javascript'>alert('Error! Customer not saved');</script>";
            echo "<script language=javascript>window.location='customers.php';</script>";
        }
} catch (Exception $e) {
            echo $e->getMessage();
        }




}