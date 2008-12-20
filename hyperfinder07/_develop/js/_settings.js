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
