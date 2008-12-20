// Sound on Mouseover javascript supplied by http://www.hypergurl.com

var aySound = new Array();
// PLACE YOUR SOUND FILES BELOW
aySound[0] = "wuff.wav";

// Don't alter anything below this line

IE = (navigator.appVersion.indexOf("MSIE")!=-1 && document.all)? 1:0;
NS = (navigator.appName=="Netscape" && navigator.plugins["LiveAudio"])? 1:0;
ver4 = IE||NS? 1:0;

function auPreload() {
	if (!ver4) return;
	if (NS) auEmb = new Layer(0,window);
	else {
		Str = "<DIV ID='auEmb' STYLE='position:absolute;'></DIV>";
		document.body.insertAdjacentHTML("BeforeEnd",Str);
	}
	var Str = '';
	for (i=0;i<aySound.length;i++)
		Str += "<EMBED SRC='"+aySound[i]+"' AUTOSTART='FALSE' HIDDEN='TRUE'>"
	if (IE) auEmb.innerHTML = Str;
	else {
			auEmb.document.open();
			auEmb.document.write(Str);
			auEmb.document.close();
	}
	auCon = IE? document.all.soundfiles:auEmb;
	auCon.control = auCtrl;
}
function auCtrl(whSound,play) {
	if (IE) this.src = play? aySound[whSound]:'';
	else eval("this.document.embeds[whSound]." + (play? "play()":"stop()"))
}
function playSound(whSound) { 
	var shutup = readCookie('shutup');
	if ("do" == shutup) return;
	if (window.auCon) auCon.control(whSound,true); 

}
function stopSound(whSound) { if (window.auCon) auCon.control(whSound,false); }

// R.L.:
function shutup() {
	createCookie('shutup', 'do', 360);
	gotoMainPage();
	//	playSound = function silent() {};
}


/* Cross Browser Sound Script
Copyright © John Davenport Scheuer
Permission granted for use
This credit must stay intact*/
//////////No need to Edit Script/////////
/*
function e_sound(soundobj) {
	if((!document.all)&&(document.getElementById)){
		var thissound= eval("document."+soundobj);
		thissound.Play();
	}
	else if(document.all){
		var a=eval("document.all."+soundobj+".src");
		document.all.sound.src=a;
	}
	else
		return;
}

function shutup() {
	e_sound = function silent() {};
}
*/