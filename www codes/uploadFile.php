<?php
/*
 Comments goes here!!
*/
	$debug = false;
	include ('link.php');
	$link = new Link($debug);
	session_start();// Starting Session
	
	$target_dir = "picsUploads/";
	$target_file = $target_dir . basename($_FILES["avatar"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	
	$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	
	if($check !== false)
	{
		print ("test OK");
	}
	
	print ("test not OK");
	
	print ("<META http-equiv = \"REFRESH\" content = \"3; userprofile.php\">");
?>