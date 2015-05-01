<?php
	session_start ();
	if (session_destroy ()) // Destroying All Sessions
		header ("Location: Main.php"); // Redirecting To Home Page
	else
		print ("<span>Error: unable to destroy session. Please clear browser's cache and cookies manually.</span>");
?>