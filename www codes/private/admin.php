<?php
/*
  This is the main page
*/
	$debug = false;
	session_start();// Starting Session
	include ("adminHeadHTML.html");
	
	if (isset($_SESSION['loginId']) && $_SESSION['loginId'] == "admin")
				$loginUser = $_SESSION['loginId'];
	
	print ("<label><strong><center><font size = \"6\" color = \"#595959\">Administration</font></center></strong><br>");
	print ("</label>");
	
	print ("<input type = \"button\" value = \"Find it\" id = \"searchButton\"><input type = \"text\" id = \"textBox\" maxlength = \"120\" placeholder = \"Looking for something?\">");
	
	if(isset($loginUser))
	{
		print ("<font size = \"3\" style = \"float:left\">Hello ".$loginUser."</font>");
		print ("<font size = \"3\" style = \"float:right\"><a href=\"../main.php\">Main Page    </a><a href=\"../logout.php\">Logout    </a></font><br>");
		
		$memList = $link->executeQuery("select * from `customer_Profile`", $_SERVER["SCRIPT_NAME"]);
		
		print ("<font size = \"2\">");
		
		if (isset($loginUser))
		{
			print ("<label> Member List <span>(click on member name to detele them)</span></label><br>");
			if (isset($memList))
			{
				//prints the labels for the travel history table
				print ("<table border='0px'>");
				print ("<tr>");
				print ("<td>First Name	</td>");
				print ("<td>Last Name	</td>");
				print ("<td>Street Address	</td>");
				print ("<td>City			</td>");
				print ("<td>State	</td>");
				print ("<td>Zip		</td>");
				print ("<td>Avatar			</td>");
				print ("<td>Email				</td>");
				print ("<td>Phone		</td>");
				print ("<td>Password	</td>");
				print ("<td>Register Date		</td>");
				print ("</tr>");
				
				while ($row = mysql_fetch_array($memList))
					print ("<tr><td>".$row ['firstName'].
							"</td><td>".$row ['lastName'].
							"</td><td>".$row ['street'].
							"</td><td>".$row ['city'].
							"</td><td>".$row ['state'].
							"</td><td>".$row ['zip'].
							"</td><td>".$row ['avatar'].
							"</td><td>".$row ['email'].
							"</td><td>".$row ['phone'].
							"</td><td>".$row ['password'].
							"</td><td>".$row ['regDate'].
							"</td><td>");
				print ("</table><br><br>");
			}
			else
				print ("Database Access Error, Try Again");
		} 
		
		print ("</font>");
	} else
		print ("<label> Login Error, Please Try Again</label><br>");
	
	include ("adminTailHTML.html");
?>