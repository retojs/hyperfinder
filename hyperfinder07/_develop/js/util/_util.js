///
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

