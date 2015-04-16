<?php
/*
 Comments goes here!!
*/
	$debug = false;
	include ('../link.php');
	$link = new Link($debug);
	
	$email = $_POST['email'];
	$field = $_POST['field'];
	$newVal = $_POST['newVal'];
	
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
		$sql = "DELETE FROM `customer_profile` WHERE `email` = '".$email."'";
		$link->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
		$sql = "DROP TABLE `".$email."`";
		$link->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
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
?>

