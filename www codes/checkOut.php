<?php
/*
 Comments goes here!!
*/
	$debug = false;
	include ('link.php');
	$link = new Link($debug);
	session_start();
	
	$_SESSION['depart'] = $_POST['depart'];
	$_SESSION['arrive'] = $_POST['arrive'];
	$_SESSION['duration'] = $_POST['duration']; 
	$_SESSION['startDate'] = $_POST['startDate'];
	$_SESSION['returnDate'] = $_POST['returnDate'];
	$_SESSION['returnDate'] = date('Y-m-d', strtotime($_SESSION['returnDate']));
	$_SESSION['model'] = $_POST['model'];
	$email = $_SESSION['loginId'];
	
	//update the customer_profile table to indicate they have check out a plane, and which plane model they check out		
	$sql = "UPDATE `customer_profile` SET `checkOutStatus` = '1', `plane` = '".$_SESSION['model']."' WHERE `email` = '".$email."'";
	$link->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	
	//update the planes table to mark the specific model as checked out
	$sql = "UPDATE `planes` SET `status` = '0', `client` = '".$email."', `leaseFrom` = '".$_SESSION['depart']."', `returnTo` = '".$_SESSION['arrive']."', `returnDate` = '".$_SESSION['returnDate']."'  WHERE `model` = '".$_SESSION['model']."'";
	$link->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	
	//pull the airport_location table to get departure and arrival coordinates to push into member's travel history table  
	$sql = "select * from `airport_locations` WHERE `airport` = '".$_SESSION['depart']."'";
	$result = $link->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	while ($row = mysql_fetch_array($result))
	{
		$origLong = $row ['long'];
		$origLat = $row ['lat'];
	}
	
	$sql = "select * from `airport_locations` WHERE `airport` = '".$_SESSION['arrive']."'";
	$result = $link->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	while ($row = mysql_fetch_array($result))
	{
		$destLong = $row ['long'];
		$destLat = $row ['lat'];
	}
	
	$sql = "INSERT INTO `".$email."` (`origAirport`, `origLong`, `origLat`, `destAirport`, `destLong`, `destLat`, `dateTravel`, `leaseModel`) VALUES ('".$_SESSION['depart']."', '".$origLong."', '".$origLat."', '".$_SESSION['arrive']."', '".$destLong."', '".$destLat."', CURRENT_TIMESTAMP,  '".$_SESSION['model']."')";
	$link->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

	print ("<META http-equiv = \"REFRESH\" content = \"0; Main.php\">");
/*
	//this is use to reset the plane checkout table, uncomment to use, but comment codes above. for debugging purposes only
	for ($x = 0; $x < 15; $x++)
	{
		$sql = "UPDATE `planes` SET `status` = '1', `client` = '', `leaseFrom` = '', `returnTo` = '', `returnDate` = ''  WHERE `id` = '".$x."'";
		$link->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	}
*/	
	
?>
































