<?php
	$debug = false;
	include ("headHTML.html");
?>





<style>
	.input
	{
		width: 150px;
		height: 20px;
		margin-right: 20px;
		margin-bottom: 20px;
		background-color: #FFFF99;
		border-color: #AAAA55;
	}
	.button
	{
		color: #ffffff;
		background-color: #4BAFF2;
		border-color: #4BAFF2;
		border-radius: 5px;
		border-style: solid;
		padding-left: 8px;
		padding-right: 8px;
		font-weight: bold;
	}
	.button:hover
	{
		color: #ffffff;
		background-color: #4BAFF2;
		border-color: #4BAFF2;
		border-radius: 5px;
		border-style: solid;
		padding-left: 8px;
		padding-right: 8px;
		font-weight: bold;
		cursor: pointer;
	}
	.button2
	{
		background-color: #fa8e8e;
		border-color: #fa8e8e;
		border-radius: 5px;
		border-style: solid;
		padding-left: 8px;
		padding-right: 8px;
		font-weight: bold;
		color: #ffffff;
	}
	.button2:hover
	{
		background-color: #79BFED;
		border-color: #79BFED;
		border-radius: 5px;
		border-style: solid;
		padding-left: 8px;
		padding-right: 8px;
		font-weight: bold;
		color: #ffffff;
		cursor: pointer;
	}
</style>

<div style="margin: 0 auto; width: 100%; text-align: center">
	<br><br>
	<p style="font-size: 30px; color: #555555; font-family: Arial; font-weight: bold">Sign Up<p>
	<div style="width: 55%; font-size: 12px; text-align: right; margin: 0 auto">
		<a href="http://userpages.umbc.edu/~tamtran1/index.html"><button class="button2">Home</button></a>
		<a href="http://userpages.umbc.edu/~tamtran1/login.php"><button class="button2">Login</button></a>
	</div>
	<hr>
	<br>
	<div style="text-align: right; width: 55%; border-style: solid; font-size: 17px; border-color: #AAAAB5; border-width: 1px; padding-top: 15px; padding-bottom: 10px; margin: 0 auto; background-color: #ffffff">
		First Name: <input class="input"><br>
		Last Name: <input class="input"><br>
		Email: <input class="input"><br>
		Username: <input class="input"><br>
		Password: <input class="input"><br>
		Re-enter Password: <input class="input"><br>
		<hr>
		Address: <input class="input"><br>
		City: <input class="input"><br>
		State: <input class="input"><br>
	</div>
	<br><br><br>
	<button class="button">Submit</button>
</div>





<?php
	//include ("test.html");
	include ("tailHTML.html");
?>