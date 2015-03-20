<?php
/*
 Comments goes here!!
*/
	$debug = false;
	include ('link.php');
	$link = new Link($debug);
	session_start();
	
	$depart = $_POST['depart'];
	$arrive = $_POST['arrive'];
	$duration = $_POST['duration']; 
	$startDate = $_POST['startDate'];
	$returnDate = $_POST['returnDate'];
	$returnDate = date('Y-m-d', strtotime($returnDate));
	$model = $_POST['model'];
	$email = $_SESSION['loginId'];
	
	//update the customer_profile table to indicate they have check out a plane, and which plane model they check out		
	$sql = "UPDATE `customer_profile` SET `checkOutStatus` = '1', `plane` = '".$model."' WHERE `email` = '".$email."'";
	$link->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	
	//update the planes table to mark the specific model as checked out
	$sql = "UPDATE `planes` SET `status` = '0', `client` = '".$email."', `leaseFrom` = '".$depart."', `returnTo` = '".$arrive."', `returnDate` = '".$returnDate."'  WHERE `model` = '".$model."'";
	$link->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	
	//pull the airport_location table to get departure and arrival coordinates to push into member's travel history table  
	$sql = "select * from `airport_locations` WHERE `airport` = '".$depart."'";
	$result = $link->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	while ($row = mysql_fetch_array($result))
	{
		$origLong = $row ['long'];
		$origLat = $row ['lat'];
	}
	
	$sql = "select * from `airport_locations` WHERE `airport` = '".$arrive."'";
	$result = $link->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	while ($row = mysql_fetch_array($result))
	{
		$destLong = $row ['long'];
		$destLat = $row ['lat'];
	}
	
	$sql = "INSERT INTO `".$email."` (`origAirport`, `origLong`, `origLat`, `destAirport`, `destLong`, `destLat`, `dateTravel`, `leaseModel`) VALUES ('".$depart."', '".$origLong."', '".$origLat."', '".$arrive."', '".$destLong."', '".$destLat."', CURRENT_TIMESTAMP,  '".$model."')";
	$link->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

/*
	//this is use to reset the plane checkout table, uncomment to use, but comment codes above. for debugging purposes only
	for ($x = 0; $x < 15; $x++)
	{
		$sql = "UPDATE `planes` SET `status` = '1', `client` = '', `leaseFrom` = '', `returnTo` = '', `returnDate` = ''  WHERE `id` = '".$x."'";
		$link->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	}
*/	
	
?>
































