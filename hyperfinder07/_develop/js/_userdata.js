// url to load the data for a userid
var userdataUrl = "_ajax_userdata_js.php";

// the name of the cookie containing the userid
var cookie_userId = "userid";

// the userid that is stored in a cookie
var userid;

// array to store the data for a userid
var userdata;

// If this flag is set to false, userdata is only stored locally.
var storeOnServer = true;

/** This function finds out the userid and loads the userdata. */
function initUserData() {
	userid = readCookie(cookie_userId);
	if (userid == null || userid == "") {
		//httpRequest("POST", userdataUrl, false, "initUserData_callback", "op=newuserid");
		sendRequest(userdataUrl, "op=newuserid", 2, "initUserData_callback", false);
	}
	createCookie(cookie_userId, userid, 90);

	loadUserData(userid);
	
	/////
	// execute op shareNews
	if (arguments[0] == "shareNews") {
		userdata["searchMode"] = arguments[1];
		userdata["sel1" + userdata["searchMode"]] = arguments[2];
		userdata["sel2" + userdata["searchMode"]] = arguments[3];
		userdata["timeStmp"] = arguments[4];
	}
	////
	// execute op cmdlineHelp (http://hyperfinder.ch/?op=cmdlineHelp)
	if (arguments[0] == "cmdlineHelp") {
		toggleHelpCmdLine();
	}
}

function initUserData_callback(intID) {
	if ("ok" != checkAjaxResponse(intID)) { return; }

	userid = eval(xmlHttp.responseText);
}

function loadUserData(userid) {
	sendRequest(userdataUrl, "userid=" + userid, 2, "loadUserData_callback", false);
}

function loadUserData_callback(intID) {
	
	if ("ok" != checkAjaxResponse(intID)) { return; }

	userdata = eval(xmlHttp.responseText);
	if (userdata == null) {
		userdata = new Array();
	}
}

function storeUserData(name, value) {
	if (name == null || value == null) { return; }
	userdata[name] = value;
	if (storeOnServer) {
		sendRequest(userdataUrl, "op=set&userid=" + userid + "&name=" + name + "&value=" + value, 2, "storeUserData_callback", false);
	}
}

function storeUserData_callback(intID) {
	// do nothing...
	// alert("userdata stored " + xmlHttp.responseText);
}

function storeSelectedAsUserData(selectId, dataName) {
	var el = $(selectId);
	if (el != null && el.selectedIndex >= 0) {
		storeUserData(dataName, el.options[el.selectedIndex].value);
	}
}

function eraseUserData() {
	userdata = null;
	sendRequest(userdataUrl, "op=del&userid=" + userid, 2, "eraseUserData_callback", false);
}

function eraseUserData_callback(intID) {
	// do nothing...
	// alert("userdata erased " + xmlHttp.responseText);
}

