function replaceLinks(urlBase) {
	var elements = document.getElementsByTagName('a');
	replaceHref(elements, urlBase);
	
	var elements = document.getElementsByTagName('img');
	replaceSrc(elements, urlBase);
}

function replaceHref(elements, urlBase) {
	for (i = 0; i < elements.length; i++) {
		alert("got link "+elements[i].href);
		if (elements[i].href.indexOf("http") >= 0) {
			elements[i].href = 'controller.php?forward=' + elements[i].href;
		} else {
			elements[i].href = 'controller.php?forward=' + urlBase + elements[i].href;
		}
		alert("set to "+elements[i].href)
	}
}

function replaceSrc(elements, urlBase) {
	for (i = 0; i < elements.length; i++) {
		//alert("got link "+elements[i].src);
		if (elements[i].src.indexOf("http") >= 0) {
			elements[i].src = 'controller.php?forward=' + elements[i].src;
		} else {
			elements[i].src = 'controller.php?forward=' + urlBase + elements[i].src;
		}
		//alert("set to "+elements[i].src)
	}
}