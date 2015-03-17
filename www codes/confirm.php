<?php
/*
 * populating user data into database
*/
	include('link.php');
	$debug = false;
	$link = new Link($debug);
	session_start();

//===data parameters to be pushed into secondary database
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
	$_SESSION ['regDate'] = date('Y-m-d'); //anonymously record user's registration date for time keeping
	
//===these are the composed description content that goes into the description box, date and time spamp goes in here !!!
	$sql = "INSERT INTO `customer_profile`(`firstName`, `lastName`, `street`, `city`, `state`, `zip`, `avatar`, `email`, `phone`, `password`, `regDate`)
		VALUES ('".$_SESSION ['firstName']."', '".$_SESSION ['lastName']."', '".$_SESSION ['street']."', '".$_SESSION ['city']."', '".$_SESSION ['state']."','".$_SESSION ['zip']."', '".$_SESSION ['avatar']."', '".$_SESSION ['email']."', '".$_SESSION ['phone']."', '".$_SESSION ['password']."', '".$_SESSION ['regDate']."')";
	$link->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	
	unset ($_SESSION);
	session_destroy();

//===html head===just a echoes a thank you message to the user for using this service, but still the head and tail html are still used to be consistence, and along with the form as well	
	include ("headHTML.html");
		print ("<form action = \"debug.php\" method = \"post\" name = \"form\">");
			print ("<label><center><strong><font size = \"5\">Registration Complete</font></strong></center></label><br>");
			print ("<META http-equiv = \"REFRESH\" content = \"5; main.php\">"); //this line automatically redirects to a php page after three seconds
			print ("<button type = \"button\" id = \"submitButton\" onclick= \"location.href = 'main.php'\">Continue</button><br><br>");
		print ("</form>");
//===html tail===
	include ("tailHTML.html");
?>