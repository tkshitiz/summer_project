<?php
    include('includes/config.php');
    require('fpdf/fpdf.php');
    $uEmail=$_GET['email'];
    $sql = "SELECT PackageName,UserEmail,PackagePrice,FromDate,ToDate,Comment from tblbooking as tb INNER JOIN tbltourpackages as tp ON tb.PackageId=tp.PackageId
    WHERE tb.UserEmail= :uEmail";
    $query = $dbh->prepare($sql);
    $query -> bindParam(':uEmail', $uEmail, PDO::PARAM_STR);
    $query->execute();
    $booking = $query->fetchAll(PDO::FETCH_OBJ);
    $pdf = new FPDF('P','mm','A4');
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(71 ,10,'',0,0);
    $pdf->Cell(59 ,10,'Booking Receipt',0,0);
    $pdf->Cell(59 ,10,'',0,1);
    // $file="BookingReceipt.txt";

    // $fp = fopen($file,"a") or die("Unable to open file!");
    // file_put_contents($file, "");
    forEach($booking as $values){
        forEach($values as $key =>$value){    
          //  fwrite($fp, "$key:\t $value\n"); 
         
          $pdf->SetFillColor(193,229,252);
		      // $pdf->SetTextColor(0);
          $pdf->Cell(80 ,6,$key,1,0);
	      	$pdf->Cell(60 ,6,$value,1,1);  
	      	// $pdf->Cell(60 ,6,$values->PackagePrice,0,1,'R',true); 
        }
      }
      $sql="SELECT sum(PackagePrice)FROM tbltourpackages				
      INNER JOIN tblbooking ON tbltourpackages.PackageId = tblbooking.PackageId 
      WHERE tblbooking.UserEmail='$uEmail'";
      $query = $dbh->prepare($sql);
      $query -> bindParam(':uEmail', $uEmail, PDO::PARAM_STR);
      $query->execute();
      $result = $query->fetchAll(PDO::FETCH_OBJ);					
      forEach($result as $totals)
      {
        forEach($totals as $key=>$total)
        {	  
          $pdf->SetFillColor(193,229,252);
          $pdf->Cell(80 ,6,'Total',1,0,'C',true);
          $pdf->Cell(60 ,6,$total,1,1,'R',true);
          // fwrite($fp, "Total:"."\t". $total);      
        }
      } 
      $pdf->Output();
    // fclose($fp);                
    // header('Content-Description: File Transfer');
    // header('Content-Disposition: attachment; filename='.basename($file));
    // header('Expires: 0');
    // header('Cache-Control: must-revalidate');
    // header('Pragma: public');
    // header('Content-Length: ' . filesize($file));
    // header("Content-Type: text/plain");
    // readfile($file);  
           
?>