<?php
/*
 Comments goes here!!
*/
	$debug = false;
	include ('link.php');
	$link = new Link($debug);
	session_start();
	
	/*
				print("<label>Depart from:  </label><label name = \"departLabel\" id = \"departLabel\"></label><br>");
				print("<label>Arrive to:  </label><label name = \"arrivalLabel\" id = \"arrivalLabel\"></label><br>");
				print("<label>Rental duration:  </label><label name = \"durationLabel\" id = \"durationLabel\"></label><br>");
				print("<label>Start date:  </label><label name = \"startLabel\" id = \"startLabel\"></label><br>");
				print("<label>Return date:  </label><label name = \"returnLabel\" id = \"returnLabel\"></label><br>");
				print("<label>Model:  </label><label name = \"planeLabel\" id = \"planeLabel\"></label><br>");
	*/
	
	$depart = $_POST['depart'];
	$arrive = $_POST['arrive'];
	$duration = $_POST['duration']; 
	$startDate = $_POST['startDate'];
	$returnDate = $_POST['returnDate'];
	$returnDate = date('Y-m-d', strtotime($returnDate));
	$model = $_POST['model'];
	$email = $_SESSION['loginId'];
	
	//update the customer_profile table to indicate they have check out a plane, and which plane model they check out
//	$sql = "UPDATE `customer_profile` SET `checkOutStatus` = 0, `plane` = ' ' WHERE `email` = '".$email."'"; //this line is use for debugging purposes
	
	
	$sql = "UPDATE `customer_profile` SET `checkOutStatus` = '1', `plane` = '".$model."' WHERE `email` = '".$email."'";
	$link->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	
/*	
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
	
	$sql = "INSERT INTO `".$email."` (`origAirport`, `origLong`, `origLat`, `destAirport`, `destLong`, `destLat`, `dateTravel`) VALUES ('".$depart."', '".$origLong."', '".$origLat."', '".$arrive."', '".$destLong."', '".$destLat."', CURRENT_TIMESTAMP)";
	$link->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
*/	
/*	
	//update the planes table to mark the specific model as checked out
	$sql = "UPDATE `planes` SET `status` = '0', `client` = '".$email."', `leaseFrom` = '".$depart."', `returnTo` = '".$arrive."', `returnDate` = '".$returnDate."'  WHERE `model` = '".$model."'";
	$link->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
*/
	
?>

