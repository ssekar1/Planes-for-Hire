<?php
/*
  This is the main page
*/
	$debug = false;
	session_start();// Starting Session
	include ("adminHeadHTML.html");
	
	if (isset($_SESSION['loginId']) && $_SESSION['loginId'] == "admin")
				$loginUser = $_SESSION['loginId'];
	
	$result = $link->executeQuery("select * from `admin_setting`", $_SERVER["SCRIPT_NAME"]);
	while ($row = mysql_fetch_array($result))
		$lateFeeDemo = $row['lateFeeDemo'];
	
	print ("<div class = \"adminBasePanel\">"); //defining the base container for all sub panel
		print ("<font size = \"3\">"); //set the default font size for the base container, all sub panel will use this specified font size
		
		print ("<div class = \"adminHeaderPanel\">"); //defining the header panel, this is use to hold the application logo, and control categories for the admin page 
			print ("<label><strong><center><font size = \"6\" color = \"#595959\">Administration</font></center></strong><br></label>");
			print("<form action=\"search.php\">"); //this is the search bar and its submit button, it is also a php form
				print ("<input type = \"submit\" value = \"Find it\" id = \"searchButton\"><input type = \"text\" name=\"query\" id = \"textBox\" maxlength = \"120\" placeholder = \"Looking for something?\">");
			print("</form>");
			if(isset($loginUser))
			{
				print ("<font size = \"3\">");
				print ("<grtngTag style = \"float:left\">Hello ".$loginUser."   </grtngTag>");
				print ("<a href=\"javascript: edit('admin', 'password', '');\" style = \"float:left\">Edit Password   </a>");
				print ("<a href=\"javascript: listPlanes('');\" style = \"float:left\">Planes   </a>");
				print ("<a href=\"javascript: addPlane('');\" style = \"float:left\">Add Plane   </a>");
				print ("<a href=\"javascript: listAirports('');\" style = \"float:left\">Airports   </a>");
				print ("<a href=\"javascript: addAirport('');\" style = \"float:left\">Add Airport   </a>");
				if ($lateFeeDemo == "on")
					print ("<a href=\"javascript: lateFeeDemo('');\" style = \"float:left\">Late fee demo ON</a>");
				else
					print ("<a href=\"javascript: lateFeeDemo('');\" style = \"float:left\">Late fee demo OFF</a>");
				print ("<a href=\"../main.php\" style = \" float:right\">Main Page    </a>");
				print ("<a href=\"../logout.php\" style = \"float:right\">Logout    </a><br>");
				print ("</font>");
			}
		print ("</div>"); // this finishes the header pannel content
	
		print ("<div id = \"adminContentPanel\" class = \"adminContentPanel\">"); //defining the content panel, this is use to provide admin functionality and display related information
			print ("<font size = \"2\">");
			
			if(isset($loginUser))
			{
				$memList = $link->executeQuery("select * from `customer_profile`", $_SERVER["SCRIPT_NAME"]);
		
				if (isset($loginUser))
				{
					print ("<label> Member List   <span>(Select any item to change their value)</span></label><br>");
					if (isset($memList))
					{
						//prints the labels for the travel history table
						print ("<table border='0px'>");
						print ("<tr>");
						print ("<td style= 'font-weight:bold'>First Name	</td>");
						print ("<td style= 'font-weight:bold'>Last Name	</td>");
						print ("<td style= 'font-weight:bold'>Street Address	</td>");
						print ("<td style= 'font-weight:bold'>City			</td>");
						print ("<td style= 'font-weight:bold'>State	</td>");
						print ("<td style= 'font-weight:bold'>Zip		</td>");
						print ("<td style= 'font-weight:bold'>Avatar			</td>");
						print ("<td style= 'font-weight:bold'>Email				</td>");
						print ("<td style= 'font-weight:bold'>Phone		</td>");
						print ("<td style= 'font-weight:bold'>Password   </td>");
						print ("<td style= 'font-weight:bold'>Checkout </td>");
						print ("<td style= 'font-weight:bold'>Register Date		</td>");
						print ("<td style= 'font-weight:bold'>Modify	</td>");
						print ("</tr>");
				
						while ($row = mysql_fetch_array($memList))
						{
							print ("<tr><td><a href = \"javascript: edit('".$row ['email']."', 'firstName', '".$row ['firstName']."');\" style = \"color: black\">".$row ['firstName']."</a>".
									"</td><td><a href = \"javascript: edit('".$row ['email']."', 'lastName', '".$row ['lastName']."');\" style = \"color: black\">".$row ['lastName']."</a>".
									"</td><td><a href = \"javascript: edit('".$row ['email']."', 'street', '".$row ['street']."');\" style = \"color: black\">".$row ['street']."</a>".
									"</td><td><a href = \"javascript: edit('".$row ['email']."', 'city', '".$row ['city']."');\" style = \"color: black\">".$row ['city']."</a>".
									"</td><td><a href = \"javascript: edit('".$row ['email']."', 'state', '".$row ['state']."');\" style = \"color: black\">".$row ['state']."</a>".
									"</td><td><a href = \"javascript: edit('".$row ['email']."', 'zip', '".$row ['zip']."');\" style = \"color: black\">".$row ['zip']."</a>".
									"</td><td><a href = \"javascript: edit('".$row ['email']."', 'avatar', '".$row ['avatar']."');\" style = \"color: black\">".$row ['avatar']."</a>".
									"</td><td><a href = \"javascript: edit('".$row ['email']."', 'email', '".$row ['email']."');\" style = \"color: black\">".$row ['email']."</a>".
									"</td><td><a href = \"javascript: edit('".$row ['email']."', 'phone', '".$row ['phone']."');\" style = \"color: black\">".$row ['phone']."</a>");
							if ($row ['password'] != NULL)
								print("</td><td><a href = \"javascript: edit('".$row ['email']."', 'password', '');\" style = \"color: black\">Edit</a>");
							else
								print("</td><td><a href = \"javascript: edit('".$row ['email']."', 'password', '');\" style = \"color: black\">SUSPENDED</a>");
							print("</td><td>".$row ['checkOutStatus']."</td><td>".$row ['regDate']);
							if ($row ['password'] != NULL)
								print("</td><td><a href = \"javascript: edit('".$row ['email']."', '', 'suspend');\" style = \"color: green\">Suspend	</a>");
							else
								print("</td><td><a href = \"javascript: edit('".$row ['email']."', '', 'suspend');\" style = \"color: orange\">Suspend	</a>");
							print("<a href = \"javascript: edit('".$row ['email']."', '', 'delete');\" style = \"color: red\">Delete</a>");
						}
						print ("</table><br><br>");
					}
					else
						print ("Database Access Error, Try Again");
				} 
			} else
				print ("<label> Login Error, Try Again</label><br>");
			
			print ("</font>");
		print ("</div>"); // this finishes the content pannel content
		
		print ("</font>");
	print ("</div>"); // this finishes the base container pannel content
	
	print ("<script>adminContentPanelBak(); </script>"); //this function is used to back up the content of the plane rental form, so that we can alter its content to display other messages and still be able to return it back to its original states 
	print ("<label id = \"xmlRespondFeedback\" style =\"visibility: hidden\" >---</label>");
	include ("adminTailHTML.html");
?>