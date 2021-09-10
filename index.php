<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>
<!DOCTYPE HTML>
<html>
<head>
<title>TMS | Tourism Management System</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script type="applijewelleryion/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
<link href="css/fontawesome/css/all.css" rel="stylesheet">
<!-- Custom Theme files -->
<script src="js/jquery-1.12.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!--animate-->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
	<script>
		 new WOW().init();
	</script>
<!--//end-animate-->
</head>
<body>
<?php include('includes/header.php');?>
<div class="banner">	
	<div class="container">
		<div class="col-md-9" style="float:left;"> 
			<h1 class="wow zoomIn animated animated" data-wow-delay=".5s" style="margin-right: 50px; margin-left: 50px;color:#e5fbef; visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;">Nepal Holiday, Nepal Tour Package</h1>
				<p>The Land of Himalayas offers you thrilling , inspiring trekking routes and mountaineering packages 
				all over Nepal.</p> <br>
				<button class="btn btn-primary"><a style="color:white;text-decoration:none;" href="#" class="see-more">View More</a></button>  
		</div>
	</div>
</div>

<!---holiday---->
<div class="container">
	<div class="holiday">	
	       <h3>Package List</h3>					
			<?php 
			$sql = "SELECT * from tbltourpackages order by rand() limit 4";
			$query = $dbh->prepare($sql);
			$query->execute();
			$results=$query->fetchAll(PDO::FETCH_OBJ);
			$cnt=1;
			if($query->rowCount() > 0)
			{
			foreach($results as $result)
			{	?>
				<div class="rom-btm">
					<div class="col-md-3 room-left wow fadeInLeft animated" data-wow-delay=".5s">
						<img src="admin/pacakgeimages/<?php echo htmlentities($result->PackageImage);?>" class="img-responsive" alt="">
					</div>
					<div class="col-md-6 room-midle wow fadeInUp animated" data-wow-delay=".5s">
						<h4>Package Name: <?php echo htmlentities($result->PackageName);?></h4>
						<h6>Package Type : <?php echo htmlentities($result->PackageType);?></h6>
						<p><b>Package Location :</b> <?php echo htmlentities($result->PackageLocation);?></p>
						<p><b>Features</b> <?php echo htmlentities($result->PackageFetures);?></p>
					</div>
					<div class="col-md-3 room-right wow fadeInRight animated" data-wow-delay=".5s">
						<h5>USD <?php echo htmlentities($result->PackagePrice);?></h5>
						<a href="package-details.php?pkgid=<?php echo htmlentities($result->PackageId);?>" class="view">Details</a>
					</div>
					<div class="clearfix"></div>
				</div>

			<?php }} ?>
					
       <div><a href="package-list.php" class="view">View More Packages</a></div>
    </div>
			<div class="clearfix"></div>
</div>

<!-- ENF_OF_HOLIDAY -->	

<!--- routes ---->
<div class="routes">
	<div class="container">
		<div class="col-md-4 routes-left wow fadeInRight animated" data-wow-delay=".5s">
			<div class="rou-left">
				<a href="#"><i class="fas fa-glasses"></i></i></a>
			</div>
			<div class="rou-rgt wow fadeInDown animated" data-wow-delay=".5s">
				<h3><?php
				$sql = "SELECT * from tblenquiry";
				$query = $dbh->prepare($sql);
				$query->execute();
				$results=$query->fetchAll(PDO::FETCH_OBJ);
				$count=count($results);echo  $count;
			   ?></h3>
				<p>Enquiries</p>
			</div>
				<div class="clearfix"></div>
		</div>
		<div class="col-md-4 routes-left">
			<div class="rou-left">
				<a href="#"><i class="fas fa-user"></i></a>
			</div>
			<div class="rou-rgt">
				<h3><?php
				    $sql = "SELECT * from tblusers";
					$query = $dbh->prepare($sql);
					$query->execute();
					$results=$query->fetchAll(PDO::FETCH_OBJ);
					$count=count($results);echo  $count;
			        ?>
			    </h3>
				<p>Registered users</p>
			</div>
				<div class="clearfix"></div>
		</div>
		<div class="col-md-4 routes-left wow fadeInRight animated" data-wow-delay=".5s">
			<div class="rou-left">
				<a href="#"><i class="fas fa-address-book"></i></a>
			</div>
			<div class="rou-rgt">
				<h3><?php
					$sql = "SELECT * from tblbooking";
					$query = $dbh->prepare($sql);
					$query->execute();
					$results=$query->fetchAll(PDO::FETCH_OBJ);
					$count=count($results);echo  $count;
		         	?>
				</h3>
				<p>Booking</p>
			</div>
				<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>

<?php include('includes/footer.php');?>
<!-- signup -->
<?php include('includes/signup.php');?>			
<!-- //signu -->
<!-- signin -->
<?php include('includes/signin.php');?>			
<!-- //signin -->
<!-- write us -->
<?php include('includes/write-us.php');?>			
<!-- //write us -->
</body>
</html>