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
				$planeWaitList = unserialize($row ['planeWaitList']);
			
			if ($planeWaitList == NULL) //if this airport doesn't have a list, then create a new list for it
			{
				$planeWaitList = new SplDoublyLinkedList(); //create a new plane list for this airport
				$memberWaitList = new SplDoublyLinkedList(); //create a new member waitlist to be put into the plane wait list
				$memberWaitList -> push($model); //the first element of the member wait list will always the model of the plane
				//$memberWaitList -> push($_SESSION['loginId']); //every element after the first element of the member wait list will be the waiting member
				$planeWaitList -> push($memberWaitList); //push the member wait list into the plane wait list
				$link->executeQuery("UPDATE `airport_locations` SET `planeWaitList` = '".serialize($planeWaitList)."' WHERE `airport` = '".$airport."'", $_SERVER["SCRIPT_NAME"]);			
			} else if ($planeWaitList != NULL) //consider if the airport's plane wait list is not null, then look through the plane wait list to see if it contains that plane 
			{
				$planeExist = "no";
				for ($planeWaitList -> rewind(); $planeWaitList -> valid(); $planeWaitList -> next())  // perform walk over the list
				{
					$memberWaitList = $planeWaitList -> current();
					$plane = $memberWaitList -> offsetGet(0); //the first element of the member wait list is the model of the plane
					if ($plane == $model)
					{
						$planeExist = "yes";		// if it exits , then break out the loop
						break;
					}
				}
			
				if ($planeExist == "no") //if the plane wait list does not contain the current requested model, then push it on the plane wait list
				{
					$memberWaitList = new SplDoublyLinkedList(); //create a new member waitlist to be put into the plane wait list
					$memberWaitList -> push($model); //the first element of the member wait list will always the model of the plane
					$planeWaitList -> push($memberWaitList); //push the member wait list into the plane wait list
					$link->executeQuery("UPDATE `airport_locations` SET `planeWaitList` = '".serialize($planeWaitList)."' WHERE `airport` = '".$airport."'", $_SERVER["SCRIPT_NAME"]);
				}
			}
		}
	}
		
	if ($intent == "addToList") //at this point of the code there will be the plane wait list at the selected airport, and as well as the member wait list in that list 
	{	//first perform query to get the wait list from the particular airort
		$result = $link->executeQuery("select * from `airport_locations` WHERE `airport` = '".$airport."'", $_SERVER["SCRIPT_NAME"]);
			while ($row = mysql_fetch_array($result))
				$planeWaitList = unserialize($row ['planeWaitList']);
			
			//then perform the walk over the list to find the particular requested model (the requested model is also actually a list, a memberWaitList) 
			for ($planeWaitList -> rewind(); $planeWaitList -> valid(); $planeWaitList -> next())  // perform walk over the list of planes
			{	
				$memberWaitList = $planeWaitList -> current(); //for each of those model, get the list from it to determine the specific model
				$plane = $memberWaitList -> offsetGet(0); //we're only interested in the first element of the list, since the first element of the memberWaitList is the model of the plane
				
				if ($plane == $model) //if the list of the interested model is found, then perform the walk over that list to find the user member
				{
					$memberExist = "no"; //we assume the member does not exist in the list until they're found
					//then perform the walk over the list of memberWaitList to determine if they're already in the list, we don't want to add the member to the list more than once
					for ($memberWaitList -> rewind(); $memberWaitList -> valid(); $memberWaitList -> next())
					{
						$member = $memberWaitList -> current();
						if ($member == $_SESSION['loginId'])
						{
							$memberExist = "yes";
							break;
						}
					}
					
					if ($memberExist == "no") //if the member is not found in the memberWaitList
					{
						$memberWaitList -> push($_SESSION['loginId']); //then add them in
						$planeWaitList -> push($memberWaitList); //then push that memberWaitList back into the planeWaitList and push it back into the database
						$link->executeQuery("UPDATE `airport_locations` SET `planeWaitList` = '".serialize($planeWaitList)."' WHERE `airport` = '".$airport."'", $_SERVER["SCRIPT_NAME"]);
					}
					
					break;
				}
			}
		
		print ("<META http-equiv = \"REFRESH\" content = \"0; Main.php\">"); //this line is commented for debug, remove when implimentation done
	} else if ($intent == "showWaitList")
	{	
		$tempBfr = new SplDoublyLinkedList(); //I have to use this to filter out repeated entries, I could not figure out why the list doesn't behave properly!!!
		$result_1 = $link->executeQuery("select * from `airport_locations`", $_SERVER["SCRIPT_NAME"]);
		while ($row = mysql_fetch_array($result_1))
		{	
			$planeWaitList = unserialize($row ['planeWaitList']);
			$airport = $row ['airport'];
			
			if ($planeWaitList != NULL)
				for ($planeWaitList -> rewind(); $planeWaitList -> valid(); $planeWaitList -> next())  // perform walk over the list
				{
					$memberWaitList = $planeWaitList -> current();
					$plane = $memberWaitList -> offsetGet(0); //we're only interested in the first element of the list, since the first element of the memberWaitList is the model of the plane
					
					for ($memberWaitList -> rewind(); $memberWaitList -> valid(); $memberWaitList -> next())  // perform walk over the list
					{
						$member = $memberWaitList -> current();
						$positionInLine = $memberWaitList -> key();
						
						if ($member == $_SESSION['loginId'])
						{							
							preg_match('/^[^,]*/', $airport, $matches); // put the * back before the /
							if ($matches)
							{
								$elemExist = 0;
								for ($tempBfr -> rewind(); $tempBfr -> valid(); $tempBfr -> next())
									if ($tempBfr -> current() == "<tr><td>".$positionInLine."</td><td>".$plane."</td><td>".$matches[0]."</td></tr>")
										$elemExist = 1;
								
								if (!$elemExist)
									$tempBfr -> push("<tr><td>".$positionInLine."</td><td>".$plane."</td><td>".$matches[0]."</td></tr>");
							
							} else
							{
								$elemExist = 0;
								for ($tempBfr -> rewind(); $tempBfr -> valid(); $tempBfr -> next())
									if ($tempBfr -> current() == "<tr><td>".$positionInLine."</td><td>".$plane."</td><td>".$airport."</td></tr>")
										$elemExist = 1;
								
								if (!$elemExist)
									$tempBfr -> push("<tr><td>".$positionInLine."</td><td>".$plane."</td><td>".$airport."</td></tr>");
							}
							
							break;
						}
					}
				}
		}
		
		print ("<div style = \"width:45%\"><font size = \"3\">");
		print ("<table border='0px'><tr><td>Position </td><td>Model						</td><td>Waiting at</td></tr>");
		for ($tempBfr -> rewind(); $tempBfr -> valid(); $tempBfr -> next())  // perform walk over the list
			print ($tempBfr -> current());
		print ("</table><br><a style = \"float:right\" href = \"javascript: showTrvHist();\"> Continue</a></font></div>");
	
	} else if ($intent == "removeFromList")
	{
		$result_1 = $link->executeQuery("select * from `airport_locations`", $_SERVER["SCRIPT_NAME"]);
		print ("<div style = \"width:53%\"><font size = \"3\">Removing from:<br>");
		while ($row = mysql_fetch_array($result_1))
		{
			$planeWaitList = unserialize($row ['planeWaitList']);
			$airport = $row['airport']; //helper variable necessary to update the database. needed variable !!!
			
			if ($planeWaitList != NULL)
			{
				for ($planeWaitList -> rewind(); $planeWaitList -> valid(); $planeWaitList -> next())  // perform walk over the list
				{
					$memberWaitList = $planeWaitList -> current();
					$model = $memberWaitList -> offsetGet(0); //helper data for visual feed back to the user, has no internal functional benefit
					
					for ($memberWaitList -> rewind(); $memberWaitList -> valid(); $memberWaitList -> next())  // perform walk over the list
					{
						$member = $memberWaitList -> current();
						$key = $memberWaitList -> key();
						
						if ($member == $_SESSION['loginId'])
						{
							preg_match('/[^,]*,[^,]*$/', $airport, $matches); //(patern, subject, matchesFound), this is the format of the regex
							if ($matches)
								print ("Removing from list for ".$model." waiting at ".$airport."<br>");
							else
								print ("Removing from list for ".$model." waiting at ".$airport."<br>");
							
							$memberWaitList -> offsetUnset($key);
							$planeWaitList -> push($memberWaitList);
							$link->executeQuery("UPDATE `airport_locations` SET `planeWaitList` = '".serialize($planeWaitList)."' WHERE `airport` = '".$airport."'", $_SERVER["SCRIPT_NAME"]);
						}
					}
				}
			}
		}
		
		print ("<br><a style = \"float:right\" href = \"javascript: showTrvHist();\">Continue</a></font></div>");
	} else if ($intent == "showConfirm")
	{
		/*
		================================================ active test area for wait list datastructure implimentation ===========================
		
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
		
		
		==============================================end of test area=========================================================================
		*/
		
		//for the showing confirmation dialog, we begin by retrieving the datastructure content from the database
		$result = $link->executeQuery("select * from `airport_locations` WHERE `airport` = '".$airport."'", $_SERVER["SCRIPT_NAME"]);
		while ($row = mysql_fetch_array($result))
			$planeWaitList = unserialize($row ['planeWaitList']);
		//the retrieved content is a linked lists of linked list, a list of waiting members inside a list list of planes  
		for ($planeWaitList -> rewind(); $planeWaitList -> valid(); $planeWaitList -> next())  // perform walk over the list of planes
		{
			$memberWaitList = $planeWaitList -> current(); //for each of those model, get the list from it to determine the specific model
			$plane = $memberWaitList -> offsetGet(0); //we're only interested in the first element of the list, since the first element of the memberWaitList is the model of the plane
			if ($plane == $model) //if the model of the plane is found, then we only need to check how many elements are in that list
			{
				$numOfMember = count($memberWaitList) - 1; //we decrement by 1 because the first element is the name of the plane itself, and we are only interested in the number of members
			}
		}
		//$numOfMember = count($memberWaitList);
		$htmlWaitingListStr = "This Plane is currently not available at this airport<br>".
							  "Would you like to be added the waiting list instead?<br><br>".
							  "Currently waiting: ".$numOfMember." people<br>". 
							  "<a style =\"float:right\" href = \"javascript: waitingList('yes|".$model."|addToList|mainFormPanel');\">Yes       </a>".
							  "<a style = \"float:right\"href = \"javascript: waitingList('no');\">No   </a>".
							  "<br><br><br>";
		
		print ($htmlWaitingListStr);
	}	
?>