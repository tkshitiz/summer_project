<!DOCTYPE HTML>
	<html>
	<head>
	<title>TMS | esewa success</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link href="css/style.css" rel='stylesheet' type='text/css' />
	</head>
	<body>
	
<?php				
include('includes/config.php');

	if( isset($_GET['oid']) &&
		isset( $_REQUEST['amt']) &&
		isset( $_REQUEST['refId'])
		)
	{
	
		$oid=intval($_GET['oid']);
		$sql = "SELECT * from tblbooking where BookingId =:oid";
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
		    'pid'=>  $_GET['oid'],
			'scd'=> 'EPAYTEST'
			];
			$curl = curl_init($url);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($curl);		
			curl_close($curl);

			if(strpos($response, 'Success') !== false)
			{
				$uEmail=$_GET['email'];
				$bid=$bookings[0]->PackageId;
				$sql = "UPDATE tblbooking SET status=1 WHERE PackageId=:bid";
				$query = $dbh->prepare($sql); 
				$query -> bindParam(':bid', $bid, PDO::PARAM_STR);
                $query->execute();
				$sql = "SELECT PackageName,UserEmail,PackagePrice,FromDate,ToDate,Comment from tblbooking as tb INNER JOIN tbltourpackages as tp ON tb.PackageId=tp.PackageId
				WHERE tb.UserEmail= :uEmail";
				$query = $dbh->prepare($sql);
				$query -> bindParam(':uEmail', $uEmail, PDO::PARAM_STR);
				$query->execute();
				$booking = $query->fetchAll(PDO::FETCH_OBJ);
                ?>
				<div style='margin:100px 100px 10px 100px;'>
			   <table class='table table-striped table-hover'>
			   <thead class="alert alert-info" role="alert">
				<tr>
				<th>PackageName</th>
				<th>Email</th>
				<th>PackagePrice</th>
				<th>FromDate</th>
				<th>ToDate</th>
				<th>Comment</th>
				</tr>
				</thead>
               <?php
				if($query->rowCount() > 0)
					{
					foreach($booking as $result)
						{ ?> 
							<tbody>
							<tr>
							<th><?php echo $result->PackageName; ?></th>
							<td> <?php echo $result->UserEmail;?></td>
							<td><?php echo $result->PackagePrice;?></td>
							<td><?php echo $result->FromDate;?></td>
							<td><?php echo $result->ToDate;?></td>
							<td><?php echo $result->Comment;;?></td>
							</tr>
							</tbody>
							

					<?php } echo "<h2 class='alert alert-success' role='alert'>Payment Successful</h2>";?>
					<?php $sql="SELECT sum(PackagePrice)FROM tbltourpackages				
						INNER JOIN tblbooking ON tbltourpackages.PackageId = tblbooking.PackageId 
						WHERE tblbooking.UserEmail='$uEmail'";
						$query = $dbh->prepare($sql);
						$query -> bindParam(':uEmail', $uEmail, PDO::PARAM_STR);
						$query->execute();
						$result = $query->fetchAll(PDO::FETCH_OBJ);					
						forEach($result as $totals){
						  forEach($totals as $key=>$total)
						  {	
					?>
					<tr>
					<th style="text-align:center;background:#beccbe;border-top:5px solid black;"colspan="2">TOTAL</th>
					<td style="border-top:5px solid black;background:#9ac5cc">Rs.<?php echo $total;?></td>
				  </tr>					
					<?php }}}?>					
					</table>
	                        </div>
							<form action="save.php?email=<?php echo $uEmail;?>" method="POST">
								<button type="submit" style="margin: 10px 50px 100px 100px;"type="button" class="btn btn-primary">
								Save</button>
						   </form>
						
		   <?php	}
			else
			{
			   header('location:esewa_failed.php');
			}
            
		}	
    }?>
</body></html>
