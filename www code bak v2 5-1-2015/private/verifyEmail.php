<?php
/*
 Comments goes here!!
*/
	$debug = false;
	include ('../link.php');
	$link = new Link($debug);
	session_start();
	
	if (isset($_POST['email']))
		$_SESSION['email'] = $_POST['email'];
	if (isset($_POST['field']))
		$_SESSION['field'] = $_POST['field'];
	if (isset($_POST['newVal']))
		$_SESSION['newVal'] = $_POST['newVal'];
	$_SESSION['intent'] = "updateField";
	
	$result = $link->executeQuery("select `email` from `customer_profile`", $_SERVER["SCRIPT_NAME"]);
	$verifyRes = true; //start by assuming email is valid
	
	while ($row = mysql_fetch_array($result))
		if ($_POST['newVal'] == $row['email'] || (!filter_var($_POST['newVal'], FILTER_VALIDATE_EMAIL)))
		{
			$verifyRes = false; //if the entered email matches ones found in database, then mark it invalid
			break;
		}
	
	if ($verifyRes)
	{
		header("Location: updateTable.php");
		exit;
	}
	else
		print ("Cannot use this email!");
	
?>