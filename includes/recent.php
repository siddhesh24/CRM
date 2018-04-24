	
<?php 	
	session_start(); 

	include('config.php');	

	$userId  = $_SESSION["id"];
	$pid = $_POST["pid"];
	$id = uniqid("r_");
	$timestamp = time();


	$query = "insert into recent_product values ('$id', '$userId', '$pid', $timestamp)";
	$result = mysql_query($query);

	if ($result)
	{
		echo "successful!!!";
	}
	else
	{
		echo mysql_error($bd);
	}
 
?>
