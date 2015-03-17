<?php
/*
  comments goes here !!!
*/
	$debug = false;
	include ('link.php');
	$LINK = new Link($debug);
	session_start();
	
	$error=''; // variable to hold error message
	if (isset($_POST['submit']))
	{
		if (empty($_POST['username']) || empty($_POST['password']))
		{
			$error = "Username or Password is invalid";
		} else
		{
			// Define $username and $password
			$username=$_POST['username'];
			$password=$_POST['password'];
			
			// Establishing Connection with Server by passing server_name, user_id and password as a parameter
			$connection = mysql_connect("localhost", "root", "");
			// To protect MySQL injection for Security purpose
			$username = stripslashes($username);
			$password = stripslashes($password);
			$username = mysql_real_escape_string($username);
			$password = mysql_real_escape_string($password);
			// Selecting Database
			$db = mysql_select_db("company", $connection);
			// SQL query to fetch information of registerd users and finds user match.
			$query = mysql_query("select * from login where password='$password' AND username='$username'", $connection);
			$rows = mysql_num_rows($query);
			
			if ($rows == 1)
			{
				$_SESSION['login_user']=$username; // Initializing Session
				header("location: profile.php"); // Redirecting To Other Page
			} else
			{
				$error = "Username or Password is invalid";
			}
			mysql_close($connection); // Closing Connection
		}
	}

	if(isset($_SESSION['login_user']))
		print ("<META http-equiv = \"REFRESH\" content = \"0; main.php\">");;
	
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