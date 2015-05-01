<?php
/*
 Comments goes here!!
*/
	$debug = false;
	include ('link.php');
	$link = new Link($debug);
	session_start();
	
	if (isset($_POST['airport']))
		$_SESSION['airport'] = $_POST['airport'];
	
	print ("<option value = ''>Select A Plane</option>");
	$result = $link->executeQuery("select * from `planes` WHERE `currentLocation` = '".$_SESSION['airport']."'", $_SERVER["SCRIPT_NAME"]);
	$rows = mysql_num_rows($result);  // available plane 
	if ($rows > 0)		
		while ($row = mysql_fetch_array($result))
		{
			$value = $row ['model']."|1";
			print ("<option value = \"".$value."\">&#10003 ".$row['model']."</option>");
		}
	$result = $link->executeQuery("select * from `planes` WHERE `currentLocation` != '".$_SESSION['airport']."'", $_SERVER["SCRIPT_NAME"]);
	$rows = mysql_num_rows($result);  // not available planes
	if ($rows > 0)
		while ($row = mysql_fetch_array($result))
		{
			$value = $row ['model']."|0";
			print ("<option value = \"".$value."\">&#10007 ".$row['model']."</option>");
		}
	
?>