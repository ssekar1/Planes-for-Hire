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
			$password = $_POST['password'];  //change here to crypassword
			
			//protect mysql injection for security purposes
			$loginId = stripslashes($loginId);
			$password = stripslashes($password);
			$loginId = mysql_real_escape_string($loginId);
			$password = mysql_real_escape_string($password);
			
			//lookup database for user
			if ($loginId == "admin")
				$query = $link->executeQuery("select * from `admin_setting`", $_SERVER["SCRIPT_NAME"]);
			else
				$query = $link->executeQuery("select * from `customer_profile` where email = '".$loginId."'", $_SERVER["SCRIPT_NAME"]);
				
			if (mysql_num_rows($query) == 1)
			{
				while($row = mysql_fetch_array($query))	// retrieve the encrypt password
					$_SESSION ['key'] = $row ['password']; // define the encrypted password									
				if(password_verify($password,$_SESSION['key'])) // compare the user's pass with the encrypted pass
					$_SESSION['loginId'] = $loginId; // if it true do Initializing Session
				else
					$error = "Username or Password is invalid";
			} else
				$error = "Username or Password is invalid";
		}
		
		
	if(isset($_SESSION['loginId']) && $_SESSION['loginId'] == "admin") //redirect to main page if login successful
		print ("<META http-equiv = \"REFRESH\" content = \"0; private/admin.php\">");
	else if (isset($_SESSION['loginId']))
		print ("<META http-equiv = \"REFRESH\" content = \"0; Main.php\">");
	
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