<?php 
 session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['submit2']))
{    
    $pid=intval($_GET['pkgid']);
    $useremail=$_SESSION['login'];
    $fromdate=$_POST['fromdate'];
    $todate=$_POST['todate'];
    $comment=$_POST['comment'];
    $status=0;
    if(isset($useremail)){
    $sql = "SELECT * from tblbooking where PackageId=:pid and UserEmail=:useremail";
	$query = $dbh->prepare($sql);
	$query -> bindParam(':pid', $pid, PDO::PARAM_STR);
	$query -> bindParam(':useremail', $useremail, PDO::PARAM_STR);
	$query->execute();
	$results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0 )
	{ 
       $error="You have already booked this Package"; 
    }
    else{
        print_r($query->rowCount());
        $sql="INSERT INTO tblbooking(PackageId,UserEmail,FromDate,ToDate,Comment,status) VALUES(:pid,:useremail,:fromdate,:todate,:comment,:status)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':pid',$pid,PDO::PARAM_STR);
        $query->bindParam(':useremail',$useremail,PDO::PARAM_STR);
        $query->bindParam(':fromdate',$fromdate,PDO::PARAM_STR);
        $query->bindParam(':todate',$todate,PDO::PARAM_STR);
        $query->bindParam(':comment',$comment,PDO::PARAM_STR);
        $query->bindParam(':status',$status,PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();       
        if($lastInsertId)  
        {
            $msg= "Your Booking is Confirmed";
    
        }
        else 
        {
            $error="Something went wrong. Please try again";
        }
    }
 }
 else{
     echo "";
 }
}

?>
<!DOCTYPE HTML>
<html>
<head>
<title>TMS | Booking Details</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="applijewelleryion/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
<link href="css/font-awesome.css" rel="stylesheet">
<!-- Custom Theme files -->
<script src="js/jquery-1.12.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!--animate-->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
<link rel="stylesheet" href="css/jquery-ui.css" />
	<script>
		 new WOW().init();
	</script>
    <script src="js/jquery-ui.js"></script>
					<script>
						$(function() {
						$( "#datepicker,#datepicker1" ).datepicker();
						});
					</script>
    <style>
		.errorWrap {
    padding: 10px;
    margin: 40px 0 40px 30px;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 40px 0 40px 30px;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
		</style>				
</head>
    <body>
    <?php include('includes/header.php');?>
    <div class="banner-3">
	<div class="container">
		<h1 class="wow zoomIn animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;">Booking Details</h1>
	</div>
</div>
<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<p style="color:red"><?php echo htmlentities($error); ?> </p></div><?php } 
				else if($msg){?><div class="succWrap"><strong>GREAT</strong>:<?php echo htmlentities($msg); 
                ?> </div><?php 
                include('payment.php');
                }?>

<?php include('includes/footer.php');?>
<!-- signup -->
<?php include('includes/signup.php');?>			
<!-- //signu -->
<!-- signin -->
<?php include('includes/signin.php');?>			
<!-- //signin -->
<!-- write us -->
<?php include('includes/write-us.php');?>                
    </body>
    </html>