<?php
/*
 Comments goes here!!
*/
	$debug = false;
	include ('link.php');
	include ('travelHist.php');
	$link = new Link($debug);
	$travelHistObj = new TravelHistory();	
	session_start();
	
	$_SESSION['depart'] = $_POST['depart'];
	$_SESSION['arrive'] = $_POST['arrive'];
	$_SESSION['duration'] = $_POST['duration']; 
	$_SESSION['startDate'] = $_POST['startDate'];
	$_SESSION['returnDate'] = $_POST['returnDate'];
	$originalReturnDate = $_SESSION['returnDate'];
	$_SESSION['returnDate'] = date('Y-m-d', strtotime($_SESSION['returnDate']));
	$_SESSION['model'] = $_POST['model'];
	$email = $_SESSION['loginId'];	
	
	$result = $link->executeQuery("select * from `customer_profile` WHERE `email` = '".$email."'", $_SERVER["SCRIPT_NAME"]);
	while ($row = mysql_fetch_array($result))
		$serializedTravelHistData = $row ['travelHist'];
	
	$travelHistList = unserialize($serializedTravelHistData);
	if ($travelHistList == NULL) //perform automatic repair of linked list if doesn't exist in database
	{
		$travelHistList = new SplDoublyLinkedList();
		$link->executeQuery("UPDATE `customer_profile` SET `travelHist` = '".serialize(new SplDoublyLinkedList())."' WHERE `email` = '".$_SESSION['loginId']."'", $_SERVER["SCRIPT_NAME"]);
	}
	
	if (count($travelHistList) > 50)
		$travelHistList -> offsetUnset(0); //removing the first item from the list
	
	preg_match('/^[^,]*/', $_SESSION['depart'], $matches); //(patern, subject, matchesFound), this is the format of the regex
	$travelHistObj -> depart = $matches[0];
	preg_match('/^[^,]*/', $_SESSION['arrive'], $matches); //(patern, subject, matchesFound), this is the format of the regex
	$travelHistObj -> arrive = $matches[0];
	$travelHistObj -> travelDate = date('Y-m-d', strtotime($_SESSION['startDate']));
	$travelHistObj -> leasedModel = $_SESSION['model'];
	
	$travelHistList -> push ($travelHistObj);
	$serializedTravelHistData = serialize($travelHistList);
	
	//update the customer_profile table to indicate they have check out a plane, and which plane model they check out		
	$sql = "UPDATE `customer_profile` SET `checkOutStatus` = '1', `plane` = '".$_SESSION['model']."', `travelHist` = '".$serializedTravelHistData."' WHERE `email` = '".$email."'";
	$link->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	
	//update the planes table to mark the specific model as checked out
	$sql = "UPDATE `planes` SET `status` = '0', `currentLocation` = '', `client` = '".$email."', `leaseFrom` = '".$_SESSION['depart']."', `returnTo` = '".$_SESSION['arrive']."', `returnDate` = '".$_SESSION['returnDate']."'  WHERE `model` = '".$_SESSION['model']."'";
	$link->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	
	//pull the airport_location table to get departure and arrival coordinates to push into member's travel history table  
	$sql = "select * from `airport_locations` WHERE `airport` = '".$_SESSION['depart']."'";
	$result = $link->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	while ($row = mysql_fetch_array($result))
	{
		$origLong = $row ['long'];
		$origLat = $row ['lat'];
	}
	
	$result = $link->executeQuery("select * from `customer_profile` WHERE `email` = '".$email."'", $_SERVER["SCRIPT_NAME"]);
	while ($row = mysql_fetch_array($result))
		$custName = $row ['firstName'];
	
	preg_match('/[^,]*/', $_SESSION['depart'], $depart); //(patern, subject, matchResult)
	preg_match('/[^,]*/', $_SESSION['arrive'], $arrive); //(patern, subject, matchResult)
	
	print ("Hi ".$custName.", here are your check out results<br>".
		   "Leaving From ".$depart[0]."<br>".
		   "Arriving to ".$arrive[0]."<br>".
		   "Leasing the ".$_SESSION['model']." for ".$_SESSION['duration']." days<br>".
		   "Beginning on ".$_SESSION['startDate']." to ".$originalReturnDate."<br><br>".
		   "<a style = \"float:right;color:black\" href = \"Main.php\">Continue		</a>");	
?>