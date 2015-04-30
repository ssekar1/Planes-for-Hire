<?php
/*
 * populating user data into database
*/
	$debug = false;
	session_start();
	 
	print (""); //this is neccessary to clear the httpXMLfeedback field so the validation won't double read the same error
	if (isset($_POST['verifyEmail'])) //this small block is for an ajax call to verify email database
	{
		include('link.php');
		$link = new Link($debug); 
		$result = $link->executeQuery("select `email` from `customer_profile`", $_SERVER["SCRIPT_NAME"]);
		print ("email"); //start by assuming the email entered is valid
		while ($row = mysql_fetch_array($result))
			if ($_POST['verifyEmail'] == $row['email'] || (!filter_var($_POST['verifyEmail'], FILTER_VALIDATE_EMAIL)))
			{
				print (" not"); //if the entered email matches ones found in database, then mark it invalid
				break;
			}
		print (" valid");
	} else
	{
		include ("headHTML.html");
		
		//data parameters to be pushed into database
		$_SESSION ['firstName'] = $_POST ['firstName'];
		$_SESSION ['lastName'] = $_POST ['lastName'];
		$_SESSION ['street'] = $_POST ['street'];
		$_SESSION ['city'] = $_POST ['city'];
		$_SESSION ['state'] = $_POST ['state'];
		$_SESSION ['zip'] = $_POST ['zip'];
		$_SESSION ['phone'] = $_POST ['phone'];
		$_SESSION ['avatar'] = "default.jpg";
		$_SESSION ['email'] = $_POST ['email'];
		$cost = 10; // the bigger the cost the better the password wil be after hashed
		$number = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.'); // will create a random numbers
		$number = sprintf("$2a$%02d$", $cost) . $number; // prefix the password for the compare log in later
		$_SESSION ['encryptPassword'] = crypt($_POST ['password'], $number); // hash the password
		$_SESSION ['dateStamp'] = date('Y-m-d, H:i:s', time());
		$_SESSION['loginId'] = $_SESSION ['email'];
		
		$serializedTravelHistData = serialize(new SplDoublyLinkedList());
		
		//inserting new user into customer_profile table
		$sql = "INSERT INTO `customer_profile`(`firstName`, `lastName`, `street`, `city`, `state`, `zip`, `avatar`, `email`, `phone`, `password`, `travelHist`, `plane`,`regDate`)
			VALUES ('".$_SESSION ['firstName']."', '".$_SESSION ['lastName']."', '".$_SESSION ['street']."', '".$_SESSION ['city']."', '".$_SESSION ['state']."','".$_SESSION ['zip']."', '".$_SESSION ['avatar']."', '".$_SESSION ['email']."', '".$_SESSION ['phone']."', '".$_SESSION ['encryptPassword']."', '".$serializedTravelHistData."', '','".$_SESSION ['dateStamp']."')";
		$link->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
		
		print ("<form action = \"debug.php\" method = \"post\" name = \"form\">");
			print ("<label><center><strong><font size = \"5\">Registration Complete</font></strong></center></label><br>");
			print ("<META http-equiv = \"REFRESH\" content = \"5; Main.php\">"); //this line automatically redirects to a php page after three seconds
			print ("<button type = \"button\" id = \"submitButton\" onclick= \"location.href = 'Main.php'\">Continue</button><br><br>");
		print ("</form>");
	
		//html tail
		include ("tailHTML.html");
	}
?>