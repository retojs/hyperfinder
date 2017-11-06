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
	if ($(s1id).selectedIndex < 0) { $(s1id).selectedIndex = 0; } // Extrawurst für Safari
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
