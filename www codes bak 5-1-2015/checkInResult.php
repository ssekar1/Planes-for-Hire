<?php
	
	$debug = false;
	session_start();
	include ("headHTML.html");
	
	print ("<label><br><br><br><strong><center><font size = \"6\" color = \"#595959\">Check In Result</font></center></strong><br></label>");
	
	print ("<center><div class = \"checkOutResult\">"); 	
	print ("<font size = \"3\" style = \"float:left\">Client ".$_SESSION['loginId'].", </font>");
	print ("<font size = \"3\" style = \"float:left\">the aircraft model ".$_SESSION['model']." has been checked in</font><br>");
	
	if ($_SESSION['feeOwe'] > 0)
	{
		print ("<font size = \"3\" style = \"float:left\">However, your check in is ".$_SESSION['diffDays']." days late. </font>");
		print ("<font size = \"3\" style = \"float:left\">A late fee in total ammount of $".$_SESSION['feeOwe']." has been added to your balance</font><br>");
	}
	
	print ("<font size = \"3\" style = \"float:left\">Thank you for using Planes For Hire for your flying needs</font><br><br>");
	print ("<button type = \"button\" id = \"submitButton\" onclick= \"location.href = 'index.html'\" style = \"float:right\">Continue</button>");
	print ("</div></center>");
	
	include ("tailHTML.html");
?>