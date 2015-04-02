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
	
	print ("<label><strong><center><font size = \"6\" color = \"#595959\">Planes For Hire</font></center></strong><br>");
	print ("</label>");
	
	print ("<input type = \"button\" value = \"Find it\" id = \"searchButton\"><input type = \"text\" id = \"textBox\" maxlength = \"120\" placeholder = \"Looking for something?\">");
	print ("<font size = \"3\" style = \"float:right\"><a href=\"../main.php\">Main Page    </a><a href=\"../logout.php\">Logout    </a></font><br>");
		
	print ("<br><div class = \"userBasePanel\">");
		print("<div class = \"userInfoPanel\">");
			print ("<font size = \"3\">".$fName." </font>");
			print ("<font size = \"3\">".$lName."</font>");
			print ("<font size = \"3\" style = \"float:right\"><a href=\"../main.php\">Edit		</a></font><br>");
			print ("<font size = \"3\">".$street." </font><br>");
			print ("<font size = \"3\">".$city.", </font>");
			print ("<font size = \"3\">".$state." </font>");
			print ("<font size = \"3\">".$zip."</font><br>");
			print ("<font size = \"3\">".$phone."</font><br><br>");
			if ($plane !== '')
				print ("<font size = \"3\">Plane on hold  ".$plane."</font><br><br>");
			print ("<font size = \"3\">Balance $".$balance."</font>");
			print ("<font size = \"3\" style = \"float:right\"><a href=\"../main.php\">Pay		</a></font><br>");
			print ("<font size = \"3\" style = \"float:right\"><a href=\"../main.php\">Change password			</a></font><br>");
		print ("</div>");
			
		print("<div class = \"userExtenPanel\">");
			print ("<font size = \"3\">User avatar other user settings goes here</font>");
		print ("</div>");
	
		print("<div class = \"userTrvHistPanel\">");
			if (isset($_SESSION['loginId']) && $_SESSION['loginId'] !== "admin")
			{
				print ("<font size = \"3\"><label> Travel History</label><br>");
				if (isset($travelHist))
				{
					//prints the labels for the travel history table
					print ("<table border='0px'>");
					print ("<tr>");
					print ("<td>Departing Airport						</td>");
					print ("<td>Arrival Airport							</td>");
					print ("<td>Date And Time Traveled    				</td>");
					print ("<td>Leased Model							</td>");
					print ("</tr>");
			
					while ($row = mysql_fetch_array($travelHist))
						print ("<tr><td>".$row ['origAirport']."</td><td>".$row ['destAirport']."</td><td>".$row ['dateTravel']."</td><td>".$row ['leaseModel']."</td></tr>");
					print ("</table></font><br><br>");
				} else
					print ("Error loading travel history table");
			}
		print ("</div>");	
	print ("</div>");
	include ("tailHTML.html");
	

?>