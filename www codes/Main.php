<?php
/*
 * This is the Main.php page. This is the main action page that directs to other subpages within the webapp.
 * It is also here that the user can login to fill out a plane rental form to check out a plane
 */
	$debug = false;
	session_start(); //Starting Session, when the user logs in, the login.php creates a session for them, startng a session here will carry over whatever session was created for them from the login.php
	include ("headHTML.html"); //the headHTML is invoke here, because planesforHire.js and planesForHire.css was invoke in the headHTML, it is included here as well
	
	if (isset($_SESSION['loginId'])) //checks if the user is loged in by checking the session variable. if they're login, populate the local variable for use
	{
		//this query retrieves the user information to determine their name when they're loged in, and whether they checkout a plane, and if they're late and how money they owe
		$query = $link->executeQuery("select * from `customer_profile` where `email` = '".$_SESSION['loginId']."'", $_SERVER["SCRIPT_NAME"]);
		
		if ($query !== false) //we cant process the query result if the SQL database doesn't return anything
			while ($row = mysql_fetch_array($query))
			{
				$loginUser = $row['firstName']; //in the main, the $loginUser variable is use for greeting the user by their name
				$userEmail = $row['email']; //this variable is use for pulling their travel history record
				$checkOutStatus = $row['checkOutStatus']; //this variable is use to determine if they'd check out a plane, and if they do, we don't let them check out another one
				if ($checkOutStatus == 1) //if they did check out a plane, then get the model they're currently holding
					$modelRented = $row['plane'];
				if ($row['notification'] != '')
					$notification = $row['notification'];
				$avatar = $row['avatar'];
			}
		
		if (isset ($modelRented)) //if they did check out a plane, then we check the plane record to see when it was suppose to be return
		{
			$query = $link->executeQuery("select * from `planes` where `model` = '".$modelRented."'", $_SERVER["SCRIPT_NAME"]); //perform query to retrieve the particular plane record 
			while ($row = mysql_fetch_array($query))
				$returnDate = $row ['returnDate']; //we are only interested only in the return date of this plane
			$query = $link->executeQuery("select * from `admin_setting`", $_SERVER["SCRIPT_NAME"]); //perform query to get the per-day-late-fee that is defined from the administrator record
			while ($row = mysql_fetch_array($query))
				$lateFee = $row ['lateFee']; //initialize the late fee variable for processing
		}
		
		if ($_SESSION['loginId'] == "admin") //unique case for administrator if they're logged in
			$loginUser = $_SESSION['loginId'];
		
		$query = $link->executeQuery("select * from `admin_setting`", $_SERVER["SCRIPT_NAME"]); //determine we can demonstrate the late fee feature
		while ($row = mysql_fetch_array($query))
			$lateFeeDemo = $row['lateFeeDemo'];
	}
	
	print ("<div class = \"mainBasePanel\">"); //defining the base container for all sub panel
		print ("<font size = \"3\">"); //set the default font size for the base container, all sub panel will use this specified font size
		
		print ("<div class = \"mainHeaderPanel\">"); //defining the header panel, this is use to hold the application logo, login, registration, and search bar items 
			print ("<b><font style = \"float:left\" size = \"6\" color = \"#CC3300\" > PLANES FOR HIRE</font></b><br>"); //this is the application logo
			print("<form action=\"search.php\">"); //this is the search bar and its submit button, it is also a php form
				print ("<input type = \"submit\" value = \"Find it\" id = \"searchButton\"><input type = \"text\" name=\"query\" id = \"textBox\" maxlength = \"120\" placeholder = \"Looking for something?\">");
			print("</form>");
	
			if(isset($loginUser)) //if the user is logged in then their name will link to their user profile page and another link for them to log out
			{
				print ("<a style = \"float:right\" href=\"logout.php\">Logout    </a>");
				if ($loginUser == "admin")
					print ("<a style = \"float:right\" href=\"private/admin.php\">Hello ".$loginUser." !   </a>");
				else
				{
					print ("<a style = \"float:right\" href=\"userprofile.php\">  Hello ".$loginUser." !   </a>");
					print ("<a style = \"float:right\" href=\"userprofile.php\"><img style = \"border-radius: 5px; height: 30px; float:right\" id = \"userAvatar\" class = \"userAvatar\" src = \"/picsUploads/".$avatar."\"></a>");
				}	
			} else //if they're not logged in then we provide a link for them to register and to login 
				print ("<a style = \"float:right\" href=\"registration.php\">Register   </a><a style = \"float:right\" href=\"login.php\">Login   </a>");
		print ("</div>"); // this finishes the header pannel content
		
		print ("<div class = \"mainMapPanel\" id=\"googleMap\"></div>"); //defining the map pannel and closing the map pannel, the map pannel only contain the map itself
		
		print ("<div class = \"mainSelectPanel\">"); //defining the selection pannel, this pannel contains all the necessary items for the user to fill out the plane rental form
			if (isset($loginUser) && $loginUser !== "admin") //we only populate the selection content if the user is logged in, otherwise, we just show them a list of airports available
			{
					//this is the departing airport selection menu, this contains the list of available airport from the database, the list of planes is also affected by this selection item, but it is not being controlled here! 
					print ("<div class = \"mainDepartPanel\">"); //defining the depart pannel for the departing airport selection menu
						mysql_data_seek($mapTbl, 0); //resetting the array cursor to re-fetch the data
						print ("Departing Airport   <br><select id = \"departingAirport\" style = \"width:150px\" onchange = \"focusMarker(this.value)\">");
						print ("<option value = ''></option>");
						while ($row = mysql_fetch_array($mapTbl))
						{	//this is the regex, since the the database airport name is long, we are only interested in the city and state of the airport to be displayed  
							preg_match('/[^,]*,[^,]*$/', $row ['airport'], $matches); //(patern, subject, matchesFound), this is the format of the regex
							if ($matches)
								print ("<option value = '".$row ['long']."|".$row ['lat']."|departLabel|".$row ['airport']."'>".$matches[0]."</option>");
							else
								print ("<option value = '".$row ['long']."|".$row ['lat']."|departLabel|".$row ['airport']."'>".$row ['airport']."</option>");
						}
						print ("</select>");
					print ("</div>"); //this finishes the depart panel for the depart selection menu
					
					//this is the arrival airport selection menu, this contain the list of available airports from the database
					print ("<div class = \"mainArrivalPanel\">"); //defining the arrival panel for the arrival airport selection menu
						mysql_data_seek($mapTbl, 0); //resetting the array cursor to re-fetch the data
						print ("Arival Airport   <br><select id = \"arivalAirport\" style = \"width:150px\" onchange = \"focusMarker(this.value)\">");
						print ("<option value = ''></option>");
						while ($row = mysql_fetch_array($mapTbl))
						{	//another regex again, since the the database airport name is long, we are only interested in the city and state of the airport to be displayed 
							preg_match('/[^,]*,[^,]*$/', $row ['airport'], $matches); //(patern, subject, matchesFound), this is the format of the regex
							if ($matches)
								print ("<option value = '".$row ['long']."|".$row ['lat']."|arrivalLabel|".$row ['airport']."'>".$matches[0]."</option>");
							else
								print ("<option value = '".$row ['long']."|".$row ['lat']."|arrivalLabel|".$row ['airport']."'>".$row ['airport']."</option>");
						}
						print ("</select>");
					print ("</div>"); //this finishes the arrival panel for the arrival selection menu
					
					//these are the rental dates and plane model select panel, this panel contans all the necessary items to define which and when the planes should be ready and when it should be return
					print ("<div class = \"mainDateModelPanel\">"); //defining the pannel for the dates and model selection items
						print ("Start Date   <input type = \"text\" id = \"datePicker\" onchange = \"updateForm('startLabel', this.value)\"><br>"); //this is the date selection item, it uses the jQuery date select for faster date entry 
						//this is the rental duration selection item, this allows the user to select how long they can rent the plane for, we only allow a 5 days maximum
						print ("Rental Duration   <select id = \"durationSelect\" onchange = \"updateForm('durationLabel', this.value)\">");
						print ("<option value = ''></option>"); 
						for ($x = 1; $x < 6; $x++)
							print ("<option value = \"".$x."\">".$x." day</option>");
						print ("</select><br>");
						
						//this is the plane model selection menu, the user can select the plane model they want to rent here, though base on availability of location, which is determine by the departing airport selection
						$planes = $link->executeQuery("select * from planes", $_SERVER["SCRIPT_NAME"]);
						print ("Plane Model   <select id = \"planeSelect\" style = \"width: 180px\" onchange = \"updateForm('planeLabel', this.value)\">");
						print ("<option value = ''>Select A Departing Airport</option>");
						print ("</select>");
					print ("</div>"); //this finishes the dates and model selection panel
					
					//this is the checkin and check out button panel, this pannel just contains the checkin and check out button, used for checkin and check out a plane
					print ("<div class = \"mainButtonPanel\">"); //defining the checkIn checkOut button panel
						print ("<center>");
						if ($checkOutStatus == 1) //if the user have a plane on hold, then we need to determine whether they are late or not, and if so how much they owe for being late 
							print ("<button id = \"checkInButton\" onclick= \"checkIn('".$checkOutStatus."', '".$returnDate."', '".$lateFee."')\">Check In</button>");
						else //if they don't have any plane checkout, then thay can't check in, the checkOutStatus value will be zero and there are no late fee or return date to begin with
							print ("<button id = \"checkInButton\" onclick= \"checkIn('".$checkOutStatus."')\">Check In</button>");
						print ("<label>   </label>"); //if the user has already checkout a plane, we wouldn't let them checkout another unless they checkin the prior
						print ("<button id = \"checkOutButton\" onclick= \"checkOut('".$checkOutStatus."')\">Check Out</button></center>");
						print ("</center>");
					print ("</div>"); //this finishes the checkIn checkOut button panel
					
					//this is the plane rental form panel, this is use as a feedback to let the user know what their current selections are
					print ("<div id = \"mainFormPanel\" class = \"mainFormPanel\">"); //defining the plane rental form panel
						print("Plane Rental Form<br>"); //the content in these forms are populated based on their label id
						print("<label>Depart from:  </label><label id = \"departLabel\"></label><br>");
						print("<label>Arrive to:  </label><label id = \"arrivalLabel\"></label><br>");
						print("<label>Rental duration:  </label><label id = \"durationLabel\"></label><br>");
						print("<label>Start date:  </label><label id = \"startLabel\"></label><br>");
						print("<label>Return date:  </label><label id = \"returnLabel\"></label><br>");
						print("<label>Model:  </label><label id = \"planeLabel\"></label><br><br><br>");	
						print("<b>Icons Legends</b><br>");
						print ("&#10003 - Plane is available<br>");
						print ("&#10007 - Plane is not available<br>");
						
						print ("<img style = \"border-radius: 5px; height: 20px; float:left\" id = \"userAvatar\" class = \"userAvatar\" src = \"/resources/images/plane.png\"> - Plane Availability<br><br>");
						print ("<img style = \"border-radius: 5px; height: 30px; float:left\" id = \"userAvatar\" class = \"userAvatar\" src = \"/resources/images/pin.png\"> - Airport Locations<br><br>");
					print ("</div>"); //this finishes the rental form panel
			} else
			{
				if (isset($mapTbl)) //must determine if the query is succesful before we can populate the map, and if not then we display an error message without showing any airport 
				{	
					mysql_data_seek($mapTbl, 0); //resetting the array cursor to re-fetch the data
					print ("<font size =\"4\"> Where would you like to fly today?</font><br>");
					while ($row = mysql_fetch_array($mapTbl))
					{	//another regex again, since the the database airport name is long, we are only interested in the city and state of the airport to be displayed 
						preg_match('/[^,]*,[^,]*$/', $row ['airport'], $matches); //(patern, subject, matchesFound), this is the format of the regex
						if ($matches)
							print ("<a href = \"javascript: focusMarker('".$row ['long']."|".$row ['lat']."');\" style = \"color: black\">".$matches[0]."</a><br>"); //when a user clicks on an airport, we pan to that location so they can see where it is
						else
							print ("<a href = \"javascript: focusMarker('".$row ['long']."|".$row ['lat']."');\" style = \"color: black\">".$row ['airport']."</a><br>");
					}
				} else
					print ("<font size =\"4\">Error Loading Airports<br>Please Reflesh Your Browser</font><br>"); //the error message in case if the SQL query is unsuccessful
			}
		print ("</div>"); //this finishes the selection items panel
		print ("</font>"); //closing the font setting for the base container
	print ("</div>"); //this finishes the base container
	print ("<script> mainFormPanelBak(); </script>"); //this function is used to back up the content of the plane rental form, so that we can alter its content to display other messages and still be able to return it back to its original states 
	print ("<label id = \"xmlRespondFeedback\"></label>");
	
	print("<script>");
		print("
				setInterval(function()
				{
					// Gets response from php document
					var xmlHttp = null;
					xmlHttp = new XMLHttpRequest();
					xmlHttp.open('GET', 'getNotification.php', false);
					xmlHttp.send( null );
					var notification = xmlHttp.responseText;
					
					// Alerts notification if there was one
					if(notification != '')
						showNotification(notification);
				}, 1000);
			 ");
	print("</script>");
	
	if (isset($notification))
		print ("<script> showNotification('".$notification."'); </script>");
	
	if (isset($lateFeeDemo))
		print ("<script> lateFeeDemo('".$lateFeeDemo."'); </script>");
	include ("tailHTML.html"); //the tailHTML is invoke here
?>