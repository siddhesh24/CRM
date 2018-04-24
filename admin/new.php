
<?php
session_start();
include('include/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
date_default_timezone_set('Asia/Kolkata');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );

if(isset($_GET['del']))
		  {
		          mysql_query("delete from products where id = '".$_GET['id']."'");
                  $_SESSION['delmsg']="Product deleted !!";
		  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin| Manage Products</title>
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
</head>


<body>
<?php include('include/header.php');?>

	<div class="wrapper">
		<div class="container">
			<div class="row">
<?php include('include/sidebar.php');?>				
			<div class="span9">
					<div class="content">

	<div class="module">
							<div class="module-head">
								<h3>Admin Mailer</h3>
							</div>
							<div class="module-body table">
	<?php if(isset($_GET['del']))
{?>
									<div class="alert alert-error">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Oh snap!</strong> 	<?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
									</div>
<?php } ?>

									<br />

							
								<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
									<thead>
										<tr>
											<th>Name</th>
											<th>Email</th>
											<th>Product Brought</th>
											<th>Product Visited</th>
											<th>product Based on Recent History</th>
										</tr>
									</thead>
									

		
<?php

//include('C:\xampp\htdocs\Cart\includes\config.php');
$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "";
$mysql_database = "cart";
$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Could not connect database");
mysql_select_db($mysql_database, $bd) or die("Could not select database");

$all=array();
$allid;
$allusername="";
$alluseremail="";
$allproductname_ordered= array();
$allimage_ordered= array();
$alldescription_ordered= array();
$allproductname_visited= array();
$allimage_visited= array();
$alldescription_visited= array();
$random_keys1;
$random_keys2;
$random_keyallname=array();
$random_keyallimage=array();
$random_keyalldesc=array();

$sql = "select distinct(userId) from recent_product";
$result = mysql_query($sql,$bd);


if (mysql_num_rows($result) > 0) {
	while($row = mysql_fetch_assoc($result)) {
        //echo "id: " . $row["userId"]."<br>";
		$allid= $row["userId"];
		
		//for name and email retrieval
		$sql2="select name, email from users where userId='".$row["userId"]."'";
		$result2 = mysql_query($sql2,$bd);
		if (mysql_num_rows($result2) > 0) {
			while($row2 = mysql_fetch_assoc($result2)) {
				//echo "Name:".$row2["name"]."  Email:".$row2["email"]."<br>";
				$allusername=$row2["name"];
				$alluseremail=$row2["email"];
			}	
		}
		
		
		
		//for product retrieval (bought product)
		
		
		//got product id
		$sql3="select distinct(productId) from orders where userId='".$row["userId"]."'";
		$result3 = mysql_query($sql3,$bd);
		if (mysql_num_rows($result3) > 0) {
			while($row3 = mysql_fetch_assoc($result3)) {
				//echo "productId:".$row3["productId"]."<br>";
				
				// got product name
				$sql4="select productName ,productImage1,productDescription from products where id='".$row3["productId"]."'";
				$result4 = mysql_query($sql4,$bd);
				if (mysql_num_rows($result4) > 0) {
					while($row4 = mysql_fetch_assoc($result4)) {
						
						
						//echo "product name:".$row4["productName"]." proct 1 :".$row4["productImage1"]."<br>";
						array_push($allproductname_ordered,$row4["productName"]);
						array_push($allimage_ordered,$row4["productImage1"]);
						array_push($alldescription_ordered,$row4["productDescription"]);
					}
				}	
				
			}	
		}
			
			
		
			
			
		//product visited 
		
		//got product id
		$sql5="select distinct(productId) from recent_product where userId='".$row["userId"]."'";
		$result5 = mysql_query($sql5,$bd);
		if (mysql_num_rows($result5) > 0) {
			while($row5 = mysql_fetch_assoc($result5)) {				
				// got product name
				$sql6="select productName ,productImage1,productDescription from products where id='".$row5["productId"]."'";
				$result6 = mysql_query($sql6,$bd);
				if (mysql_num_rows($result6) > 0) {
					while($row6 = mysql_fetch_assoc($result6)) {
						
						
						//echo "product name:".$row6["productName"]." proct 1 :".$row6["productImage1"]."<br>";
				
						array_push($allproductname_visited,$row6["productName"]);
						array_push($allimage_visited,$row6["productImage1"]);
						array_push($alldescription_visited,$row6["productDescription"]);

					}
				}	
				
			}	
		}
		
		array_push($all,$allid,$allusername,$alluseremail,$allproductname_ordered,$allimage_ordered,$alldescription_ordered,$allproductname_visited,$allimage_visited,$alldescription_visited);

		
		
		
		//random product from ordered and visited - change kr siddhesh
		
		//for name
		$random_keys1=array_rand($allproductname_ordered,1);
		array_push($random_keyallname,$allproductname_ordered[$random_keys1]);
		array_push($random_keyallimage,$allimage_ordered[$random_keys1]);
		array_push($random_keyalldesc,$alldescription_ordered[$random_keys1]);
		
		$random_keys2=array_rand($allproductname_visited,1);
		array_push($random_keyallname,$allproductname_visited[$random_keys2]);
		array_push($random_keyallimage,$allimage_visited[$random_keys2]);
		array_push($random_keyalldesc,$alldescription_visited[$random_keys2]);


		
		
		$imgpath="https://ucart.000webhostapp.com/".$random_keyallname[0]."/".$random_keyallimage[0];
		$imgpath2="https://ucart.000webhostapp.com/".$random_keyallname[1]."/".$random_keyallimage[1];
		//echo "<img src='".$imgpath."' />";
		
		$sql7="select email from users where userId='".$row["userId"]."'";
		$result7 = mysql_query($sql7,$bd);
		if (mysql_num_rows($result7) > 0) {
			while($row7 = mysql_fetch_assoc($result7)) {
				
				
				$maildata = $row7["email"]."<br>".$random_keyallname[0]."<br><img src='".$imgpath."' />".$random_keyalldesc[0]."<br>";
				$maildata += $random_keyallname[1]."<br><img src='".$imgpath2."' />".$random_keyalldesc[1]."<br>";
				
				//echo "sending mail to :".$row7["email"];
				//mail($row7["email"],'Suggested Product For You',$maildata,'From: ucart@gmail.com');
			}	
		}
		
		
		
		
		
		
		
    }
}



									<tbody>
										<tr>
						
											<td><?php echo htmlentities($row2["name"]);?></td>
											<td><?php echo htmlentities($row2["email"]);?></td>
											<td> <?php echo htmlentities($row4["productName"]);?></td>
											<td><?php echo htmlentities($row6["productName"]);?></td>
											<td><?php echo htmlentities($row7["email"]);?></td>
										
									</tbody>	
								</table>
							</div>
						</div>						

						
						
					</div><!--/.content-->
				</div><!--/.span9-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->

<?php include('include/footer.php');?>

	<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
	<script src="scripts/datatables/jquery.dataTables.js"></script>
	<script>
		$(document).ready(function() {
			$('.datatable-1').dataTable();
			$('.dataTables_paginate').addClass("btn-group datatable-pagination");
			$('.dataTables_paginate > a').wrapInner('<span />');
			$('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
			$('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
		} );
	</script>
</body>
