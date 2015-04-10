// Global variables
var map; 						//need this variable as global to use in multiple functions
var userTrvHist; 				//this is use to hold the original content of the user profile travel history inner html content
var avatarToggle = "false";		// ???
var mainFormPanel; 				//this variable is use to back up the content of the form panel
var srcDestToggle = -1;			// Toggle that alternates between -1 and 1.  -1 meaning src, 1 meaning destination.
var src = dest = null;			// Two points storing long and lat coords
var flightPath = null;			// Object representing a Google Maps path graphics object

function saveTrvHist () {userTrvHist = document.getElementById('userTrvHistPanel').innerHTML;}
function showTrvHist () {document.getElementById('userTrvHistPanel').innerHTML = userTrvHist;}

$(function() {$("#datePicker").datepicker();});

function checkIn(checkOutStatus, dayVal, feeVal)
{
	if (parseInt(checkOutStatus) === 1)
	{
		var oneDay = 24*60*60*1000;															// creating a day value: hours * minutes * seconds * milliseconds
		var msec = Date.parse(dayVal);														// creating the return date object
		var returnDate = new Date(msec);
		returnDate.setDate(returnDate.getDate() + 1);
		var currDate = new Date();															// creating the current date object
		var diffDays = Math.round((currDate.getTime() - returnDate.getTime())/(oneDay));	// getting the difference of the two dates
		var feeOwe = diffDays * feeVal;														// determining the late ammount
					
		//ignoring negative values
		if (diffDays < 0)
		{
			diffDays = 0;
			feeOwe = 0;
		}
					
		var data = "diffDays="+diffDays+"&feeOwe="+feeOwe;
		
		if (window.XMLHttpRequest)
			xmlhttp = new XMLHttpRequest();
		else
			xmlhttp = new ActiveXObject ("Microsoft.XMLHTTP");
			
		xmlhttp.onreadystatechange = function()
		{
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
				document.getElementById('mainFormPanel').innerHTML = xmlhttp.responseText;
		}
		
		xmlhttp.open ("post", "checkIn.php", "true");
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send (data);
	} else
		document.getElementById('mainFormPanel').innerHTML = "<br><br><center><span>You currently dont have any planes checked out</span></center>";
	return;
}
			
function checkOut(checkOutStatus)
{								
	document.getElementById('mainFormPanel').innerHTML = mainFormPanel;
	
	var depart = document.getElementById('departLabel').innerHTML;
	var arrive = document.getElementById('arrivalLabel').innerHTML;
	var duration = document.getElementById('durationLabel').innerHTML;
	var startDate = document.getElementById('startLabel').innerHTML;
	var returnDate = document.getElementById('returnLabel').innerHTML;
	var model = document.getElementById('planeLabel').innerHTML;
	
	if (parseInt(checkOutStatus) === 0)
	{
		if (depart !== '' && arrive !== '' && duration !== '' && startDate !== '' && returnDate !== '' && model !== '')
		{
			var data = "depart="+depart+"&arrive="+arrive+"&duration="+duration+"&startDate="+startDate+"&returnDate="+returnDate+"&model="+model;
			
			if (window.XMLHttpRequest)
				xmlhttp = new XMLHttpRequest();
			else
				xmlhttp = new ActiveXObject ("Microsoft.XMLHTTP");
			
			xmlhttp.onreadystatechange = function()
			{
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
					document.getElementById('mainFormPanel').innerHTML = xmlhttp.responseText;
			}
		
			xmlhttp.open ("post", "checkOut.php", "true");
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send (data);
		} else
		{
			document.getElementById('mainFormPanel').innerHTML = "<br><br><center><span>Rental form incomplete</span></center>";
			return;
		}
	} else
	{
		document.getElementById('mainFormPanel').innerHTML = "<br><br><center><span>You already checkout a plane</span></center>";
		return;
	}
}

/*this java script function verifies the phone number entered are only digits, if the user enters a non digits character it will be remove*/
function isValidChar (char, id)
{
		var txt = char;
	var found = false;
	var validChars = "0123456789"; //List of valid characters

	for(j = 0; j < txt.length; j++) //Will look through the value of text
	{
		var c = txt.charAt (j);
		found = false;
		for (x = 0; x < validChars.length; x++)
		{
			if (c == validChars.charAt (x))
			{
				found = true;
				break;
			}
		}
		if (!found)
		{
			if (id == 'zip')
				document.getElementById('zip').value = char.substring(0, char.length -1);
			if (id == 'phone')
				document.getElementById('phone').value = char.substring(0, char.length -1);
			break;
		}
	}
}
			
//this function performs a check to verify if all required fields are entered before submitting
function confirmEntry ()
{
	if (document.getElementById ('firstName').value != '')
		if (document.getElementById ('lastName').value != '')
			if ((document.getElementById ('street').value) != '')
				if (document.getElementById ('city').value != '')
					if (document.getElementById ('state').value != '')
						if (document.getElementById ('zip').value != '')
							if (document.getElementById ('phone').value != '')
								if (document.getElementById ('email').value != '')
									if (document.getElementById ('password').value != '')
										if (document.getElementById ('password2').value == document.getElementById ('password').value)
											document.form.submit();
										else
											alert ('the password doesn\'t match');
									else
										alert ('you need to enter your a password');
								else
									alert ('you need to enter your email');
							else
								alert ('you need to enter your phone number');
						else
							alert ('you need to enter your zip code');
					else
						alert ('you need to enter your state');
				else
					alert ('you need to enter your city');
			else
				alert ('you need to enter your street address');
		else
			alert ('You need to enter your last name'); 
	else
		alert ('You need to enter your first name');				
}
			
function updateUserInfo(intent)
{
	var data = "";				
	
	if (intent === 'clearHist')
		data = "clearHist=\"clearHist\"";
	
	if (intent === 'updatePassword')
	{
		if (document.getElementById('changePassword').value === document.getElementById('changePassword2').value && document.getElementById('changePassword').value !== '')
			data = data+"password="+document.getElementById('changePassword').value;
		else
		{
			updatePassword ('userTrvHistPanel', 'error');
			return;
		}
	}
	
	if (intent === 'payBalance')
		data = data+"payBalance="+document.getElementById('payBalance').value;
	
	if (intent === 'updateUser')
	{
		if (document.getElementById('firstName').value !== '')
			data = data+"firstName="+document.getElementById('firstName').value;
		if (document.getElementById('lastName').value !== '')
		{	
			if(data !== "")
				data = data+"&";
			data = data+"lastName="+document.getElementById('lastName').value;
		}
		if (document.getElementById('street').value !== '')
		{
			if(data !== "")
				data = data+"&";
			data = data+"street="+document.getElementById('street').value;
		}
		if (document.getElementById('city').value !== '')
		{
			if(data !== "")
				data = data+"&";
			data = data+"city="+document.getElementById('city').value;
		}
			if (document.getElementById('state').value !== '')
		{
			if(data !== "")
				data = data+"&";
			data = data+"state="+document.getElementById('state').value;
		}
		if (document.getElementById('zip').value !== '')
		{
			if(data !== "")
				data = data+"&";
			data = data+"zip="+document.getElementById('zip').value;
		}
		if (document.getElementById('phone').value !== '')
		{
			if(data !== "")
				data = data+"&";
			data = data+"phone="+document.getElementById('phone').value;
		}
		if (document.getElementById('email').value !== '')
		{
			if(data !== "")
				data = data+"&";
			data = data+"email="+document.getElementById('email').value;
		}
	}
	
	if (data === "")
	{
		alert ("All fields were empty, no changes were made");
		showTrvHist();
		return;
	}
	
	//document.getElementById('userTrvHistPanel').innerHTML = data;
			
	if (window.XMLHttpRequest)
		xmlhttp = new XMLHttpRequest();
	else
		xmlhttp = new ActiveXObject ("Microsoft.XMLHTTP");
	
	xmlhttp.onreadystatechange = function()
	{
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
			//compliments of https://www.developphp.com/video/JavaScript/Ajax-Post-to-PHP-File-XMLHttpRequest-Object-Return-Data-Tutorial
			document.getElementById('userTrvHistPanel').innerHTML = xmlhttp.responseText; //for debug
	}
		
	xmlhttp.open ("post", "updateUserProfile.php", "true");
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send (data);
}
			
function changeUserInfo (id)
{				
	var string = "<div style = \"width:37%\"><font size = \"3\">" +
			 "<label>First Name   <input name = \"firstName\" id = \"firstName\" type = \"text\" maxlength = \"30\" class = \"input\"/><br><br></label>" +
			 "<label>Last Name   <input name = \"lastName\" id = \"lastName\" type = \"text\" maxlength = \"30\" class = \"input\"/><br><br></label>" +
			 "<label>Street Address   <input name = \"street\" id = \"street\" type = \"text\" maxlength = \"30\" class = \"input\"/><br><br></label>" +
			 "<label>City   <input name = \"city\" id = \"city\" type = \"text\" maxlength = \"30\" class = \"input\"/><br><br></label>" +
			 "<label>State <input name = \"state\" id = \"state\" type = \"text\" maxlength = \"30\" class = \"input\"/><br><br></label>" +
			 "<label>Zip Code <input name = \"zip\" id = \"zip\" type = \"text\" maxlength = \"5\" class = \"input\" onKeyup = \"isValidChar (this.value, 'zip')\"/><br><br></label>" +
			 "<label>Phone Number <input name = \"phone\" id = \"phone\" type = \"text\" maxlength = \"10\" class = \"input\" onKeyup = \"isValidChar (this.value, 'phone')\"/><br><br></label>" +
			 "<label>Email <input name = \"email\" id = \"email\" type = \"text\" maxlength = \"30\" class = \"input\"/><br><br></label>" +
			 "<a style = \"float:right;color:black\" href = \"javascript: updateUserInfo('updateUser');\">Apply</a><a style = \"float:right;color:black\" href = \"javascript: showTrvHist();\">Cancel   </a>" +
			 "</font></div>";
									
	document.getElementById(id).innerHTML = string;
}

function updatePassword (id, error)
{
	var string = "<div style = \"width:43%\"><font size = \"3\">" +
			 "<label>Enter new password   </label>" +
			 "<input id = \"changePassword\" type = \"password\" maxlength = \"30\" class = \"input\"/><br><br>" +
			 "<label>Retype password   </label>" +
			 "<input id = \"changePassword2\" type = \"password\" maxlength = \"30\" class = \"input\"/><br><br>" +
			 "<a style = \"float:right;color:black\" href = \"javascript: updateUserInfo('updatePassword');\">Apply</a><a style = \"float:right;color:black\" href = \"javascript: showTrvHist();\">Cancel   </a>";
			 if (error === 'error')
				string = string + "<br><span style = \"float:right\">Password invalid</span>";
			string = string + "</div></font>";

	document.getElementById(id).innerHTML = string;
}

function payBalance (id)
{
	var string = "<div style = \"width:47%\"><font size = \"3\">" +
			 "<label>Enter exact amount in dollars   </label>" +
			 "<input id = \"payBalance\" type = \"text\" maxlength = \"30\" class = \"input\"/><br><br>" +
			 "<a style = \"float:right;color:black\" href = \"javascript: updateUserInfo('payBalance');\">Apply</a><a style = \"float:right;color:black\" href = \"javascript: showTrvHist();\">Cancel   </a>" +
			 "</font></div>";
	document.getElementById(id).innerHTML = string;
}
			
function changeAvatar (id, avatar)
{
	//complimentary of http://blog.teamtreehouse.com/uploading-files-ajax
	//http://codular.com/javascript-ajax-file-upload-with-progress
	//http://www.w3schools.com/php/php_file_upload.asp
	
	if (avatarToggle === "false")
	{
		var string = "<font size = \"3\">" +
					 "<input type = \"button\" value = \"Find it\" id = \"searchButton\"><input type = \"text\" id = \"textBox\" maxlength = \"120\" placeholder = \"Looking for something?\">" +
					 "<a style = \"float:right; color:black\"href=\"logout.php\">Logout    </a><br>" +
					 "<img id = \"userAvatar\" class = \"userAvatar\" src = 	\"/picsUploads/" + avatar + "\"><br>" +
					 "<form action = \"uploadFile.php\" method = \"post\" enctype = \"multipart/form-data\">" +
					 "<input type = \"button\" value = \"Cancel\" onclick = \"changeAvatar('userExtenPanel', '" + avatar + "')\">" +
					 "<input type = \"submit\" value = \"Apply\" name = \"submit\">" +
					 "<input type = \"file\" name = \"fileToUpload\" id = \"fileToUpload\"><br>" +
					 "</form></font>";
		avatarToggle = "true";
	} else
	{
		
		var string = "<font size = \"3\">" +
					 "<input type = \"button\" value = \"Find it\" id = \"searchButton\"><input type = \"text\" id = \"textBox\" maxlength = \"120\" placeholder = \"Looking for something?\">" +
					 "<a style = \"float:right; color:black\"href=\"logout.php\">Logout    </a><br>" +
					 "<img id = \"userAvatar\" class = \"userAvatar\" src = \"/picsUploads/" + avatar + "\"><br>" +
					 "<a style = \"color:black\"href = \"javascript: changeAvatar('userExtenPanel', '" + avatar + "');\">Edit</a>" +
					 "</font>";
		avatarToggle = "false";
	}
	
	document.getElementById(id).innerHTML = string;	
}

// Creates easy to use icon
function createMarker(name, long, lat)
{
	// Generates marker
	var img = "resources/images/pin.png";
	var marker = new google.maps.Marker
	({
      	position: new google.maps.LatLng(long, lat, 0),
     	map: map,
     	title: name,
		icon: img
  	});
	
	// Gives marker onclick ocde
	google.maps.event.addListener(marker, 'click', function()
	{		
		// If in src state, alter src
		if(srcDestToggle == -1)
		{
			// Inputs data into select field
			var elem = document.getElementById("departingAirport");
			elem.value = "" + long + "|" + lat + "|departLabel|" + name;
			elem.onchange();
			//focusMarker("" + long + "|" + lat + "|departLabel|" + name);
		}

		// Otherwise, alter dest
		else
		{
			elem = document.getElementById("arivalAirport");
			elem.value = "" + long + "|" + lat + "|arrivalLabel|" + name;
			elem.onchange();
			//focusMarker("" + long + "|" + lat + "|arrivalLabel|" + name);
		}

		// Toggles between src and dest state
		srcDestToggle *= -1;
	});
	return marker;
}
			
function updateForm (id, value)
{
	if (value === '')
		return;
	
	document.getElementById('mainFormPanel').innerHTML = mainFormPanel;
	document.getElementById(id).innerHTML = value;
	
	if (document.getElementById('durationLabel').innerHTML !== '' && document.getElementById('startLabel').innerHTML !== '')
	{
		var msec = Date.parse(document.getElementById('startLabel').innerHTML);
		var date = new Date(msec);
		date.setDate(date.getDate() + (parseInt(document.getElementById('durationLabel').innerHTML) - 1));
		var formDate = (date.getMonth() + 1) + "/" + date.getDate() + "/" + date.getFullYear(); 
		document.getElementById('returnLabel').innerHTML = formDate;
	}
	
	mainFormPanel = document.getElementById('mainFormPanel').innerHTML;
	
	/*===========update drop down box for planes here==================*/ 
	if (id === 'departLabel')
	{
		if (window.XMLHttpRequest)
			xmlhttp = new XMLHttpRequest();
		else
			xmlhttp = new ActiveXObject ("Microsoft.XMLHTTP");
	
		xmlhttp.onreadystatechange = function()
		{
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{
				//compliments of https://www.developphp.com/video/JavaScript/Ajax-Post-to-PHP-File-XMLHttpRequest-Object-Return-Data-Tutorial
				document.getElementById('planeSelect').innerHTML = xmlhttp.responseText; //for debug
			}
		}
		
		xmlhttp.open ("post", "populatePlaneOption.php", "true");
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send ("airport=" + value);
	}
	/*====================//=========================*/
	
}

function focusMarker(value)
{
	// Splits data into array
	var dataArr = value.split("|");
	if (dataArr[0] === '')
		return;
	
	// Extracts values from delimited string
	var lat = Number(dataArr[0]);
	var lng = Number(dataArr[1]);
	var latlng = new google.maps.Marker({position: new google.maps.LatLng(lat, lng, 0)});
	var label = dataArr[2];
	var airport = dataArr[3];
					
	// Breaks out of function early if input was bad
	if (label === undefined && airport === undefined)
		return;
	
	// Pans to location specified
	map.panTo(latlng.getPosition());
	
	// Assigns either src or dest global position objects
	if(label == "departLabel")
		src = new google.maps.LatLng(lat, lng);
	else
		dest = new google.maps.LatLng(lat, lng);
	
	// If both source and destination points are defined...
	if(src && dest)
	{
		// Draw a line between them!
		drawPath([src, dest]);
	}
	
	// Update the form
	updateForm(dataArr[2], dataArr[3]);
}

/*
* Draws a path on the map consisting of the points given
*/
function drawPath(lngLatPath)
{
	// Removes path from map, if it exists
	if(flightPath)
	{
		flightPath.setMap(null);
	}

	// Creates path object
	flightPath = new google.maps.Polyline
	({
		path: lngLatPath,
			geodesic: true,
			strokeColor: '#FF0000',
			strokeOpacity: 1.0,
			strokeWeight: 2
	});

	// Applies path to map
	flightPath.setMap(map);
}

function mainFormPanelBak ()
{
	mainFormPanel = document.getElementById('mainFormPanel').innerHTML;
}

// --------------- Init function for map -------------------------------
function initialize()
{
	// -------------------- Constructs and initializes sexy-assed map -------------------------
	var mapProp =
	{
		center:new google.maps.LatLng(38.954413, -96.271539),
		zoom:4,
		mapTypeId:google.maps.MapTypeId.ROADMAP
	};
	map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
	populatePins();			
}

google.maps.event.addDomListener(window, 'load', initialize);