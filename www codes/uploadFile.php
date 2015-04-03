<?php
/*
 Comments goes here!!
*/
	$debug = false;
	include ('link.php');
	$link = new Link($debug);
	session_start();// Starting Session
	
	$target_dir = "picsUploads/";
<<<<<<< HEAD
	$target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"]))
	{
    	$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    	if($check !== false) {
    	    echo "File is an image - " . $check["mime"] . ".";
    	    $uploadOk = 1;
    	} else
    	{
        	echo "File is not an image.";
        	$uploadOk = 0;
    	}
	}
	
	// Check if file already exists	
	if (file_exists($target_file))
	{
	    echo "Sorry, file already exists.";
	    $uploadOk = 0;
	}
	
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 500000) 
	{
	    echo "Sorry, your file is too large.";
	    $uploadOk = 0;
	}
	
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" )
	{
	    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	    $uploadOk = 0;
	}
	
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0)
	{
	    echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else
	{
	    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
	    {
	        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
	    } else
	    {
	        echo "Sorry, there was an error uploading your file.";
	    }
	}
	
	$link->executeQuery("UPDATE `customer_profile` SET `avatar` = '".basename( $_FILES["fileToUpload"]["name"])."' WHERE `email` = '".$_SESSION['loginId']."'", $_SERVER["SCRIPT_NAME"]);
	
	print ("<META http-equiv = \"REFRESH\" content = \"0; userprofile.php\">");
=======
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
>>>>>>> origin/master
?>