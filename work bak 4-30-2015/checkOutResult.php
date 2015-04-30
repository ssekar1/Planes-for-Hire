<?php
	
	$debug = false;
	session_start();
	include ("headHTML.html");
	
	print ("<label><br><br><br><strong><center><font size = \"6\" color = \"#595959\">Check Out Result</font></center></strong><br></label>");
	
	print ("<center><div class = \"checkOutResult\">"); 	
	print ("<font size = \"3\" style = \"float:left\">Client ".$_SESSION['loginId'].", here are the results of your check out</font><br>");
	print ("<font size = \"3\" style = \"float:left\">Departing from ".$_SESSION['depart'].". </font>");
	print ("<font size = \"3\" style = \"float:left\">Arriving to ".$_SESSION['arrive']."</font><br>");
	print ("<font size = \"3\" style = \"float:left\">Retaining for ".$_SESSION['duration']." days, </font>");
	print ("<font size = \"3\" style = \"float:left\">begin on ".$_SESSION['startDate']." </font>");
	print ("<font size = \"3\" style = \"float:left\">and return on ".$_SESSION['returnDate']."</font><br>");
	print ("<font size = \"3\" style = \"float:left\">Your requested aircraft model ".$_SESSION['model'].", and will be ready on ".$_SESSION['startDate']."</font><br>");
	print ("<font size = \"3\" style = \"float:left\">Thank you for using Planes For Hire for your flying needs</font><br><br>");	
	print ("<button type = \"button\" id = \"submitButton\" onclick= \"location.href = 'index.html'\" style = \"float:right\">Continue</button><br><br>");
	print ("</div></center>");
	
	include ("tailHTML.html");
	
?>