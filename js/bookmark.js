// (C) 2000 www.CodeLifter.com
// http://www.codelifter.com
// Free for all users, but leave in this header

// message to show in non-IE browsers
var txt = "Bookmark Us!"

// url you wish to have bookmarked
var url = "http://www.stanfordtravel.com";

// caption to appear with bookmark
var who = "Stanford Travel - South America, Galapagos Island Cruises"

// do not edit below this line
// ===========================

var ver = navigator.appName
var num = parseInt(navigator.appVersion)
if ((ver == "Microsoft Internet Explorer")&&(num >= 4)) {
   document.write('<A HREF="javascript:window.external.AddFavorite(url,who);" ');
   document.write('onMouseOver=" window.status=')
   document.write("txt; return true ")
   document.write('"onMouseOut=" window.status=')
   document.write("' '; return true ")
   document.write('">'+ txt + '</a>')
}else{
   txt += "  (Ctrl+D)"
   document.write(txt)
} 

