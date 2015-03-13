<?php
/*
  comments goes here !!!
*/
	$debug = false;
	include ("headHTML.html");
	
	print ("<label><strong><center><font size = \"6\" color = \"#676767\">Create an account</font></center></strong><br>");
	print ("</label>");
	
	print ("<div id = \"registration\">");
	print ("<label>What is your first name ");
			print ("<input name = \"fistName\" id = \"firstName\" type = \"text\" size = \"30\" maxlength = \"30\" class = \"input\"/><br><br>");
		print ("</label>");
	
	print ("<label>And your last name ");
			print ("<input name = \"lastName\" id = \"lastName\" type = \"text\" size = \"30\" maxlength = \"30\" class = \"input\"/><br><br>");
		print ("</label>");
	
	print ("<label>What is your street address ");
			print ("<input name = \"street\" id = \"street\" type = \"text\" size = \"30\" maxlength = \"30\" class = \"input\"/><br><br>");
		print ("</label>");

	print ("<label>In what city is that ");
			print ("<input name = \"city\" id = \"city\" type = \"text\" size = \"30\" maxlength = \"30\" class = \"input\"/><br><br>");
		print ("</label>");

	print ("<label>and the state its in ");
			print ("<input name = \"state\" id = \"state\" type = \"text\" size = \"30\" maxlength = \"30\" class = \"input\"/><br><br>");
		print ("</label>");

	print ("<label>What is your phone number ");
			print ("<input name = \"phone\" id = \"phone\" type = \"text\" size = \"30\" maxlength = \"30\" class = \"input\"/><br><br>");
		print ("</label>");

	print ("<label>And your email address ");
			print ("<input name = \"email\" id = \"email\" type = \"text\" size = \"30\" maxlength = \"30\" class = \"input\"/><br><br>");
		print ("</label>");
	
	print ("<label>Create a password ");
			print ("<input name = \"password\" id = \"password\" type = \"text\" size = \"30\" maxlength = \"30\" class = \"input\"/><br><br>");
		print ("</label>");
	
	print ("<label>Retype that password again ");
			print ("<input name = \"password\" id = \"password\" type = \"text\" size = \"30\" maxlength = \"30\" class = \"input\"/><br><br>");
		print ("</label>");
	
	print ("<button type = \"button\" id = \"submitButton\" onclick= \"confirm()\">Submit</button><br><br>");
	
	print ("</div>");

	include ("tailHTML.html");
?>