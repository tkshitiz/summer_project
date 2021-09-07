<?php
    include('includes/config.php');
    $uEmail=$_GET['email'];
    $sql = "SELECT PackageName,UserEmail,PackagePrice,FromDate,ToDate,Comment from tblbooking as tb INNER JOIN tbltourpackages as tp ON tb.PackageId=tp.PackageId
    WHERE tb.UserEmail= :uEmail";
    $query = $dbh->prepare($sql);
    $query -> bindParam(':uEmail', $uEmail, PDO::PARAM_STR);
    $query->execute();
    $booking = $query->fetchAll(PDO::FETCH_OBJ);
   
  forEach($booking as $values){
      forEach($values as $key =>$value){
          $file="data.txt";
          $fp = fopen($file,"a") or die("Unable to open file!");
                fwrite($fp, "$key:\t $value\n");
                fclose($fp);   
      }
  }
  header('Content-Description: File Transfer');
  header('Content-Disposition: attachment; filename='.basename($file));
  header('Expires: 0');
  header('Cache-Control: must-revalidate');
  header('Pragma: public');
  header('Content-Length: ' . filesize($file));
  header("Content-Type: text/plain");
  readfile($file);
   
            
  
  
               
          
               
?>