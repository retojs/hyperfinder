var urls = new Array();

// Keys need to correspond to the target values

urls['commandline'] = "http://cmd.hyperfinder.ch/do.php?find=arg1";

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
urls['googleMaps'] = "http://maps.google.ch/maps?q=arg1";
            
urls['leo'] = "http://dict.leo.org/?lang=de&searchLoc=0&cmpType=relaxed&relink=on&sectHdr=on&spellToler=std&search=arg1";
urls['leo_fr'] = "http://dict.leo.org/frde?lp=frde&lang=de&searchLoc=0&cmpType=relaxed&sectHdr=on&spellToler=std&search=arg1";
urls['leo_es'] = "http://dict.leo.org/esde?lp=esde&lang=de&searchLoc=0&cmpType=relaxed&sectHdr=on&spellToler=std&search=arg1";
urls['leo_it'] = "http://dict.leo.org/itde?lp=itde&lang=de&searchLoc=0&cmpType=relaxed&sectHdr=on&spellToler=std&search=arg1";

urls['wiki'] = "http://de.wikipedia.org/wiki/Spezial:Search?search=arg1&go=Artikel"

urls['sbb'] = "http://fahrplan.sbb.ch/bin/query.exe/dn?";

urls['mapsearch'] = "http://map.search.ch/arg2/arg1";

urls['telsearch'] = "http://tel.search.ch/result.html?name=arg1&misc=arg3&strasse=arg4&ort=arg5&kanton=arg6&tel=arg2";

urls['route'] = "http://www.viamichelin.de/viamichelin/deu/dyn/controller/ItiWGPerformPage?E_wg=210506008kS6J506007214242232805ITIWG2i11133deu0026110h10041010041010010010072006007039.004-1.00110001001001001001001003deu011011&pim=true&strStartAddress=arg1&strStartCP=&strStartCity=arg2&strStartCityCountry=arg5&strDestAddress=arg3&strDestCP=&strDestCity=arg4&strDestCityCountry=arg6&strStep1Address=&strStep1CP=&strStep1City=&strStep1CityCountry=EUR&strStep3Address=&strStep3CP=&strStep3City=&strStep3CityCountry=EUR&strStep2Address=&strStep2CP=&strStep2City=&strStep2CityCountry=EUR&dtmDeparture=07%2F01%2F2006&intItineraryType=1&intOneCountryCheck=true&unit=km&vh=CAR&conso=6&carbCost=1.00&devise=1.0%7CEUR&devise2=Andere&image.x=37&image.y=12"

urls['amazon'] = "http://www.amazon.de/exec/obidos/search-handle-form";

urls['ricardo'] = "http://www.ricardo.ch/search/search.asp?txtSearch=arg1&Catg=arg2";
	
urls['ebay'] = "http://search.ebay.ch/search/search.dll?cgiurl=http%3A%2F%2Fcgi.ebay.ch%2Fws%2F&fkr=1&from=R8&satitle=arg1&category0=arg2";

urls['imdb'] = "http://www.imdb.com/find?q=arg1;s=all";

urls['cineman'] = "http://cineman.ch/kinoprogramm/process.php?zip=arg1";
urls['cineman_all'] = "http://cineman.ch/search/global/index.php?search=arg4&searchall=yes";

urls['swissquote'] = "http://www.swissquote.ch/cgi-bin/redirector/go?cb&arg1&self&d";

urls['snow'] = "http://snow.search.ch/index.php?sc=rl&rn=arg1&rr=arg2&search_button=Suche+Starten";

urls['webcams'] = "http://www.swisswebcams.ch/deutsch/search.php";

urls['fx'] = "http://www.oanda.com/convert/classic?lang=de";

urls['meteo'] = "http://www.meteoschweiz.ch/web/de/wetter/Detailprognose/lokalprognose.html?language=de&plz=arg1";

urls['tv'] = "http://www.teleboy.ch/programm/jetzt_im_tv.php?showtime=arg1&stations=top&order_by=label";
urls['tv_fuzzy'] = "http://www.teleboy.ch/programm/process.php?fuzzy=arg2";
urls['tv_sender'] = "http://www.teleboy.ch/programm/station/?id=arg3";

urls['gelbe'] = "http://www.directories.ch/gelbeseiten/base.aspx?do=search&searchtype=adr_simple&language=de&page=1&name=arg1&geo=arg2";
urls['gelbeExt'] = "http://www.directories.ch/gelbeseiten/base.aspx?do=backToSearchForms&searchtype=adr_extended&language=de&page=1&name=arg1&geo=arg2";

urls['ytube'] = "http://youtube.com/results?search_query=arg1&search=";
urls['ytube_cat'] = "http://youtube.com/browse?s=arg2&t=arg3&c=arg4&l="

urls['preisvgl_1'] = "http://www.preissuchmaschine.ch/main.asp?suche=arg1&image1.x=0&image1.y=0";
urls['preisvgl_2'] = "http://www.toppreise.ch/index.php?search=arg1&sRes=OK";
urls['preisvgl_3'] = "http://www.preisvergleich.ch/suchergebnis.php?query=arg1&stype=1";
urls['preisvgl_4'] = "http://www.guenstiger.ch/main.asp?suche=arg1&submit.x=0&submit.y=0";
urls['preisvgl_5'] = "http://www.suche.ch/preisvergleich/search.cfm?q=arg1&x=0&y=0";

// stores the slot where the last key was pressed
var lastTarget;

function onPressKey(target) {
	if (null != target) {
		lastTarget = target;
	}
}

var lastField;

function setLastField(field) {
	lastField = field;
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
	var value1Obj = $(target + '_arg1');
	var value2Obj = $(target + '_arg2');
	var value3Obj = $(target + '_arg3');
	var value4Obj = $(target + '_arg4');
	var value5Obj = $(target + '_arg5');
	var value6Obj = $(target + '_arg6');

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
		
	// special care for several targets
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
		} else if (value2 == 'maps') {
			// Maps
			urlKey = 'googleMaps';
		} else {
			// Bilder usw.
			urlKey = 'google_2';
		}
	} else if ('leo' == target) {
		if (lastField == 'leo_fr') {
			urlKey = 'leo_fr';
			value1 = value2;
		} else if (lastField == 'leo_es') {
			urlKey = 'leo_es';
			value1 = value3;
		} else if (lastField == 'leo_it') {
			urlKey = 'leo_it';
			value1 = value4;
		}
	} else if ('sbb' == target) {
		var hidden5 = $('hidden_' + target + '5');
		var an = $('sbb_an');
		if (null != an && an.checked == true) {
			hidden5.value = '0';
		} else {
			hidden5.value = '1';
		}
		
		storeUserData('sbb_arg1', $('sbb_arg1').value);
		
	} else if ('route' == target) {
		storeUserData('route_arg1', $('route_arg1').value);
		storeUserData('route_arg2', $('route_arg2').value);
	
	} else if ('mapsearch' == target) {
		if (value2 == '') {
			value2 = '-';
		}
		value1 = mapsearch_replace(value1);
		value2 = mapsearch_replace(value2);
	
	} else if ('gelbe' == target) {
		storeUserData('gelbe_arg2', $('gelbe_arg2').value);
	
	} else if ('meteo' == target) {
		if (lastField != 'meteo_plz') {
			linkTo($('prognosen').options[$('prognosen').selectedIndex].value);
			return;
		}
		
		storeUserData('meteo_arg1', $('meteo_arg1').value);
		
	} else if ('snow' == target) {
		// falls region gewählt, ignoriere ort
		if (lastField == 'snow_arg1') {
			value2 = "";
		} else if (lastField == 'snow_arg2') {
			value1 = "";
		}
	} else if ('tv' == target) {
		if (lastField == 'tv_sender') {
			urlKey = 'tv_sender';
		} else if (lastField == 'tv_fuzzy') {
			urlKey = 'tv_fuzzy';
		} 
	} else if ('cineman' == target) {
		if (lastField == 'cineman_arg4') {
 			urlKey = 'cineman_all';
 		}
 		
 		storeUserData('cineman_arg1', $('cineman_arg1').value);
 		
 	} else if ('ytube' == target) {
		if (lastField == 'ytube_cat') {
			urlKey = 'ytube_cat';
		} 
	} else if ('preisvgl' == target) {
		urlKey = "preisvgl_" + $('preisvgl_site').options[$('preisvgl_site').selectedIndex].value;
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
	if (target != 'sbb' && 
		target != 'amazon' && 
		target != 'webcams' && 
		target != 'fx'
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
		var form = $(formId); 
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

function mapsearch_replace(value) {
	value = value.replace("ü", "ue");
	value = value.replace("ä", "ae");
	value = value.replace("ö", "oe");
	value = value.replace(" ", "-");
	return value;
}

// Select-Eingabefelder sollten onkeydown diese methode aufrufen, damit RETURNs die Anfrage ausführt. 
function submitForm(e, usethisUrlKey) {
	if (!e) e = window.event;
	// open result window on ENTER
	if (13 == e.keyCode) {
		gotoURL(usethisUrlKey);
	}
}

// Öffnet einen Link bei bedarf in einem neuen Fenster
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
	var newwin = $('newwin');
	if (newwin.checked == true) {
		openNewWin = true;
	} else {
		openNewWin = false;
	}	
	// createCookie("openNewWin", openNewWin, 366);
	storeUserData("openNewWin", openNewWin);
}
