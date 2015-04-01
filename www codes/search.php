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
function createHtmlEntry($state, $city, $long, $lat)
{
	$entry = "$state, $city, ";
	$entry .= "$long $lat\n";
	return $entry;
}
?>


<?php
	//------------------------- Header ---------------------------
	$debug = false;
	session_start();// Starting Session
	include("headHTML.html");
?>
<label><strong><center><font size = "6" color = "#595959">Search Results</font></center></strong><br>

<?php
	//------------------ List of entries found from search ------------------------
	// Gets search parameters by splitting string by space character
	$params = explode(" ", $_GET["query"]);

	// Trims empty params
	foreach($params as &$param)
	{
		if(strlen($param) == 0)
			unset($param);
	}
	$params = array_values($params);

	// Adds test entry
	print(createHtmlEntry("Gaithersburg", "MD", 25, 42) . "\n");

	include("tailHTML.html");
?>