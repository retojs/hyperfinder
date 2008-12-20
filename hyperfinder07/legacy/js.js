// requires ajax.js for functions weg(), ein(), reloadMain() and !

var urls = new Array();

// AdSense
urls['google'] = "http://www.google.ch/custom";
urls['google'] += "?hl=de";
urls['google'] += "&ie=ISO-8859-1";
urls['google'] += "&oe=ISO-8859-1";
urls['google'] += "&client=pub-3941083662020418";
urls['google'] += "&cof=FORID%3A1%3BGL%3A1%3BBGC%3AFFFFFF%3BT%3A%23000000%3BLC%3A%230000cc%3BVLC%3A%23660099%3BALC%3A%230000cc%3BGALT%3A%23009900%3BGFNT%3A%239999cc%3BGIMP%3A%239999cc%3BDIV%3A%230000cc%3BLBGC%3AFFFFFF%3BAH%3Acenter%3B";
urls['google'] += "&q=arg1";
urls['google'] += "&btnG=Suche";
urls['google'] += "&meta=arg3";
urls['google_2'] = "http://www.google.ch/arg2?hl=de&q=arg1&meta=arg3";
urls['googleDir'] = "http://www.google.ch/arg2?hl=de&cat=gwd%2FTop&q=arg1";
            
urls['leo'] = "http://dict.leo.org/?lang=de&searchLoc=0&cmpType=relaxed&relink=on&sectHdr=on&spellToler=std&search=arg1";
urls['leo_fr'] = "http://dict.leo.org/?lp=frde&lang=de&searchLoc=0&cmpType=relaxed&relink=on&sectHdr=on&spellToler=std&search=arg1";
urls['leo_es'] = "http://dix.osola.com/index.php";
urls['pons_it'] = "http://www.ponsline.de/cgi-bin/wb/w.pl";

urls['wiki'] = "http://de.wikipedia.org/wiki/Spezial:Search?search=arg1&go=Artikel"

urls['sbb'] = "http://fahrplan.sbb.ch/bin/query.exe/dn?";

urls['mapsearch'] = "http://map.search.ch/arg2/arg1";

urls['telsearch'] = "http://tel.search.ch/result.html?name=arg1&misc=arg3&strasse=arg4&ort=arg5&kanton=arg6&tel=arg2";

urls['michelin'] = "http://www.viamichelin.de/viamichelin/deu/dyn/controller/ItiWGPerformPage?E_wg=210506008kS6J506007214242232805ITIWG2i11133deu0026110h10041010041010010010072006007039.004-1.00110001001001001001001003deu011011&pim=true&strStartAddress=arg1&strStartCP=&strStartCity=arg2&strStartCityCountry=arg5&strDestAddress=arg3&strDestCP=&strDestCity=arg4&strDestCityCountry=arg6&strStep1Address=&strStep1CP=&strStep1City=&strStep1CityCountry=EUR&strStep3Address=&strStep3CP=&strStep3City=&strStep3CityCountry=EUR&strStep2Address=&strStep2CP=&strStep2City=&strStep2CityCountry=EUR&dtmDeparture=07%2F01%2F2006&intItineraryType=1&intOneCountryCheck=true&unit=km&vh=CAR&conso=6&carbCost=1.00&devise=1.0%7CEUR&devise2=Andere&image.x=37&image.y=12"

urls['amazon'] = "http://www.amazon.de/exec/obidos/search-handle-form";

urls['ricardo'] = "http://www.ricardo.ch/cgi-bin/auk?lng=de;cmd=srch";
	
urls['ebay'] = "http://search.ebay.ch/search/search.dll?cgiurl=http%3A%2F%2Fcgi.ebay.ch%2Fws%2F&fkr=1&from=R8&satitle=arg1&category0=arg2";

urls['imdb'] = "http://www.imdb.com/find?q=arg1;s=all";

urls['cineman'] = "http://cineman.ch/kinoprogramm/process.php?zip=arg1";
urls['cineman_all'] = "http://cineman.ch/search/global/index.php?search=arg4&searchall=yes";

urls['swissquote'] = "http://www.swissquote.ch/cgi-bin/redirector/go?cb&arg1&self&d";

urls['snow'] = "http://snow.search.ch/index.php?sc=rl&rn=arg1&rr=arg2&search_button=Suche+Starten";

urls['webcams'] = "http://www.swisswebcams.ch/deutsch/search.php";

urls['fx'] = "http://www.oanda.com/convert/classic?lang=de";

urls['meteo'] = "http://www.meteoschweiz.ch/web/de/wetter/Detailprognose/lokalprognose.html?language=de&plz=arg1";

//urls['tv'] = "http://www.fernsehen.ch/suche/index.php";
urls['tv'] = "http://www.teleboy.ch/programm/process.php";
//urls['tv_sender'] = "http://www.fernsehen.ch/sender/senderprogramm.php3?sender=arg1";
urls['tv_sender'] = "http://www.teleboy.ch/programm/station/detail.php?id=arg1";

urls['gelbe'] = "http://www.directories.ch/gelbeseiten/base.aspx?do=search&searchtype=adr_simple&language=de&page=1&name=arg1&geo=arg2";
urls['gelbeExt'] = "http://www.directories.ch/gelbeseiten/base.aspx?do=backToSearchForms&searchtype=adr_extended&language=de&page=1&name=arg1&geo=arg2";

var lastTarget;

var lastLeoField;
var lastSnowField;
var lastCinemanField;
var lastTvField;

function setLastLeoField(field) {
	lastLeoField = field;
}

function setLastSnowField(field) {
	lastSnowField = field;
}

function setLastCinemanField(field) {
	lastCinemanField = field;
}

function setLastTvField(field) {
	lastTvField = field;
}

function onPressKey(target) {
	// 1. keep the target
	if (null != target) {
		lastTarget = target;
	}
}

function focusField(id) {
	var field = document.getElementById(id);
	if (null == field) return;
	if (field.value != null) selectField(id);
	//field.focus();
	field.click();
}

function selectField(id) {
	// suppress initial google focus
	autoFocus = false;

	var field = document.getElementById(id);
	if (null == field) return;
	field.select(0, field.value.length);
}

// diese funktion führt die suchanfragen aus.
// die url für die anfrage muss im array urls[] definiert sein.
// vor dem öffnen eines neuen fensters mit dieser url werden die strings 
//  "argn" (n = 1..6) ersetzt durch die werte der inputfelder mit id 
//  "<target>_argn" (n = 1..6).
// also beim target "google" z.B. mit dem wert des feldes mit id "google_arg1".
// 
// für anfragen via ein web form muss das target unten im IF-statement aufgeführt sein.
// 
function gotoURL(usethisUrlKey) {
	
	var target = lastTarget;
	var formId = 'pageform';
	
	// get values from inputfields
	var value1Obj = document.getElementById(target + '_arg1');
	var value2Obj = document.getElementById(target + '_arg2');
	var value3Obj = document.getElementById(target + '_arg3');
	var value4Obj = document.getElementById(target + '_arg4');
	var value5Obj = document.getElementById(target + '_arg5');
	var value6Obj = document.getElementById(target + '_arg6');

	if (null != value1Obj) {
		var value1 = value1Obj.value;
	}
	if (null != value2Obj) {
		var value2 = value2Obj.value;
	}
	if (null != value3Obj) {
		var value3 = value3Obj.value;
	}
	if (null != value4Obj) {
		var value4 = value4Obj.value;
	}
	if (null != value5Obj) {
		var value5 = value5Obj.value;
	}
	if (null != value6Obj) {
		var value6 = value6Obj.value;
	}

	urlKey = target;
	if (usethisUrlKey != null) {
		urlKey = usethisUrlKey;
	}
	
		
	// special care for sbb radiobutton
	if ('sbb' == target) {
		var hidden5 = document.getElementById('hidden_' + target + '5');
		if (hidden5 != null) {
			hidden5.value = value5;
		}
		var an = document.getElementById('sbb_an');
		if (null != an && an.checked == true) {
			hidden5.value = '0';
		} else {
			hidden5.value = '1';
		}
	}

	// special care
	if ('google' == target) {
		if (value2 == 'custom') {
			if (value3Obj.checked == true) {
				// nur seiten auf deutsch
				value3 = 'lr%3Dlang_de';
			} else if (value4Obj.checked == true) {
				// nur seiten aus der schweiz
				value3 = 'cr%3DcountryCH';
			}
		} else if (value2 == 'searchDir') {
			// Verzeichnis
			urlKey = 'googleDir';
			value2 = 'search';
		} else {
			// Bilder usw.
			urlKey = 'google_2';
		}
	}
	if ('cineman' == target) {
		if (lastCinemanField == 'cineman_arg4') {
 			urlKey = 'cineman_all';
 		}
 	} 
	if ('mapsearch' == target && value2 == '') {
		value2 = '-';
	}
	if ('leo' == target) {
		if (lastLeoField == 'leo_arg2') {
			urlKey = 'leo_fr';
			value1 = value2;
		} else if (lastLeoField == 'leo_es') {
			urlKey = 'leo_es';
			target = 'leo_es';
		} else if (lastLeoField == 'pons_it') {
			urlKey = 'pons_it';
			target = 'pons_it';
			formId = 'ponsform';
			document.getElementById('pons_Begriff').value = document.getElementById('leo_arg4').value;
		}
	} 
	if ('snow' == target) {
		// falls region gewählt, ignoriere ort
		if (lastSnowField == 'snow_arg1') {
			value2 = "";
		} else if (lastSnowField == 'snow_arg2') {
			value1 = "";
		}
	}
	// delete defaults in gelbe seiten:
	if (target == 'gelbe') {
		if (value1 == 'Firma, Rubrik, Stichwort, Produkt') {
			value1 = '';
		}
		if (value2 == 'Ort / PLZ') {
			value2 = '';
		}
	}
	if ('tv' == target && lastTvField == 'tv_sender') {
			urlKey = 'tv_sender';
			value1 = value2;
	} 

	// replace arg1 to arg6
	var url = urls[urlKey];
	if (null != value1) {
		url = url.replace(/arg1/, value1);
	}
	if (null != value2) {
		url = url.replace(/arg2/, value2);
	}
	if (null != value3) {
		url = url.replace(/arg3/, value3);
	}
	if (null != value4) {
		url = url.replace(/arg4/, value4);
	}
	if (null != value5) {
		url = url.replace(/arg5/, value5);
	}
	if (null != value6) {
		url = url.replace(/arg6/, value6);
	}
	
	if (url == null) return false;
		
	// (A) goto URL
	if (target != 'leo_es' && 
			target != 'pons_it' && 
			target != 'sbb' && 
			target != 'amazon' && 
			target != 'ricardo' && 
			target != 'webcams' && 
			target != 'fx' &&
			target != 'tv' 
		) {
		
		if (openNewWin) {
			var win = window.open(url, target);	
			win.focus();
		} else {
			document.location.href=url;
		}
		return false;
	} 
	
	// (B) submit form
	else {
		var form = document.getElementById(formId); 
		form.action = url;
		if (openNewWin) {
			form.target = target;
		} else {
			form.target = '_self';
		}
		form.submit();
		return false;
	}
}

// select input felder sollten onkeydown diese methode aufrufen. 
function submitForm(e, usethisUrlKey) {
	if (!e) e = window.event;
	// open result window on ENTER
	if (13 == e.keyCode) {
		gotoURL(usethisUrlKey);
	}
}

function linkTo(ziel, target) {
	if (openNewWin) {
		var win = window.open(ziel, target);	
		win.focus();
	} else {
		document.location.href=ziel;
	}
}

// turns opening new windows on ENTER on and off and stores settings in a cookie
var openNewWin = true;
function toggleNewWin() {
	var newwin = document.getElementById('newwin');
	if (newwin.checked == true) {
		openNewWin = true;
	} else {
		openNewWin = false;
	}	
	createCookie("openNewWin", openNewWin, 366);
}

// sets checkbox "nur Seiten auf deutsch" in google
function enableGoogleDECH() {
	var sel = document.getElementById('google_arg2');
	var checkboxDE = document.getElementById('google_arg3');
	var checkboxCH = document.getElementById('google_arg4');
	if (sel != null && sel.selectedIndex > 0) {
		checkboxDE.disabled = 'disabled';
		checkboxCH.disabled = 'disabled';
	} else {
		checkboxDE.disabled = '';
		checkboxCH.disabled = '';
	}
}

function saveConfig(altkey) {
	var page = document.getElementById(altkey).value;
	if (null != page && "" != page) {
		createCookie(altkey, page, 366);
	}
}

function setGoogleDE() {
	unselectCheckbox('google_arg4');
	storeGoogleDECH();
}

function setGoogleCH() {
	unselectCheckbox('google_arg3');
	storeGoogleDECH();
}

function unselectCheckbox(id) {
	var checkbox = document.getElementById(id);
	checkbox.checked = false;
}

// stores the checkbox state in a cookie and unselects counterpart checkbox state
function storeGoogleDECH() {
	var checkboxDE = document.getElementById('google_arg3');
	var checkboxCH = document.getElementById('google_arg4');
	createCookie("googleDE", checkboxDE.checked, 366);
	createCookie("googleCH", checkboxCH.checked, 366);
}

// stores the checkbox state in a cookie
function readGoogleDECH() {
	var checkboxDE = document.getElementById('google_arg3');
	var checkboxCH = document.getElementById('google_arg4');
	if (null == checkboxDE || null == checkboxCH) return;
	checkboxDE.checked = ('true' == readCookie("googleDE"));
	checkboxCH.checked = ('true' == readCookie("googleCH"));
}


// Functions to create, read and erase a cookie from www.quirksmode.org
function createCookie(name,value,days) {
	if (days)	{
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
}

function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}

function eraseCookie(name) {
	createCookie(name, "", -1);
}


// JavaScript zum Einrichten der Startseite (anchor dient zum springen zu einer suchmaske, z.b. sbb)
function makeHomepage(anchor) {
	// Variablen
	var success = false; // google Conversion Tracking
	var homepage_url = 'http://hyperfinder.ch';
	var browser = navigator.appName;
	var version = navigator.appVersion.substring(0,1);
	if ((browser=='Netscape') && (version >= 4 && version < 5)) {
		window.onerror=java_error;
		netscape.security.PrivilegeManager.enablePrivilege('UniversalPreferencesWrite');
		navigator.preference('signed.applets.codebase_principal_support', true);
		navigator.preference('browser.startup.homepage', homepage_url);
		success = true; // google Conversion Tracking
		alert('Voilà! '+ homepage_url + ' ist nun Ihre Startseite.');
	} else if ((browser=='Microsoft Internet Explorer') && (version >= 4)) {
		// MSIE 4.x, 5.x Version
		document.body.style.behavior='url(#default#homepage)';
		document.body.setHomePage(homepage_url);
		success = true; // google Conversion Tracking
	} else {
		// Manuelle Einstellung noetig
		alert('Wenn sie hyperfinder.ch zu ihrer Startseite machen möchten, gehen sie ins Menu Extras -> Einstellungen -> Startseite.');
		success = true; // google Conversion Tracking
	}
	if (success) {
		if (anchor == 'sbb') {
			document.location.href = 'conversionTrackingSBB.htm';
		} else if (anchor == 'telsearch') {
			document.location.href = 'conversionTrackingTel.htm';
		} else {
			document.location.href = 'conversionTracking.htm';
		}
	}
}
 
// focus the anchor field onLoad. autoFocus is set to false if a field is manually selected before that.
var autoFocus = (null == readCookie('noIntro')); //true; 

function initPage(scrollPos, anchorTarget) {
	
	if (null != anchorTarget) {
		createCookie('show' + anchorTarget, 'on', 366);
		//document.location = '#' + anchorTarget; 
	} else {
		anchorTarget = 'google';
	}
	
	if (autoFocus) {
			focusField(anchorTarget + '_arg1');
 	}
	
	// Don't do things now that can wait. You have only one chance to make a first impression...
	setTimeout("initPageDelayed('" + scrollPos + ", " + anchorTarget + "')", 500);
}

function initPageDelayed(scrollPos, anchorTarget) {
	// set scrollPos via PHP from index.php
	// TEST if (null != scrollPos) scrollTo(0, scrollPos);
	
	auPreload();
	
	// init google checkbox "nur Seiten auf Deutsch"
	readGoogleDECH();
	
	// settings for open new window 
	openNewWin = ('true' == readCookie('openNewWin'));
	var newwin = document.getElementById('newwin');
	newwin.checked = openNewWin;
	
	// sbb datum
	var today = new Date();
	var sbb3 = document.getElementById('sbb_arg3');
	var sbb4 = document.getElementById('sbb_arg4');
	if (null != sbb3 && null != sbb4) {
		sbb3.value = today.getDate() + "." + (1 + today.getMonth()) + "." + today.getFullYear();
		var hours = today.getHours();
		var minutes = today.getMinutes();
		if (hours < 10) { hours = "0" + hours; }
		if (minutes < 10) { minutes = "0" + minutes; }
		sbb4.value = hours + ":" + minutes;
	}
 	
 	restartTickerHeadline();
 	
}

function setSelectValue(o, value) {
	var i = 0; 
	while (i < o.options.length) { 
		if (o.options[i].value == value) { 
			o.selectedIndex = i; 
			i = o.options.length; 
		} 
		i++; 
	} 
}

function noIntro(anchorTarget) {
	// check checkbox state 
	var noIntroBox = document.getElementById('noIntro');
	if (null != noIntroBox && noIntroBox.checked) {
		createCookie("noIntro", "no", 366);
	}
	gotoMainPage(null, anchorTarget);
}

function showIntro() {
	createCookie("noIntro", "false", 366);
	gotoIntro();
}

function initIntro() {
	if ("no" == readCookie("noIntro")) {
		gotoMainPage();
	}
}

// REQUIRES AJAX.JS	--- BEGIN 

function weg(target) {
	//createCookie('show' + target, 'off', 366);
	storeVisibility(target, "h");
	// AJAX does it asnchronous! gotoMainPage('scrollPos=' + getScrollPos());
	reloadMain();
}

function ein(target) {
	//createCookie('show' + target, 'on', 366);
	storeVisibility(target, "v");
	// AJAX does it asnchronous! gotoMainPage('scrollPos=' + getScrollPos());
	reloadMain();
}

// do one request at a time...
var busy_ajaxing = false;
// firefox keeps scrolling...
var scrollPosBeforeLoad;

// reload main DIV via AJAX
function reloadMain() {
	if (busy_ajaxing) {
		alert("Ein kleiner Moment bitte! Die Seite wird gerade neu konfiguriert...");
	} else {
		busy_ajaxing = true;
		scrollPosBeforeLoad = getScrollPos();
		sendRequest("maintable.php?directInclude=do", "", 2, "processResponseMain");
	}
}

// process data from server
function processDataMain(xmlHttp, intID) {
	var main = document.getElementById('main');
	main.innerHTML = xmlHttp.responseText;
	busy_ajaxing = false;
	
	if (scrollPosBeforeLoad != getScrollPos()) {
		scrollTo(0, scrollPosBeforeLoad);
	}
	
	// reset ticker
	gezeigt = 0;
	
	// restart headline ticker
	restartTickerHeadline();
	
	// load the RSS news if visible
	//if (reloadRSS) { reloadRSS(); }
}
			
// REQUIRES AJAX.JS	--- END 

function getScrollPos() {
	var scrollPos = 0;
    if (document.documentElement && document.documentElement.scrollTop) {
      scrollPos = document.documentElement.scrollTop;
    } else if (document.body) {
      scrollPos = document.body.scrollTop;
    } else {
      scrollPos = window.pageYOffset;
    }      
    return scrollPos;
}

function resetPage() {
	
	eraseCookie('slotVisibility');
	
	// reset openNewWin
	eraseCookie('openNewWin');
	
	// reset logo
	eraseCookie('logo');
	
	// reset shutup
	eraseCookie('shutup');
	
	// reset RSS cookies
	eraseCookie('visibleSelect');
	eraseCookie('searchMode');
	eraseCookie('stichwort');
	// leave pageselect and newsfeed...
	
	//
	eraseCookie('tip');
	
	gotoMainPage();
}

var nextLogo = new Array();
nextLogo['hyperfinder.gif'] = 'hyperfinder2.gif';
nextLogo['hyperfinder2.gif'] = 'hyperfinder3.gif';
nextLogo['hyperfinder3.gif'] = 'hyperfinder4.gif';
nextLogo['hyperfinder4.gif'] = 'hyperfinder5.gif';
nextLogo['hyperfinder5.gif'] = 'hyperfinder.gif';

function toggleLogo() {
	var currentLogo = readCookie('logo');
	var newLogo = nextLogo[currentLogo];
	if (null != newLogo) {
		createCookie('logo', newLogo, 360);
	} else {
		createCookie('logo', nextLogo['hyperfinder.gif'], 360);
	}
	gotoMainPage();
}

function gotoMainPage(params, anchorTarget) {
	var mainPage = 'index.php';
	var separator = "?";
	if (null != params) {
		mainPage = mainPage + separator + params;
		separator = "&";
	}
	// needs to be the last one, since it sets the anchor too 
	if (null != anchorTarget) {
		mainPage = mainPage + separator + 'anchor=' + anchorTarget ; // + '#' + anchorTarget ;
	}
	//alert("goto "+mainPage);
	document.location.href = mainPage;
}

function gotoIntro() {
	document.location.href = 'index.php';
}
