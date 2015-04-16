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
		//if ($field == "city")
			print ("hello world");
		
		$sql = "UPDATE `customer_profile` SET `".$field."` = '".$newVal."' WHERE `email` = '".$email."'";
		$link->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	}
?>

