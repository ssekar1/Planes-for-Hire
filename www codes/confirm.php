<?php
/*
 * populating user data into database
*/
	$debug = false;
	session_start();
	include ("headHTML.html");

//===data parameters to be pushed into database
	$_SESSION ['firstName'] = $_POST ['firstName'];
	$_SESSION ['lastName'] = $_POST ['lastName'];
	$_SESSION ['street'] = $_POST ['street'];
	$_SESSION ['city'] = $_POST ['city'];
	$_SESSION ['state'] = $_POST ['state'];
	$_SESSION ['zip'] = $_POST ['zip'];
	$_SESSION ['phone'] = $_POST ['phone'];
	if (empty($_POST ['avatar']))
		$_SESSION ['avatar'] = "none specify";
	else
		$_SESSION ['avatar'] = $_POST ['avatar'];
	$_SESSION ['email'] = $_POST ['email'];
	$_SESSION ['password'] = $_POST ['password'];
	$_SESSION ['dateStamp'] = date('Y-m-d, H:i:s', time());
	
//===inserting new user into customer_profile table
	$sql = "INSERT INTO `customer_profile`(`firstName`, `lastName`, `street`, `city`, `state`, `zip`, `avatar`, `email`, `phone`, `password`, `regDate`)
		VALUES ('".$_SESSION ['firstName']."', '".$_SESSION ['lastName']."', '".$_SESSION ['street']."', '".$_SESSION ['city']."', '".$_SESSION ['state']."','".$_SESSION ['zip']."', '".$_SESSION ['avatar']."', '".$_SESSION ['email']."', '".$_SESSION ['phone']."', '".$_SESSION ['password']."', '".$_SESSION ['dateStamp']."')";
	$link->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

//===creating new travel history table for the new user, these tables are created dynamically for each new user
	$sql = "CREATE TABLE `".$_SESSION ['email']."` (`id` int(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY, `origAirport` varchar(30) NOT NULL, `origLong` double signed NOT NULL, `origLat` double signed NOT NULL, `destAirport` varchar(30) NOT NULL, `destLong` double signed NOT NULL, `destLat` double signed NOT NULL, `dateTravel` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP)";
    $link->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	
	unset ($_SESSION);
	session_destroy();
	
		print ("<form action = \"debug.php\" method = \"post\" name = \"form\">");
			print ("<label><center><strong><font size = \"5\">Registration Complete</font></strong></center></label><br>");
			print ("<META http-equiv = \"REFRESH\" content = \"5; main.php\">"); //this line automatically redirects to a php page after three seconds
			print ("<button type = \"button\" id = \"submitButton\" onclick= \"location.href = 'main.php'\">Continue</button><br><br>");
		print ("</form>");
//===html tail===
	include ("tailHTML.html");
?>