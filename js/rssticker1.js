// -------------------------------------------------------------------
// Advanced RSS Ticker (Ajax invocation) core file
// Author: Dynamic Drive (http://www.dynamicdrive.com)
// -------------------------------------------------------------------

//Relative URL syntax:
var lastrssbridgeurl="lastrss/bridge1.php"

//Absolute URL syntax. Uncomment below line if you wish to use an absolute reference:
//var lastrssbridgeurl="http://"+window.location.hostname+"/lastrss/bridge.php"

////////////No need to edit beyond here//////////////

function createAjaxObj(){
var httprequest=false
if (window.XMLHttpRequest){ // if Mozilla, Safari etc
httprequest=new XMLHttpRequest()
if (httprequest.overrideMimeType)
httprequest.overrideMimeType('text/xml')
}
else if (window.ActiveXObject){ // if IE
try {
httprequest=new ActiveXObject("Msxml2.XMLHTTP");
} 
catch (e){
try{
httprequest=new ActiveXObject("Microsoft.XMLHTTP");
}
catch (e){}
}
}
return httprequest
}

// -------------------------------------------------------------------
// Main RSS Ticker Object function
// rssticker_ajax(RSS_id, cachetime, divId, divClass, delay, optionallogicswitch)
// -------------------------------------------------------------------

function rssticker_ajax(RSS_id, cachetime, divId, divClass, delay, logicswitch, dispchar){
this.RSS_id=RSS_id //Array key indicating which RSS feed to display
this.cachetime=cachetime //Time to cache feed, in minutes. 0=no cache.
this.tickerid=divId //ID of ticker div to display information
this.delay=delay //Delay between msg change, in miliseconds.
this.logicswitch=(typeof logicswitch!="undefined")? logicswitch : ""
this.dispchar=(typeof dispchar!="undefined")? dispchar : ""
this.mouseoverBol=0 //Boolean to indicate whether mouse is currently over ticker (and pause it if it is)
this.pointer=0
this.opacitysetting=0.2 //Opacity value when reset. Internal use.
this.title=[], this.link=[], this.description=[], this.pubdate=[], this.location=[], this.forecast1=[], this.forecast2=[] //Arrays to hold each component of an RSS item
this.ajaxobj=createAjaxObj()

this.timer=[]

document.write('<div id="'+divId+'" class="'+divClass+'" ></div>')
if (window.getComputedStyle) //detect if moz-opacity is defined in external CSS for specified class
this.mozopacityisdefined=(window.getComputedStyle(document.getElementById(this.tickerid), "").getPropertyValue("-moz-opacity")==1)? 0 : 1
this.getAjaxcontent()
}

// -------------------------------------------------------------------
// getAjaxcontent()- Makes asynchronous GET request to "bridge.php" with the supplied parameters
// -------------------------------------------------------------------

rssticker_ajax.prototype.getAjaxcontent=function(){
if (this.ajaxobj){
var instanceOfTicker=this
var parameters="id="+encodeURIComponent(this.RSS_id)+"&cachetime="+this.cachetime+"&bustcache="+new Date().getTime()
this.ajaxobj.open('GET', lastrssbridgeurl+"?"+parameters, true)
this.ajaxobj.onreadystatechange=function(){instanceOfTicker.initialize()}
this.ajaxobj.send(null)
}
}

// -------------------------------------------------------------------
// initialize()- Initialize ticker method.
// -Gets contents of RSS content and parse it using JavaScript DOM methods 
// -------------------------------------------------------------------

rssticker_ajax.prototype.initialize=function(){ 
if (this.ajaxobj.readyState == 4){ //if request of file completed
if (this.ajaxobj.status==200){ //if request was successful
var xmldata=this.ajaxobj.responseXML
if(xmldata.getElementsByTagName("item").length==0){ //if no <item> elements found in returned content
//document.getElementById(this.tickerid).innerHTML="<b>Error</b> fetching remote RSS feed!<br />"+this.ajaxobj.responseText
document.getElementById(this.tickerid).innerHTML=this.ajaxobj.responseText
return
}
var instanceOfTicker=this
this.feeditems=xmldata.getElementsByTagName("item")
//Cycle through RSS XML object and store each peice of an item inside a corresponding array
for (var i=0; i<this.feeditems.length; i++){

this.title[i]=this.feeditems[i].getElementsByTagName("title")[0].firstChild.nodeValue
this.location[i]=this.feeditems[i].getElementsByTagName("location")[0].firstChild.nodeValue
this.description[i]=this.feeditems[i].getElementsByTagName("description")[0].firstChild.nodeValue
this.pubdate[i]=this.feeditems[i].getElementsByTagName("pubDate")[0].firstChild.nodeValue
this.link[i]=this.feeditems[i].getElementsByTagName("link")[0].firstChild.nodeValue
this.forecast1[i]=this.feeditems[i].getElementsByTagName("forecast1")[0].firstChild.nodeValue
this.forecast2[i]=this.feeditems[i].getElementsByTagName("forecast2")[0].firstChild.nodeValue

clearTimeout(this.timer[i])

}
document.getElementById(this.tickerid).onmouseover=function(){instanceOfTicker.mouseoverBol=1}
document.getElementById(this.tickerid).onmouseout=function(){instanceOfTicker.mouseoverBol=0}
this.rotatemsg()
}

setTimeout(function(){instanceOfTicker.getAjaxcontent()}, this.cachetime*1000) //update container every second=1000 milisec

}
}

// -------------------------------------------------------------------
// rotatemsg()- Rotate through RSS messages and displays them
// -------------------------------------------------------------------

rssticker_ajax.prototype.rotatemsg=function(){
var instanceOfTicker=this
if (this.mouseoverBol==1) //if mouse is currently over ticker, do nothing (pause it)
setTimeout(function(){instanceOfTicker.rotatemsg()}, 100)
else{ //else, construct item, show and rotate it!
var tickerDiv=document.getElementById(this.tickerid)
//var linktitle='<div class="rsstitle"><a href="'+this.link[this.pointer]+'">'+this.title[this.pointer]+'</a></div>'

var linktitle='<div class="rsstitle"><img src="'+this.link[this.pointer]+'"></a></div>'
var title='<div class="rsstitle">'+this.title[this.pointer]+'</div>'
var description='<div class="rssdescription">'+this.description[this.pointer]+'</div>'
var feeddate='<div class="rssdate">'+this.pubdate[this.pointer]+'</div>'
if (this.logicswitch.indexOf("description")==-1) description=""
if (this.logicswitch.indexOf("date")==-1) feeddate=""

var tickercontent=linktitle+feeddate+description //STRING FOR FEED CONTENTS 

this.fadetransition("reset") //FADE EFFECT- RESET OPACITY

//tickerDiv.innerHTML=tickercontent

var rsslocation=document.getElementById("rsslocation")
var rsstitle=document.getElementById("rsstitle")
var rssdate=document.getElementById("rssdate")
var rssdescription=document.getElementById("rssdescription")
var rssimage=document.getElementById("rssimage")
var tabcurrent=document.getElementById("tabcurrent")
var rssforecast1=document.getElementById("rssforecast1")
var rssforecast2=document.getElementById("rssforecast2")

//alert(1)
rsslocation.innerHTML=this.location[this.pointer]+'';
if(this.title[this.pointer]=="�")
	rsstitle.innerHTML="�";
else
	rsstitle.innerHTML=this.title[this.pointer]+"&deg;"+this.dispchar;
rssdate.innerHTML=this.pubdate[this.pointer];
rssdescription.innerHTML=this.description[this.pointer];
rssimage.src=this.link[this.pointer];

rssforecast1.innerHTML=this.forecast1[this.pointer];
rssforecast2.innerHTML=this.forecast2[this.pointer];

//alert(this.forecast2[this.pointer])

///*
if(this.dispchar == " C"){
if(this.title[this.pointer]>-20 && this.title[this.pointer]<-9)
	rsstitle.style.color = "#ffffff";
if(this.title[this.pointer]>-10 && this.title[this.pointer]<-4)
	rsstitle.style.color = "#ccffff";
if(this.title[this.pointer]>-5 && this.title[this.pointer]<1)
	rsstitle.style.color = "#99ffff";
if(this.title[this.pointer]>0 && this.title[this.pointer]<6)
	rsstitle.style.color = "#66ccff";
if(this.title[this.pointer]>5 && this.title[this.pointer]<11)
	rsstitle.style.color = "#54a9ff";
if(this.title[this.pointer]>10 && this.title[this.pointer]<16)
	rsstitle.style.color = "#ccff99";
if(this.title[this.pointer]>15 && this.title[this.pointer]<21)
	rsstitle.style.color = "#ffff99";
if(this.title[this.pointer]>21 && this.title[this.pointer]<26)
	rsstitle.style.color = "#ffcc66";
if(this.title[this.pointer]>25 && this.title[this.pointer]<31)
	rsstitle.style.color = "#ff9966";
if(this.title[this.pointer]>30 && this.title[this.pointer]<36)
	rsstitle.style.color = "#cc6666";
if(this.title[this.pointer]>35 && this.title[this.pointer]<40)
	rsstitle.style.color = "#d14949";
} else {
if(this.title[this.pointer]>10 && this.title[this.pointer]<21)
	rsstitle.style.color = "#ccffff";
if(this.title[this.pointer]>20 && this.title[this.pointer]<31)
	rsstitle.style.color = "#99ffff";
if(this.title[this.pointer]>30 && this.title[this.pointer]<41)
	rsstitle.style.color = "#66ccff";
if(this.title[this.pointer]>40 && this.title[this.pointer]<51)
	rsstitle.style.color = "#54a9ff";
if(this.title[this.pointer]>50 && this.title[this.pointer]<61)
	rsstitle.style.color = "#ccff99";
if(this.title[this.pointer]>60 && this.title[this.pointer]<71)
	rsstitle.style.color = "#ffff99";
if(this.title[this.pointer]>70 && this.title[this.pointer]<81)
	rsstitle.style.color = "#ffcc66";
if(this.title[this.pointer]>80 && this.title[this.pointer]<91)
	rsstitle.style.color = "#ff9966";
if(this.title[this.pointer]>90 && this.title[this.pointer]<101)
	rsstitle.style.color = "#cc6666";
if(this.title[this.pointer]>100 && this.title[this.pointer]<110)
	rsstitle.style.color = "#d14949";
}
//*/


this.fadetimer1=setInterval(function(){instanceOfTicker.fadetransition('up', 'fadetimer1')}, 100) //FADE EFFECT- PLAY IT

this.pointer = (this.pointer<this.feeditems.length-1)? this.pointer+1 : 0
this.timer[this.pointer]=setTimeout(function(){instanceOfTicker.rotatemsg()}, this.delay) //update container every second
}
}

// -------------------------------------------------------------------
// fadetransition()- cross browser fade method for IE5.5+ and Mozilla/Firefox
// -------------------------------------------------------------------

rssticker_ajax.prototype.fadetransition=function(fadetype, timerid){
var tickerDiv=document.getElementById(this.tickerid)
if (fadetype=="reset")
this.opacitysetting=0.2
if (tickerDiv.filters && tickerDiv.filters[0]){
if (typeof tickerDiv.filters[0].opacity=="number") //IE6+
tickerDiv.filters[0].opacity=this.opacitysetting*100
else //IE 5.5
tickerDiv.style.filter="alpha(opacity="+this.opacitysetting*100+")"
}
else if (typeof tickerDiv.style.MozOpacity!="undefined" && this.mozopacityisdefined){
tickerDiv.style.MozOpacity=this.opacitysetting
}
if (fadetype=="up")
this.opacitysetting+=0.2
if (fadetype=="up" && this.opacitysetting>=1)
clearInterval(this[timerid])
}