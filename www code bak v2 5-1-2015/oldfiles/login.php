<!-- Header code that brings in our consistant style -->
<?php
	$debug = false;
	include ("headHTML.html");
?>


<!-- Page title -->
<label><strong><center><font size = "6" color = "#676767">Login</font></center></strong><br></label>

<!-- Input fields -->
<div id = "login">
	<label>
		Enter your email
		<input name = "name" id = "name" type = "text" size = "30" maxlength = "30" class = "input"><br><br>
	</label>
	
	<label>
		Enter your password
		<input name = "name" id = "name" type = "password" size = "30" maxlength = "30" class = "input"><br><br>
	</label>
	
	<button type = "button" id = "submitButton" onclick= "confirm()">Submit</button><br><br>
</div>


<!-- Footer code that finishes stylizing the page -->
<?php
	include ("tailHTML.html");
?>