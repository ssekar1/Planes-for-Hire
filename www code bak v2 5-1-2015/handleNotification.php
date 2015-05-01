<?php
/*
 Comments goes here!!
*/
	$debug = false;
	include ('link.php');
	$link = new Link($debug);
	session_start();
	
	if (isset($_POST['notification']))
		$model = $_POST['notification'];
	
	//first determine the plane's location so we can look up the waiting list while its in that airport
	$result = $link->executeQuery("select * from `planes` WHERE `model` = '".$model."'", $_SERVER["SCRIPT_NAME"]);
	while ($row = mysql_fetch_array($result))
		$airport = $row ['currentLocation']; //retrieving the current location
	
	//then we retrieve the waiting list from that aitport 
	$result = $link->executeQuery("select * from `airport_locations` WHERE `airport` = '".$airport."'", $_SERVER["SCRIPT_NAME"]);
	while ($row = mysql_fetch_array($result))
		$planeWaitList = unserialize($row ['planeWaitList']); //retrieving the waiting list
	
	for ($planeWaitList -> rewind(); $planeWaitList -> valid(); $planeWaitList -> next())  // perform walk over the list
	{
		$memberWaitList = $planeWaitList -> current();
		$plane = $memberWaitList -> offsetGet(0); //we're only interested in the first element of the list, since the first element of the memberWaitList is the model of the plane
		if ($plane == $model)
		{
			for ($memberWaitList -> rewind(); $memberWaitList -> valid(); $memberWaitList -> next())  // perform walk over the list
			{
				if ($memberWaitList -> current() == $_SESSION['loginId'])
				{
					$key1 = $memberWaitList -> key();
					$memberWaitList -> offsetUnset($key1);
					$planeWaitList -> push ($memberWaitList);
					$link->executeQuery("UPDATE `airport_locations` SET `planeWaitList` = '".serialize($planeWaitList)."' WHERE `airport` = '".$airport."'", $_SERVER["SCRIPT_NAME"]);
				}
			}
		}			
	}
	
	$link->executeQuery("UPDATE `customer_profile` SET `notification` = '' WHERE `email` = '".$_SESSION['loginId']."'", $_SERVER["SCRIPT_NAME"]);
	
	print (""); //use for feedback purposes, do not delete!!!
?>