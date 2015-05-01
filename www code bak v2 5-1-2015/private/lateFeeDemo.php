<?php
	$debug = false;
	include ('../link.php');
	$link = new Link($debug);
	
	$result = $link->executeQuery("select * from `admin_setting`", $_SERVER["SCRIPT_NAME"]);
	while ($row = mysql_fetch_array($result))
		$demo = $row['lateFeeDemo'];

	if ($demo == "off")
		$link->executeQuery("UPDATE `admin_setting` SET `lateFeeDemo` = 'on' WHERE `lateFeeDemo` = 'off'", $_SERVER["SCRIPT_NAME"]);
	if ($demo == "on")
		$link->executeQuery("UPDATE `admin_setting` SET `lateFeeDemo` = 'off' WHERE `lateFeeDemo` = 'on'", $_SERVER["SCRIPT_NAME"]);
	
	print ("<META http-equiv = \"REFRESH\" content = \"0; admin.php\">");
	exit;
?>