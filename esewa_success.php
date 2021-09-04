<?php
include('includes/config.php');

if( isset($_GET['oid']) &&
	isset( $_REQUEST['amt']) &&
	isset( $_REQUEST['refId'])
	)
{
	
	$oid=intval($_GET['oid']);
	$sql = "SELECT * from tblbooking where PackageId =:oid";
	$query = $dbh->prepare($sql);
    $query -> bindParam(':oid', $oid, PDO::PARAM_INT);
    $query->execute();
	$bookings = $query->fetchAll(PDO::FETCH_OBJ);
	
		if($query->rowCount() > 0)
          {       	  		
	
			$url = "https://uat.esewa.com.np/epay/transrec";
			$data =[
			'amt'=>  $_REQUEST['amt'],
			'rid'=>  $_REQUEST['refId'],
		    'pid'=>  $bookings[0]->PackageId,
			'scd'=> 'EPAYTEST'
			];

			$curl = curl_init($url);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($curl);			
			$response_code = get_xml_node_value('response_code',$response);			
			curl_close($curl);
			// var_dump($response_code);
            
			if ( trim($response_code)  == 'Success')
			{
				$uEmail=$_GET['email'];
				$bid=$bookings[0]->PackageId;
				$sql = "UPDATE tblbooking SET status=1 WHERE PackageId=:bid";
				$query = $dbh->prepare($sql); 
				$query -> bindParam(':bid', $bid, PDO::PARAM_STR);
                $query->execute();
				$sql = "SELECT * from tblbooking where PackageId =:bid and UserEmail=:uEmail";
				$query = $dbh->prepare($sql);
				$query -> bindParam(':bid', $bid, PDO::PARAM_INT);
				$query -> bindParam(':uEmail', $uEmail, PDO::PARAM_STR);
				$query->execute();
				$booking = $query->fetchAll(PDO::FETCH_OBJ);
				header('Location: success.php');
			}
		}	
}

function get_xml_node_value($node, $xml) {
    if ($xml == false) {
        return false;
    }
    $found = preg_match('#<'.$node.'(?:\s+[^>]+)?>(.*?)'.
            '</'.$node.'>#s', $xml, $matches);
    if ($found != false) {
        
            return $matches[1]; 
         
    }	  
   return false;
}
?>