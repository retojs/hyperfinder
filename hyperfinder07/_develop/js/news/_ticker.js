/**
 *
 * requires: _vars.js, util/_ajax.js
 */

// load the latest news.
function loadNews() {
	saveNewsSettings();
	tickerStopped = false;
	continueTicker();
	$(id_div_newsDisplay).innerHTML = "<div align=\"center\"><br><img src=\"img/ico_searching.gif\"><br><br></div>";
	reloadNews();
}

// loads the newsfeed
function reloadNews() {
	if (tickerStopped || feedPanels[newsMode] == null) return;
	
	// clear reload timeout
	clearTimeout(reloadNewsTimeout);
	
	searchMode = userdata[cookie_newsMode];
	if (searchMode == 'byKeyword') {
		reloadGoogleNews();
		
	} else {
		select1 = userdata[feedPanels[newsMode].cookie_select1];
		select2 = userdata[feedPanels[newsMode].cookie_select2];
		if (select1 == null) {
			select1 = selVal(feedPanels[newsMode].id_select1);
			storeUserData(feedPanels[newsMode].cookie_select1, select1);
		}
		if (select2 == null) {
			select2 = selVal(feedPanels[newsMode].id_select2);
			storeUserData(feedPanels[newsMode].cookie_select2, select2);
		}

		reloadUrl = "news/_ajax_ticker_js_feeds.php";
		postData = "mode=" + searchMode + "&select1=" + select1 + "&select2=" + select2; //"&feedurl=" + feedurl;
		//httpRequest("POST", reloadUrl, true, "reloadNews_callback", postData);
		sendRequest(reloadUrl, postData, 2, "reloadNews_callback", true);
	}
}

function loadNewsOnEnter(e) {
	var keyCode = getKeyCode(e);
	if (13 == keyCode) { loadNews(); }
}

function reloadGoogleNews() {
	if (tickerStopped) return;
	
	stichwort = userdata[cookie_keyword];
	if (null != stichwort && '' != stichwort) {
		$(id_div_currfeedlabel).innerHTML = "[ Stichwort: " + stichwort + " ]";
	} 
	
	reloadUrl = "news/_ajax_ticker_js_google.php";
	postData = "stichwort=" + stichwort;
	tickerTempo = 10000;
	//httpRequest("POST", reloadUrl, true, "reloadNews_callback", postData);
	sendRequest(reloadUrl, postData, 2, "reloadNews_callback", true);
}

var feedTempo;

// process data from server
function reloadNews_callback(intID) {

	if ("ok" != checkAjaxResponse(intID)) { return; }

	// 1. display the news
	var newsDisplay = $(id_div_newsDisplay);
	if (newsDisplay) {
		newsDisplay.innerHTML = xmlHttp.responseText;
	}

	if (xmlHttp.responseText.indexOf("Error reading RSS data") > 0) { return; }
	
	// restart ticker
	item_shown = 0;
	continueTicker();
	clearTimeout(tickerTimeout);
	startTicker(feedTempo, feedTempo);

	// schedule new ajax reload
	startNewsReload();
	
	/////
	// Calc max height to set a max height...
	// TODO: Experimental!
	var maxHeight = 0;
	item_shown_backup = item_shown;
	item_shown = 0;
	nextMsg = $(item_shown++);
	while (null != nextMsg) {
		show_item(nextMsg);
		if (nextMsg.offsetHeight > maxHeight) {
			maxHeight = nextMsg.offsetHeight;
		}
		nextMsg = $(item_shown++);
		// alert("maxHeight: "+maxHeight);
	}
	item_shown = item_shown_backup;
	
	/////
	// select newsfeed item by title stored in userdata["timeStmp"]
	var i = 0;
	while (userdata["timeStmp"] != null && $(i) != null) {
		if (userdata["timeStmp"] === $(i).className) {
	 		show_item(i);
	 		stopTicker();
	 		suspendTicker();
	 		break;
	 	}
	 	i++;
	}
	
	setShareNewsLink();
}

var newsReloadInterval = 1000 * 60 * 3; // 3 Minuten
var reloadNewsTimeout;

function startNewsReload() {
	clearTimeout(reloadNewsTimeout);
	reloadNewsTimeout = setTimeout("reloadNews('2')", newsReloadInterval);
}

///
// News-ticker funktionen (lassen alle Schlagzeilen durchlaufen)

var tickerTimeout; // timeout variable
var tickerTempo = 4000; // wie lange einzelne items angezeigt werden
var tickerStartDelay = 8000; // wie lange der erste item angezeigt wird.

// switch message DIVs
var item_shown = 0;
function show_item(id) {
	if ($(id) == null) {return;}
	suuitch(item_shown, id);
	item_shown = id;
	
	setShareNewsLink();
}

function ticker() {
	item_shown = parseInt(item_shown);
	var nextMsg = $(item_shown + 1);
	if (null == nextMsg) {
		show_item(0);
	} else {
		show_item(item_shown + 1);
	}
	clearTimeout(tickerTimeout);
	tickerTimeout = setTimeout("ticker()", tickerTempo);
}

// die Variable stopped zeigt an, dass der ticker gestoppt ist und verhindert den reload der newsfeeds.
// Sie wird auf true gesetzt, solange sich der mauspointer über dem news bereich befindet.

var tickerStopped = false;

function startTicker(setTickerTempo, setStartTempo) {
	if (suspended) return;

	if (null != setTickerTempo && setTickerTempo > 0) {
		tickerTempo = setTickerTempo;
	}
	if (null != setStartTempo && setStartTempo > 0) {
		tickerTimeout = setTimeout("ticker()", setStartTempo);
	} else {
		tickerTimeout = setTimeout("ticker()", tickerStartDelay);
	}

	tickerStopped = false;
	displayStopped("hidden");
	
	startNewsReload();
}

// wird aufgerufen, sobald sich der mauszeiger über den news-bereich bewegt
function stopTicker() {
	clearTimeout(tickerTimeout);
	clearTimeout(reloadNewsTimeout);
	tickerStopped = true;
	displayStopped("visible");
}

// Die Variable suspended blockiert den start des tickers.
// Sie wird auf true gesetzt, wenn ein Artikel angeklickt wird 
// und wird erst auf false zurückgesetzt, wenn ein button der navigation geklickt wird.

var suspended = false;

function suspendTicker() {
	clearTimeout(tickerTimeout);
	suspended = true;
	displayStopped("visible");
}

function continueTicker() {
	// falls das Formular zum Email verschicken offen ist, sollte der Ticker angehalten bleiben
	if (!shareNewsVisible) {
		suspended = false;
	}
	// (!) ticker sollte angehalten bleiben, da man mit der maus im ticker bereich ist... 
	// displayStopped("hidden");	
}

// zeigt oder versteckt den text "(angehalten)". 
function displayStopped(state) {
	var i = 0;
	while(null != (stopped = $('rssticker_stopped' + (i++)))) {
		stopped.style.visibility = state;	
	}
}

startTicker();
