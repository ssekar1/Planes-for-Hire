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
				$loginUser = $row['firstName']." ".$row['lastName'];
				$userEmail = $row['email'];
				$checkOutStatus = $row['checkOutStatus'];
				
			}
		
		if ($_SESSION['loginId'] == "admin")
			$loginUser = $_SESSION['loginId'];
		
		if (isset ($userEmail))
			$travelHist = $link->executeQuery("select * from `".$userEmail."`", $_SERVER["SCRIPT_NAME"]);
	}
	
	print ("<label><strong><center><font size = \"6\" color = \"#595959\">Planes For Hire</font></center></strong><br>");
	print ("</label>");
	
	print ("<input type = \"button\" value = \"Find it\" id = \"searchButton\"><input type = \"text\" id = \"textBox\" maxlength = \"120\" placeholder = \"Looking for something?\">");
	
	if(isset($loginUser))
	{
		print ("<font size = \"3\" style = \"float:left\">Hello ".$loginUser."</font>");
		print ("<font size = \"3\" style = \"float:right\"><a href=\"logout.php\">Logout    </a></font><br>");
	} else
	{
		print ("<font size = \"3\" style = \"float:left\">Hello you...</font>");
		print ("<font size = \"3\" style = \"float:right\"><a href=\"registration.php\">Register   </a><a href=\"login.php\">Login   </a></font><br>");
	}
	
	print("<center><div id=\"googleMap\"></div></center>");
	
	print ("<font size = \"2\">");
	if (isset($loginUser))
	{
		print ("<label> Travel History</label><br>");
		if (isset($travelHist))
		{
			//prints the labels for the travel history table
			print ("<table border='0px'>");
			print ("<tr>");
			print ("<td>Departing Airport    </td>");
			print ("<td>Departing Longitude    </td>");
			print ("<td>Departing Latitude    </td>");
			print ("<td>Arrival Airport    </td>");
			print ("<td>Arival Longitude    </td>");
			print ("<td>Arrival Latitude    </td>");
			print ("<td>Date And Time Traveled    </td>");
			print ("</tr>");
			
			while ($row = mysql_fetch_array($travelHist))
				print ("<tr><td>".$row ['origAirport']."</td><td>".$row ['origLong']."</td><td>".$row ['origLat']."</td><td>".$row ['destAirport']."</td><td>".$row ['destLong']."</td><td>".$row ['destLat']."</td><td>".$row ['dateTravel']."</td></tr>");
			print ("</table><br><br>");
		}
		else
			print ("Error loading travel history table");
		
		print("<center>");
		print("<div class = \"basePanel\">");
			print("<div class = \"leftPanel\">");
				print ("<label>Departing Airport</label><br><br>");
				mysql_data_seek($mapTbl, 0);
				while ($row = mysql_fetch_array($mapTbl))
					print ("<a href = \"javascript: focusMarker('".$row ['long']."', '".$row ['lat']."', 'departLabel', '".$row ['airport']."');\" style = \"color: black\">".$row ['airport']."</a><br><br>");
			print("</div>");
		
			print("<div class = \"middlePanel\">");
				print ("<label>Arival Airport</label><br><br>");
				mysql_data_seek($mapTbl, 0);
				while ($row = mysql_fetch_array($mapTbl))
					print ("<a href = \"javascript: focusMarker('".$row ['long']."', '".$row ['lat']."', 'arrivalLabel', '".$row ['airport']."');\" style = \"color: black\">".$row ['airport']."</a><br><br>");
			print("</div>");
			
			print("<div class = \"rightPanel\">");
				print ("<label>Rental Duration  </label><select name = \"durationSelect\" id = \"durationSelect\" onchange = \"updateForm('durationLabel', this.value)\">");
					print ("<option value = ''></option>");
					for ($x = 1; $x < 6; $x++)
						print ("<option value = \"".$x."\">".$x." day</option>");
					print ("</select><br><br>");
				
				print ("<label>Start Date   </label><input type = \"text\" id = \"datePicker\" onchange = \"updateForm('startLabel', this.value)\"><br><br>");
				
				$sql = "select * from planes";
				$planes = $link->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
				print ("<label>Plane Model  </label><select name = \"planeSelect\" id = \"planeSelect\" style = \"width: 180px\"onchange = \"updateForm('planeLabel', this.value)\">");
					print ("<option value = ''></option>");
					while ($row = mysql_fetch_array($planes))
						print ("<option value = \"".$row['model']."\">".$row['model']."</option>");
					print ("</select><br><br>");
			
				print("<label>Plane Rental Form<br>Depart from:  </label><label id = \"departLabel\"></label><br>");
				print("<label>Arrive to:  </label><label id = \"arrivalLabel\"></label><br>");
				print("<label>Rental duration:  </label><label id = \"durationLabel\"></label><br>");
				print("<label>Start date:  </label><label id = \"startLabel\"></label><br>");
				print("<label>Return date:  </label><label id = \"returnLabel\"></label><br>");
				print("<label>Model:  </label><label id = \"planeLabel\"></label><br>");
				print ("<br><center><button type = \"button\" id = \"checkInButton\" onclick= \"checkIn('".$checkOutStatus."','".$userEmail."')\">Check In</button><label>   ");
				print ("</label><button type = \"button\" id = \"checkOutButton\" onclick= \"checkOut('".$checkOutStatus."','".$userEmail."')\">Check Out</button></center><br>");
			print("</div>");
		print("</div>");	
		print("</center>");
				
	} else
	{
		//for debuging purposes
		print ("<label>Greetings, here are the available airports<br></label>");
		if (isset($mapTbl))
		{
			print ("<table border='0px'>");
			print ("<tr>");
			print ("<td>Airport					</td>");	
			print ("<td>Longitude    </td>");
			print ("<td>Latitude    </td>");
			print ("</tr>");
			
			mysql_data_seek($mapTbl, 0);
			while ($row = mysql_fetch_array($mapTbl))
				print ("<tr><td><a href = \"javascript: focusMarker('".$row ['long']."', '".$row ['lat']."');\">".$row ['airport']."</a></td><td>".$row ['long']."</td><td>".$row ['lat']."</td></tr>");
			print ("</table><br><br>");
		}
	}
	
	print ("</font>");
	//include ("test.html");
	include ("tailHTML.html");
?>