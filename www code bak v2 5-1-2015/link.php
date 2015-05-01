<?php 

class Link
{	
	var $conn;
	var $debug;
			
	function Link($debug)
	{
		$this->debug = $debug; 
		$rs = $this->connect("planes_for_hire"); // db name really here
		return $rs;
	}

// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% */
	
	function connect($db)// connect to MySQL
	{
		$conn = @mysql_connect("localhost", "root", "") or die("Could not connect to MySQL");
		$rs = @mysql_select_db($db, $conn) or die("Could not connect select $db database");
		$this->conn = $conn; 
	}

// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% */
	
	function executeQuery($sql, $filename) // execute query
	{
		if($this->debug == true) { echo("$sql <br>\n"); }
		$rs = mysql_query($sql, $this->conn); 
		return $rs;
	}			

} // ends class, NEEDED!!

?>