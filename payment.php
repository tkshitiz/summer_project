
<?php
	include('includes/config.php');
	
	$pid=intval($_GET['pkgid']);
	$useremail=$_SESSION['login'];
	$user = strstr($useremail, '@', true);
    $name_from_email = preg_replace('/\d+/u', '', $user);
	$sql = "SELECT * from tblbooking as tb INNER JOIN tbltourpackages as tp ON tb.PackageId=tp.PackageId
	WHERE tb.PackageId = :pid and tb.UserEmail= :useremail";
	$query = $dbh->prepare($sql);
	$query -> bindParam(':pid', $pid, PDO::PARAM_STR);
	$query -> bindParam(':useremail', $useremail, PDO::PARAM_STR);
	$query->execute();
	$results=$query->fetchAll(PDO::FETCH_OBJ);
	// echo "<pre>";print_r($results);exit;echo "</pre>";
	$cnt=1;
	if($query->rowCount() > 0)
	{
	foreach($results as $result)

{ ?>

		<div class="selectroom_top">			
			  <div class="col-md-4 selectroom_right wow fadeInRight animated " data-wow-delay=".5s">
				  <h2 style="color:black;">Booking Id: <?php echo htmlentities($result->BookingId);?></h2>
			  </div>

              <div class="col-md-5 selectroom_left wow fadeInLeft animated" data-wow-delay=".5s">
				  <img src="admin/pacakgeimages/<?php echo $result->PackageImage;?>"  style=' width: 200px;
  height: 300px;
  object-fit: contain;'class="img-responsive" alt="Package_Image">
			  </div>
  
              <div class="col-md-3 selectroom_right wow fadeInRight animated " data-wow-delay=".5s">
			  	 <h2 style="font-size:15px;color:black;">Booked by: <?php echo htmlentities($name_from_email);?></h2>
			  </div>
                <div style="border:1px solid #d6d6d6; margin: 50px 0;"></div>
					
				<div class="grand">
					<p>Grand Total</p>
					<h3><strong style="color:green;">USD: </strong><?php echo htmlentities ($result->PackagePrice);?></h3>
				</div>
                <div class="grand">
				<form action="https://uat.esewa.com.np/epay/main" method="POST">
					<input value="110" name="tAmt" type="hidden">
					<input value="100" name="amt" type="hidden">
					<input value="5" name="txAmt" type="hidden">
					<input value="2" name="psc" type="hidden">
					<input value="3" name="pdc" type="hidden">
					<input value="EPAYTEST" name="scd" type="hidden">
					<input value="<?php echo $pid;?>" name="pid" type="hidden">
					<input value="http://localhost/tms/tms/esewa_success.php?email=<?php echo $useremail;?>" type="hidden" name="su">
					<input value="http://localhost/tms/tms/esewa_failed.php?q=fu" type="hidden" name="fu">
					<button style='margin-top:15px; padding:3px 10px 6px 10px;'type="submit" class="btn btn-primary">Pay with Esewa</button>
   				 </form>
				</div>
			</div>
		</div>
		<?php }}?>

