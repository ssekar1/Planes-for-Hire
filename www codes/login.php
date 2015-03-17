<?php
/*
  comments goes here !!!
*/
	$debug = false;
	include ('link.php');
	$link = new Link($debug);
	session_start();
	
	$error=''; // variable to hold error message
	if (isset($_POST['submit']))
		if (empty($_POST['username']) || empty($_POST['password']))
			$error = "Username or Password is invalid";
		else
		{
			// Define $username and $password
			$username = $_POST['username'];
			$password = $_POST['password'];
			
			$query = $link->executeQuery("select * from `customer_profile` where `password` = '".$password."' AND email = '".$username."'", $_SERVER["SCRIPT_NAME"]);
			$rows = mysql_num_rows($query);
			
			if ($rows == 1)
				$_SESSION['login_user'] = $username; // Initializing Session
			else
				$error = "Username or Password is invalid";
			
			//mysql_close($connection); // Closing connection
		}

	if(isset($_SESSION['login_user'])) //redirect to main page if login successful
		header('Location: main.php');
	
	include ("headHTML.html");
	
	print ("<form id = \"form\" name = \"form\" action = \"\" method = \"post\">");
	print ("<label><strong><center><font size = \"6\" color = \"#676767\">Login</font></center></strong><br>");
	print ("</label>");
	
	print ("<div id = \"login\">");
	print ("<label>Login Email:");
			print ("<input name = \"username\" id = \"username\" type = \"text\" maxlength = \"30\" class = \"input\"/><br><br><br>");
		print ("</label>");
	
	print ("<label>Password:");
			print ("<input name = \"password\" id = \"password\" type = \"password\" maxlength = \"30\" class = \"input\"/><br><br><br>");
		print ("</label>");
	
	print ("<input name = \"submit\" type = \"submit\" id = \"submitButton\" value = \"Login\"><br>");
	print ("<span>".$error."</span>");
	print ("</div>");
	
	print ("</form>");
	include ("tailHTML.html");
?>