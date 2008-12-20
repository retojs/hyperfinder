// url to load newsfeeds
var ctrlUrl = "_ajax_polling_js.php";

// refreshPeriod
var refreshPeriod = 1000;

function setPollTimeout() {
	setTimeout("doPoll()", refreshPeriod);
}

function doPoll() {
	sendRequest(ctrlUrl, "", 2, "doPoll_callback", false);
}

function doPoll_callback(intID) {
	if ("ok" != checkAjaxResponse(intID)) { return; }

	//alert("doPoll_callback "+xmlHttp.responseText);

	forward = eval(xmlHttp.responseText);
	
	if (forward.url != null && forward.url != "") {
		document.location.href = "listener.php?forward=" + forward.url;
		setPollTimeout();
	} else {
		setPollTimeout();
	}
}