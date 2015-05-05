// Global variables
var map; 						//need this variable as global to use in multiple functions
var userTrvHist; 				//this is use to hold the original content of the user profile travel history inner html content
var avatarToggle = "false";		//toggle between the link and the upload buttons, when the user clink on link to change avatar, upload buttons appear, when they click cancel button, link appear
var mainFormPanel; 				//this variable is use to back up the content of the form panel
var srcDestToggle = -1;			//Toggle that alternates between -1 and 1.  -1 meaning src, 1 meaning destination.
var src = dest = null;			//Two points storing long and lat coords
var flightPath = null;			//Object representing a Google Maps path graphics object
var notification = '';
var updateUserInfoData;			//global variable use for ajax in update user info
var lateFeeDemo;

var changeAvatarOnHTML = //this entire string is the html content that replaces the content inside the userExtenPanel
		"<font size = \"3\">" +
		"<input type = \"button\" value = \"Find it\" id = \"searchButton\">" + 
		"<input type = \"text\" id = \"textBox\" maxlength = \"120\" placeholder = \"Looking for something?\">" +
		"<a style = \"float:right\"href=\"logout.php\">Logout    </a><br>" +
		"<a href = \"javascript: changeAvatar('userExtenPanel');\">" +
		"<img id = \"userAvatar\" class = \"userAvatar\" src = \"\"></a><br>" +
		"<form action = \"uploadFile.php\" method = \"post\" enctype = \"multipart/form-data\">" +
		"<input type = \"button\" value = \"Cancel\" onclick = \"changeAvatar('userExtenPanel')\">" +
		"<input type = \"submit\" value = \"Apply\" name = \"submit\">" +
		"<input type = \"file\" name = \"fileToUpload\" id = \"fileToUpload\"><br>" +
		"</form></font>";

var changeAvatarOffHTML = //this entire string is the html content that replaces the content inside the userExtenPanel
		"<font size = \"3\">" +
		"<input type = \"button\" value = \"Find it\" id = \"searchButton\">" +
		"<input type = \"text\" id = \"textBox\" maxlength = \"120\" placeholder = \"Looking for something?\">" +
		"<a style = \"float:right\" href=\"logout.php\">Logout    </a><br>" +
		"<a href = \"javascript: changeAvatar('userExtenPanel');\">" +
		"<img id = \"userAvatar\" class = \"userAvatar\" src = \"\"></a><br>" +
		"<a href = \"javascript: changeAvatar('userExtenPanel');\">Edit</a>" +
		"</font>";

var changeUserInfoHTML = //this entire string is the html content that replaces the content inside the userTravHistPanel
		"<div id = \"changeUserInfo\" style = \"width:37%;\"><font size = \"3\">" +
		"<label>First Name   <input name = \"firstName\" id = \"firstName\" type = \"text\" maxlength = \"30\" class = \"input\"/><br><br></label>" +
		"<label>Last Name   <input name = \"lastName\" id = \"lastName\" type = \"text\" maxlength = \"30\" class = \"input\"/><br><br></label>" +
		"<label>Street Address   <input name = \"street\" id = \"street\" type = \"text\" maxlength = \"30\" class = \"input\"/><br><br></label>" +
		"<label>City   <input name = \"city\" id = \"city\" type = \"text\" maxlength = \"30\" class = \"input\"/><br><br></label>" +
		"<label>State <input name = \"state\" id = \"state\" type = \"text\" maxlength = \"30\" class = \"input\"/><br><br></label>" +
		"<label>Zip Code <input name = \"zip\" id = \"zip\" type = \"text\" maxlength = \"5\" class = \"input\" onKeyup = \"isValidChar (this.value, 'zip')\"/><br><br></label>" +
		"<label>Phone Number <input name = \"phone\" id = \"phone\" type = \"text\" maxlength = \"10\" class = \"input\" onKeyup = \"isValidChar (this.value, 'phone')\"/><br><br></label>" +
		"<label>Email <input name = \"email\" id = \"email\" type = \"text\" maxlength = \"30\" class = \"input\"/><br><br></label>" +
		"<a style = \"float:right\" href = \"javascript: updateUserInfo('updateUser');\">Apply</a><a style = \"float:right\" href = \"javascript: showTrvHist();\">Cancel   </a>" +
		"<br><valErr id = \"valErr\" class = \"valErr\" style = \"float:right; color:red; opacity: 0;\">---</valErr>" +
		"</font></div>";

var updatePasswordHTML = //this entire string is the html content that replaces the content inside the userTravHistPanel
		"<div id = \"updatePasswordHTML\" style = \"width:43%\"><font size = \"3\">" +
		"<label>Enter new password   </label>" +
		"<input id = \"changePassword\" type = \"password\" maxlength = \"30\" class = \"input\"/><br><br>" +
		"<label>Retype password   </label>" +
		"<input id = \"changePassword2\" type = \"password\" maxlength = \"30\" class = \"input\"/><br><br>" +
		"<a style = \"float:right\" href = \"javascript: updateUserInfo('updatePassword');\">Apply</a>" +
		"<a style = \"float:right\" href = \"javascript: showTrvHist();\">Cancel   </a>" +
		"<br><valErr id = \"valErr\" class = \"valErr\" style = \"float:right; color:red; opacity: 0;\">---</valErr>" +
		"</font></div>";
		
var payBalanceHTML = //this entire string is the html content that replaces the content inside the userTravHistPanel
		"<div style = \"width:47%\"><font size = \"3\">" +
		"<label>Enter exact amount in dollars   </label>" +
		"<input id = \"payBalance\" type = \"text\" maxlength = \"30\" class = \"input\"/><br><br>" +
		"<a style = \"float:right\" href = \"javascript: updateUserInfo('payBalance');\">Apply</a>" +
		"<a style = \"float:right\" href = \"javascript: showTrvHist();\">Cancel   </a>" +
		"<br><passErr class = \"valErr\" style = \"float:right; color:red; opacity: 0;\">Invalid amount</passErr>" +
		"</font></div>";

function saveTrvHist () {userTrvHist = document.getElementById('userTrvHistPanel').innerHTML;}
function showTrvHist () {document.getElementById('userTrvHistPanel').innerHTML = userTrvHist;}
function mainFormPanelBak () {mainFormPanel = document.getElementById('mainFormPanel').innerHTML;}
function mainFormPanelRes () {document.getElementById('mainFormPanel').innerHTML = mainFormPanel;}
function lateFeeDemo (value) {lateFeeDemo = value}
$(function() {$("#datePicker").datepicker();}); //this is the jQuery function to perform the date picker selection for the checkout date, makes inputing date much faster 

/*
 *this checkin function performs any late fees calculation and then asynchronously calls the backend server to perform the any
 *database functions for the checkin process, method of asynchronous calls uses traditional javascript ajax with post  
 */
function checkIn(checkOutStatus, dayVal, feeVal)
{
	if (parseInt(checkOutStatus) === 1)
	{
		var oneDay = 24*60*60*1000;															//creating a day value: hours * minutes * seconds * milliseconds
		var msec = Date.parse(dayVal);														//creating the return date object
		var returnDate = new Date(msec);													//creating new return date object using the created time object 
		returnDate.setDate(returnDate.getDate() + 1);										//not sure what I did here, but it worked, so leave it alone  
		var currDate = new Date();															//creating the current date object
		var diffDays = Math.round((currDate.getTime() - returnDate.getTime())/(oneDay));	//getting the difference of the two dates
		var feeOwe = diffDays * feeVal;														//determining the late ammount
					
		if (diffDays < 0) //we ignore any negative values
		{
			diffDays = 0;
			feeOwe = 0;
		}
		var data = "diffDays="+diffDays+"&feeOwe="+feeOwe; //the data to pass to the backend server are the days late and how much it cost per day
		ajax ("mainFormPanel", "checkIn.php", data);
		
	} else //change the content of the plane rental form and display a message telling them that they don't have any planes checked out
		document.getElementById('mainFormPanel').innerHTML = "<br><br><center><span>You currently dont have any planes checked out</span></center>"; //if they don't have any planes checked out
	return;
}

/*
 *this checkOut function retrieves all values collected from the plane rental forms and assigns it to local variable for checkout processing
 *this function uses asynchronous communication with backend server to perform all necessary check out routine functions
 */
function checkOut(checkOutStatus)
{								
	mainFormPanelRes(); //first, restore whatever content that was originally belong to the plane rental form panel
	var depart = document.getElementById('departLabel').innerHTML; //collect all necessary checkout data from the plane rental form
	var arrive = document.getElementById('arrivalLabel').innerHTML; //if the data content is insufficient for checkout, we will display an error message
	var duration = document.getElementById('durationLabel').innerHTML; //indicating the chck out form is incomplete
	var startDate = document.getElementById('startLabel').innerHTML;
	var returnDate = document.getElementById('returnLabel').innerHTML;
	var model = document.getElementById('planeLabel').innerHTML;
	
	if (parseInt(checkOutStatus) === 0) //second, we want to determine is they had already checkout a plane, and if so 
	{//change the content of the plane rental form and display a message telling them that they had already checked out a plane
		if (depart !== '' && arrive !== '' && duration !== '' && startDate !== '' && returnDate !== '' && model !== '') //verify all the collected data are not empty 
		{	//combine all collected data into a single string of data
			var data = "depart="+depart+"&arrive="+arrive+"&duration="+duration+"&startDate="+startDate+"&returnDate="+returnDate+"&model="+model;
			ajax ("mainFormPanel", "checkOut.php", data);
		} else
		{	//error message telling user that rental form is incomplete
			document.getElementById('mainFormPanel').innerHTML = "<br><br><center><span>Rental form incomplete</span></center>";
			return;
		}
	} else //error message telling user that they currently have a lane checkout
		document.getElementById('mainFormPanel').innerHTML = "<br><br><center><span>You already checkout a plane</span></center>";
}

/*
 *this function verifies if any digit field content entered are suppose to be digits, if the user enters a non digit character it will be remove
 *the parameters for this function are the content of the text field and the location id of where that text was entered
 */
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
			document.getElementById(id).value = char.substring(0, char.length -1);
			break;
		}
	}
}
			
/*
 *this function is used by the registration process to check if all required fields are entered before submitting
 *if a field is not entered, then we will alert a message to indicate the required content 
 */
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
											if ((document.getElementById ('password').value).length > 7)
												ajax ('xmlRespondFeedback', 'confirm.php', "verifyEmail=" + document.getElementById ('email').value);
											else {document.getElementById ('valErr').innerHTML = "password needs to be at least 8 characters long";
												document.getElementById ('valErr').style.opacity = '1';}
										else {document.getElementById ('valErr').innerHTML = "the password doesn't match";
											document.getElementById ('valErr').style.opacity = '1';}
									else {document.getElementById ('valErr').innerHTML = "you need to enter your a password";
										document.getElementById ('valErr').style.opacity = '1';}
								else {document.getElementById ('valErr').innerHTML = "you need to enter your email";
									document.getElementById ('valErr').style.opacity = '1';}
							else {document.getElementById ('valErr').innerHTML = "you need to enter your phone number";
								document.getElementById ('valErr').style.opacity = '1';}
						else {document.getElementById ('valErr').innerHTML = "you need to enter your zip code";
							document.getElementById ('valErr').style.opacity = '1';}
					else {document.getElementById ('valErr').innerHTML = "you need to enter your state";
						document.getElementById ('valErr').style.opacity = '1';}
				else {document.getElementById ('valErr').innerHTML = "you need to enter your city";
					document.getElementById ('valErr').style.opacity = '1';}
			else {document.getElementById ('valErr').innerHTML = "you need to enter your street address";
				document.getElementById ('valErr').style.opacity = '1';}
		else {document.getElementById ('valErr').innerHTML = "You need to enter your last name";
			document.getElementById ('valErr').style.opacity = '1';}
	else {document.getElementById ('valErr').innerHTML = "You need to enter your first name";
		document.getElementById ('valErr').style.opacity = '1';}
}

/*
 *this function is use to update user info, it is a subroutine call to provide functionality for user profile page for the user edit link, pay link, 
 *and clear history link each of the link passes an intended condition that is required to perform the specific task. these intent task are match with 
 *the condition set in the function's logic that initialize the necessary data values to be sent over to the server script where it will be process accordingly
 *though, not every link in the user profile page invoke this function directly   
 */
function updateUserInfo(intent)
{
	var data = ""; //initializes the data string
	
	if (intent === 'clearHist') //if clear hist link was chosen, it will sent over a clearHist intent, the data parameter for the ajax are initialize here
		data = "clearHist=\"clearHist\""; //this function is invoke directly from the link
	
	if (intent === 'updatePassword') //use to update the password
	{
		if (document.getElementById('changePassword').value === document.getElementById('changePassword2').value && document.getElementById('changePassword').value !== '')
		{
			if ((document.getElementById('changePassword').value).length >= 7)
			{
				data = data+"password="+document.getElementById('changePassword').value;
			}
			else
			{
				document.getElementById('valErr').innerHTML = "password needs to be at least 8 characters long";
				updatePassword ('userTrvHistPanel', 'error');
				return;
			}
		} else
		{
			document.getElementById('valErr').innerHTML = "password don't match";
			updatePassword ('userTrvHistPanel', 'error');
			return;
		}
	}
	
	if (intent === 'payBalance') //use to pay the balance
	{
		if (document.getElementById('payBalance').value < 0)
		{
			$('.valErr').animate({opacity: '1'});
			return;
		}
		data = data+"payBalance="+document.getElementById('payBalance').value;
		
	}
	
	if (intent === 'updateUser') //update the user information, data entries are concatenated as a single string, for which ever entries that are available
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
			updateUserInfoData = data+"email="+document.getElementById('email').value;
			ajax ('xmlRespondFeedback', 'confirm.php', "verifyEmail=" + document.getElementById ('email').value);
			return;
		}
	}
	
	if (data === "") //if the user click apply without entering in anything, then there are nothing to process 
	{
		showTrvHist(); //return the travel history to its original state before leaving
		return; //return to our normal routine
	}
	ajax ("xmlRespondFeedback", "updateUserProfile.php", data);
}

/*
 *this function changes the user information, it is directly invoke from the userProfile page, its functionality is handle by the updateUserInfo function just right above
 *the content of of this function is simply altering the html content of the userTravHistPanel with the necessary text field items for the user to change their information
 */			
function changeUserInfo (id)
{
	document.getElementById(id).innerHTML = changeUserInfoHTML; //this line modifies the the content of the userTravHistPanel
}

/*
 *this function changes the user password, it is directly invoke from the userProfile page, its functionality is handle by the updateUserInfo function
 *the content of of this function is simply altering the html content of the userTravHistPanel with the necessary text field items for the user to change their password
 */	
function updatePassword (id, error)
{
	if (!document.getElementById('updatePasswordHTML'))
		document.getElementById(id).innerHTML = updatePasswordHTML; //this line modifies the the content of the userTravHistPanel
	if (error === 'error')
		$('.valErr').animate({opacity: '1'});
}

/*
 *this function allows the user to pay their balance, it is directly invoke from the userProfile page, its functionality is handle by the updateUserInfo function
 *the content of of this function is simply altering the html content of the userTravHistPanel with the necessary text field items to allow the user to pay their balance
 */	
function payBalance (id)
{
	document.getElementById(id).innerHTML = payBalanceHTML; //this line modifies the the content of the userTravHistPanel
}

/*
 *this function allows the user to upload a picture to change their profile picture, it is directly invoke from the userProfile page
 *the content of of this function is simply altering the html content of the userExtenPanel with the necessary button items to allow the user to upload and change their profile picture
 *complimentary of http://blog.teamtreehouse.com/uploading-files-ajax
 *http://codular.com/javascript-ajax-file-upload-with-progress
 *http://www.w3schools.com/php/php_file_upload.asp
 */				
function changeAvatar (id)
{
	var avatar = document.getElementById('userAvatar').src;
	if (avatarToggle === "false") //this if else logic is use to toggle between the link and the button, the avatarToggle is a global variable and initially set to false to allow the function to switch to the buttons mode
	{	
		document.getElementById(id).innerHTML = changeAvatarOnHTML;
		document.getElementById('userAvatar').src = avatar;
		avatarToggle = "true";
	} else //switch back to the link mode
	{	
		document.getElementById(id).innerHTML = changeAvatarOffHTML; //this line modifies the the content of the userExtenPanel
		document.getElementById('userAvatar').src = avatar;
		avatarToggle = "false";
	}
}

/*
 *this function creates the airport markers and paces it on the map
 */
function createMarker(name, long, lat, type)
{
	// Generates planes and airport markers
	if (type === "plane")
	{
		lat -= .0005; //offset the plane marker to one side to it wouldn't cover up the airport entirely
		img = "resources/images/plane.png";
	}
	else if (type === "airport")
		var img = "resources/images/pin.png";
	
	var marker = new google.maps.Marker
	({
      	position: new google.maps.LatLng(lat, long, 0),
     	map: map,
     	title: name,
		icon: img
  	});
  	
  	if (type === "plane") //plane marker can overlap airport marker, so we want to make the plane marker clickable as well
	  	lat += .0005; //offset value to accurately point the airport 
  	
	google.maps.event.addListener(marker, 'click', function() // Gives marker onclick code
	{
		if(srcDestToggle == -1) // If in src state, alter src
		{	// Inputs data into select field
			if (document.getElementById("departingAirport"))
			{
				var elem = document.getElementById("departingAirport");
				elem.value = "" + long + "|" + lat + "|departLabel|" + name;
				elem.onchange();
			} else //this is the case when the user is not log in
			{
				var elem = document.createElement("link");
				elem.onclick = focusMarker("" + long + "|" + lat + "|departLabel|" + name);
			}
		}
		else // Otherwise, alter dest
		{
			if (document.getElementById("arivalAirport")) 
			{
				elem = document.getElementById("arivalAirport");
				elem.value = "" + long + "|" + lat + "|arrivalLabel|" + name;
				elem.onchange();
			} else
			{
				var elem = document.createElement("link");
				elem.onclick = focusMarker("" + long + "|" + lat + "|departLabel|" + name);
			}
			//focusMarker("" + long + "|" + lat + "|arrivalLabel|" + name);
		}
		
		srcDestToggle *= -1; // Toggles between src and dest state
	});
	return marker;
}

function waitingList(value)
{
	var valueArr = value.split("|");
	var model = valueArr[1];
	var id = valueArr[3];
	var airport;
	if (document.getElementById('departingAirport'))
	{
		var airportDataStr = document.getElementById('departingAirport').value;
		var airportDataArr = airportDataStr.split("|");
		airport = airportDataArr[3];
	} else
		airport = valueArr[1];
	var data = "model=" + model + "&airport=" + airport;
	
	if (valueArr[0] === "yes")
	{
		if (valueArr[2] === "removeFromList")
			data += data + "&intent=" + valueArr[2];
		else if (valueArr[2] === "showConfirm")
			data += "&intent=" + valueArr[2];
		else if (valueArr[2] === "addToList")
			data += "&intent=" + valueArr[2];
		else if (valueArr[2] === "showWaitList")
			data += "&intent=" + valueArr[2];
		
		ajax (id, "waitingList.php", data);
	}
	else if (valueArr[0] === "no") 
		mainFormPanelRes();
}

function handleNotification (value)
{
	var valueArr = value.split("|");
	notification = valueArr[1];
	var data = "notification=" + notification;
	if (valueArr[0] === "yes")
	{
		ajax ("xmlRespondFeedback", "handleNotification.php", data);
		document.getElementById('departingAirport').value = "" + valueArr[3] + "|" + valueArr[4] + "|departLabel|" + valueArr[2];
		document.getElementById('departingAirport').onchange();
				
	} else if (valueArr[0] === "no")
	{
		mainFormPanelRes();
		ajax ("xmlRespondFeedback", "handleNotification.php", data);
	}
}

function showNotification(value)
{
	var valueArr2 = value.split("|");
	document.getElementById('mainFormPanel').innerHTML = 
		"<br><br><span>A plane you've been waiting for is available !</span><br><br>" + valueArr2[0] +
		" is available right now at<br>" + valueArr2[1] +
		"<br><br>Would you like to check it out?<br>" +
		"<a style =\"float:right\" href = \"javascript: handleNotification('yes|" + value + "');\">Yes       </a>" +
		"<a style = \"float:right\"href = \"javascript: handleNotification('no|" + value + "|');\">No   </a>";
}

//this is the common ajax function to be implemented into the rest of the javascript, this should reduce unnecessary lengthly codes 
function ajax (id, php, data)
{
	//alert ("this is the common ajax\n" + "id: " + id + "\nphp: " + php + "\ndata: " + data); //for debugging purposes
	
	if (window.XMLHttpRequest)
			xmlhttp = new XMLHttpRequest();
		else
			xmlhttp = new ActiveXObject ("Microsoft.XMLHTTP");
	
		xmlhttp.onreadystatechange = function()
		{
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{
				//compliments of https://www.developphp.com/video/JavaScript/Ajax-Post-to-PHP-File-XMLHttpRequest-Object-Return-Data-Tutorial
				document.getElementById(id).innerHTML = xmlhttp.responseText; //will need a feedback target on html document
				
				if (document.getElementById ('xmlRespondFeedback').innerHTML === 'email valid')
				{
					if (document.getElementById('registration'))
					{
						document.form.submit();
					} else if (document.getElementById('changeUserInfo'))
					{
						ajax ("xmlRespondFeedback", "updateUserProfile.php", updateUserInfoData);
					}
					
				}
				else if (document.getElementById ('xmlRespondFeedback').innerHTML === 'email not valid')
				{
					document.getElementById ('valErr').innerHTML = "Cannot use this email";
					document.getElementById ('valErr').style.opacity = '1';
				}
				
				if (notification !== '') //part of notification handler, automatically selecting the plane for the user when they select yes
				{
					document.getElementById('planeSelect').value = notification + "|1";
					document.getElementById('planeSelect').onchange();
					notification = '';
					
				}
			}
		}
		
		xmlhttp.open ("post", php, "true"); // will need a designation php target file 
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send (data); //will need the data to be sent
}

function focusMarker(value)
{
	//alert(value);
	// Splits data into array
	var dataArr = value.split("|");
	if (dataArr[0] === '')
		return;
		
	// Extracts values from delimited string
	var lat = Number(dataArr[1]);
	var lng = Number(dataArr[0]);
	var latlng = new google.maps.Marker({position: new google.maps.LatLng(lat, lng, 0)});
	var label = dataArr[2];
	var airport = dataArr[3];
	
	// Pans to location specified
	map.panTo(latlng.getPosition());
	
	// Breaks out of function early if input was bad
	if (label === undefined && airport === undefined)
		return;
	
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
	//alert(dataArr[2] + " " + dataArr[3]);
	// Update the form
	updateForm(dataArr[2], dataArr[3]);
}

/*
 *this function update the content of the plane rental form panel. when the user selects and item in the main page to rent a plane
 *content of this panel are populated with their selections to provide feedback on what they pick
 *the parameter accepted here are the id of where on the form the content of the value of the selection is to be place
 */
function updateForm (id, value)
{
	mainFormPanelRes();
	var valueArr = value.split("|");
	if (valueArr[1] === '0')
	{		
		waitingList ('yes|' + valueArr[0] + '|showConfirm|mainFormPanel');
		return;
	}
	
	value = valueArr[0];
	
	if (value === '') //if there value is empty, then we don't update the form
		return;
	
	if (lateFeeDemo === "off")
		if (id === 'startLabel') //verify if the selected checkout date is current or later
		{
			var selDte = Date.parse(value);
			var currDte = Date.parse(((new Date()).getMonth() + 1) + "/" + (new Date()).getDate() + "/" + (new Date()).getFullYear());
			if (selDte < currDte)
			{
				document.getElementById('mainFormPanel').innerHTML = "<br><br><center><span>Invalid start date</span></center>";
				return;
			}
		}
	
	mainFormPanelRes();
	document.getElementById(id).innerHTML = value;
	
	if (document.getElementById('durationLabel').innerHTML !== '' && document.getElementById('startLabel').innerHTML !== '')
	{
		var msec = Date.parse(document.getElementById('startLabel').innerHTML);
		var date = new Date(msec);
		date.setDate(date.getDate() + (parseInt(document.getElementById('durationLabel').innerHTML) - 1));
		var formDate = (date.getMonth() + 1) + "/" + date.getDate() + "/" + date.getFullYear(); 
		document.getElementById('returnLabel').innerHTML = formDate;
	}
	
	mainFormPanelBak();
	
	//this section performs the update drop down box for the planes select options 
	if (id === 'departLabel')
	{
		var data = "airport=" + value;		
		ajax("planeSelect", "populatePlaneOption.php", data);
	}
		
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