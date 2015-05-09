<?php
/*
  This is the user profile page
*/
	$debug = false;
	session_start();// Starting Session
	include ("headHTML.html");
	include ('travelHist.php'); //needs this class to dereference linked list object
	
	if (isset($_SESSION['loginId']))
	{
		$query = $link->executeQuery("select * from `customer_profile` where `email` = '".$_SESSION['loginId']."'", $_SERVER["SCRIPT_NAME"]);
		if ($query !== false)
			while ($row = mysql_fetch_array($query))
			{
				$fName = $row['firstName'];
				$lName = $row['lastName'];
				$street = $row['street'];
				$city = $row['city'];
				$state = $row['state'];
				$zip = $row['zip'];
				$avatar = $row['avatar'];
				$phone = $row['phone'];
				$plane = $row['plane'];
				$balance = $row['balance'];
			}
		
		$result = $link->executeQuery("select * from `customer_profile` where `email` = '".$_SESSION['loginId']."'", $_SERVER["SCRIPT_NAME"]);
		while ($row = mysql_fetch_array($result))
			$serializedTravelHistData = $row ['travelHist'];
		$travelHistList = unserialize($serializedTravelHistData);
		if ($travelHistList == NULL) //perform automatic repair of linked list if list doesn't exist in database
		{
			$travelHistList = new SplDoublyLinkedList();
			$link->executeQuery("UPDATE `customer_profile` SET `travelHist` = '".serialize(new SplDoublyLinkedList())."' WHERE `email` = '".$_SESSION['loginId']."'", $_SERVER["SCRIPT_NAME"]);
		}
		
		if ($plane !== '')
		{
			$query = $link->executeQuery("select * from `planes` where `model` = '".$plane."'", $_SERVER["SCRIPT_NAME"]);
			while ($row = mysql_fetch_array($query))
				$returnDate = $row['returnDate'];
		}
	}
	
	print ("<div class = \"userBaseFramePanel\">");
		print ("<font size = \"3\">");
		print ("<div class = \"userBasePanel\">");
			print("<div class = \"userInfoPanel\">");
				print ("<strong><font size = \"5\"><a style = \"color:#CC3300\" href=\"main.php\">PLANES FOR HIRE</a></font></strong><br>");	
				print ($fName." ");
				print ($lName);
				print ("<a style = \"float:right\" href = \"javascript: changeUserInfo('userTrvHistPanel');\">Edit Info</a><br>");
				print ($street."<br>");
				print ($city.", ");
				print ($state." ");
				print ($zip."<br>");
				print ($phone."<br>");
				print ($_SESSION['loginId']."<br><br>");
				if ($plane !== '')
				{
					print ("Plane on hold  ".$plane."<br>");
					print ("Return by  ".$returnDate."<br><br>");
				}
				print ("Balance $".$balance);
				print ("<a style = \"float:right\" href = \"javascript: payBalance('userTrvHistPanel');\">Pay</a><br>");
				print ("<a style = \"float:right\" href = \"javascript: updatePassword('userTrvHistPanel');\">Change password</a>");
				print ("<a style = \"float:left\" href = \"javascript: waitingList('yes|none|showWaitList|userTrvHistPanel');\">Show wait list    </a>");
				print ("<a style = \"float:left\" href = \"javascript: waitingList('yes|none|removeFromList|userTrvHistPanel');\">Clear wait list</a><br><br>");
			print ("</div>");
			
			print("<div id = \"userExtenPanel\" class = \"userExtenPanel\">");
                        print("<form action=\"search.php\">");
                                print ("<input type = \"submit\" value = \"Find it\" id = \"searchButton\"><input type = \"text\" name=\"query\" id = \"textBox\" maxlength = \"120\" placeholder = \"Looking for something?\">");
                        print("</form>");
				print ("<a style = \"float:right\" href=\"logout.php\">Logout    </a><br>");
				print ("<a href = \"javascript: changeAvatar('userExtenPanel');\"><img id = \"userAvatar\" class = \"userAvatar\" src = \"/picsUploads/".$avatar."\"></a><br>");
				print ("<a href = \"javascript: changeAvatar('userExtenPanel');\"> Choose Avatar</a><br>");
			print ("</div>");
			
			print("<div id = \"userTrvHistPanel\" class = \"userTrvHistPanel\">");
				if (isset($_SESSION['loginId']) && $_SESSION['loginId'] !== "admin")
				{	
					print ("Travel History		<a href = \"javascript: updateUserInfo('clearHist');\">Clear</a>");
					if (isset($travelHistList))
					{
						//prints the labels for the travel history table
						print ("<table border='0px'>");
						print ("<tr>");
						print ("<td style= 'color:#CC0000; font-weight:bold'>Departing Airport							</td>");
						print ("<td style= 'color:#CC0000; font-weight:bold'>Arrival Airport								</td>");
						print ("<td style= 'color:#CC0000; font-weight:bold'>Date Traveled  	</td>");
						print ("<td style= 'color:#CC0000; font-weight:bold'>Leased Model							</td>");
						print ("</tr>");
				
						for ($travelHistList -> rewind(); $travelHistList -> valid(); $travelHistList -> next())
							print ("<tr><td>".$travelHistList -> current() -> depart."</td><td>".$travelHistList -> current() -> arrive."</td><td>".$travelHistList -> current() -> travelDate."</td><td>".$travelHistList -> current() -> leasedModel."</td></tr>");
						print ("</table></font>");			
					} else	
						print ("Error loading travel history table");
				}
			print ("</div>");
		
		print ("</div>");
		
		print ("</font>");
	print ("</div>");
	
	print ("<script>saveTrvHist();</script>");
	print ("<label id = \"xmlRespondFeedback\" style = \"visibility:hidden;\"></label>");
	include ("tailHTML.html");
?>