// global xmlhttprequest object
var xmlHttp = false;

// association of URL to callback function
var callBacks = new Array();

/** AJAX functions **/

// constants
var REQUEST_XML   	= 1;
var REQEST_POST		= 2;
var REQUEST_HEAD	= 3;
var REQUEST_GET		= 0;


var charset = "utf-8"; // "iso-8859-1"; // 

/**
 * instantiates a new xmlhttprequest object
 *
 * @return xmlhttprequest object or false
 */
function getXMLRequester( )
{
    var xmlHttp = false;
            
    // try to create a new instance of the xmlhttprequest object        
    try
    {
        // Internet Explorer
        if( window.ActiveXObject )
        {
            for( var i = 5; i; i-- )
            {
                try
                {
                    // loading of a newer version of msxml dll (msxml3 - msxml5) failed
                    // use fallback solution
                    // old style msxml version independent, deprecated
                    if( i == 2 )
                    {
                        xmlHttp = new ActiveXObject( "Microsoft.XMLHTTP" );    
                    }
                    // try to use the latest msxml dll
                    else
                    {  
                        xmlHttp = new ActiveXObject( "Msxml2.XMLHTTP." + i + ".0" );
                    }
                    break;
                }
                catch( excNotLoadable )
                {                        
                    xmlHttp = false;
                }
            }
        }
        // Mozilla, Opera und Safari
        else if( window.XMLHttpRequest )
        {
            xmlHttp = new XMLHttpRequest();
        }
    }
    // loading of xmlhttp object failed
    catch( excNotLoadable )
    {
        xmlHttp = false;
    }
    return xmlHttp ;
}

/**
 * sends a http request to server
 *
 * @param strSource, String, datasource on server, e.g. data.php
 *
 * @param strData, String, data to send to server, optionally
 *
 * @param intType, Integer,request type, possible values: REQUEST_GET, REQUEST_POST, REQUEST_XML, REQUEST_HEAD default REQUEST_GET
 *
 * @param callbackFunction, (R.L.) name of the function called onreadystatechange, optionally, default is processResponseRSS
 *
 * @param intID, Integer, ID of this request, will be given to registered event handler onreadystatechange, optionally
 *
 * @return String, request data or data source
 */
function sendRequest( strSource, strData, intType, callbackFunction, isAsynch, intID) {
	
    if(!strData) {
        strData = '';
    }

    // default type (0 = GET, 1 = xml, 2 = POST )
    if(isNaN(intType)) {
        intType = 0; // GET
	}
    // previous request not finished yet, abort it before sending a new request
    if(xmlHttp && xmlHttp.readyState) {
        xmlHttp.abort( );
        xmlHttp = false;
    }
        
    // create a new instance of xmlhttprequest object
    // if it fails, return
    if(!xmlHttp) {
        xmlHttp = getXMLRequester( );
        if( !xmlHttp )
        	return;
    }
    
    // parse query string
    if( intType != 1 && ( strData && strData.substr( 0, 1 ) == '&' || strData.substr( 0, 1 ) == '?' ) )
        strData = strData.substring( 1, strData.length );

    // data to send using POST
    var dataReturn = strData ? strData : strSource;

    switch( intType )
    {
        case 1: // xml
            strData = "xml=" + strData;
        case 2: // POST
       		// open the connection 
            xmlHttp.open( "POST", strSource, isAsynch );
            xmlHttp.setRequestHeader( 'Content-Type', 'application/x-www-form-urlencoded; charset=' + charset);
            xmlHttp.setRequestHeader( 'Content-length', strData.length );
            break;
        case 3: // HEAD
            // open the connection 
            xmlHttp.open( "HEAD", strSource, isAsynch );
            strData = null;
            break;
        default: // GET
        	// open the connection 
            var strDataFile = strSource + (strData ? '?' + strData : '&' );
            xmlHttp.open( "GET", strDataFile, isAsynch );
            strData = null;
    }
    
    // set onload data event-handler
    if (null == callbackFunction) {
    	// R.L. set default
    	callbackFunction = "checkAjaxResponse";
    }
    
    // FF workaround (1) dont set onreadystatechange with synchronous calls
    if (isAsynch) {
	    xmlHttp.onreadystatechange = new Function( "", callbackFunction + "(" + intID + ")" ); ;
	} 
	
    // send request to server
    xmlHttp.send( strData ); // param = POST data
    
    // FF workaround (2) exec callback via eval with synchronous calls
    if (!isAsynch) {
		eval(callbackFunction + "(" + intID + ");");
	}
    
    return dataReturn;
}
    

/**
 * process the response data from server
 *
 * @param intID, Integer, ID of this response
 */
function checkAjaxResponse(intID) {
	// status 0 UNINITIALIZED open() has not been called yet.
	// status 1 LOADING send() has not been called yet.
	// status 2 LOADED send() has been called, headers and status are available.
	// status 3 INTERACTIVE Downloading, responseText holds the partial data.
	// status 4 COMPLETED Finished with all operations.
    switch( xmlHttp.readyState ) {
        // uninitialized
        case 0:
        // loading
        case 1:
        // loaded
        case 2:
        // interactive
        case 3:
            break;
        // complete
        case 4:    
            // check http status
            if( xmlHttp.status == 200 )    // success 
            {
                return "ok";
            }
            // loading not successfull, e.g. page not available
            else {
                if( window.handleAJAXError ) {
                    handleAJAXError( xmlHttp, intID );
                } else {
                    alert( "ERROR\n HTTP status = " + xmlHttp.status + "\n" + xmlHttp.statusText ) ;
                }
            }
    }
}

/** End AJAX functions **/


var cmdhelp = new Array();
cmdhelp["amazon"] = "amazon / buch / dvd / cd (Suchbegriff)";
cmdhelp["cineman"] = "kinoin / kinowo (Ort/PLZ) // kino (Stichwort)";
cmdhelp["ebay"] = "ebay (Stichwort)";
cmdhelp["fx"] = "wechselkurs / kurs / geld (Betrag), (Währung), (Zielwährung)";
cmdhelp["gelbe"] = "gelbe (Stichwort)";
cmdhelp["google"] = "(Stichwort) // google / find(e) / ? // bild // maps (Stichwort)";
cmdhelp["imdb"] = "imdb (Stichwort)";
cmdhelp["leo"] = "leo / en / fr / es / it (Wort)";
cmdhelp["mapsearch"] = "wo / ort / plan / karte (Strasse), (Ort)";
cmdhelp["meteo"] = "meteo / wetter (Ort / PLZ) // radar";
cmdhelp["preisvgl"] = "vergleich / vgl (Stichwort)";
cmdhelp["ricardo"] = "ric / ricardo (Stichwort)";
cmdhelp["route"] = "route / weg (von Adresse), (von Ort), (nach Adresse), (nach Ort)";
cmdhelp["sbb"] = "sbb / öv (von), (nach) (, Datum) (, Zeit (ab))";
cmdhelp["snow"] = "snow / schnee (Ort / PLZ)";
cmdhelp["swissquote"] = "börse (Titel)";
cmdhelp["telsearch"] = "tel (Was / Wer), (Wo)";
cmdhelp["tv"] = "tv / tvjetzt / tv8 / tv9 / ...";
cmdhelp["webcams"] = "cam / webcam (Ort / PLZ)";
cmdhelp["wiki"] = "wiki / wikipedia (Stichwort)";
cmdhelp["ytube"] = "yt[mr/mv/tr/md][t/w/m]";

var id_cmdLine = "commandline_arg1";

var id_helpCmdLine = "commandline_help";
var helpCmdLine = false;

function toggleHelpCmdLine() {
	helpCmdLine = !helpCmdLine;
	hideShowIf(id_helpCmdLine, helpCmdLine);
}

function selectCmdLine() {
	$(id_cmdLine).select(0, $(id_cmdLine).value.length);
}// Functions to create, read and erase a cookie from www.quirksmode.org
function createCookie(name, value, days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else { 
		var expires = "";
	}
	document.cookie = name+"="+value+expires+"; path=/";
}

function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for (var i = 0; i < ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}

function eraseCookie(name) {
	createCookie(name, "", -1);
}


// saves the selected option in a cookie.
function saveSelected(id, cookiename) {
	var el = $(id);
	if (el != null && el.selectedIndex >= 0) {
		createCookie(cookiename, el.options[el.selectedIndex].value, 366);
	}
}///
// _util.js
//
function ie() {
	return "Microsoft Internet Explorer" == navigator.appName;
}

String.prototype.stripSlashes = function() {
	return this.replace(/\\/g, '');
}

function fullscreen(url) {
	window.open(url, "", "fullscreen=yes, scrollbars=auto");
}

function $(id) {
	return document.getElementById(id);
}

function show(id) {
	$(id).style.display = "inline";
}

function hide(id) {
	$(id).style.display = "none";
}

function hideAll(idArray) {
	for (i = 0; i < idArray.length; i++) {
		$(idArray[i]).style.display = "none";
	}
}

function hideShowIf(id, doShow) {
	if (doShow && doShow != "false") {
		show(id);
	} else {
		hide(id);
	}
}

function commandHelp(cmd) {
    $('commandline_arg1').value = cmdhelp[cmd];
    window.scroll(0,0);
    selectCmdLine();
}

function suuitch(id_hide, id_show) {
	$(id_hide).style.display = "none";
	$(id_show).style.display = "inline";
}

function setVis(id, visibility) {
	$(id).style.visibility = visibility;
}

function getKeyCode(e) {
	if (window.event) return window.event.keyCode;
	else if (e) return e.which;
}

function unsselect(select_id) {
	$(select_id).selectedIndex = 0;
}

function getRadioValue(radioName) {
	var radio = document.getElementsByName(radioName);
	for (i = 0; i < radio.length; i++) {
		if (radio[i].checked) {
	    	return radio[i].value;
		}
	}
}

/** 
 * Copies the specified field from each element in the specified array into a new array. 
 * (The argument "valueField" is a String that specifies the name of the desired field...)
 * If the third argument "keyField" is specified, the valueField is stored under the value of the keyField.
 * 
 * Example:
 *   If the array a contains objects like this: 
 *     [{key:one, os:mac}, {key:two, os:win}, ...] 
 * 
 *   the call extractArray(a, "os") will return the array [mac, win]
 *   the call extractArray(a, "os", "key") will return the array [one => mac, two => win]. 
 * 
 * @returns: the new array 
 */
function extractArray(_array, valueField, keyField) {
	var _new = new Array();
	for(i = 0; i < _array.length; i++) {
		if (null != keyField) {
			var key = eval("_array["+ i +"]." + keyField);
			_new[key] = eval("_array["+ i +"]." + valueField);
		}
		_new[i] = eval("_array["+ i +"]." + valueField);
	}
	return _new;
}

/** 
 * Adds the specified Options to the select Element with the specified id.
 */
function addToSelect(selId, _optionLabels, _optionValues) {
	var sel = $(selId);
	// remove old options
	while(sel.hasChildNodes()) {
		for (var i = 0; i < sel.childNodes.length; i++) {
			sel.removeChild(sel.firstChild);
		}
	}
	// add new options
	for(i = 0; i < _optionLabels.length; i++) {
		var opt = document.createElement("option");
		if (_optionValues != null) {
			opt.setAttribute("value", _optionValues[i]);
		}
		opt.appendChild(document.createTextNode(_optionLabels[i]));
		sel.appendChild(opt);
	}
}

/** 
 * Selects the specified option of the specified select element. 
 * (checks the value and text attributes for a match with selectedOption)
 */
function selectOption(selectId, selectedOption) {
	var el = $(selectId);
	for (i = 0; i < el.options.length; i++) {
		var opt = el.options[i];
		if (opt.value == selectedOption || opt.text == selectedOption) {
			opt.selected = true;
		} else {
			opt.selected = false;			
		}
	}
}

function selVal(selectId) {
	return $(selectId).options[$(selectId).selectedIndex].value;
}

/** 
 * Returns a DOM-select-object with the specified name and the specified options.
 * An first empty option is added unless the 4th arg is set to false.
 */
function createSelect(name, _optionLabels, _optionValues, firstEmpty) {
	var sel = document.createElement("select");
	sel.setAttribute("name", name);
	sel.setAttribute("id", name);

	// add empty option first
	if (firstEmpty != false) {
		sel.appendChild(document.createElement("option"));
	}
	
	for(i = 0; i < _optionLabels.length; i++) {
		var opt = document.createElement("option");
		if (_optionValues != null) {
			opt.setAttribute("value", _optionValues[i]);
		}
		opt.appendChild(document.createTextNode(_optionLabels[i]));
		sel.appendChild(opt);
	}

	return sel;
}


///
// The three functions below perform some useful tasks on DOM-objects

/**
 * Removes all children of the specified DOM element.
 */
function removeKids(el) {
	while (el != null && el.hasChildNodes()) {
		for (var i = 0; i < el.childNodes.length; i++) {
			el.removeChild(el.firstChild);
		}
	}
}

/** Adds the specified DOM element to the element with the specified ID. */
function addToParent(el, parentId) {
	var elParent = document.getElementById(parentId);
	elParent.appendChild(el);
}

/** 
 * Removes the all children of the specified parent and adds the new child element.
 */
function replaceChild(parentId, newChild) {
	removeKids($(parentId));
	addToParent(newChild, parentId);
}

/** Adds a newline () to the specified parent node if the Browser is IE */
function ieNln(parentId) {
	if (ie()) {
		$(parentId).appendChild(document.createTextNode("\u000A\u000D"));
	}
}

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

urls['snow'] = "http://snow.myswitzerland.com/requests/SearchSearchRequest.jsp?AdminSearchTerms=arg1";

urls['webcams'] = "http://www.swisswebcams.ch/deutsch/search.php";

urls['fx'] = "http://www.oanda.com/convert/classic?lang=de";

urls['meteo'] = "http://www.meteoschweiz.admin.ch/web/de/wetter/detailprognose/lokalprognose.html?language=de&plz=arg1";

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
	
	for (i = 1; i <= 6; i++) {
		val = "value" + i;
		eval(val + " = escape("+val+")");
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
	
	} else if ('gelbe' == target) {
		storeUserData('gelbe_arg2', $('gelbe_arg2').value);
	
	} else if ('meteo' == target) {
		if (lastField == 'meteo_prognosen') {
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
//
// user settings

var cookie_googleDE = "googleDE";
var cookie_googleCH = "googleCH";

// sets checkbox "nur Seiten auf deutsch" in google
function enableGoogleDECH() {
	var sel = $('google_arg2');
	var checkboxDE = $('google_arg3');
	var checkboxCH = $('google_arg4');
	if (sel != null && sel.selectedIndex > 0) {
		checkboxDE.disabled = 'disabled';
		checkboxCH.disabled = 'disabled';
	} else {
		checkboxDE.disabled = '';
		checkboxCH.disabled = '';
	}
}

function uncheckBox(id) {
	var checkbox = $(id);
	checkbox.checked = false;
}

function setGoogleDE() {
	uncheckBox('google_arg4');
	storeGoogleDECH();
}

function setGoogleCH() {
	uncheckBox('google_arg3');
	storeGoogleDECH();
}

// stores the checkbox state in a cookie and unselects counterpart checkbox state
function storeGoogleDECH() {
	var checkboxDE = $('google_arg3');
	var checkboxCH = $('google_arg4');
	storeUserData(cookie_googleDE, checkboxDE.checked);
	storeUserData(cookie_googleCH, checkboxCH.checked);
}

// stores the checkbox state in a cookie
function readGoogleDECH() {
	var checkboxDE = $('google_arg3');
	var checkboxCH = $('google_arg4');
	if (null == checkboxDE || null == checkboxCH) return;
	checkboxDE.checked = ('true' == userdata[cookie_googleDE]);
	checkboxCH.checked = ('true' == userdata[cookie_googleCH]);
}

function resetPage() {
	eraseUserData();
	gotoMainPage();
}
// url to load the data for a userid
var userdataUrl = "_ajax_userdata_js.php";

// the name of the cookie containing the userid
var cookie_userId = "userid";

// the userid that is stored in a cookie
var userid;

// array to store the data for a userid
var userdata;

// If this flag is set to false, userdata is only stored locally.
var storeOnServer = true;

/** This function finds out the userid and loads the userdata. */
function initUserData() {
	userid = readCookie(cookie_userId);
	if (userid == null || userid == "") {
		//httpRequest("POST", userdataUrl, false, "initUserData_callback", "op=newuserid");
		sendRequest(userdataUrl, "op=newuserid", 2, "initUserData_callback", false);
	}
	createCookie(cookie_userId, userid, 90);

	loadUserData(userid);
	
	/////
	// execute op shareNews
	if (arguments[0] == "shareNews") {
		userdata["searchMode"] = arguments[1];
		userdata["sel1" + userdata["searchMode"]] = arguments[2];
		userdata["sel2" + userdata["searchMode"]] = arguments[3];
		userdata["timeStmp"] = arguments[4];
	}
	////
	// execute op cmdlineHelp (http://hyperfinder.ch/?op=cmdlineHelp)
	if (arguments[0] == "cmdlineHelp") {
		toggleHelpCmdLine();
	}
}

function initUserData_callback(intID) {
	if ("ok" != checkAjaxResponse(intID)) { return; }

	userid = eval(xmlHttp.responseText);
}

function loadUserData(userid) {
	sendRequest(userdataUrl, "userid=" + userid, 2, "loadUserData_callback", false);
}

function loadUserData_callback(intID) {
	
	if ("ok" != checkAjaxResponse(intID)) { return; }

	userdata = eval(xmlHttp.responseText);
	if (userdata == null) {
		userdata = new Array();
	}
}

function storeUserData(name, value) {
	if (name == null || value == null) { return; }
	userdata[name] = value;
	if (storeOnServer) {
		sendRequest(userdataUrl, "op=set&userid=" + userid + "&name=" + name + "&value=" + value, 2, "storeUserData_callback", false);
	}
}

function storeUserData_callback(intID) {
	// do nothing...
	// alert("userdata stored " + xmlHttp.responseText);
}

function storeSelectedAsUserData(selectId, dataName) {
	var el = $(selectId);
	if (el != null && el.selectedIndex >= 0) {
		storeUserData(dataName, el.options[el.selectedIndex].value);
	}
}

function eraseUserData() {
	userdata = null;
	sendRequest(userdataUrl, "op=del&userid=" + userid, 2, "eraseUserData_callback", false);
}

function eraseUserData_callback(intID) {
	// do nothing...
	// alert("userdata erased " + xmlHttp.responseText);
}

