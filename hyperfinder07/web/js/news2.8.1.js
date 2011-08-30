/** 
 * Contains the functions to load newsfeedpage- and newsfeed-lists.
 * 
 * requires: _vars.js, util/*.js
 */


// url to load newsfeeds
var feedsUrl = "news/_ajax_feeds_js.php";

// Array of NewsfeedPanel objects for each news mode
var feedPanels = new Array();

/** The NewfeedPanel class stores div ids and cookie names for each searchmode panel */
function NewsfeedPanel(newsMode) {

	this.feedPagesLoaded = false;

	this.cookie_select1 = "sel1" + newsMode;
	this.cookie_select2 = "sel2" + newsMode;

	this.id_select1 = "select_" + newsMode;
	this.id_select1Parent = this.id_select1 + "_parent";

	this.id_select2 = "feed_" + newsMode;
	this.id_select2Parent = this.id_select2 + "_parent";
}


/** Loads the available newsfeed pages from the server. */
function loadFeedPages() {
	if (!feedPanels[newsMode].feedPagesLoaded) {
		//httpRequest("POST", feedsUrl, false, "loadFeedPages_callback", "mode=" + newsMode);
		sendRequest(feedsUrl, "mode=" + newsMode, 2, "loadFeedPages_callback", false);
		feedPanels[newsMode].feedPagesLoaded = true;
	}
}

/** Displays the available newsfeed pages */
function loadFeedPages_callback(intID) {

	if ("ok" != checkAjaxResponse(intID)) { return; }

	var sel1Data = eval(xmlHttp.responseText);
	var sel1 = createSelect(feedPanels[newsMode].id_select1, extractArray(sel1Data, "label"), extractArray(sel1Data, "key"), false);
	sel1.onchange = function(){ loadFeeds() };
	sel1.className = "wideerinput";
	replaceChild(feedPanels[newsMode].id_select1Parent, sel1);
	
	// restore selected page from cookie
	selectOption(feedPanels[newsMode].id_select1, userdata[(feedPanels[newsMode].cookie_select1)]);
	
	loadFeeds();
}


/** Loads the newsfeeds of the selected page from the server. */
function loadFeeds() {
	var s1id = feedPanels[newsMode].id_select1;
	if ($(s1id).selectedIndex < 0) { $(s1id).selectedIndex = 0; } // Extrawurst f�r Safari
	var select = $(s1id).options[$(s1id).selectedIndex].value;
	if (select != null) {
		//httpRequest("POST", feedsUrl, false, "loadFeeds_callback", "mode=" + newsMode + "&select=" + select);
		sendRequest(feedsUrl, "mode=" + newsMode + "&select=" + select, 2, "loadFeeds_callback", false);
	}
}

// the feeds of the currently loaded newsfeed list
var feeds;

/** Displays the available newsfeed pages. */
function loadFeeds_callback(intID) {

	if ("ok" != checkAjaxResponse(intID)) { return; }

	feeds = eval(xmlHttp.responseText);
	var feedSel = createSelect(feedPanels[newsMode].id_select2, extractArray(feeds, "label"), extractArray(feeds, "key"));
	feedSel.onchange = function(){ setCurrentFeed() };
	feedSel.className = "wideerinput";
	replaceChild(feedPanels[newsMode].id_select2Parent, feedSel);
	
	// if select2 contains only one single feed, select this feed.
	if ($(feedPanels[newsMode].id_select2).options.length == 2 ) {
		$(feedPanels[newsMode].id_select2).selectedIndex = 1;
		setCurrentFeed();
	}
}

/** 
 * in case the page is reloaded: 
 *  - restore selected feedurl from userdata or 
 *  - if no userdata set: choose the first feed in the list
 */	
function restoreSelectedFeed() {	
	var feed = userdata[feedPanels[newsMode].cookie_select2];
	if (feed == null) {
		$(feedPanels[newsMode].id_select2).selectedIndex = 1;
	} else {
		selectOption(feedPanels[newsMode].id_select2, feed);
	}
}

/** Displays the label of the current feed in the headline and sets the feed tempo. */
function setCurrentFeed() {
	currentFeed = feeds[$(feedPanels[newsMode].id_select2).selectedIndex - 1];	
	if (currentFeed == null) { return; }
	feedTempo = currentFeed.tempo;
	$(id_div_currfeedlabel).innerHTML = "[" + currentFeed.label + "]";
	loadNews();
}
/** 
 * Contains the functions to display, save and restore news settings.
 * 
 * requires: _vars.js, util/_cookies.js
 */

// tells if help text is visible or not
var visibleHelp = false;

// hide/show help
function toggleHelp() {
	visibleHelp = !visibleHelp;
	hideShowIf(id_div_help, visibleHelp);
}

var visibleNewsSelect = false;

// hide/show selectfeed
function toggleNewsSelect() {
	visibleNewsSelect = !visibleNewsSelect;
	hideShowIf(id_div_selectfeed, visibleNewsSelect);
	storeUserData(cookie_newsSelect, visibleNewsSelect);
	if (visibleNewsSelect) { storeUserData(cookie_newsDisabled, "n"); }
}

// disable news slot 
function disableNews() {	
	stopTicker();
	// need to do this at the beginning, because firefox will call reloadNews_callback after it: (?)
	storeUserData(cookie_newsDisabled, "y"); 
	if (visibleHelp) { toggleHelp(); }
	if (visibleNewsSelect) { toggleNewsSelect(); }
	if (feedPanels[newsMode] != null && $(feedPanels[newsMode].id_select2) != null) { 
		$(feedPanels[newsMode].id_select2).selectedIndex = 0; 
	}
	$(id_div_currfeedlabel).innerHTML = "";
	$(id_div_newsDisplay).innerHTML = "";
}

var newsMode;

// switch between search mode
function toggleNewsMode(mode) {
	
	// find out selected radio or select radio if link was clicked
	if (mode == null) {
		mode = getRadioValue(name_radio_newssearchmode);
	} else {
		$(name_radio_newssearchmode + mode).checked = true;
	}
	
	newsMode = mode;
	storeUserData(cookie_newsMode, mode);
	
	if (feedPanels[mode] == null) {
		feedPanels[mode] = new NewsfeedPanel(mode);
	}
	hideAll(searchModeDivs);
	
	if (mode == "byKeyword") { 
		show(id_div_news["byKeyword"]);
		setCurrentKeyword();
	
	} else {
		show(id_div_news[mode]);
		loadFeedPages();
		restoreSelectedFeed();
		setCurrentFeed(true);
	}	
}

function setCurrentKeyword() {
	if (userdata[cookie_keyword] != null) {
		$(id_news_keyword).value = userdata[cookie_keyword].stripSlashes();
		loadNews();
	}
}

// speichert das keyWord in ein cookie (nur falls searchmode nach keyword).
function saveKeyWord() {
	if ("byKeyword" === getRadioValue(name_radio_newssearchmode)) {
		storeUserData(cookie_keyword, $(id_news_keyword).value);
	}
}

// stores newsfeed select1 and 2 and keyword in cookies
function saveNewsSettings() {
	if (feedPanels[newsMode] != null) {
		storeSelectedAsUserData(feedPanels[newsMode].id_select1, feedPanels[newsMode].cookie_select1);
		storeSelectedAsUserData(feedPanels[newsMode].id_select2, feedPanels[newsMode].cookie_select2);
	}
	saveKeyWord();
}

// Called onload of page. Benefit: no need to evaluate cookies in PHP.
function restoreNewsSettings() {
	var newsDisabled = (userdata[cookie_newsDisabled] === "y") && (arguments[0] != op_shareNews);
	if (!newsDisabled) {
		visibleNewsSelect = (userdata[cookie_newsSelect] == null)
		hideShowIf(id_div_selectfeed, visibleNewsSelect);
		storeUserData(cookie_newsSelect, "off"); 
		
		storeOnServer = false;
		toggleNewsMode(userdata[cookie_newsMode], true);
		storeOnServer = true;
	}
}

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
		alert("Leider konnte das Email nicht verschickt werden. Bitte �berpr�fen Sie die Email-Adresse und versuchen Sie es sp�ter nochmal...");
	}
}/**
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
// Sie wird auf true gesetzt, solange sich der mauspointer �ber dem news bereich befindet.

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

// wird aufgerufen, sobald sich der mauszeiger �ber den news-bereich bewegt
function stopTicker() {
	clearTimeout(tickerTimeout);
	clearTimeout(reloadNewsTimeout);
	tickerStopped = true;
	displayStopped("visible");
}

// Die Variable suspended blockiert den start des tickers.
// Sie wird auf true gesetzt, wenn ein Artikel angeklickt wird 
// und wird erst auf false zur�ckgesetzt, wenn ein button der navigation geklickt wird.

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
///
// element ids

var id_div_help = "help";
var id_div_currfeedlabel = "currfeedlabel";
var id_div_selectfeed = "selectfeed";
var id_div_newsDisplay = "newsDisplay";

var id_div_news = new Array();
id_div_news["byTopic"] = "newsByTopic";
id_div_news["byUrl"] = "newsByUrl";
id_div_news["byKeyword"] = "newsByKeyword";
id_div_news["podcasts"] = "podcasts";
id_div_news["swissnews"] = "swissnews";

var searchModeDivs = new Array();
searchModeDivs[0] = id_div_news["byTopic"];
searchModeDivs[1] = id_div_news["byUrl"];
searchModeDivs[2] = id_div_news["byKeyword"];
searchModeDivs[3] = id_div_news["podcasts"];
searchModeDivs[4] = id_div_news["swissnews"];

var name_radio_newssearchmode = "newssearchmode";

var id_news_keyword = "newsKeyword";

///
// cookie names
var cookie_newsSelect = 'newsSelect';
var cookie_newsMode = 'searchMode';

var cookie_keyword = 'stichwort';
var cookie_feedpage = 'pageselect';
var cookie_feedurl = 'feedurl';

var cookie_newsDisabled = 'noNews';

// operation shareNews (experimental)
// URL sample: http://localhost/hyperfinder07/?op=shareNews&arg1=podcasts&arg2=0&arg3=37
var op_shareNews = "shareNews";
