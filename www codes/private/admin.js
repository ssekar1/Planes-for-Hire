var adminContentPanel;
var emailG;
var fieldG;
var valueG;
var addPlaneHtmlContent = 
	"<div style = \"width:35%\"><font size = \"3\"><br>" +
	"Model Name<input id = \"model\" maxlength = \"30\" class = \"input\"/><br><br>" +
	"Desire Location<select id = \"airportLocation\" style = \"width: 310px; float: right;\">" +
	"<option value = ''></option></select><br><br>" +
	"<a style = \"float:right\" href = \"javascript: addPlane('apply');\">Apply</a>" +
	"<a style = \"float:right\" href = \"javascript: restoreAdminContentPanel();\">Cancel   </a>" +
	"<br><valErr id = \"valErr\" class = \"valErr\" style = \"float:right; color:red;\"></valErr>" +
	"</font></div><br><br>";

var addAirportHtmlContent =
	"<div style = \"width:35%\"><font size = \"3\"><br>" +
	"Airport Name<input id = \"airport\" maxlength = \"90\" class = \"input\"/><br><br>" +
	"Longitude<input id = \"lon\" maxlength = \"30\" class = \"input\"/><br><br>" +
	"Latitude<input id = \"lat\" maxlength = \"30\" class = \"input\"/><br><br>" +
	"<a style = \"float:right\" href = \"javascript: addAirport('apply');\">Apply</a>" +
	"<a style = \"float:right\" href = \"javascript: restoreAdminContentPanel();\">Cancel   </a>" +
	"<br><valErr id = \"valErr\" class = \"valErr\" style = \"float:right; color:red;\"></valErr>" +
	"</font></div><br><br>";

function adminContentPanelBak () {adminContentPanel = document.getElementById('adminContentPanel').innerHTML;}
function restoreAdminContentPanel() {document.getElementById('adminContentPanel').innerHTML = adminContentPanel;}
function listAirports () {ajax ("adminContentPanel", "updateTable.php", "intent=listAirports");}
function listPlanes () {ajax ("adminContentPanel", "updateTable.php", "intent=listPlanes");}
function deletePlane (model) {ajax ("adminContentPanel", "updateTable.php", "intent=deletePlane&model=" + model);}
function deleteAirport (airport) {ajax ("adminContentPanel", "updateTable.php", "intent=deleteAirport&airport=" + airport);}

function lateFeeDemo ()
{
	ajax ("xmlRespondFeedback", "lateFeeDemo.php", '');
}

function edit(email, field, value)
{
	var msg = "Enter a new " + field + " value for member " + email + "\nThe current value is:";
	var newVal, intent = "updateField";

	if (value == "delete")
		document.getElementById('adminContentPanel').innerHTML = 
			"<div style = \"width:25%\"><font size = \"3\"><br>" +
			"Delete member " + email + " ?   This cannot be undone<br>" +
			"<a style = \"float:right;color:red;\" href = \"javascript: edit('" + email + "', '" + field + "', 'updateField');\">Delete</a>" +
			"<a style = \"float:right\" href = \"javascript: restoreAdminContentPanel();\">Cancel   </a>" +
			"<input id = \"fieldValue\" maxlength = \"90\" value = \"delete\" style = \"float:left; visibility:hidden;\" class = \"input\"/><br><br>" +
			"</font></div><br><br>";
	else if (value == "suspend")
		newVal = "suspend";
	else if (value == "updateField")
	{
		if (document.getElementById('fieldValue').value == '')
		{
			restoreAdminContentPanel();
			return;
		} else if (field === "email")
		{
			var data = "email=" + email + "&field=" + field + "&newVal=" + document.getElementById('fieldValue').value
			ajax ("valErr", "verifyEmail.php", data);
			return;
		} else if (field === "password")
		{
			if ((document.getElementById('fieldValue').value).length < 8)
			{
				document.getElementById('valErr').innerHTML = "Password needs at least 8 characters"; 
				return;
			}
		}
		
		newVal = document.getElementById('fieldValue').value;
	} else if (field == "avatar")
		document.getElementById('adminContentPanel').innerHTML = 
			"<div style = \"width:35%\"><font size = \"3\"><br>" +
			"Reset member " + email + " " + field + " ?<br>" +
			"<a style = \"float:right\" href = \"javascript: edit('" + email + "', '" + field + "', 'updateField');\">Apply</a>" +
			"<a style = \"float:right\" href = \"javascript: restoreAdminContentPanel();\">Cancel   </a>" +
			"<input id = \"fieldValue\" maxlength = \"90\" value = \"default.jpg\" style = \"float:left; visibility:hidden;\" class = \"input\"/><br><br>" +
			"</font></div><br><br>";
	else if (field === "password")
		document.getElementById('adminContentPanel').innerHTML = 
			"<div style = \"width:23.5%\"><font size = \"3\"><br>" +
			"Enter a new " + field + " for member " + email + "<br>" +
			"<input id = \"fieldValue\" maxlength = \"90\" placeholder = \"" + value + "\" style = \"float:left;\" type = \"password\" class = \"input\"/><br><br>" +
			"<a style = \"float:right\" href = \"javascript: edit('" + email + "', '" + field + "', 'updateField');\">Apply</a>" +
			"<a style = \"float:right\" href = \"javascript: restoreAdminContentPanel();\">Cancel   </a>" +
			"<br><valErr id = \"valErr\" class = \"valErr\" style = \"float:right; color:red; opacity: 1;\"></valErr>" +
			"</font></div><br><br>";
	else
		document.getElementById('adminContentPanel').innerHTML =
			"<div id = \"" + field + "\" style = \"width:23.5%\"><font size = \"3\"><br>" +
			"Enter a new " + field + " for member " + email + "<br>" +
			"<input id = \"fieldValue\" maxlength = \"90\" placeholder = \"" + value + "\" style = \"float:left;\" class = \"input\"/><br><br>" +
			"<a style = \"float:right\" href = \"javascript: edit('" + email + "', '" + field + "', 'updateField');\">Apply</a>" +
			"<a style = \"float:right\" href = \"javascript: restoreAdminContentPanel();\">Cancel   </a>" +
			"<br><valErr id = \"valErr\" class = \"valErr\" style = \"float:right; color:red; opacity: 1;\"></valErr>" +
			"</font></div><br><br>";
	
	var data = "email=" + email + "&field=" + field + "&newVal=" + newVal + "&intent=" + intent;
	
	if (newVal.length >= 1)	
		ajax ("xmlRespondFeedback", "updateTable.php", data);
}

function addPlane(intent) 
{
	var data, intent, model, location;
	if (intent == '')
	{
		document.getElementById('adminContentPanel').innerHTML = addPlaneHtmlContent;
		intent = "populateAirportList";
		data = "intent=" + intent;
	}
	
	if (intent == 'apply')
	{
		if (document.getElementById('model').value === '' || document.getElementById('airportLocation').value === '')
		{
			document.getElementById('valErr').innerHTML = "Field value missing";
			return;
		}
		
		model = document.getElementById('model').value;
		airportLocation = document.getElementById('airportLocation').value;
		intent = "addPlaneToTable";
		data = "intent=" + intent + "&model=" + model + "&airportLocation=" + airportLocation; 
		restoreAdminContentPanel();
	}
	
	if (data.length >= 1)
		ajax ("airportLocation", "updateTable.php", data);
}

function addAirport(intent)
{
	var data, intent, airport, lon, lat;
	if (intent == '')
		document.getElementById('adminContentPanel').innerHTML = addAirportHtmlContent;
	
	if (intent == 'apply')
	{
		if (document.getElementById('lat').value <= -180 || document.getElementById('lon').value >= 180)
		{
			document.getElementById('valErr').innerHTML = "Latitude need to be between -90 and 90";
			return; 
		}
		
		if (document.getElementById('lon').value <= -90 || document.getElementById('lat').value >= 90)
		{
			document.getElementById('valErr').innerHTML = "Longitude need to be between -180 and 180";
			return; 
		}
		
		if (document.getElementById('lon').value === '' || document.getElementById('lat').value === '' || document.getElementById('airport').value === '')
		{
			document.getElementById('valErr').innerHTML = "Missing field values";
			return;
		}
		
		airport = document.getElementById('airport').value;
		lon = document.getElementById('lon').value;
		lat = document.getElementById('lat').value;
		intent = "addNewAirportLocation";
		data = "intent=" + intent + "&airport=" + airport + "&lon=" + lon + "&lat=" + lat;
		restoreAdminContentPanel();
	}
	
	if (data.length >= 1)
		ajax ("xmlRespondFeedback", "updateTable.php", data);
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
		}
	}

	xmlhttp.open ("post", php, "true"); // will need a designation php target file 
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send (data); //will need the data to be sent
}