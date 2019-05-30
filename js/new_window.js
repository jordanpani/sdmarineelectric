// restores all swapped images
function MM_swapImgRestore() 
{
	var i, x, a = document.MM_sr; 
	for (i = 0; a && i < a.length && (x = a[i]) && x.oSrc; i++) 
		x.src = x.oSrc;
}

// preloads images in a page
function MM_preloadImages() 
{
	var d=document; 
	
	if (d.images)
	{ 
		if (!d.MM_p) 
			d.MM_p=new Array();
			
		var i, j = d.MM_p.length, a = MM_preloadImages.arguments; 
		
		for (i = 0; i < a.length; i++)
			if (a[i].indexOf("#")!=0)
			{
				d.MM_p[j] = new Image; 
				d.MM_p[j++].src = a[i];
			}
	}
}

// swaps an image with another
function MM_swapImage() 
{
	var i, j=0, x, a = MM_swapImage.arguments; 
	
	document.MM_sr = new Array; 
	
	for (i = 0; i < (a.length - 2) ; i += 3)
		if ((x = MM_findObj(a[i])) != null)
		{
			document.MM_sr[j++] = x; 
			if (!x.oSrc) 
				x.oSrc = x.src; 
			x.src = a[i+2];
		}
}


// Opens a new window
function NewWindow(u,n,w,h,f,p,x,y)
{
	var ws = window.screen? 1 : 0;
	var m = Math;
	var C = 'center';
	var R = 'random';
	var M = 'custom';
	var sw = screen.availWidth;
	var sh = screen.availHeight;
	var T = (p == C && ws)?
			(sh - h) / 2 
			: (p == R && ws)? 
				(m.floor(m.random() * (sh - h))) 
				: (p == M)?
					y 
					: 100;
	var L = (p == C && ws)?
			(sw - w) / 2
			: (p == R && ws)?
				(m.floor(m.random() * (sw - w)))
				: (p == M)?
					x 
					: 100;
	var s = 'width=' + w + 'height=' + h + ',top=' + T + ',left=' + L;
	s += (!f || f=='')?
		''
		:',' + f;
		
	win = window.open(u,n,s);
	
	if (win.focus)
		win.focus(); 
	win.resizeTo(w,h);
}
// Bills open window function
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}

function MM_displayStatusMsg(msgStr) { //v1.0
  status=msgStr;
  document.MM_returnValue = true;
}
//-->
