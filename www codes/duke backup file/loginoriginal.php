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
				$query = $link->executeQuery("select * from `admin_setting` where `password` = '".$password."'", $_SERVER["SCRIPT_NAME"]);
			else
				$query = $link->executeQuery("select * from `customer_profile` where email = '".$loginId."'", $_SERVER["SCRIPT_NAME"]);
			$rows = mysql_num_rows($query);
			/*$cost = 10;
			$number = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.'); // will create a random numbers
			$number = sprintf("$2a$%02d$", $cost) . $number;
			*/
			if ($rows == 1)
			{
				while($row = mysql_fetch_array($query))	// retrieve the encrypt password
					if(hash_equals($row['password']->encryptPassword , crypt($password, $row['password']->encryptPassword) ))  // compare 2 passwords
					//if($row['password'] == crypt($_POST ['password'], $number) )
					{
						$error = " test Username or Password is invalid";
						$_SESSION['loginId'] = $loginId; // Initializing Session
					}
			}
				else
				{
					$error = " test1 Username or Password is invalid";
					$error = "Username or Password is invalid";
				}
		}
			else
			{
				$error = " test2 Username or Password is invalid";
				$error = "Username or Password is invalid";
			}
			//mysql_close($connection); // Closing connection
		

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