<?php
/*
 Comments goes here!!
*/
	$debug = false;
	include ('link.php');
	$link = new Link($debug);
	session_start();
	
	if (isset($_POST['airport']))
		$_SESSION['airport'] = $_POST['airport'];
	
	if (isset($_POST['notification']))
	{
		$model = $_POST['notification'];		
		$result = $link->executeQuery("select * from `planes` WHERE `model` = '".$model."'", $_SERVER["SCRIPT_NAME"]);
		while ($row = mysql_fetch_array($result))
			$serializedMemberWaitList = $row ['memberWaitList'];
		$memberWaitList = unserialize($serializedMemberWaitList);
		for ($memberWaitList -> rewind(); $memberWaitList -> valid(); $memberWaitList -> next())  // perform walk over the list
			if ($memberWaitList -> current() == $_SESSION['loginId'])
			{
				$key1 = $memberWaitList -> key();
				$memberWaitList -> offsetUnset($key1);
				$link->executeQuery("UPDATE `planes` SET `memberWaitList` = '".serialize($memberWaitList)."' WHERE `model` = '".$model."'", $_SERVER["SCRIPT_NAME"]);
			}
		$link->executeQuery("UPDATE `customer_profile` SET `notification` = '' WHERE `email` = '".$_SESSION['loginId']."'", $_SERVER["SCRIPT_NAME"]);	
	}
	
	print ("<option value = ''>Select A Plane</option>");
	$result = $link->executeQuery("select * from `planes` WHERE `currentLocation` = '".$_SESSION['airport']."'", $_SERVER["SCRIPT_NAME"]);
	$rows = mysql_num_rows($result);  // available plane 
	if ($rows > 0)		
		while ($row = mysql_fetch_array($result))
		{
			$value = $row ['model']."|1";
			print ("<option value = \"".$value."\">&#10003 ".$row['model']."</option>");
		}
	$result = $link->executeQuery("select * from `planes` WHERE `currentLocation` != '".$_SESSION['airport']."'", $_SERVER["SCRIPT_NAME"]);
	$rows = mysql_num_rows($result);  // not available planes
	if ($rows > 0)
		while ($row = mysql_fetch_array($result))
		{
			$value = $row ['model']."|0";
			print ("<option value = \"".$value."\">&#10007 ".$row['model']."</option>");
		}
	
?>