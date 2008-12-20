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

			
// REQUIRES AJAX.JS	--- END 
