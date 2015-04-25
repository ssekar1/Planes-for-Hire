<?php
/*
 Comments goes here!!
*/
	$debug = false;
	include ('link.php');
	$link = new Link($debug);
	session_start();
	
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
	
	print (""); //use for feedback purposes, do not delete!!!
?>