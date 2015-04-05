<?php
/*
 Comments goes here!!
*/
	$debug = false;
	include ('link.php');
	$link = new Link($debug);
	session_start();
	
	$_SESSION['airport'] = $_POST['airport'];
	
	$sql = "select * from `planes` WHERE `currentLocation` = '".$_SESSION['airport']."'";
	$result = $link->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	$rows = mysql_num_rows($result);
	if ($rows >= 1)
	{
		print ("<option value = ''>Select A Plane</option>");
		while ($row = mysql_fetch_array($result))
			print ("<option value = \"".$row['model']."\">".$row['model']."</option>");
	}
?>