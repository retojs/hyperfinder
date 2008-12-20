///
// element ids

var id_div_help = "help";
var id_div_currfeedlabel = "currfeedlabel";
var id_div_selectfeed = "selectfeed";
var id_div_newsDisplay = "newsDisplay";

var id_div_news = new Array();
id_div_news["byTopic"] = "newsByTopic";
id_div_news["byUrl"] = "newsByUrl";
id_div_news["byKeyword"] = "newsByKeyword";
id_div_news["podcasts"] = "podcasts";
id_div_news["swissnews"] = "swissnews";

var searchModeDivs = new Array();
searchModeDivs[0] = id_div_news["byTopic"];
searchModeDivs[1] = id_div_news["byUrl"];
searchModeDivs[2] = id_div_news["byKeyword"];
searchModeDivs[3] = id_div_news["podcasts"];
searchModeDivs[4] = id_div_news["swissnews"];

var name_radio_newssearchmode = "newssearchmode";

var id_news_keyword = "newsKeyword";

///
// cookie names
var cookie_newsSelect = 'newsSelect';
var cookie_newsMode = 'searchMode';

var cookie_keyword = 'stichwort';
var cookie_feedpage = 'pageselect';
var cookie_feedurl = 'feedurl';

var cookie_newsDisabled = 'noNews';

// operation shareNews (experimental)
// URL sample: http://localhost/hyperfinder07/?op=shareNews&arg1=podcasts&arg2=0&arg3=37
var op_shareNews = "shareNews";
