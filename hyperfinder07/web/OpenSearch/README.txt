Die Datei hyperfinder.src gehört in den searchplugins-Ordner des Firefox Verzeichnisses.

Anleitung unter:
	http://developer.mozilla.org/en/docs/Creating_OpenSearch_plugins_for_Firefox
	

Autodiscovery of search plugins

A web site that offers a search plugin can advertise it so that Firefox users can easily download and install the plugin. 

To support autodiscovery, you simply need to add one line to the <head> section of your web page: 

	<link rel="search" type="application/opensearchdescription+xml" title="searchTitle" href="pluginURL">

Replace the italicized items as explained below: 

- searchTitle 
	The name of the search to perform, such as "Search MDC" or "Yahoo! Search". This value should match your plugin file's ShortName. 
- pluginURL 
	The URL to the XML search plugin, from which the browser can download it. 


