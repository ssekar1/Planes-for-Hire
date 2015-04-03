<?php
/*
 Comments goes here!!
*/
	$debug = false;
	include ('link.php');
	$link = new Link($debug);
	session_start();
	
	$email = $_SESSION['loginId'];
	$_SESSION['diffDays'] = $_POST['diffDays']; //not sure what to do with this...
	$_SESSION['feeOwe'] = $_POST['feeOwe'];
	
	//check what plane they checked out
	$sql = "select * from `customer_profile` WHERE `email` = '".$email."'";
	$result = $link->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	while ($row = mysql_fetch_array($result))
	{
		$_SESSION['model'] = $row ['plane'];
		$_SESSION['balance'] = $row ['balance']; //use to calculate with the late fee, late fee will be added to total balance
	}
	
	$_SESSION['balance'] = $_SESSION['balance'] + $_SESSION['feeOwe'];
	
	//update their profile by removing the plane entry, and mark them as having no plane check out, also put in the new total latefee
	$sql = "UPDATE `customer_profile` SET `checkOutStatus` = '0', `plane` = '', `balance` = ".$_SESSION['balance']." WHERE `email` = '".$email."'";
	$link->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	
	//mark the plane as check in, and remove the them from the plane record
	$sql = "UPDATE `planes` SET `status` = '1', `client` = '', `leaseFrom` = '', `returnTo` = '', `returnDate` = '0000-00-00' WHERE `model` = '".$_SESSION['model']."'";
	$link->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);	
	
	print ("<META http-equiv = \"REFRESH\" content = \"0; checkInResult.php\">");
	
?>
































