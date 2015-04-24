<?php
/*
 Comments goes here!!
*/
	$debug = false;
	include ('../link.php');
	$link = new Link($debug);
	
	if (isset($_POST['email']))
		$email = $_POST['email'];
	if (isset($_POST['field']))
		$field = $_POST['field'];
	if (isset($_POST['newVal']))
		$newVal = $_POST['newVal'];
	if (isset($_POST['intent']))
		$intent = $_POST['intent'];
	if (isset($_POST['model']))
		$model = $_POST['model'];
	if (isset($_POST['airportLocation']))
		$airportLocation = $_POST['airportLocation'];
	if (isset($_POST['airport']))
		$airport = $_POST['airport'];
	if (isset($_POST['lon']))
		$lon = $_POST['lon'];
	if (isset($_POST['lat']))
		$lat = $_POST['lat'];

	if ($intent == "addNewAirportLocation")
	{
		if ($airport != '' && $lat != '' && $lon != '')
		{
			if (is_numeric($lon) && is_numeric($lat))
			{
				$lon = floatval($lon);
				$lat = floatval($lat);
				
				$sql = "INSERT INTO `airport_locations` (`airport`, `long`, `lat`) VALUES ('".$airport."', '".$lon."', '".$lat."')";
				$link->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
			}
		}
	}
	else if ($intent == "addPlaneToTable")
	{
		if ($model != '' && $airportLocation != '')
		{
			$sql = "INSERT INTO `planes` (`model`, `status`, `currentLocation`) VALUES ('".$model."', '1', '".$airportLocation."')";
			$link->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
		}
	}
	else if ($intent == "populateAirportList")
	{
		$sql = "SELECT * FROM `airport_locations`";
		$result = $link->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
		print ("<option value = ''></option>");
		while ($row = mysql_fetch_array($result))
		{	
			preg_match('/^[^,]*/', $row ['airport'], $matches); //(patern, subject, matchesFound), this is the format of the regex
			print ("<option value = '".$row['airport']."'>".$matches[0]."</option>");
		}
	}
	else if ($intent == "updateField")
	{
		if ($newVal == "delete")
		{
			//getting our plane back before booting the client
			$sql = "select * from `planes` WHERE `client` = '".$email."'";
			$result = $link->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
			$rows = mysql_num_rows($result);
			if ($rows >= 1)
			{
				while ($row = mysql_fetch_array($result))
				{
					$leaseFrom = $row['leaseFrom'];
					$model = $row['model'];
				}
				$sql = "UPDATE `planes` SET `status` = '1', `client` = '', `leaseFrom` = '', `currentLocation` = '".$leaseFrom."', `returnTo` = '', `returnDate` = '0000-00-00' WHERE `model` = '".$model."'";
				$link->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
			}
		
			//drop the client from the database
			$link->executeQuery("DELETE FROM `customer_profile` WHERE `email` = '".$email."'", $_SERVER["SCRIPT_NAME"]);
		} else if ($newVal == "suspend")
		{	//suspend the nauty client
			$sql = "UPDATE `customer_profile` SET `password` = NULL WHERE `email` = '".$email."'";
			$link->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
		} else
		{	//this one change their data records  
			if ($field == "password")
			{
				$cost = 10; // the bigger the cost the better the password wil be after hashed
				$number = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.'); // will create a random numbers
				$number = sprintf("$2a$%02d$", $cost).$number; // prefix the password for the compare log in later
				$_SESSION ['encryptPassword'] = crypt($_POST ['newVal'], $number); // hash the password
			
				if ($email == "admin")
					$sql = "UPDATE `admin_setting` SET `".$field."` = '".$_SESSION ['encryptPassword']."' WHERE `id` = '1'";
				else
					$sql = "UPDATE `customer_profile` SET `".$field."` = '".$_SESSION ['encryptPassword']."' WHERE `email` = '".$email."'";
			}
				else
					$sql = "UPDATE `customer_profile` SET `".$field."` = '".$newVal."' WHERE `email` = '".$email."'";
			$link->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
		}
		
		print ("<META http-equiv = \"REFRESH\" content = \"0; admin.php\">");
	}
?>

