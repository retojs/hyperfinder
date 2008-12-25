// url to load newsfeeds
var url_Listener = "_ajax_polling_js.php";

// url to load newsfeeds
var url_Controller = "_ajax_polling_controller_js.php";

// refreshPeriod
var refreshPeriod = 1000;

// last page visited by controller
var currentControllerLocation = "";

function setPollListenerTimeout() {
	setTimeout("poll_Listener()", refreshPeriod);
}

function setPollControllerTimeout() {
	currentControllerLocation = window.frames["content_frame"].location.href;
	alert("url = "+currentControllerLocation);
	setTimeout("poll_Controller()", refreshPeriod);
}

function poll_Listener() {
	sendRequest(url_Listener, "", 2, "poll_Listener_callback", false);
}

function poll_Listener_callback(intID) {
	if ("ok" != checkAjaxResponse(intID)) { return; }

	// alert("poll_Listener_callback "+xmlHttp.responseText);

	forward = eval(xmlHttp.responseText);
	
	if (forward.url != null && forward.url != "") {
		document.location.href = "listener.php?forward=" + forward.url;
		setPollTimeout();
	} else {
		setPollTimeout();
	}
}

function poll_Controller() {
	var contentFrameLocation = window.frames["content_frame"].location.href;
	alert("url still " + contentFrameLocation);
	if (currentControllerLocation != contentFrameLocation) {
		alert("url changed to: " + contentFrameLocation);
		sendRequest(url_Controller, "setForward=do&forward=contentFrameLocation", 2, "poll_Controller_callback", false);
	} else {
		setTimeout("poll_Controller()", refreshPeriod);
	}
}

function poll_Controller_callback(intID) {
	if ("ok" != checkAjaxResponse(intID)) { return; }

	alert("poll_Controller_callback "+xmlHttp.responseText);	
}
