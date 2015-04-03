<?php
// -------------------------- Set of utility functions ----------------------------

/*
* Function I found here: http://stackoverflow.com/questions/80646/how-do-the-php-equality-double-equals-and-identity-triple-equals-comp
* Checks if $haystack string ends with $needle string
* I use this for checking for php file extensions
* @param haystack String to look for extension
* @param needle Extension we are looking for in haystack
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
* @param dir Directory to search for navigable pages
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
* @param airport Name of airport
* @param long Longitude of airport. Not yet used.
* @param lat Latitude of airport.  Not yet used.
*/
function createAirportEntry($airport, $long, $lat)
{
	// Starts with empty string
	$entry = "";

	// Adds div
	$entry .= "<div style='float: left; width: 50%; 0 auto'>";

	// Adds link portion
	$entry .= "<a href='Main.php?long=$long&lat=$lat'>";
	$entry .= $airport;

	// Ends link at end of city and state
	$entry .= "</a>";

	// End of div
	$entry .= "</div>";

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
<div class="searchBasePanel" style="background-color:#b2b2b2">
<label><strong><center><font size = "6" color = "#595959">Search Results</font></center></strong>
<?php
	//--------- Airport entries -------------
	// Gets query string
	if(isset($_GET["query"]))
		$input = $_GET["query"];
	else
		$input = "";

	// Splits query string to get list of args
	$args = explode(" ", $input);

	// Trims array to remove empty strings
	foreach($args as &$arg)
	{
		if(strlen($arg) == 0)
			unset($arg);
	}
	$args = array_values($args);

	// Creates array that will store all relevant airports found
	$airports = array();
	$numPorts = 0;

	// Queries all airport entries
	$query = $link->executeQuery("select * from airport_locations", $_SERVER["SCRIPT_NAME"]);

	// If valid query...
	if($query && $input != "")
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

				// Store airport into array if either its name, city or state matches param,
				// and the airport is not already included in $airports
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
					$airports[$port->id] = $port;
					$numPorts ++;
				}
			}

			// Resets query's internal pointer for next iteration
			mysql_data_seek($query, 0);
		}
	}
	
	// Increases numEntries by number of airports found
	$numEntries += $numPorts;

	// Div containing all airport entries
	print('<div style="background: #dddddd; padding: 30px; border-bottom-left-radius: 30px; border-bottom-right-radius: 30px">');

	// Prints title of div
	print('<div style="color: #595959; font-weight: bold">');
		print("Airports: $numPorts<br>");
	print('</div>');
	
	// Outputs all entries
	foreach($airports as $port)
	{
		print(createAirportEntry($port->airport, $port->long, $port->lat) . "<br>");
	}

	// End of div containing airport entries
	print('</div>');

	// Unsets variables no longer in use
	unset($numPorts);
	unset($numEntries);
	unset($args);
	unset($arg);
?>
</div>

<!-------------- Tail code -------------->
<?php
	include("tailHTML.html");
?>