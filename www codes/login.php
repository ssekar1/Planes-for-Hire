<?php
/*
  comments goes here !!!
*/
	$debug = false;
	session_start();
	include ("headHTML.html");
	
	$error=''; // variable to hold error message
	if (isset($_POST['submit']))
		if (empty($_POST['loginId']) || empty($_POST['password']))
			$error = "Username or Password is invalid";
		else
		{
			// Define $username and $password
			$loginId = $_POST['loginId'];
			$password = $_POST['password'];
			
			//protect mysql injection for security purposes
			$loginId = stripslashes($loginId);
			$password = stripslashes($password);
			$loginId = mysql_real_escape_string($loginId);
			$password = mysql_real_escape_string($password);
			
			//lookup database for user
			if ($loginId == "admin")
				$query = $link->executeQuery("select * from `admin_setting` where `password` = '".$password."'", $_SERVER["SCRIPT_NAME"]);
			else
				$query = $link->executeQuery("select * from `customer_profile` where `password` = '".$password."' AND email = '".$loginId."'", $_SERVER["SCRIPT_NAME"]);
			$rows = mysql_num_rows($query);
			
			if ($rows == 1)
				$_SESSION['loginId'] = $loginId; // Initializing Session
			else
				$error = "Username or Password is invalid";
			
			//mysql_close($connection); // Closing connection
		}

	if(isset($_SESSION['loginId']) && $_SESSION['loginId'] == "admin") //redirect to main page if login successful
		print ("<META http-equiv = \"REFRESH\" content = \"0; private/admin.php\">");
	else if (isset($_SESSION['loginId']))
		print ("<META http-equiv = \"REFRESH\" content = \"0; main.php\">");
	
	print ("<div id = \"loginPage\">");
	print ("<form id = \"form\" name = \"form\" action = \"\" method = \"post\">");
	print ("<h2><label><strong>Login</strong></label></h2>");
	
	
	print ("<label>Login Email:");
			print ("<input name = \"loginId\" id = \"loginId\" type = \"text\" maxlength = \"30\" class = \"input\"/><br><br><br>");
		print ("</label>");
	
	print ("<label>Password:");
			print ("<input name = \"password\" id = \"password\" type = \"password\" maxlength = \"30\" class = \"input\"/><br><br><br><br>");
		print ("</label>");
	
	print ("<input name = \"submit\" type = \"submit\" id = \"submitButton\" value = \"Login\">");
	print ("<span>".$error."</span><br><br>");
	print ("</div>");
	print ("</form>");
	
	include ("tailHTML.html");
?>