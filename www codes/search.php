<?php
// -------------------------- Set of utility functions ----------------------------

/*
* Function I found here: http://stackoverflow.com/questions/80646/how-do-the-php-equality-double-equals-and-identity-triple-equals-comp
* Checks if $haystack string ends with $needle string
* I use this for checking for php file extensions
* @copy-and-paster William Andrew Cahill
*/
function endsWith($haystack, $needle)
{
    $length = strlen($needle);
    if ($length == 0)
    {
        return true;
    }

    return (substr($haystack, -$length) === $needle);
}

/*
* Lists all navigable pages in a given directory
*/
function listNavigablePages($dir)
{	
	// Lists all files in directory
	$files = scandir($dir);

	// Ignores all files not ending with a .php or .html
	$len = count($files);
	for($i=0; $i < $len; $i++)
	{
		if(!endsWith($files[$i], ".php") && !endsWith($files[$i], ".html"))
			unset($files[$i]);
	}

	// Removes all null keys left from previous loop
	$files = array_values(array_filter($files));
	
	// Returns generated list of files
	return $files;
}

/*
* Generates an HTML string that will display a search entry
*/
function createAirportEntry($airport, $long, $lat)
{
	// Starts with empty string
	$entry = "";

	// Adds div
	$entry .= "<div style='float: left; width: 50%; margin: 0 auto'>";

	// Adds link portion
	$entry .= "<a href='Main.php?longlat=$long+$lat'>";
	$entry .= $airport;

	// Ends link at end of city and state
	$entry .= "</a>";

	// End of div
	$entry .= "</div>";

	// Adds longitude and latitude values
	$entry .= "$long, $lat";

	// Returns html string
	return $entry;
}
?>



<!--------------------- Header code ------------------------>
<?php
	// Includes Head.html
	$debug = false;
	session_start();// Starting Session
	include("headHTML.html");

	// Makes variable that keeps track
	// of number of entries total found
	$numEntries = 0;
?>

<!--------- Title ----------->
<label><strong><center><font size = "6" color = "#595959">Search Results</font></center></strong><br>



<?php
	//--------- Airport entries -------------
	// Gets search args by splitting string by space character
	$input = $_GET["query"];
	$args = explode(" ", $input);

	// Trims array to remove empty strings
	foreach($args as &$arg)
	{
		if(strlen($arg) == 0)
			unset($arg);
	}
	$args = array_values($args);

	// Stores all airports found from query into array
	$airports = array();
	$numPorts = 0;

	// Queries all airport entries
	$query = $link->executeQuery("select * from airport_locations", $_SERVER["SCRIPT_NAME"]);

	// If valid query...
	if($query)
	{
		// Searches query using arguments entered in search bar
		foreach($args as &$arg)
		{
			// While there are more entries in query, fetch a row
			while($row = mysql_fetch_array($query))
			{
				// Creates airport object
				$port = (object) array
				(
					"id" => $row["id"],
					"airport" => $row["airport"],
					"long" => $row["long"],
					"lat" => $row["lat"]				
				);

				// Store airport into array if either it's city or state matches param, and the airport is not already included
				$split = explode(", ", $port->airport);
				$name = $split[0];
				$city = $split[1];
				$state = $split[2];
				$res = strpos($name, $input);
				if($res === false)
				{
					$res = strpos($city, $arg);
					if($res === false)
					{
						$res = strpos($state, $arg);
					}
				}
				if($res !== false && !array_key_exists($port->id, $airports))
				{
					print("Added becase res was $res\n");
					$airports[$port->id] = $port;
					$numPorts ++;
				}
			}

			// Resets internal pointer
			mysql_data_seek($query, 0);
		}

	}

	// Otherwise, output error
	else
	{
		print("Failed query");
	}
	
	// Increases numEntries by number of airports found
	$numEntries += $numPorts;

	// Outputs airport entries, if there were any
	if($numPorts != 0)
	{

		// Prints titoe of div
		print("Airports: $numPorts<br>");

		// Div containing all airport entries
		print('<div style="background: white">');
			// Outputs all entries
			foreach($airports as $port)
			{
				print(createAirportEntry($port->airport, $port->long, $port->lat) . "<br>");
			}
		print('</div>');
	}

	// Outputs error if there were no entries of any kind found
	if($numEntries == 0)
	{
		print("<div style='font-size: 30px; text-align: center'>");
			print("No entries found!");
		print("</div>");
	}

	// Unsets variables no longer in use
	unset($numPorts);
	unset($numEntries);
	unset($args);
	unset($arg);
?>
<!-------------- Tail code -------------->
<?php
	include("tailHTML.html");
?>