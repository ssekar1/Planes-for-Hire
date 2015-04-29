<?php
/*
 Comments goes here!!
*/
	$debug = false;
	include ('link.php');
	$link = new Link($debug);
	session_start();
		
	if (isset($_POST['airport']) && isset($_POST['model']) && isset($_POST['intent']))
	{
		$airport = $_POST['airport'];
		$model = $_POST['model'];
		$intent = $_POST['intent'];
		
		/*
		 * these two block perform autonomic repair in case the data structure in the database is broken
		 */
		$result = $link->executeQuery("select * from `airport_locations` WHERE `airport` = '".$airport."'", $_SERVER["SCRIPT_NAME"]);
		if (mysql_num_rows($result) > 0)
		{
			while ($row = mysql_fetch_array($result))
				$serializedPlaneWaitList = $row ['planeWaitList'];
			$planeWaitList = unserialize($serializedPlaneWaitList);
			if ($planeWaitList == NULL) //perform automatic repair of linked list if doesn't exist in database
				$link->executeQuery("UPDATE `airport_locations` SET `planeWaitList` = '".serialize(new SplDoublyLinkedList())."' WHERE `airport` = '".$airport."'", $_SERVER["SCRIPT_NAME"]);
		}
		if (mysql_num_rows($result) > 0)
		{
			$result = $link->executeQuery("select * from `planes` WHERE `model` = '".$model."'", $_SERVER["SCRIPT_NAME"]);
			while ($row = mysql_fetch_array($result))
				$serializedMemberWaitList = $row ['memberWaitList'];
			$memberWaitList = unserialize($serializedMemberWaitList);
			if ($memberWaitList == NULL) //perform automatic repair of linked list if doesn't exist in database
				$link->executeQuery("UPDATE `planes` SET `memberWaitList` = '".serialize(new SplDoublyLinkedList())."' WHERE `model` = '".$model."'", $_SERVER["SCRIPT_NAME"]);
		}
	}
	//print ("inside the waitingList.php<br>member is ".$_SESSION['loginId']."<br>airport is ".$airport."<br>model is ".$model."<br>");	//for debug
		
	if ($intent == "addToList")
	{
		//perform check on airport list to see if model already exist in list
		$result = $link->executeQuery("select * from `airport_locations` WHERE `airport` = '".$airport."'", $_SERVER["SCRIPT_NAME"]);
		while ($row = mysql_fetch_array($result))
			$serializedPlaneWaitList = $row ['planeWaitList'];
		$planeWaitList = unserialize($serializedPlaneWaitList);
		
		$planeExist = "no";   // boolean variable to use to check if plane exists in list
		for ($planeWaitList -> rewind(); $planeWaitList -> valid(); $planeWaitList -> next())  // perform walk over the list
			if ($planeWaitList -> current() == $model)
			{
				$planeExist = "yes";		// if it exits , then break out the loop
				break;
			}
		
		if ($planeExist == "no")		// if no found , push model into list , then push to the database 
		{
			$planeWaitList -> push ($model);
			$serializedPlaneWaitList = serialize ($planeWaitList);	
			$link->executeQuery("UPDATE `airport_locations` SET `planeWaitList` = '".$serializedPlaneWaitList."' WHERE `airport` = '".$airport."'", $_SERVER["SCRIPT_NAME"]);
		}
		
		//perform check on member Wait List to see if member is already exist in list
		$result = $link->executeQuery("select * from `planes` WHERE `model` = '".$model."'", $_SERVER["SCRIPT_NAME"]);
		while ($row = mysql_fetch_array($result))
			$serializedMemberWaitList = $row ['memberWaitList'];
		$memberWaitList = unserialize($serializedMemberWaitList);
		
		$memberExist = "no";   // boolean variable to use to check if plane exists in list
		for ($memberWaitList -> rewind(); $memberWaitList -> valid(); $memberWaitList -> next())  // perform walk over the list
			if ($memberWaitList -> current() == $_SESSION['loginId'])
			{
				$memberExist = "yes";		// if it exits , then break out the loop
				break;
			}
		
		if ($memberExist == "no")		// if no found , push model into list , then push to the database 
		{
			$memberWaitList -> push ($_SESSION['loginId']);
			$serializedMemberWaitList = serialize ($memberWaitList);	
			$link->executeQuery("UPDATE `planes` SET `memberWaitList` = '".$serializedMemberWaitList."' WHERE `model` = '".$model."'", $_SERVER["SCRIPT_NAME"]);
		}
		
		print ("<META http-equiv = \"REFRESH\" content = \"0; Main.php\">");
	} else if ($intent == "removeFromList")
	{
		$result = $link->executeQuery("select * from `planes`", $_SERVER["SCRIPT_NAME"]);
		print ("<div style = \"width:43%\"><font size = \"3\">Removing from:<br>");
		while ($row = mysql_fetch_array($result))
		{	
			$serializedMemberWaitList = $row ['memberWaitList'];
			$model = $row ['model'];
			$memberWaitList = unserialize($serializedMemberWaitList);
			if ($memberWaitList != NULL)
				for ($memberWaitList -> rewind(); $memberWaitList -> valid(); $memberWaitList -> next())  // perform walk over the list
					if ($memberWaitList -> current() == $_SESSION['loginId'])
					{
						print ($model." waiting list<br>");
						$key1 = $memberWaitList -> key();
						$memberWaitList -> offsetUnset($key1);
						$serializedMemberWaitList = serialize ($memberWaitList);
						$link->executeQuery("UPDATE `planes` SET `memberWaitList` = '".$serializedMemberWaitList."' WHERE `model` = '".$model."'", $_SERVER["SCRIPT_NAME"]);
						break;
					}	
		}
		print ("<a style = \"float:right\" href = \"javascript: showTrvHist();\">Continue</a></div></font>");
	} else if ($intent == "showConfirm")
	{
		/*================================================ active test area for wait list datastructure implimentation ===========================*/
		
		$file = "./airportsWaitList/test2";
		$fileObj;
		$test = "test";
		if (file_exists($file))
		{
			$fileObj = fopen($file, "a") or die("Unable to open file!");
			fwrite($fileObj, $test);
		}
		else
		{
			$fileObj = fopen($file, "w") or die("Unable to open file!");
			fwrite($fileObj, $test);
		}
		fclose($fileObj);
		
		
		/*==============================================end of test area=========================================================================*/
		
		$result = $link->executeQuery("select * from `planes` WHERE `model` = '".$model."'", $_SERVER["SCRIPT_NAME"]);
		while ($row = mysql_fetch_array($result))
			$serializedMemberWaitList = $row ['memberWaitList'];
		$memberWaitList = unserialize($serializedMemberWaitList);
		$numOfMember = count($memberWaitList);
		$htmlWaitingListStr = "This Plane is currently not available at this airport<br>".
							  "Would you like to be added the waiting list instead?<br><br>".
							  "Currently waiting: ".$numOfMember." people<br>". 
							  "<a style =\"float:right\" href = \"javascript: waitingList('yes|".$model."|addToList|mainFormPanel');\">Yes       </a>".
							  "<a style = \"float:right\"href = \"javascript: waitingList('no');\">No   </a>".
							  "<br><br><br>".$test;
		
		print ($htmlWaitingListStr);
	}	
?>