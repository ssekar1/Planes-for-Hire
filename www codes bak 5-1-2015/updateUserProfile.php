<?php
/*
 Comments goes here!!
*/
	$debug = false;
	include ('link.php');
	include ('travelHist.php');
	$link = new Link($debug);
	$travelHistObj = new TravelHistory();
	session_start();// Starting Session
	
	if (isset($_POST['firstName']))
		$link->executeQuery("UPDATE `customer_profile` SET `firstName` = '".$_POST['firstName']."' WHERE `email` = '".$_SESSION['loginId']."'", $_SERVER["SCRIPT_NAME"]);
	if (isset($_POST['lastName']))
		$link->executeQuery("UPDATE `customer_profile` SET `lastName` = '".$_POST['lastName']."' WHERE `email` = '".$_SESSION['loginId']."'", $_SERVER["SCRIPT_NAME"]);
	if (isset($_POST['street']))
		$link->executeQuery("UPDATE `customer_profile` SET `street` = '".$_POST['street']."' WHERE `email` = '".$_SESSION['loginId']."'", $_SERVER["SCRIPT_NAME"]);
	if (isset($_POST['city']))
		$link->executeQuery("UPDATE `customer_profile` SET `city` = '".$_POST['city']."' WHERE `email` = '".$_SESSION['loginId']."'", $_SERVER["SCRIPT_NAME"]);
	if (isset($_POST['state']))
		$link->executeQuery("UPDATE `customer_profile` SET `state` = '".$_POST['state']."' WHERE `email` = '".$_SESSION['loginId']."'", $_SERVER["SCRIPT_NAME"]);
	if (isset($_POST['zip']))
		$link->executeQuery("UPDATE `customer_profile` SET `zip` = '".$_POST['zip']."' WHERE `email` = '".$_SESSION['loginId']."'", $_SERVER["SCRIPT_NAME"]);
	if (isset($_POST['phone']))
		$link->executeQuery("UPDATE `customer_profile` SET `phone` = '".$_POST['phone']."' WHERE `email` = '".$_SESSION['loginId']."'", $_SERVER["SCRIPT_NAME"]);
	if (isset($_POST['password'])) //I think its right here!!!
	{
		$cost = 10; // the bigger the cost the better the password wil be after hashed
		$number = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.'); // will create a random numbers
		$number = sprintf("$2a$%02d$", $cost) . $number; // prefix the password for the compare log in later		
		$_SESSION['key'] = crypt($_POST ['password'], $number); //hash the password is here
		
		$link->executeQuery("UPDATE `customer_profile` SET `password` = '".$_SESSION['key']."' WHERE `email` = '".$_SESSION['loginId']."'", $_SERVER["SCRIPT_NAME"]);
	}
	if (isset($_POST['clearHist']))
	{
		$serializedTravelHistData = serialize(new SplDoublyLinkedList());
		$link->executeQuery("UPDATE `customer_profile` SET `travelHist` = '".$serializedTravelHistData."' WHERE `email` = '".$_SESSION['loginId']."'", $_SERVER["SCRIPT_NAME"]);
	}
	if (isset($_POST['email']))
	{
		$link->executeQuery("UPDATE `customer_profile` SET `email` = '".$_POST['email']."' WHERE `email` = '".$_SESSION['loginId']."'", $_SERVER["SCRIPT_NAME"]);
		$link->executeQuery("RENAME TABLE `".$_SESSION['loginId']."` TO `".$_POST['email']."`", $_SERVER["SCRIPT_NAME"]);
		$_SESSION['loginId'] = $_POST['email'];
	}
	if (isset($_POST['payBalance']))
	{
		$sql = "select * from `customer_profile` WHERE `email` = '".$_SESSION['loginId']."'";
		$result = $link->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
		while ($row = mysql_fetch_array($result))
			$balance = $row ['balance'];
		$newBalance = $balance - doubleval($_POST['payBalance']);
		$link->executeQuery("UPDATE `customer_profile` SET `balance` = ".$newBalance." WHERE `email` = '".$_SESSION['loginId']."'", $_SERVER["SCRIPT_NAME"]);
	}
	
	print ("<META http-equiv = \"REFRESH\" content = \"0; userprofile.php\">");
?>