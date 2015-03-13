<?php
/*
  This is the main page
*/
	$debug = false;
	include ('link.php');
	$LINK = new Link($debug);
	include ("headHTML.html");
	
	print ("<label><strong><center><font size = \"6\" color = \"#676767\">Planes For Hire</font></center></strong><br>");
	print ("</label>");
	
	print ("<font size = \"1\" style = \"float:left\">Hello you...</font>");
	print ("<input type = \"button\" value = \"Find it\" id = \"searchButton\"><input type = \"text\" id = \"textBox\" size = \"19\" maxlength = \"120\" placeholder = \"Looking for something?\">");
	print ("<font size = \"1\" style = \"float:right\"><a href=\"registration.php\">Register</a><label>&nbsp&nbsp&nbsp</label><a href=\"login.php\">Login &nbsp&nbsp&nbsp</a></font><br>");
	
	print("<center><div id=\"googleMap\"></div></center>");

	print ("<br><center><button type = \"button\" id = \"checkInButton\" onclick= \"confirm()\">Check In</button>");
	print ("<label>&nbsp&nbsp&nbsp</label>");
	print ("<button type = \"button\" id = \"checkOutButton\" onclick= \"confirm()\">Check Out</button></center><br>");
	
	print ("<font size = \"2\">");
	print ("<label>Greetings...</label><br>");
	print ("<label>All planes are available and ready to go</label>");
	print ("</font>");

	//include ("test.html");
	include ("tailHTML.html");
?>