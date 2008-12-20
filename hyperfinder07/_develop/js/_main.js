var googleFocus = true; 

function focusField(id) {
	var field = document.getElementById(id);
	if (null == field) return;
	if (field.value != null) selectField(id);
	field.click();
}

function selectField(id) {
	// suppress initial google focus
	googleFocus = false;

	var field = document.getElementById(id);
	if (null == field) return;
	field.select(0, field.value.length);
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

// JavaScript zum Einrichten der Startseite (anchor dient zum springen zu einer suchmaske, z.b. sbb)
function makeHomepage(anchor) {
	// Variablen
	var homepage_url = 'http://hyperfinder.ch';
	var browser = navigator.appName;
	var version = navigator.appVersion.substring(0,1);
	if ((browser=='Netscape') && (version >= 4 && version < 5)) {
		window.onerror=java_error;
		netscape.security.PrivilegeManager.enablePrivilege('UniversalPreferencesWrite');
		navigator.preference('signed.applets.codebase_principal_support', true);
		navigator.preference('browser.startup.homepage', homepage_url);
		alert('Voilà! '+ homepage_url + ' ist nun Ihre Startseite.');
	} else if ((browser=='Microsoft Internet Explorer') && (version >= 4)) {
		// MSIE 4.x, 5.x Version
		document.body.style.behavior='url(#default#homepage)';
		document.body.setHomePage(homepage_url);
	} else {
		// Manuelle Einstellung noetig
		alert('Wenn sie hyperfinder.ch zu ihrer Startseite machen möchten, gehen sie ins Menu Extras -> Einstellungen -> Startseite.');
	}
}

// focus google wird neu direkt im google slot gemacht (vor onload)
function initPage() {
	
	initUserData(arguments[0], arguments[1], arguments[2], arguments[3], arguments[4]);
	
	restoreNewsSettings(arguments[0]);
	
	// init google checkbox "nur Seiten auf Deutsch"
	readGoogleDECH();
	
	// settings for open new window 
	openNewWin = ('true' == userdata.openNewWin);
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

	// user defaults
	
	$('sbb_arg1').value = (userdata['sbb_arg1'] != null)? userdata['sbb_arg1'] : "";
	
	$('route_arg1').value = (userdata['route_arg1'] != null)? userdata['route_arg1'] : "";
	$('route_arg2').value = (userdata['route_arg2'] != null)? userdata['route_arg2'] : "";
	
	$('gelbe_arg2').value = (userdata['gelbe_arg2'] != null)? userdata['gelbe_arg2'] : "";
	
	$('meteo_arg1').value = (userdata['meteo_arg1'] != null)? userdata['meteo_arg1'] : "";
	
	$('cineman_arg1').value = (userdata['cineman_arg1'] != null)? userdata['cineman_arg1'] : "";
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
		createCookie('logo', newLogo, 366);
	} else {
		createCookie('logo', nextLogo['hyperfinder.gif'], 366);
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
	document.location.href = mainPage;
}
