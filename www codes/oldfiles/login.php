<?php
/*
  comments goes here !!!
*/
	$debug = false;
	include ("headHTML.html");
	
	print ("<label><strong><center><font size = \"6\" color = \"#676767\">Login</font></center></strong><br>");
	print ("</label>");
	
	print ("<div id = \"login\">");
	print ("<label>Enter your email ");
			print ("<input name = \"name\" id = \"name\" type = \"text\" size = \"30\" maxlength = \"30\" class = \"input\"/><br><br>");
		print ("</label>");
	
	print ("<label>Enter your password ");
			print ("<input name = \"name\" id = \"name\" type = \"text\" size = \"30\" maxlength = \"30\" class = \"input\"/><br><br>");
		print ("</label>");
	
	print ("<button type = \"button\" id = \"submitButton\" onclick= \"confirm()\">Submit</button><br><br>");
	
	print ("</div>");

	include ("tailHTML.html");
?>