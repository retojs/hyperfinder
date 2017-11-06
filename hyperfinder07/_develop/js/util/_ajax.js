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

