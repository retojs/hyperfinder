var enterTextTimeout;

/** Enters a string into the input field with the specified id char by char */
function enterText(id, str, pos, contArg) {
	clearTimeout(enterTextTimeout);
	
	if (null == pos) {
		pos = 1;
	}
	currStr = str.slice(0, pos++);
	var elem = document.getElementById(id);
	if (elem) {
		elem.value = currStr;
	}
	if (pos <= str.length) {
		enterTextTimeout = setTimeout("enterText('" + id + "', '" + str + "', " + pos + ", '" + contArg + "')", 100);
	} else {
		enterTextTimeout = setTimeout("enterTextComplete('"+ contArg + "')", 100);
	}
}

/* Kind of general function that is called after (asynchronous!) method enterText(txt) is completed. 
 * This is necessary because we cannot pass quotes over multiple eval steps. 
 */
function enterTextComplete(demoname) {
	clearTimeout(enterTextTimeout);
	clearTimeout(quissTimeout);
	var hyperdemo = demos[demoname];
	quissTimeout = setTimeout(hyperdemo.playFunc + "('"+ demoname +"', 'enterdone')", 1000);
}


/** Selects an option from the select with the specified id */
function selectOption(id, index) {
	var elem = document.getElementById(id);
	if (elem) {
		elem.options[index].selected = true;
	}
}

function markElement(id) {
	var el = document.getElementById(id);
	if (el) {
		el.className += ' demo';
	}
}

// The demo class (defined via its constructor as in http://www.javascriptkit.com/javatutors/oopjs2.shtml
function hyperdemo(target, anchor, fieldId, searchStr) {
	this.target = target;
	this.anchor = anchor;
	this.playFunc = "playdemo";
	this.fieldId = fieldId;
	this.searchStr = searchStr;
}

// This class needs arrays as paramters fieldIds and searchStrs.
function hyperdemoDouble(target, anchor, fieldId, searchStr, fieldId2, searchStr2) {
	this.target = target;
	this.anchor = anchor;
	this.fieldsDone = 0;
	this.playFunc = "playdemoMulti";
	this.fields = new Array(2);
	this.strs = new Array(2);
	this.fields[0] = fieldId;
	this.fields[1] = fieldId2;
	this.strs[0] = searchStr;
	this.strs[1] = searchStr2;
	this.getCurrField = function() {
		return this.fields[this.fieldsDone];
	}
	this.getCurrStr = function() {
		return this.strs[this.fieldsDone];
	}
	this.hasMore = function() {
		return (this.fieldsDone < this.fields.length);
	}
}

// Leo queries need a special event call before send...
function createLeoDemo(target, anchor, fieldId, searchStr) {
	var demo = new hyperdemo(target, anchor, fieldId, searchStr);
	demo.sendFunc = "setLastLeoField('"+ fieldId +"');";
	return demo;
}

// Cineman queries need a special event call before send...
function createCinemanDemo(target, anchor, fieldId, searchStr) {
	var demo = new hyperdemo(target, anchor, fieldId, searchStr);
	demo.sendFunc = "setLastCinemanField('"+ fieldId +"');";
	return demo;
}

// For Demos with a textfield and a selection
function createTextNSelectDemo(target, anchor, fieldId, searchStr, spanId, selectId, index) {
	var demo = new hyperdemo(target, anchor, fieldId, searchStr);
	demo.playFunc = "playdemoWithSelect";
	demo.spanId = spanId;
	demo.selectId = selectId;
	demo.index = index;
	return demo;
}

// Creates a demo that shows how to close and show a slot.
function createKonfigDemo(target, anchor) {
	var demo = new hyperdemo(target, anchor, '', '');
	demo.playFunc = "playdemoKonfig";
	demo.fieldsDone = 0;
	return demo;
}


function getLocationPure() {
	if (document.location.href.indexOf('#') > 0) {
		return document.location.href.substring(0, document.location.href.indexOf('#')); // 'http://hyperfinder.ch/test/index.php'
	} else {
		return document.location.href;
	}
}


var quissTimeout; 
var triesToDisplaySlot; // falls ein Demo für einen Slot gedacht ist, der nicht eingeblendet ist, muss man mehrmals versuchen...
var submitMsg = "Wenn Sie selber suchen, drücken sie einfach die Taste ENTER, um die Suchanfrage zu starten.";

// this function executes a single keyword search demo  
// there needs to be an object of type hyperdemo 
// associated with demoname in the array demos.
function playdemo(demoname, state) {
	stopTickerHeadline();
	if (quissTimeout) clearTimeout(quissTimeout);
	
	// get the hyperdemo object out of the array demos
	var hyperdemo = demos[demoname];
	
	if (null == state) {
		// 0.1 init the counter
		triesToDisplaySlot = 0;
		// 0.2 start with the first field
		playdemo(demoname, "mark");
	}
		
	else if ("mark" == state) {
		var el = document.getElementById(hyperdemo.fieldId);
		if (el) {
			// 1. jump to anchor
			document.location.href = getLocationPure() + "#" + hyperdemo.anchor + "_anchorShow";
			// 2. clear and mark field
			el.value = '';
			el.className += ' demo';
			// 3. wait...
			quissTimeout = setTimeout("playdemo('"+ demoname +"', 'enter')", 1000);

		} else if (triesToDisplaySlot < 5) {
			// if the field is not here, try to display it.
			ein(hyperdemo.target);
			triesToDisplaySlot++;
			quissTimeout = setTimeout("playdemo('"+ demoname +"', 'mark')", 2000);
		}		
	}

	else if ("enter" == state) {
		// 4. enter search string
		enterText(hyperdemo.fieldId, hyperdemo.searchStr, 0, demoname);
	}
	else if ("enterdone" == state) {
		playdemo(demoname, "send");
	}
	
	else if ("send" == state) {
		// 5. submit search request
		onPressKey(hyperdemo.target);
		eval (hyperdemo.sendFunc);
		alert(submitMsg);
		gotoURL();
		restartTickerHeadline();
	} 
}


// this function executes a multi keyword search demo  
// there needs to be an object of type hyperdemo associated with the argument demoname in the array demos.
function playdemoMulti(demoname, state) {
	stopTickerHeadline();
	if (quissTimeout) clearTimeout(quissTimeout);
	
	// get the hyperdemo object out of the array demos
	var hyperdemo = demos[demoname];
	
	if (null == state) {
		// 0.1 init the counter
		hyperdemo.fieldsDone = 0;
		triesToDisplaySlot = 0;
		// 0.2 start with the first field
		playdemoMulti(demoname, "mark");
	}
		
	else if ("mark" == state) {
		var el = document.getElementById(hyperdemo.getCurrField());
		if (el) {
			// 1. jump to anchor
			document.location.href = getLocationPure() + "#" + hyperdemo.anchor + "_anchorShow";
			// 2. clear and mark field
			el.value = '';
			el.className += ' demo';
			// 3. wait...
			quissTimeout = setTimeout("playdemoMulti('"+ demoname +"', 'enter')", 1000);
		} else if (triesToDisplaySlot < 5) {
			// if the field is not here, try to display it.
			ein(hyperdemo.target);
			triesToDisplaySlot++;
			quissTimeout = setTimeout("playdemoMulti('"+ demoname +"', 'mark')", 2000);
		}
	}

	else if ("enter" == state) {
		// 4. enter search string
		enterText(hyperdemo.getCurrField(), hyperdemo.getCurrStr(), 0, demoname);
	}
	else if ("enterdone" == state) {
		hyperdemo.fieldsDone++;
		// 4.2 maybe enter another search string
		if (hyperdemo.hasMore()) {
			playdemoMulti(demoname, "mark");
		} else {
			playdemoMulti(demoname, "send");
		}
	}
	
	else if ("send" == state) {
		// 5. submit search request
		onPressKey(hyperdemo.target);
		gotoURL();
		alert(submitMsg);
		restartTickerHeadline();
	} 
}



// this function executes a demo that just presses a link  
// there needs to be an object of type hyperdemo 
// associated with demoname in the array demos.
function playLinkDemo(demoname, state) {
	stopTickerHeadline();
	if (quissTimeout) clearTimeout(quissTimeout);
	
	// get the hyperdemo object out of the array demos
	var hyperdemo = demos[demoname];
	
	if (null == state) {
		triesToDisplaySlot = 0;
		// 0.2 start with the first field
		state = "einblend";
	}
	
	if ("einblend" == state) {
		var el = document.getElementById(hyperdemo.fieldId);
		if (!el) {
			if (triesToDisplaySlot < 5) {
				// if the field is not here, try to display it.
				ein(hyperdemo.target);
				triesToDisplaySlot++;
				quissTimeout = setTimeout("playLinkDemo('"+ demoname +"', 'einblend')", 2000);
			} else {
				alert("Keine Verbindung. Versuchen Sie es später nochmals.");
			}
		} else {
			// 1. jump to anchor
			document.location.href = getLocationPure() + "#" + hyperdemo.anchor + "_anchorShow";
			// 2. wait...
			quissTimeout = setTimeout("playLinkDemo('"+ demoname +"', 'mark')", 800);
		}
	}
		
	else if ("mark" == state) {
		var el = document.getElementById(hyperdemo.fieldId);
		// 3. mark link
		el.className += ' demo';
		// 4. wait...
		quissTimeout = setTimeout("playLinkDemo('"+ demoname +"', 'send')", 1300);
	}
	
	else if ("send" == state) {
		// 5. press the link
		linkTo(hyperdemo.searchStr, hyperdemo.target);
		restartTickerHeadline();
	} 
}



// this function executes a single keyword search demo  
// there needs to be an object of type hyperdemo 
// associated with demoname in the array demos.
function playdemoWithSelect(demoname, state) {
	stopTickerHeadline();
	if (quissTimeout) clearTimeout(quissTimeout);
	
	// get the hyperdemo object out of the array demos
	var hyperdemo = demos[demoname];
	
	if (null == state) {
		// 0.1 init the counter
		triesToDisplaySlot = 0;
		// 0.2 start with the first field
		state = "mark";
	}
		
	if ("mark" == state) {
		var el = document.getElementById(hyperdemo.fieldId);
		if (el) {
			// 1. jump to anchor
			document.location.href = getLocationPure() + "#" + hyperdemo.anchor + "_anchorShow";
			// 2. clear and mark field
			el.value = '';
			el.className += ' demo';
			// 3. wait...
			quissTimeout = setTimeout("playdemoWithSelect('"+ demoname +"', 'enter')", 1000);

		} else if (triesToDisplaySlot < 5) {
			// if the field is not here, try to display it.
			ein(hyperdemo.target);
			triesToDisplaySlot++;
			quissTimeout = setTimeout("playdemoWithSelect('"+ demoname +"', 'mark')", 2000);
		}		
	}

	else if ("enter" == state) {
		// 4. enter search string
		enterText(hyperdemo.fieldId, hyperdemo.searchStr, 0, demoname);
	}
	else if ("enterdone" == state) {
		quissTimeout = setTimeout("playdemoWithSelect('"+ demoname +"', 'selectmark')", 1000);
	}
	
	else if ("selectmark" == state) {
		// 5. mark select
		var el = document.getElementById(hyperdemo.spanId);
		if (el) {
			el.className = 'demo';
		}
		quissTimeout = setTimeout("playdemoWithSelect('"+ demoname +"', 'select')", 1000);
	}
	else if ("select" == state) {
		// 6. select option
		selectOption(hyperdemo.selectId, hyperdemo.index);
		quissTimeout = setTimeout("playdemoWithSelect('"+ demoname +"', 'send')", 1000);
	}
	
	else if ("send" == state) {
		// 5. submit search request
		onPressKey(hyperdemo.target);
		eval (hyperdemo.sendFunc);
		alert(submitMsg);
		gotoURL();
		restartTickerHeadline();
	} 
}



// this function executes a demo that just presses a link  
// there needs to be an object of type hyperdemo 
// associated with demoname in the array demos.
function playdemoKonfig(demoname, state) {
	stopTickerHeadline();
	if (quissTimeout) clearTimeout(quissTimeout);
	
	// get the hyperdemo object out of the array demos
	var hyperdemo = demos[demoname];
			
	// visible?
	if (state == null) {
		// jump to anchor
		document.location.href = getLocationPure() + "#" + hyperdemo.anchor + "_anchorShow";
		var el = document.getElementById(hyperdemo.target + "_close");
		if (el) {
			state = "mark_close";
		} else {
			state = "mark_show";
		}
	}
		
	if ("mark_close" == state) {
		var el = document.getElementById(hyperdemo.target + "_close");
		el.className += ' demo';
		quissTimeout = setTimeout("playdemoKonfig('"+ demoname +"', 'close')", 1000);
	} else if ("mark_show" == state) {
		var el = document.getElementById(hyperdemo.target + "_show");
		el.className += ' demo';
		quissTimeout = setTimeout("playdemoKonfig('"+ demoname +"', 'show')", 1000);
	}
	else if ("close" == state) {
		alert("Ein Klick auf 'schliessen' lässt einen Suchdienst verschwinden und schafft mehr Übersicht.");
		weg(hyperdemo.target);
		quissTimeout = setTimeout("playdemoKonfig('"+ demoname +"', 'repeat')", 2500);
	} else if ("show" == state) {
		alert("Ein Klick auf diesen Link blendet einen Suchdienst ein.");
		ein(hyperdemo.target);
		quissTimeout = setTimeout("playdemoKonfig('"+ demoname +"', 'repeat')", 2500);
	} 
	else if ("repeat" == state) {
		// mark link if open
		var el = document.getElementById(hyperdemo.target + "_link");
		if (el) {
			el.className += ' demo';
		}
		// do it again vice versa
		hyperdemo.fieldsDone++;
		if (hyperdemo.fieldsDone < 2) {
			quissTimeout = setTimeout("playdemoKonfig('"+ demoname +"', null)", 500);
		} else {
			hyperdemo.fieldsDone = 0;
			alert("Probieren Sie's selber!");
			restartTickerHeadline();
		}
	}
}

// init all demos and associate them with a name
var demos = new Array();
demos['leo1'] = createLeoDemo('leo', 'Basic', 'leo_arg2', 'Pfingsten');
demos['cine1'] = createCinemanDemo('cineman', 'Fun', 'cineman_arg1', '8000');
demos['michelin1'] = new hyperdemoDouble('michelin', 'Nav', 'michelin_arg2', 'Bern', 'michelin_arg4', 'Zermatt');
demos['sbb1'] = new hyperdemoDouble('sbb', 'Nav', 'sbb_arg1', 'Aarau', 'sbb_arg2', 'Genf');
demos['webcam1'] = new hyperdemo('webcams', 'Wetter', 'webcams_arg1', 'Pilatus');
demos['meteo1'] = new hyperdemo('meteo', 'Wetter', 'meteo_radar', 'http://www.nzz.ch/wetter/radar_grossbild_aktuell.html');
demos['meteo2'] = new hyperdemo('meteo', 'Wetter', 'meteo_arg1', 'Interlaken');
demos['wiki1'] = new hyperdemo('wiki', 'Basic', 'wiki_arg1', 'Pizza');
demos['define1'] = new hyperdemo('google', 'Basic', 'google_arg1', 'define: HTML');
demos['img1'] = createTextNSelectDemo('google', 'Basic', 'google_arg1', 'Labrador', 'google_select', 'google_arg2', 1);
demos['img2'] = createTextNSelectDemo('google', 'Basic', 'google_arg1', 'Taj Mahal', 'google_select', 'google_arg2', 1);
demos['konfig1'] = createKonfigDemo('michelin', 'Nav');
demos['change1'] = new hyperdemo('fx', 'Handel', 'fx_arg1', '59.90');
demos['ricardo1'] = createTextNSelectDemo('ricardo', 'Handel', 'ricardo_arg1', 'Maus', 'ricardo_select', 'ricardo_arg2', 7);
demos['amazon1'] = new hyperdemo('amazon', 'Handel', 'amazon_arg1', 'Da Vinci Code entschlüsselt');
demos['tv1'] = new hyperdemo('tv', 'Fun', 'tv_jetzt', 'http://www.fernsehen.ch/zeit/index.php');
demos['tv2'] = new hyperdemo('tv', 'Fun', 'tv_arg1', 'Simpsons');
demos['gelbe1'] = new hyperdemoDouble('gelbe', 'Nav', 'gelbe_arg1', 'Massage', 'gelbe_arg2', 'Dübendorf');
demos['ricardo2'] = new hyperdemo('ricardo', 'Handel', 'ricardo_link', 'http://affiliate.ricardo.ch/app/auc_aff/interface/?c=2&c_p=2&affid=10729&campid=19445');
demos['cine2'] = createCinemanDemo('cineman', 'Fun', 'cineman_arg4', 'Kidman');
demos['map2'] = new hyperdemo('mapsearch', 'Nav', 'mapsearch_arg2', 'Luzern');

// Headline messages
var headMsg = new Array();
var i = 0;

headMsg[i++] = "Die ideale Startseite... ";
headMsg[i++] = "wer drauf verzichtet ist selber Schuld.";

headMsg[i++] = "Was heisst 'Pfingsten' auf Französisch?";
headMsg[i++] = "<input type=button class=demobutton onclick=playdemo('leo1') value=\"Für die Antwort hier klicken\">";

headMsg[i++] = "Was läuft am TV?";
headMsg[i++] = "<input type=button class=demobutton onclick=playLinkDemo('tv1') value=\"Für die Antwort hier klicken\">";


headMsg[i++] = "Hyperfinder.ch...";
headMsg[i++] = "die Abkürzung ins Internet";

headMsg[i++] = "Wie fahr ich mit dem Auto von Bern nach Zermatt?";
headMsg[i++] = "<input type=button class=demobutton onclick=playdemoMulti('michelin1') value=\"Für die Antwort hier klicken\">";



headMsg[i++] = "Was Google nicht weiss...";
headMsg[i++] = "weiss Hyperfinder.";

headMsg[i++] = "Hat es Nebel auf dem Pilatus?";
headMsg[i++] = "<input type=button class=demobutton onclick=playdemo('webcam1') value=\"Für die Antwort hier klicken\">";

headMsg[i++] = "Regnet es in Locarno?";
headMsg[i++] = "<input type=button class=demobutton onclick=playLinkDemo('meteo1') value=\"Für die Antwort hier klicken\">";

headMsg[i++] = "Wer massiert mich in Dübendorf?";
headMsg[i++] = "<input type=button class=demobutton onclick=playdemoMulti('gelbe1') value=\"Für die Antwort hier klicken\">";


headMsg[i++] = "Die ideale Startseite... ";
headMsg[i++] = "<span class=altkey style=font-weight:normal;font-size:13px class=whitecolor>ALT-Home</span>&nbsp; Sweet Hyperfinder.ch";

headMsg[i++] = "Wann kommen die Simpsons?";
headMsg[i++] = "<input type=button class=demobutton onclick=playdemo('tv2') value=\"Für die Antwort hier klicken\">";

headMsg[i++] = "Wer hat die Pizza erfunden?";
headMsg[i++] = "<input type=button class=demobutton onclick=playdemo('wiki1') value=\"Für die Antwort hier klicken\">";

headMsg[i++] = "Wie passe ich Hyperfinder meinen Bedürfnissen an?";
headMsg[i++] = "<input type=button class=demobutton onclick=playdemoKonfig('konfig1') value=\"Für die Antwort hier klicken\">";



headMsg[i++] = "Das Beste aus dem Internet...";
headMsg[i++] = "auf einen Blick.";

headMsg[i++] = "Was heisst eigentlich HTML?";
headMsg[i++] = "<input type=button class=demobutton onclick=playdemo('define1') value=\"Für die Antwort hier klicken\">";

headMsg[i++] = "Wie sieht ein Labrador aus?";
headMsg[i++] = "<input type=button class=demobutton onclick=playdemoWithSelect('img1') value=\"Für die Antwort hier klicken\">";

headMsg[i++] = "Was läuft in Zürich im Kino?";
headMsg[i++] = "<input type=button class=demobutton onclick=playdemo('cine1') value=\"Für die Antwort hier klicken\">";



headMsg[i++] = "Wer's praktisch findet, darf's behalten...";
headMsg[i++] = "als Startseite.";

headMsg[i++] = "Wieviel sind 59.90 Euro?";
headMsg[i++] = "<input type=button class=demobutton onclick=playdemo('change1') value=\"Für die Antwort hier klicken\">";

headMsg[i++] = "Wo schnapp ich mir eine günstige Maus?";
headMsg[i++] = "<input type=button class=demobutton onclick=playdemoWithSelect('ricardo1') value=\"Für die Antwort hier klicken\">";


headMsg[i++] = "Der leichte Weg zu weniger Hektik...";
headMsg[i++] = "hyperfinder.ch.";

headMsg[i++] = "Wie knack ich den Da Vinci-Code?";
headMsg[i++] = "<input type=button class=demobutton onclick=playdemo('amazon1') value=\"Für die Antwort hier klicken\">";



headMsg[i++] = "Was wichtig ist schneller finden...";
headMsg[i++] = "Gewusst wo.";

headMsg[i++] = "Wer holt mein altes Sofa ab und zahlt dafür?";
headMsg[i++] = "<input type=button class=demobutton onclick=playLinkDemo('ricardo2') value=\"Für die Antwort hier klicken\">";

headMsg[i++] = "Wann seh ich Nicole Kidman?";
headMsg[i++] = "<input type=button class=demobutton onclick=playdemo('cine2') value=\"Für die Antwort hier klicken\">";

headMsg[i++] = "Wo kann ich in Luzern parkieren?";
headMsg[i++] = "<input type=button class=demobutton onclick=playdemo('map2') value=\"Für die Antwort hier klicken\">";



headMsg[i++] = "Reduce the internet to the max...";
headMsg[i++] = "Das Wesentliche schneller finden.";

headMsg[i++] = "Wie wird das Wetter in Interlaken?";
headMsg[i++] = "<input type=button class=demobutton onclick=playdemo('meteo2') value=\"Für die Antwort hier klicken\">";

headMsg[i++] = "Wie sieht der Taj Mahal aus?";
headMsg[i++] = "<input type=button class=demobutton onclick=playdemoWithSelect('img2') value=\"Für die Antwort hier klicken\">";

headMsg[i++] = "Wie lange geht die Zugfahrt von Aarau nach Genf?";
headMsg[i++] = "<input type=button class=demobutton onclick=playdemoMulti('sbb1') value=\"Für die Antwort hier klicken\">";


/*

headMsg[8] = "Was wichtig ist schneller finden. ";
headMsg[9] = "<a href=\"test\">So geht's</a>";

headMsg[4] = "Wer's praktisch findet, darf's behalten... ";
headMsg[5] = "<a href=\"test\">als Startseite.</a>";
*/
// Quiss


/*
headMsg[1] = "Regnet es in Zürich?";
headMsg[2] = "<input class=smallinput type=radio onclick=submitQuiss('any')>ja<input class=smallinput type=radio onclick=submitQuiss('any')>nein";
*/


/*
headMsg[5] = "Was heisst 'Frohe Ostern!' auf Französisch?";
headMsg[6] = "<input type=text name=xanswer onclick=submitQuiss()>";

headMsg[7] = "Wieviel Franken kostet das Buch xy auf Amazon? (nicht EURO)";
headMsg[8] = "<input type=text name=xanswer onclick=submitQuiss()>";

headMsg[9] = "ABB Aktien Handel oder verHandel? ";
headMsg[10] = "<input class=smallinput type=radio onclick=submitQuiss('any')>Handel<input class=smallinput type=radio onclick=submitQuiss('any')>verHandel";

headMsg[11] = "Was ist die neuste Meldung auf Finanznet.de?";
headMsg[12] = "<input type=text name=xanswer onclick=submitQuiss()>";

headMsg[13] = "Hat es Nebel in Chur?";
headMsg[14] = "<input class=smallinput type=radio onclick=submitQuiss('any')>ja<input class=smallinput type=radio onclick=submitQuiss('any')>nein";

headMsg[15] = "Kann man noch Skifahren in Flims?";
headMsg[16] = "<input class=smallinput type=radio onclick=submitQuiss('any')>ja<input class=smallinput type=radio onclick=submitQuiss('any')>nein";

headMsg[17] = "Was bedeutet 'advantageous'?";
headMsg[18] = "<input type=text name=xanswer onclick=submitQuiss()>";

headMsg[19] = "Wer hat das Internet erfunden";
headMsg[20] = "<input type=text name=xanswer onclick=submitQuiss()>";

headMsg[21] = " ";
*/
/*
headMsg[16] = "Wieviel kostet die günstigste Playstation auf Ricardo?";
headMsg[17] = "<a href=\"test\">auf einen Blick</a>";

headMsg[16] = "Wann läuft der Film x in Zürich nächsten Montag Abend?";
headMsg[17] = "<a href=\"test\">auf einen Blick</a>";

headMsg[16] = "Welches Rastaurant liegt in der Nähe der XYStrasse?";
headMsg[17] = "<a href=\"test\">auf einen Blick</a>";

headMsg[16] = "Wieviel kostet das Benzin für eine Fahrt von Zürich nach Zermatt?";
headMsg[17] = "<a href=\"test\">auf einen Blick</a>";

headMsg[16] = "Wie ist die Telefonnummer von Stefan Studer in Zürich?";
headMsg[17] = "<a href=\"test\">auf einen Blick</a>";

headMsg[16] = "Wer kennt Stefan Studer?";
headMsg[17] = "<a href=\"test\">auf einen Blick</a>";

// Newsfeed von findemich
headMsg[16] = "Wer stand am Montag in der Migros?";
headMsg[17] = "<a href=\"test\">auf einen Blick</a>";

// Konfig Fragen
headMsg[16] = "Wie kann ich Suchdienste ausblenden und einblenden?";
headMsg[17] = "<a href=\"test\">auf einen Blick</a>";

headMsg[16] = "Wie höre ich den neuesten Newfeed der Weltwoche?";
headMsg[17] = "<a href=\"test\">auf einen Blick</a>";

*/

var epilog = "Was fragst du Google? Google weiss das nicht. Aber hyperfinder weiss es."

/*

var solutions[] = {"1a", "2b", "3c", "4a"};


$replies[] = "falls Lösung korrekt: Gratulation. Sie erhalten als Auszeichnung hyperfinder.ch als Startseite. (jedem anderen ist es untersagt, hyperfinder zu benutzen)";
$replies[] = "Gratulation. sie dürfen nun hyperfinder als Startseite einrichten und in Zukunft das Internet beherrschen wie ein Magier.";
$replies[] = "Gratulation! Sie haben hyperfinder als Startseite gewonnen!";

*/

var tickerHeadlineTimeout;
var gezeigtHeadline = 0;
var tickerHeadlineTempo = 1500;
var tickerHeadlineTempo2 = 3000;

function tickerHeadline(spanId, i) {	
	
	var headline = document.getElementById(spanId);
	headline.innerHTML = headMsg[i];
	
	i += 1;
	if (i >= headMsg.length) {
		i = 0;
	}
			
	if (spanId == 'headline') {
		spanId = 'headline2';
		var headline2 = document.getElementById('headline2');
		headline2.innerHTML = "";
	} else {
		spanId = 'headline';
		createCookie('tip', i);
	}
	
	startTickerHeadline(spanId, i);
}

function startTickerHeadline(spanId, i) {
	clearTimeout(tickerHeadlineTimeout);
	var tempo = tickerHeadlineTempo;
	if (spanId == 'headline') {
		tempo = tickerHeadlineTempo2;
	}
	tickerHeadlineTimeout = setTimeout("tickerHeadline('" + spanId + "', " + i + ")", tempo);
}

function stopTickerHeadline() {
	clearTimeout(tickerHeadlineTimeout);
}

function restartTickerHeadline() {
	
	// continue where we stopped
 	tipIndex = readCookie('tip');
	if (null == tipIndex) {
		tipIndex = 2;
	}
 	//startTickerHeadline('headline', tipIndex);
	startTickerHeadline('headline', 2);
}