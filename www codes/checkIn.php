<?php
/*
 Comments goes here!!
*/
	$debug = false;
	include ('link.php');
	$link = new Link($debug);
	session_start();
	
	$email = $_SESSION['loginId'];
	
	//check what plane they checked out
	$sql = "select * from `customer_profile` WHERE `email` = '".$email."'";
	$result = $link->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	while ($row = mysql_fetch_array($result))
	{
		$model = $row ['plane'];
		$balance = $row ['balance']; //use to calculate with the late fee, late fee will be added to total balance
	}
	
	//check the due date for this plane. the plane table has a expected return date
	$sql = "select * from `plane` WHERE `model` = '".$model."'";
	$result = $link->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	while ($row = mysql_fetch_array($result))
		$returnDate = $row ['returnDate']; //use this to caculate with current date to determine late fee
	
	//retrieve the late fee perday from the admin table
	$sql = "select * from `admin_setting` WHERE `id` = '1'";
	$result = $link->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	while ($row = mysql_fetch_array($result))
		$fee = $row ['lateFee']; //use to calculate with late fee
	
	/*
		there should be some date calculation right here to determine the total late days, then multiplied that by the fee retrieved from admin_setting table
		to get the total latefee, then push that back to the customer profile table as a new total balance
	*/
	
	//update their profile by removing the plane entry, and mark them as having no plane check out, also put in the new total latefee
	$sql = "UPDATE `customer_profile` SET `checkOutStatus` = '0', `plane` = ' ', `balance` = '' WHERE `email` = '".$email."'";
	$link->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	
	//mark the plane as check in, and remove the them from the plane record
	$sql = "UPDATE `planes` SET `status` = '1', `client` = ' ', `leaseFrom` = ' ', `returnTo` = ' ', `returnDate` = '0000-00-00' WHERE `model` = '".$model."'";
	$link->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);	
	
?>
































