<?php
/*
  This is the main page
*/
	$debug = false;
	session_start();// Starting Session
	include ("headHTML.html");
	
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
		$travelHist = $link->executeQuery("select * from `".$_SESSION['loginId']."`", $_SERVER["SCRIPT_NAME"]);
	}
	
	print ("<div class = \"userBaseFramePanel\">");
		print ("<font size = \"3\">");
		print ("<div class = \"userBasePanel\">");
			print("<div class = \"userInfoPanel\">");
				print ("<strong><font size = \"5\"><a style = \"color:#CC3300\" href=\"main.php\">PLANES FOR HIRE</a></font></strong><br>");	
				print ($fName." ");
				print ($lName);
				print ("<a style = \"float:right; color:black\" href = \"javascript: changeUserInfo('userTrvHistPanel');\">Edit</a><br>");
				print ($street."<br>");
				print ($city.", ");
				print ($state." ");
				print ($zip."<br>");
				print ($phone."<br>");
				print ($_SESSION['loginId']."<br><br>");
				if ($plane !== '')
					print ("Plane on hold  ".$plane."<br><br>");
				print ("Balance $".$balance);
				print ("<a style = \"float:right; color:black\" href = \"javascript: payBalance('userTrvHistPanel');\">Pay</a><br>");
				print ("<a style = \"float:right; color:black\" href = \"javascript: updatePassword('userTrvHistPanel');\">Change password</a><br><br>");
			print ("</div>");
			
			print("<div id = \"userExtenPanel\" class = \"userExtenPanel\">");
				print ("<input type = \"button\" value = \"Find it\" id = \"searchButton\"><input type = \"text\" id = \"textBox\" maxlength = \"120\" placeholder = \"Looking for something?\">");
				print ("<a style = \"float:right; color:black\" href=\"logout.php\">Logout    </a><br>");
				print ("<img id = \"userAvatar\" class = \"userAvatar\" src = \"/picsUploads/".$avatar."\"><br>");
				print ("<a style = \"color:black\"href = \"javascript: changeAvatar('userExtenPanel', '".$avatar."');\">Edit</a><br>");
			print ("</div>");
	
			print("<div id = \"userTrvHistPanel\" class = \"userTrvHistPanel\">");
				if (isset($_SESSION['loginId']) && $_SESSION['loginId'] !== "admin")
				{	
					print ("Travel History		<a style = \"color:black\" href = \"javascript: updateUserInfo('clearHist');\">Clear</a>");
					if (isset($travelHist))
					{
						//prints the labels for the travel history table
						print ("<table border='0px'>");
						print ("<tr>");
						print ("<td>Departing Airport							</td>");
						print ("<td>Arrival Airport								</td>");
						print ("<td>Date And Time Traveled  	</td>");
						print ("<td>Leased Model							</td>");
						print ("</tr>");
						
						while ($row = mysql_fetch_array($travelHist))
							print ("<tr><td>".$row ['origAirport']."</td><td>".$row ['destAirport']."</td><td>".$row ['dateTravel']."</td><td>".$row ['leaseModel']."</td></tr>");
						print ("</table></font>");
					} else	
						print ("Error loading travel history table");
				}
			print ("</div>");
		print ("</div>");
		print ("</font>");
	print ("</div>");
	print ("<script>saveTrvHist();</script>");
	include ("tailHTML.html");
	

?>