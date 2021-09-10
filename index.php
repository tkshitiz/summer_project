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
<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <img src="images/trek2.jpeg" alt="Banner image">
    </div>

    <div class="item">
      <img src="images/trek1.jpg" alt="Banner Image">
    </div>

    <div class="item">
      <img src="images/trek.jpg" alt="Banner Image">
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
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