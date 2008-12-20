/**
 * share news by Email
 */

// url to post shareNews form data
var shareNewsUrl = "news/_ajax_share_js.php";

var hyperfinderURL = "http://hyperfinder.ch/";

var shareNewsVisible = false;

function setShareNewsLink() {
	var link = hyperfinderURL + "?op=shareNews&arg1="+userdata["searchMode"]+"&arg2="+userdata["sel1" + userdata["searchMode"]]+"&arg3="+userdata["sel2" + userdata["searchMode"]]+"&arg4=" + $(item_shown).className;
	if ($("shareNewsLink") != null) {
		$("shareNewsLink").value = link;
	}
	if ($("openMailToolLink") != null) {
		$("openMailToolLink").href = "mailto:?subject=Interessanter Artikel&body="+  escape ("\n") + "Hyperfinder News-Link: "+ escape ("\n") + escape(link);	
	}
	
}

function toggleShareNewsForm() {
	shareNewsVisible = !shareNewsVisible;
	hideShowIf("shareNewsForm", shareNewsVisible);
	setShareNewsLink();
	if (shareNewsVisible) {
		stopTicker();
		suspendTicker();
	} else {
		continueTicker();
		// startTicker();
	}
}

/** Sends email data with news link to the server */
function shareNews() {
	var postData = "link=" + escape($("shareNewsLink").value);
	postData += "&to=" + escape($("shareNewsTo").value);
	postData += "&from=" + escape($("shareNewsFrom").value);
	postData += "&msg=" + escape($("shareNewsMsg").value);
	sendRequest(shareNewsUrl, postData , 2, "shareNews_callback", false);
}

/** Display success or failure */
function shareNews_callback(intID) {

	if ("ok" != checkAjaxResponse(intID)) { return; }

	reply = xmlHttp.responseText;
	//alert("reply "+reply);
	
	if (reply == "ok") {
		alert("Ihr Email wurde verschickt.");
		toggleShareNewsForm();
	
	} else if (reply == "noTo") {
		alert("Bitte geben Sie an, an welche Email Adresse der Artikel geschickt werden soll.");
	
	} else if (reply == "noFrom") {
		alert("Bitte geben Sie an, wer Sie sind. (Ihr Name oder ihre EMail-Adresse)");
	
	} else {
		alert("Leider konnte das Email nicht verschickt werden. Bitte überprüfen Sie die Email-Adresse und versuchen Sie es später nochmal...");
	}
}