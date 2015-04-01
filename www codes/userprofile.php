<?php
/*
  This is the main page
*/
	$debug = false;
	session_start();// Starting Session
	include ("headHTML.html");

if (isset($_SESSION['loginId']) && $_SESSION['loginId'] == "user")
				$loginUser = $_SESSION['loginId'];
	
	print ("<label><strong><center><font size = \"6\" color = \"#595959\">User Profile Page</font></center></strong><br>");
	print ("</label>");
	
	print ("<input type = \"button\" value = \"Find it\" id = \"searchButton\"><input type = \"text\" id = \"textBox\" maxlength = \"120\" placeholder = \"Looking for something?\">");
	
	if(isset($loginUser))
	{
		print ("<font size = \"3\" style = \"float:left\">Hello ".$loginUser."</font>");
		print ("<font size = \"3\" style = \"float:right\"><a href=\"../main.php\">Main Page    </a><a href=\"../logout.php\">Logout    </a></font><br>");
	}
	
	include ("tailHTML.html");
	
?>