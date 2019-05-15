<?php




session_start();
$supplier = $_POST['supplier'];
$paymethod = $_POST['paymethod'];
$amountpaid = $_POST['amountpaid'];

date_default_timezone_set("Africa/Nairobi");
$today = date("Y-m-d");
$total_quantity =0;


$totalpurchase = 0;
$item_price = 0;
foreach ($_SESSION["purchase_invoice"] as $item){
        $item_price = $item["quantity"]*$item["purchase"];
        $total_quantity += $item["quantity"];
	$totalpurchase += ($item["purchase"]*$item["quantity"]);
    }//end foreach

    if($amountpaid  > $totalpurchase){
        $amountpaid = $totalpurchase;
    }
    $payStatus = 'Unpaid';
    if($totalpurchase == $amountpaid){
        $payStatus = 'Paid';
    }
  
    $invoice = "INSERT INTO `invoice`
            (`invoice_date`,`amount`,`supplier_id`,`pay_status`,`paid_amount`)
VALUES ('$today','$totalpurchase','$supplier','$payStatus','$amountpaid')";
  
  include('dao/connect.php');
   $resultInv = $db->query($invoice);

   //SELECT INVOICE NO.
   $InvNo = "SELECT max(invoice_id) as invno from invoice where supplier_id ='$supplier' and invoice_date ='$today'";
  $resultInv3 = $db->query($InvNo);
 while($Inv= $resultInv3->fetch_assoc()) {
     $invNo2 = $Inv['invno'];
 }
 
 
 if($resultInv3){
 foreach ($_SESSION["purchase_invoice"] as $item){
        $item_price = $item["purchase"];
        $quantity = $item["quantity"];
        $proID = $item["id"];
	
        $inv_items = "INSERT INTO `invoice_items`
            (`invoice_id`,
             `product_id`,
             `price`,
             `quantity`)
VALUES ('$invNo2',
        '$proID',
        '$item_price',
        '$quantity')";
        
       $db->query($inv_items);
       
       
       $updt = "UPDATE `products`
            SET  `qnty` = qnty + $quantity
            WHERE `product_id` = '$proID'";
     $db->query($updt); 	      
    
        
    }//end foreach

   
     
     $stat = "UPDATE `cashsettings`
SET `cash_amount` = cash_amount - $amountpaid";
$result27 = $db->query($stat);

   echo "<script language=javascript>window.location='create_invoice.php?action=empty';</script>"; 
    echo "<script language=javascript>window.location=' invoices.php';</script>"; 
   
}else{
  echo "<script type= 'text/javascript'>alert('Error Saving transaction');</script>";
  echo "<script language=javascript>window.location='create_invoice.php?action=empty';</script>"; 
}
