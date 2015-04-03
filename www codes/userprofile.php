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
	
	print ("<label><strong><font size = \"5\" color = \"#595959\"><a href=\"main.php\"><br>Planes For Hire</a></font></strong></label>");
	print ("<input type = \"button\" value = \"Find it\" id = \"searchButton\"><input type = \"text\" id = \"textBox\" maxlength = \"120\" placeholder = \"Looking for something?\">");
	print ("<font size = \"3\" style = \"float:right\"><a href=\"logout.php\">Logout    </a></font><br>");
		
	print ("<div class = \"userBasePanel\">");
		print("<div class = \"userInfoPanel\">");
			print ("<font size = \"3\">");
			print ($fName." ");
			print ($lName);
			print ("<text style = \"float:right\"><a href = \"javascript: changeUserInfo('userTrvHistPanel');\">Edit</a></text><br>");
			print ($street."<br>");
			print ($city.", ");
			print ($state." ");
			print ($zip."<br>");
			print ($phone."<br>");
			print ($_SESSION['loginId']."<br><br>");
			if ($plane !== '')
				print ("Plane on hold  ".$plane."<br><br>");
			print ("Balance $".$balance);
			print ("<a style = \"float:right\" href = \"javascript: payBalance('userTrvHistPanel');\">Pay</a><br>");
			print ("<a style = \"float:right\" href = \"javascript: updatePassword('userTrvHistPanel');\">Change password</a><br>");
			print ("</font>");
		print ("</div>");
			
		print("<div class = \"userExtenPanel\">");
			print ("<font size = \"3\">");
			print ("<img id = \"userAvatar\" class = \"userAvatar\"src = \"/picsUploads/default.jpg\"><br>");
			print ("<input type = \"file\" id = \"file\" name = \"file\"><br>");
			print ("</font>");
		print ("</div>");
	
		print("<div id = \"userTrvHistPanel\" class = \"userTrvHistPanel\">");
			print ("<font size = \"3\">");
			if (isset($_SESSION['loginId']) && $_SESSION['loginId'] !== "admin")
			{
				print ("Travel History		<a href = \"javascript: updateUserInfo('clearHist');\">Clear</a><br>");
				if (isset($travelHist))
				{
					//prints the labels for the travel history table
					print ("<table border='0px'>");
					print ("<tr>");
					print ("<td>Departing Airport						</td>");
					print ("<td>Arrival Airport							</td>");
					print ("<td>Date And Time Traveled    		</td>");
					print ("<td>Leased Model							</td>");
					print ("</tr>");
			
					while ($row = mysql_fetch_array($travelHist))
						print ("<tr><td>".$row ['origAirport']."</td><td>".$row ['destAirport']."</td><td>".$row ['dateTravel']."</td><td>".$row ['leaseModel']."</td></tr>");
					print ("</table></font>");
					print ("<script>window.onload = saveTrvHist(); </script>");
				} else	
					print ("Error loading travel history table");
				print ("</font>");
			}
		print ("</div>");	
	print ("</div>");
	include ("tailHTML.html");
	

?>