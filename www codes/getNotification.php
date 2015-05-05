<?php
include ("Link.php");

	/**
	* Gets a notification from a user
	*/
	function getNotification()
	{
		// Gets customer profile information of this user
		$link = new Link(false);
		$query = $link->executeQuery("select * from customer_profile where email = '" . $_SESSION['loginId'] . "'", $_SERVER["SCRIPT_NAME"]);
		
		// Breaks out of function early if notification failed
		if(!$query)
			return "";
		
		// Reads only row in 
		if ($row = mysql_fetch_array($query))
		{
			return $row["notification"];
		}
		
		// Default return if getting the notification value failed
		return "";
	}
	
	// Calls the notification function
	session_start();
	print(getNotification());
?>