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

