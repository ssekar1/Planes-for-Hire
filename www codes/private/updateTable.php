<?php
/*
 Comments goes here!!
*/
	$debug = false;
	include ('../link.php');
	$link = new Link($debug);
	session_start();
	
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
	if (isset($_SESSION['intent']))
		$intent = $_SESSION['intent'];
	if (isset($_SESSION['newVal']))
		$newVal = $_SESSION['newVal'];
	if (isset($_SESSION['field']))
		$field = $_SESSION['field'];
	if (isset($_SESSION['email']))
		$email = $_SESSION['email'];
	
	unset($_SESSION['intent']);
	unset($_SESSION['email']);
	unset($_SESSION['field']);
	unset($_SESSION['newVal']);

	if ($intent == "addNewAirportLocation")
	{
		if ($airport != '' && $lon != '' && $lat != '')
		{
			if (is_numeric($lon) && is_numeric($lat))
			{
				$lon = floatval($lon);
				$lat = floatval($lat);
				
				$sql = "INSERT INTO `airport_locations` (`airport`, `long`, `lat`) VALUES ('".$airport."', '".$lon."', '".$lat."')";
				$link->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
			}
		}
	} else if ($intent == "listAirports") //list the airports currently in database
	{	
		print ("<br><table border='0px'>");
		print ("<tr>");
		print ("<td>Delete   </td>");
		print ("<td>Airport</td>");
		print ("</tr>");
		$result = $link->executeQuery("SELECT * FROM `airport_locations`", $_SERVER["SCRIPT_NAME"]);
		while ($row = mysql_fetch_array($result))
		{
			print ("<tr><td><a href = \"javascript: deleteAirport('".$row ['airport']."');\" style = \"color: red\">delete</td>".
				"<td>".$row['airport']."</td></tr>");
		}
		print ("</table><br>");
		print ("<a style = \"float:left\" href = \"javascript: restoreAdminContentPanel();\">Return</a>");
	} else if ($intent == "deleteAirport") //delete an airport
	{
		//$planeResult = $link->executeQuery("SELECT * FROM `planes` WHERE `currentLocation` = '".$airport."'", $_SERVER["SCRIPT_NAME"]);
		$airportResult = $link->executeQuery("SELECT * FROM `airport_locations` WHERE `airport` != '".$airport."'", $_SERVER["SCRIPT_NAME"]);
		$link->executeQuery("UPDATE `planes` SET `currentLocation` = '".mysql_fetch_array($airportResult)['airport']."' WHERE `currentLocation` = '".$airport."'", $_SERVER["SCRIPT_NAME"]);
		$link->executeQuery("UPDATE `planes` SET `returnTo` = '".mysql_fetch_array($airportResult)['airport']."' WHERE `returnTo` = '".$airport."'", $_SERVER["SCRIPT_NAME"]);
		
		$link->executeQuery("DELETE FROM `airport_locations` WHERE `airport` = '".$airport."'", $_SERVER["SCRIPT_NAME"]);
		print ($airport." was deleted<br><table border='0px'>");
		print ("<tr>");
		print ("<td>Delete   </td>");
		print ("<td>Airport</td>");
		print ("</tr>");
		$result = $link->executeQuery("SELECT * FROM `airport_locations`", $_SERVER["SCRIPT_NAME"]);
		while ($row = mysql_fetch_array($result))
		{
			print ("<tr><td><a href = \"javascript: deleteAirport('".$row ['airport']."');\" style = \"color: red\">delete</td>".
				"<td>".$row['airport']."</td></tr>");
		}
		print ("</table><br>");
		print ("<a style = \"float:left\" href = \"javascript: restoreAdminContentPanel();\">Return</a>");
	} else if ($intent == "listPlanes") //list the planes currently in database
	{
		print ("<br><table border='0px'>");
		print ("<tr>");
		print ("<td style= 'font-weight:bold'>Delete   </td>");
		print ("<td style= 'font-weight:bold'>Plane Model							</td>");
		print ("<td style= 'font-weight:bold'>Current Location</td>");
		print ("</tr>");
		$result = $link->executeQuery("SELECT * FROM `planes`", $_SERVER["SCRIPT_NAME"]);
		while ($row = mysql_fetch_array($result))
		{
			print ("<tr><td><a href = \"javascript: deletePlane('".$row ['model']."');\" style = \"color: red\">delete</td>".
				"<td>".$row['model']."</td>".
				"<td>".$row['currentLocation']."</td>".
				"</tr>");
		}
		print ("</table><br>");
		print ("<a style = \"float:left\" href = \"javascript: restoreAdminContentPanel();\">Return</a>");
	} else if ($intent == "deletePlane") //delete a plane
	{
		$result = $link->executeQuery("SELECT * FROM `planes` WHERE `model` = '".$model."'", $_SERVER["SCRIPT_NAME"]);
		if (mysql_fetch_array($result)['status'])
		{
			$link->executeQuery("DELETE FROM `planes` WHERE `model` = '".$model."'", $_SERVER["SCRIPT_NAME"]);
			print ("<plane style = \"color:green\">".$model." was deleted</plane><br>");
		}
		else
			print ("<span>Error! Unavailable plane is currently on lease, wait until it is check in</span>");
		
		print ("<table border='0px'>");
		print ("<tr>");
		print ("<td>Delete   </td>");
		print ("<td>Model							</td>");
		print ("<td>Current Location</td>");
		print ("</tr>");
		$result = $link->executeQuery("SELECT * FROM `planes`", $_SERVER["SCRIPT_NAME"]);
		while ($row = mysql_fetch_array($result))
		{
			print ("<tr><td><a href = \"javascript: deletePlane('".$row ['model']."');\" style = \"color: red\">delete</td>".
				"<td>".$row['model']."</td>".
				"<td>".$row['currentLocation']."</td>".
				"</tr>");
		}
		print ("</table><br>");
		print ("<a style = \"float:left\" href = \"javascript: restoreAdminContentPanel();\">Return</a>");
	} else if ($intent == "addPlaneToTable")
	{
		if ($model != '' && $airportLocation != '')
		{
			$sql = "INSERT INTO `planes` (`model`, `status`, `currentLocation`) VALUES ('".$model."', '1', '".$airportLocation."')";
			$link->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
		}
	} else if ($intent == "populateAirportList")
	{
		$sql = "SELECT * FROM `airport_locations`";
		$result = $link->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
		print ("<option value = ''></option>");
		while ($row = mysql_fetch_array($result))
		{	
			preg_match('/^[^,]*/', $row ['airport'], $matches); //(patern, subject, matchesFound), this is the format of the regex
			if ($matches)
				print ("<option value = '".$row['airport']."'>".$matches[0]."</option>");
			else
				print ("<option value = '".$row['airport']."'>".$row['airport']."</option>");
		}
	} else if ($intent == "updateField")
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
		exit;
	}
?>

