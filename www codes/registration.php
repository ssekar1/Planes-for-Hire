<?php
/*
  comments goes here !!!
*/
	$debug = false;
	include ("headHTML.html");
	
	//defining the form for the html document
	print ("<form id = \"form\" name = \"form\" action = \"confirm.php\" method = \"post\">");
	print ("<div id = \"registration\">");
	print ("<h3><label><strong>Create an account</strong><br></h3>");
	print ("</label>");
	
	print ("<br><label>First Name ");
			print ("<input name = \"firstName\" id = \"firstName\" type = \"text\" maxlength = \"30\" class = \"input\"/><br><br>");
		print ("</label>");
	
	print ("<label>Last Name ");
			print ("<input name = \"lastName\" id = \"lastName\" type = \"text\" maxlength = \"30\" class = \"input\"/><br><br>");
		print ("</label>");
	
	print ("<label>Street Address ");
			print ("<input name = \"street\" id = \"street\" type = \"text\" maxlength = \"30\" class = \"input\"/><br><br>");
		print ("</label>");

	print ("<label>City ");
			print ("<input name = \"city\" id = \"city\" type = \"text\" maxlength = \"30\" class = \"input\"/><br><br>");
		print ("</label>");

	print ("<label>State ");
			print ("<input name = \"state\" id = \"state\" type = \"text\" maxlength = \"30\" class = \"input\"/><br><br>");
		print ("</label>");
	
	print ("<label>Zip Code ");
			print ("<input name = \"zip\" id = \"zip\" type = \"text\" maxlength = \"5\" class = \"input\" onKeyup = \"isValidChar (this.value, 'zip')\"/><br><br>");
		print ("</label>");

	print ("<label>Phone Number ");
			print ("<input name = \"phone\" id = \"phone\" type = \"text\" maxlength = \"10\" class = \"input\" onKeyup = \"isValidChar (this.value, 'phone')\"/><br><br>");
		print ("</label>");

	print ("<label>Email ");
			print ("<input name = \"email\" id = \"email\" type = \"text\" maxlength = \"30\" class = \"input\"/><br><br>");
		print ("</label>");
	
	print ("<label>Profile Picture ");
			print ("<input name = \"avatar\" id = \"avatar\" type = \"text\" placeholder = \"optional\" maxlength = \"30\" class = \"input\"/><br><br>");
		print ("</label>");
	
	print ("<label>Password ");
			print ("<input name = \"password\" id = \"password\" type = \"password\" maxlength = \"30\" class = \"input\"/><br><br>");
		print ("</label>");
	
	print ("<label>Retype Password ");
			print ("<input name = \"password2\" id = \"password2\" type = \"password\" maxlength = \"30\" class = \"input\"/><br><br>");
		print ("</label>");
	
	print ("<button type = \"button\" id = \"submitButton\" onclick= \"confirmEntry ()\">Submit</button><br><br>");
	
	print ("</div>");
	print ("</form>");
	include ("tailHTML.html");
?>