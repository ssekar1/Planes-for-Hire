<?php
/*
Tam Tran
Instructor: Mr. Lupoli
Class: CMSC 331
11/21/2014
Project 1
description: this is the confirm.php page, this page confirms all required field are entered accordingly and then userdata are compared and pulled
required information primary database, and then pushed into secondary customer request database.
*/
	include('common.php');
	$debug = false;
	$COMMON = new Common($debug);
	session_start();

//===pulling primary database content
	$_SESSION ['locationTable'] = $COMMON->executeQuery("select * from `Location` where `Property` = ".$_POST['location'], $_SERVER["SCRIPT_NAME"]);
	$_SESSION ['issueTable'] = $COMMON->executeQuery("select * from `problemType` where `problem_code` = '".$_POST['issue']."'", $_SERVER["SCRIPT_NAME"]);
	$_SESSION ['detailTable'] = $COMMON->executeQuery("select * from `".$_POST ['problem']."` where `code` = '".$_POST ['detail']."'", $_SERVER["SCRIPT_NAME"]);
	$_SESSION ['organizationTable'] = $COMMON->executeQuery("select * from `organization`", $_SERVER["SCRIPT_NAME"]);
	$_SESSION ['requestorTable'] = $COMMON->executeQuery("select * from `requestor`", $_SERVER["SCRIPT_NAME"]);

//===data parameters to be pushed into secondary database
	$_SESSION ['name'] = $_POST ['name'];
	$_SESSION ['phone'] = $_POST ['phone'];
	$_SESSION ['problemDescription'] = $_POST ['problem'];
	$_SESSION ['desireDate'] = $_POST ['jobBeginDate'];
	$_SESSION ['otherComments'] = $_POST ['comments'];
	$_SESSION ['dateStamp'] = date('m-d-Y, H:i:s', time());
	$_SESSION ['userName'] = "tamtran1";
	$_SESSION ['email'] = "tamtran1@umbc.edu";
	
	//gathering data from the location table
	if ($_SESSION ['locationTable'] !== false)
		while ($row = mysql_fetch_array($_SESSION ['locationTable']))
		{
			$_SESSION ['property'] = $row['Description'];
			$_SESSION ['bldg'] = $row['Property'];
			$_SESSION ['regionCode'] = $row['Region'];
			$_SESSION ['facilityID'] = $row['Facility'];
		}

	//gathering data from the ralated issue table 
	if ($_SESSION ['issueTable'] !== false)
		while ($row = mysql_fetch_array($_SESSION ['issueTable']))
		{
			$_SESSION ['problemCode'] = $row['problem_code'];
			$_SESSION ['problemType'] = $row['description'];
			$_SESSION ['shop'] = $row['shop'];
			$_SESSION ['pri_code'] = $row['pri_code'];
			$_SESSION ['order_type'] = $row['order_type'];
			$_SESSION ['category'] = $row['category'];
		}
	
	//gathering data from the detail of the issue table 
	if ($_SESSION ['detailTable'] !== false)
		while ($row = mysql_fetch_array($_SESSION ['detailTable']))
		{
			$_SESSION ['detailCode'] = $row['code'];
			$_SESSION ['detailDescription'] = $row['description'];
		}

	//gathering data from the organization table, these are fixed content and are not seen by the user
	if ($_SESSION ['organizationTable'] !== false)	
		while ($row = mysql_fetch_array($_SESSION ['organizationTable']))
		{
			$_SESSION ['organizationOc_code'] = $row['oc_code'];
			$_SESSION ['organizationDescription'] = $row['description'];
			$_SESSION ['company_id'] = $row['company_id'];
			$_SESSION ['dept_id'] = $row['dept_id'];
			$_SESSION ['organizationActive'] = $row['active'];
		}

	//gathering data from the requestor table, this information is also not seen by the user
	if ($_SESSION ['requestorTable'] !== false)
		while ($row = mysql_fetch_array($_SESSION ['requestorTable']))
			$_SESSION ['requestor'] = $row['requestor'];
	
//===these are the composed description content that goes into the description box, date and time spamp goes in here !!!
	$_SESSION ['composedDescription'] = "#".$_SESSION ['problemCode'].$_SESSION ['detailCode']." ".$_SESSION ['problemType'].", ".$_SESSION ['problemDescription'].", ".$_SESSION ['detailDescription']." at the ".$_SESSION ['property'].". Submitted on: ".$_SESSION ['dateStamp'];
	$sql = "INSERT INTO `Customer Request`(`requestor`, `desired_date`, `description`, `long_desc`, `region_code`, `fac_id`, `bldg`, `contact`, `contact_ph`, `contact_mc`, `problem_code`, `login`, `shop`, `company_id`, `dept_id`, `oc_code`, `order_type`, `category`, `pri_code`)
		VALUES ('".$_SESSION ['requestor']."', '".$_SESSION ['desireDate']."', '".$_SESSION ['composedDescription']."', '".$_SESSION ['otherComments']."', '".$_SESSION ['regionCode']."','".$_SESSION ['facilityID']."', '".$_SESSION ['bldg']."', '".$_SESSION ['name']."', '".$_SESSION ['phone']."', '".$_SESSION ['email']."', '".$_SESSION ['problemCode'].$_SESSION ['detailCode']."', '".$_SESSION ['userName']."', '".$_SESSION ['shop']."', '".$_SESSION ['company_id']."', '".$_SESSION ['dept_id']."', '".$_SESSION ['organizationOc_code']."', '".$_SESSION ['order_type']."', '".$_SESSION ['category']."', '".$_SESSION ['pri_code']."')";
	$COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	
	unset ($_SESSION);
	session_destroy();

//===html head===just a echoes a thank you message to the user for using this service, but still the head and tail html are still used to be consistence, and along with the form as well	
	include ("headHTML.html");
		print ("<form action = \"debug.php\" method = \"post\" name = \"form\">");
			print ("<label><center><strong><font size = \"5\">Thank you for reporting a maintenance issue</font></strong></center></label><br>");
			print ("<META http-equiv = \"REFRESH\" content = \"3; debug.php\">"); //this line automatically redirects to a php page after three seconds
			print ("<button type = \"button\" id = \"submitButton\" onclick= \"location.href = 'debug.php'\">Continue</button><br><br>");
		print ("</form>");
//===html tail===
	include ("tailHTML.html");
?>