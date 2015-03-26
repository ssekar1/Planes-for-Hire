<?php
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


// Gets current working directory
$dir = getcwd();

// Lists all files in directory
$files = scandir($dir);

// Ignores all files not ending with a .php or .html
$len = count($files);
for($i=0; $i < $len; $i++)
{
	if(!endsWith($files[$i], ".php") && !endsWith($files[$i], ".html"))
	{
		unset($files[$i]);
	}
}

// Removes all null keys left from previous loop
$files = array_values(array_filter($files));