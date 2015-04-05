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
				$loginUser = $row['firstName'];
				$userEmail = $row['email'];
				$checkOutStatus = $row['checkOutStatus'];
				
				if ($checkOutStatus == 1)
					$modelRented = $row['plane'];
			}
		
		if (isset ($modelRented))
		{
			$query = $link->executeQuery("select * from `planes` where `model` = '".$modelRented."'", $_SERVER["SCRIPT_NAME"]);
			while ($row = mysql_fetch_array($query))
				$returnDate = $row ['returnDate'];
			$query = $link->executeQuery("select * from `admin_setting`", $_SERVER["SCRIPT_NAME"]);
			while ($row = mysql_fetch_array($query))
				$lateFee = $row ['lateFee'];
		}
		
		if ($_SESSION['loginId'] == "admin")
			$loginUser = $_SESSION['loginId'];
		
		if (isset ($userEmail))
			$travelHist = $link->executeQuery("select * from `".$userEmail."`", $_SERVER["SCRIPT_NAME"]);
	}
	
	print ("<div class = \"mainBasePanel\">");
		print ("<font size = \"3\">");
		
		print ("<div class = \"mainHeaderPanel\">");
			print ("<b><font style = \"float:left\" size = \"6\" color = \"#CC3300\">PLANES FOR HIRE</font></b><br>");
			print("<form action=\"search.php\">");
				print ("<input type = \"submit\" value = \"Find it\" id = \"searchButton\"><input type = \"text\" name=\"query\" id = \"textBox\" maxlength = \"120\" placeholder = \"Looking for something?\">");
			print("</form>");
	
			if(isset($loginUser))
			{
				print ("<a style = \"float:right; color:black\" href=\"logout.php\">Logout    </a>");
				print ("<a style = \"float:right; color:black\" href=\"userprofile.php\">Hello ".$loginUser.".   </a>");		
			} else
				print ("<a style = \"float:right; color: black\" href=\"registration.php\">Register   </a><a style = \"float:right; color:black\" href=\"login.php\">Login   </a>");
		print ("</div>");
		
		print ("<div class = \"mainMapPanel\" id=\"googleMap\"></div>");
		
		print ("<div class = \"mainSelectPanel\">");	
			if (isset($loginUser) && $loginUser !== "admin")
			{
					//this is the departing airport selection menu
					print ("<div class = \"mainDepartPanel\">");
						mysql_data_seek($mapTbl, 0);
						print ("Departing Airport   <br><select id = \"departingAirport\" style = \"width:150px\" onchange = \"focusMarker(this.value)\">");
						print ("<option value = ''></option>");
						while ($row = mysql_fetch_array($mapTbl))
						{
							preg_match('/[^,]*,[^,]*$/', $row ['airport'], $matches); //(patern, subject, matchesFound)
							print ("<option value = '".$row ['long']."|".$row ['lat']."|departLabel|".$row ['airport']."'>".$matches[0]."</option>");
						}
						print ("</select>");
					print ("</div>");
					
					//this is the arrival airport selection menu
					print ("<div class = \"mainArrivalPanel\">");
						mysql_data_seek($mapTbl, 0);
						print ("Arival Airport   <br><select id = \"arivalAirport\" style = \"width:150px\" onchange = \"focusMarker(this.value)\">");
						print ("<option value = ''></option>");
						while ($row = mysql_fetch_array($mapTbl))
						{
							preg_match('/[^,]*,[^,]*$/', $row ['airport'], $matches); //(patern, subject, matchesFound)
							print ("<option value = '".$row ['long']."|".$row ['lat']."|arrivalLabel|".$row ['airport']."'>".$matches[0]."</option>");
						}
						print ("</select>");
					print ("</div>");
					
					//these are the rental dates and plane model select panel
					print ("<div class = \"mainDateModelPanel\">");
						print ("Start Date   <input type = \"text\" id = \"datePicker\" onchange = \"updateForm('startLabel', this.value)\"><br>");
						
						print ("Rental Duration   <select id = \"durationSelect\" onchange = \"updateForm('durationLabel', this.value)\">");
						print ("<option value = ''></option>");
						for ($x = 1; $x < 6; $x++)
							print ("<option value = \"".$x."\">".$x." day</option>");
						print ("</select><br>");
						
						//this is the plane model selection menu
						$planes = $link->executeQuery("select * from planes", $_SERVER["SCRIPT_NAME"]);
						print ("Plane Model   <select id = \"planeSelect\" style = \"width: 180px\" onchange = \"updateForm('planeLabel', this.value)\">");
						print ("<option value = ''>Select A Departing Airport</option>");
			//			while ($row = mysql_fetch_array($planes))
			//				print ("<option value = \"".$row['model']."\">".$row['model']."</option>");
						print ("</select>");
					print ("</div>");
					
					//this is the checkin and check out button panel
					print ("<div class = \"mainButtonPanel\">");
						print ("<center>");
						if ($checkOutStatus == 1)
							print ("<button id = \"checkInButton\" onclick= \"checkIn('".$checkOutStatus."', '".$returnDate."', '".$lateFee."')\">Check In</button>");
						else
							print ("<button id = \"checkInButton\" onclick= \"checkIn('".$checkOutStatus."')\">Check In</button>");
						print ("<label>   </label>");
						print ("<button id = \"checkOutButton\" onclick= \"checkOut('".$checkOutStatus."')\">Check Out</button></center>");
						print ("</center>");
					print ("</div>");
					
					//this is the rental form
					print ("<div id = \"mainFormPanel\"class = \"mainFormPanel\">");
						print("Plane Rental Form<br>");
						print("<label>Depart from:  </label><label id = \"departLabel\"></label><br>");
						print("<label>Arrive to:  </label><label id = \"arrivalLabel\"></label><br>");
						print("<label>Rental duration:  </label><label id = \"durationLabel\"></label><br>");
						print("<label>Start date:  </label><label id = \"startLabel\"></label><br>");
						print("<label>Return date:  </label><label id = \"returnLabel\"></label><br>");
						print("<label>Model:  </label><label id = \"planeLabel\"></label><br>");	
					print ("</div>");
			} else
			{
				if (isset($mapTbl))
				{	
					mysql_data_seek($mapTbl, 0);
					print ("<font size =\"4\"> Where would you like to fly today?</font><br>");
					while ($row = mysql_fetch_array($mapTbl))
					{
						preg_match('/[^,]*,[^,]*$/', $row ['airport'], $matches); //(patern, subject, matchesFound)
						print ("<a href = \"javascript: focusMarker('".$row ['long']."|".$row ['lat']."');\">".$matches[0]."</a><br>");
					}
				} else
					print ("<font size =\"4\">Error Loading Airports<br>Please Reflesh Your Browser</font><br>");
			}
		print ("</div>");
		print ("</font>");
	print ("</div>");
	print ("<script> mainFormPanelBak(); </script>");
	include ("tailHTML.html");
?>






