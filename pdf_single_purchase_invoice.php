<?php

require('fpdf.php');

$invoice_id = $_GET['invoice_id'];


function getInvoiceDetails (){
    include('dao/connect.php');
    $id = $_GET['invoice_id'];
    $sql ="SELECT DATE_FORMAT(`invoice_date`,'%d-%m-%Y') AS idate,`company_name`,`contact_person` FROM INVOICE  JOIN `suppliers`
ON invoice.`supplier_id` = suppliers.`supplier_id` WHERE invoice_id ='$id'";
    $result = $db->query($sql);
       $details = "";
        while ($de = $result->fetch_assoc()) {
            $details = "Invoice Date: ".$de['idate'] ." Supplier : ".$de['company_name']."  : ".$de['contact_person'];
        }
        return $details;
}

function getPaidAmount (){
    include('dao/connect.php');
    $id = $_GET['invoice_id'];
    $sql ="SELECT * FROM invoice WHERE invoice_id ='$id'";
    $result = $db->query($sql);
       $details = 0;
        while ($de = $result->fetch_assoc()) {
            $details =$de['paid_amount'];
        }
        return $details;
}

function getTotalAmount (){
    include('dao/connect.php');
    $id = $_GET['invoice_id'];
    $sql ="SELECT * FROM invoice WHERE invoice_id ='$id'";
    $result = $db->query($sql);
       $details = 0;
        while ($de = $result->fetch_assoc()) {
            $details =$de['amount'];
        }
        return $details;
}


class PeoplePDF extends FPDF {

//Page header
    function Header() {



        $num = 0;
        $fill = 0;
        include('dao/connect.php');
        $result = $db->query("select * from institution_details");
        while ($de = $result->fetch_assoc()) {
            $name = $de['institution_name'];
            $name2 = $de['name_part2'];
            $address = $de['box'] . " , " . $de['place'] . " Tel: " . $de['telphone'];
            //$logref=$de['logref'];
            $phone = $de['telphone'];
            $headoffice = $de['head_office'];
            $email = $de['email'];
            $web = $de['website'];
        }
        $logo = "images/logo.png";
        $date = date("Y-m-d H:i:s");
        $y = date("Y");
        $m = date("m");
        $d = date("d");
        $hr = date("H");
        $min = date("i");
        $sec = date("s");
        $hcodes = $y . $m . $d . $hr;
        $mins = $min . $sec;

        $hcode = $hcodes . $mins;

        $barcode = "images/barcode.PNG";

        $this->SetFont('times', '', 8);
        $this->Image($logo, 15, 10, 20, 20);
        $this->Image($barcode, 165, 10, 0, 0);
        $this->Text(175, 25, $hcode);

        $this->SetFont('times', '', 8);
        //$this->Image($barcode,150,10,0,0);
        //$this->Text(151, 25, $hcode);
        $this->SetFont('times', 'B', 28);

        $this->Cell(195, 7, $name, 0, 0, "C", 0);
        $this->Ln();
        $this->SetFont('times', 'B', 14);
        $this->Cell(195, 6, $name2, 0, 0, "C", 0);
        $this->Ln();
        $this->SetFont('times', '', 12);
        $this->Cell(195, 6, "Office: $headoffice, Email: $email", 0, 0, "C", 0);
        $this->Ln();

        $this->Cell(195, 6, strtoupper(getInvoiceDetails()) , 0, 0, "C", 0);
        $this->Line(10, 36, 200, 36);
        $this->Ln();



        $this->Ln(20);
    }

//Page footer
    function Footer() {
        //Position at 1.5 cm from bottom
        $this->SetY(-15);
        //Arial italic 8
        $this->SetFont('Arial', 'I', 9);
        //Page number
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

}

$pdf = new FPDF();
$pdf = new PeoplePDF();
$pdf->AliasNbPages(); //for page numbers
//$pdf->open();
$pdf->addPage();
$pdf->SetAutoPageBreak(false);
$pdf->SetFillColor(0, 0, 0); //black
$pdf->SetDrawColor(0, 0, 0); //black
//table header
$pdf->SetFillColor(128, 128, 128); //gray
$pdf->setFont("times", "", "11");
$pdf->setXY(10, 40);
$pdf->Cell(10, 7, "#", 1, 0, "L", 1);

                
                 


       $pdf->Cell(50, 7, "Category", 1, 0, "C", 1);
       $pdf->Cell(50, 7, "Product", 1, 0, "C", 1);
       $pdf->Cell(25, 7, "Price", 1, 0, "C", 1);
       $pdf->Cell(25, 7, "Quantity", 1, 0, "C", 1);
       $pdf->Cell(25, 7, "Total", 1, 0, "C", 1);
       
      
                 
                


$pdf->Ln();
//gegevens van database
$y = $pdf->GetY();
$x = 10;
$pdf->setXY($x, $y);

 $statement = "SELECT invoice_items.*, category,`product_value`,`purchase_price`  FROM `invoice_items` 
JOIN `products` ON `invoice_items`.`product_id` = `products`.`product_id`
JOIN `product_category` ON PRODUCTS.`product_category` = `product_category`.`category_id`
WHERE `invoice_id` = '$invoice_id' ORDER BY `product_category` ASC, `product_value` ASC";
                        
include('dao/connect.php');
$result = $db->query($statement);
$num = 0;
$fill = 0;

$purchase_total = 0;
$wholesale_total = 0;

$totalunits = 0;
$totalcost = 0;
while ($row = $result->fetch_assoc()) {
    $num++;
    $pdf->SetFillColor(224, 235, 255);
    $pdf->setFont("times", "", "11");
    
    
   $totalunits += $row['quantity'];
   $totalcost += ($row['purchase_price'] * $row['quantity']);

    $pdf->Cell(10, 7, $num, 1, 0, "L", $fill);
    $pdf->Cell(50, 7, strtoupper($row['category']), 1, 0, "L", $fill);
    $pdf->Cell(50, 7, strtoupper($row['product_value']), 1, 0, "L", $fill);
    $pdf->Cell(25, 7, $row['purchase_price'], 1, 0, "R", $fill);
    $pdf->Cell(25, 7, $row['quantity'], 1, 0, "R", $fill);
    $pdf->Cell(25, 7, number_format($row['price'] * $row['quantity'],2), 1, 0, "R", $fill);
   
                  
    

    $y += 7;
    $fill = !$fill;
    if ($y > 275) {
        $pdf->AddPage();
        $pdf->SetFillColor(128, 128, 128); //gray
        $pdf->setFont("times", "", "11");
        $pdf->setXY(20, 40);

       $pdf->Cell(10, 7, "#", 1, 0, "L", 1);
       $pdf->Cell(50, 7, "Category", 1, 0, "C", 1);
       $pdf->Cell(50, 7, "Product", 1, 0, "C", 1);
       $pdf->Cell(25, 7, "Price", 1, 0, "C", 1);
       $pdf->Cell(25, 7, "Quantity", 1, 0, "C", 1);
       $pdf->Cell(25, 7, "Total", 1, 0, "C", 1);


        $pdf->Ln();
        $y = 45;
    }

    $pdf->setXY($x, $y);
}
$pdf->Cell(185, 7, "", 1, 0, "C", 0);
$pdf->Ln();
$pdf->Cell(135, 7, "Totals", 1, 0, "R", 0);
$pdf->Cell(25, 7, $totalunits, 1, 0, "R", 0);
$pdf->Cell(25, 7, number_format(getTotalAmount(),2), 1, 0, "R", 0);
$pdf->Ln();
$pdf->Cell(135, 7, "Amount Paid", 1, 0, "R", 0);
$pdf->Cell(25, 7, "", 1, 0, "R", 0);
$pdf->Cell(25, 7, number_format(getPaidAmount(),2), 1, 0, "R", 0);   
$pdf->Ln();
$pdf->Cell(135, 7, "Balance", 1, 0, "R", 0);
$pdf->Cell(25, 7, "", 1, 0, "R", 0);
$pdf->Cell(25, 7, number_format(getTotalAmount() - getPaidAmount(),2), 1, 0, "R", 0);   

$pdf->Output();
?>