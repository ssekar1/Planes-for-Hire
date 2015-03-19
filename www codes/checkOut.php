<?php
/*
 Comments goes here!!
*/
	$debug = false;
	include ('link.php');
	$link = new Link($debug);
	
	$depart = $_POST['depart'];
	$arrive = $_POST['arrive'];
	$duration = $_POST['duration']; 
	$startDate = $_POST['startDate'];
	$returnDate = $_POST['returnDate'];
	$model = $_POST['model'];
	$checkOutStatus = $_POST['checkOutStatus'];
	$email = $_POST['user'];
	
	
//	$sql = "UPDATE `customer_profile` SET `checkOutStatus` = '1', `plane` = '".$model."' WHERE `email` = '".$email."'";
//	$link->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	$sql = "INSERT INTO `".$email."` (`origAirport`, `destAirport`, `dateTravel`) VALUES ('"$depart"', '".$arrive."', CURRENT_TIMESTAMP)";
	
//	$sql = "UPDATE `planes` SET `origAirport` = '".$depart."', `destAirport` = '".$depart."', `arriveTo` = '".$arrive."' WHERE `model` = '".$model."'";
	$link->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	
	
?>

