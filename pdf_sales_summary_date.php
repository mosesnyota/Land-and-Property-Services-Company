<?php

require('fpdf.php');

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
       
        $this->Ln();
        
        
        if(isset($_GET['from'])){
          
            //echo $mydate;
            $start  = date("d-M-Y",strtotime($_GET['from'])); 
            $end  = date("d-M-Y",strtotime($_GET['to'])); 
            
        }else{
           
             $start  = date("d-m-Y");
             $end   =  date("d-m-Y", strtotime("-5 days", strtotime($to)));
             
        }
 $this->SetFont('times', 'B', 11);
        $this->Cell(195, 6, "SALES SUMMARY REPORT: ".$start."   to   ".$end , 0, 0, "C", 0);
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

$pdf->Cell(55, 7, "Date", 1, 0, "C", 1);
$pdf->Cell(55, 7, "Total Sales", 1, 0, "C", 1);
$pdf->Cell(30, 7, "Total Paid", 1, 0, "C", 1);
$pdf->Cell(40, 7, "Total Balance", 1, 0, "C", 1);
       
 
   

$pdf->Ln();
//gegevens van database
$y = $pdf->GetY();
$x = 10;
$pdf->setXY($x, $y);


if(isset($_GET['from'])){
          
            //echo $mydate;
            $from  = date("Y-m-d",strtotime($_GET['from'])); 
            $to  = date("Y-m-d",strtotime($_GET['to'])); 
            
        }else{
           
             $to  = date("Y-m-d");
             $from   =  date("Y-m-d", strtotime("-5 days", strtotime($to)));
             
        }
        

  $statement = "SELECT DATE_FORMAT(sales.`sales_date`,'%d-%m-%Y') AS sdate3,SUM(`total_amount`) AS total,SUM(`amount_paid`) AS paid,SUM(total_amount - amount_paid) AS balance FROM `sales` 
                             WHERE  sales_date >= '$from' AND sales_date <= '$to'
                             GROUP BY sales_date";
                        
include('dao/connect.php');
$result = $db->query($statement);
$num = 0;
$fill = 0;

$totalSale = 0;
            $totalPaid = 0;
            $totalUnits = 0;
            $totalbalance = 0;
while ($row = $result->fetch_assoc()) {
    $num++;
    $totalSale += $row['total'];
    $totalPaid += $row['paid'];
    $totalbalance += $row['balance'];
    $pdf->SetFillColor(224, 235, 255);
    $pdf->setFont("times", "", "11");


    $pdf->Cell(10, 7, $num, 1, 0, "L", $fill);
    $pdf->Cell(55, 7, $row['sdate3'], 1, 0, "C", $fill);
    $pdf->Cell(55, 7,  number_format($row['total'],2), 1, 0, "R", $fill);
    $pdf->Cell(30, 7, number_format($row['paid'],2), 1, 0, "R", $fill);
    $pdf->Cell(40, 7, number_format($row['balance'],2), 1, 0, "R", $fill);
   
    
    $y += 7;
    $fill = !$fill;
    if ($y > 275) {
        $pdf->AddPage();
        $pdf->SetFillColor(128, 128, 128); //gray
        $pdf->setFont("times", "", "11");
        $pdf->setXY(20, 40);

        $pdf->Cell(10, 7, "#", 1, 0, "L", 1);
        $pdf->Cell(55, 7, "Date", 1, 0, "C", 1);
        $pdf->Cell(55, 7, "Total Sales", 1, 0, "C", 1);
        $pdf->Cell(30, 7, "Total Paid", 1, 0, "C", 1);
        $pdf->Cell(40, 7, "Total Balance", 1, 0, "C", 1);

        $pdf->Ln();
        $y = 45;
    }

    $pdf->setXY($x, $y);
}
$pdf->Cell(65, 7, "Totals", 1, 0, "C", 0);
$pdf->Cell(55, 7, number_format($totalSale,2), 1, 0, "R", 0);
$pdf->Cell(30, 7, number_format($totalPaid,2), 1, 0, "R", 0);
$pdf->Cell(40, 7, number_format($totalbalance,2), 1, 0, "R", 0);

$pdf->Output();
