<?php
/*
 Comments goes here!!
*/
	$debug = false;
	include ('../link.php');
	$link = new Link($debug);
	
	$email = $_POST['email'];
	$field = $_POST['field'];
	$newVal = $_POST['newVal'];
	
	if ($newVal == "delete")
	{
		$sql = "DELETE FROM `customer_profile` WHERE `email` = '".$email."'";
		$link->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
		$sql = "DROP TABLE `".$email."`";
		$link->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	} else if ($newVal == "suspend")
	{
		$sql = "UPDATE `customer_profile` SET `password` = NULL WHERE `email` = '".$email."'";
		$link->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	} else
	{
		$sql = "UPDATE `customer_profile` SET `".$field."` = '".$newVal."' WHERE `email` = '".$email."'";
		$link->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	}
?>

