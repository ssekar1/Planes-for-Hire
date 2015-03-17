<?php
/*
  comments goes here !!!
*/
	$debug = false;
	include ('link.php');
	$LINK = new Link($debug);
	include ("headHTML.html");
	
	//defining the form for the html document
	print ("<form id = \"form\" name = \"form\" action = \"confirm.php\" method = \"post\">");
	print ("<label><strong><center><font size = \"6\" color = \"#676767\">Create an account</font></center></strong><br>");
	print ("</label>");
	
	print ("<div id = \"registration\">");
	print ("<label>First Name ");
			print ("<input name = \"firstName\" id = \"firstName\" type = \"text\" size = \"30\" maxlength = \"30\" class = \"input\"/><br><br>");
		print ("</label>");
	
	print ("<label>Last Name ");
			print ("<input name = \"lastName\" id = \"lastName\" type = \"text\" size = \"30\" maxlength = \"30\" class = \"input\"/><br><br>");
		print ("</label>");
	
	print ("<label>Street Address ");
			print ("<input name = \"street\" id = \"street\" type = \"text\" size = \"30\" maxlength = \"30\" class = \"input\"/><br><br>");
		print ("</label>");

	print ("<label>City ");
			print ("<input name = \"city\" id = \"city\" type = \"text\" size = \"30\" maxlength = \"30\" class = \"input\"/><br><br>");
		print ("</label>");

	print ("<label>State ");
			print ("<input name = \"state\" id = \"state\" type = \"text\" size = \"30\" maxlength = \"30\" class = \"input\"/><br><br>");
		print ("</label>");
	
	print ("<label>Zip Code ");
			print ("<input name = \"zip\" id = \"zip\" type = \"text\" size = \"30\" maxlength = \"30\" class = \"input\" onKeyup = \"isValidChar (this.value, 'zip')\"/><br><br>");
		print ("</label>");

	print ("<label>Phone Number ");
			print ("<input name = \"phone\" id = \"phone\" type = \"text\" size = \"30\" maxlength = \"30\" class = \"input\" onKeyup = \"isValidChar (this.value, 'phone')\"/><br><br>");
		print ("</label>");

	print ("<label>Email ");
			print ("<input name = \"email\" id = \"email\" type = \"text\" size = \"30\" maxlength = \"30\" class = \"input\"/><br><br>");
		print ("</label>");
	
	print ("<label>Profile Picture ");
			print ("<input name = \"avatar\" id = \"avatar\" type = \"text\" placeholder = \"optional\" size = \"30\" maxlength = \"30\" class = \"input\"/><br><br>");
		print ("</label>");
	
	print ("<label>Password ");
			print ("<input name = \"password\" id = \"password\" type = \"password\" size = \"30\" maxlength = \"30\" class = \"input\"/><br><br>");
		print ("</label>");
	
	print ("<label>Retype Password ");
			print ("<input name = \"password2\" id = \"password2\" type = \"password\" size = \"30\" maxlength = \"30\" class = \"input\"/><br><br>");
		print ("</label>");
	
	print ("<button type = \"button\" id = \"submitButton\" onclick= \"confirm()\">Submit</button><br><br>");
	
	print ("</div>");
	
	print ("</form>");
	include ("tailHTML.html");
?>