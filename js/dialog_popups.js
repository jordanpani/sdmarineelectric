var timeoutId;
var overImg;

$(document).ready( function () {

	//////////////////
	var htmlForPopupLayers = 
	"<div id='dialog' style='position: absolute'>" +
		"<img id='img_loading' src='images/loader1.gif' alt='loading' style='visibility: hidden'>" +
		"<div id='dialog_content'></div>" + 
			"<img id='img_magnify' src='images/magnifying-glass-plus.png' width='90' height='48' style='visibility: hidden; position: absolute;'> " +
	"</div>";
	//////////////////
	$("body").append(htmlForPopupLayers);
	//////////////////////////////////////
		
	$('#dialog').draggable();	
	$('div.popup a.popup_text').click(popup_click);
	//$('.img_thumb').click(popup_click); //make an image with this certain class show a larger picture
	//$('.popup_hyperlink').click(popup_click);
	
	//to add a popup link1
	//<img src="images/a.jpg" class="img_thumb" href="images/b.jpg" alt="Taj Mahal Tour, Agra, India">
	//$('#red_fort').click( red_fort_click);
	
});

function openPageInDialog(e, page) {
	var l = e.pageX; //left 
	var t = e.pageY; //top
	showBlankDialogInMiddle(l, t);	
	getDialogHtmlFromAjax(page, null);
}

/*
function openPageInAnimatedDialogOnTop(e, page) {
	var height_animation_length = 2000; //milliseconds
	var top_minimum = 200;
	
	var l = e.pageX; //left 
	var t = e.pageY; //top
	showBlankDialogInMiddle(l, t);

	getDialogHtmlFromAjax(page, function() {
		var dialog = $('#dialog'); //dialog where html will be showed in a div
		var height = dialog.height();
		console.log("t:" + t + "\r\n" + "height:" + height);
		t = t - height; //place dialog above mouse position
		
		if (t < top_minimum) t = top_minimum;
		dialog.animate({ top : t }, height_animation_length, 'linear');
	});
}
*/

function showBlankDialogInMiddle(l, t) {
	var dialog = $('#dialog'); //dialog where html will be showed in a div
	
	//$('#img_loading').css('visibility', 'visible'); //show loading img

	//HOW TO CALCULATE CENTER OF SCREEN
	//ignore the left coordinate of click
	   //var top = ($(window).height() - $(this).outerHeight()) / 2;
	var dialogLeft ;
	var dialogWidth = dialog.width();

	if (isNaN(dialogWidth)) {
		dialogLeft = 0;
	} else {
		var pageWidth = window.innerWidth;
		var spaceLeft = pageWidth - dialogWidth;
		dialogLeft = spaceLeft / 2;
	}

	
    //$(this).css({position:'absolute', margin:0, top: (top > 0 ? top : 0)+'px', left: (left > 0 ? left : 0)+'px'});
	dialog.css({'visibility': 'visible', 'margin-left': 'auto', 'margin-right': 'auto', 'left': dialogLeft + 'px', 'top' : t + 'px' } );	//set position and visibility	
				
	//dialog.css({'left': l, 'top': t});	//set position 
	dialog.show();
}


function getDialogHtmlFromAjax(page, callback) {

/* get is shorthand for 
$.ajax({
  url: url,
  data: data,
  success: success,
  dataType: dataType
});*/
	
	$.ajax({
	  url: page,
	  data: null,
	  async: true,
	  success: function(data) {
			//console.log(data);
			var dialog_content=	$('#dialog_content'); //get content area of dialog
			dialog_content.html(data);	//load content
			
			//var dialog = $('#dialog');
			//dialog.slideDown(); //start sliding down the dialog while an asynchronous ajax is happening
	
			$('#img_loading').css('visibility', 'hidden');		//stop loading img (hide)
			if (callback) callback();
	  	},
	  dataType: 'html'}).error(dialog_error); //add type 'html' or xml
	
}

function openDialogWithContent(e, contentAreaHtml, callback) {
	
	var page = "dialog-template.dwt";
	
	$.get(page, null, function(data) {
		var dialog_content=	$('#dialog_content'); //get content area of dialog
		dialog_content.html(data);	//load popup
		//console.log(data);
				
		var content_area = $('#dialog_content_area', dialog_content);
		content_area.html(contentAreaHtml); //load the image somwehere in the returned html (ajax server data)

		$('#img_loading').css('visibility', 'hidden');		//stop loading img (hide)
		
		//////////////////////////////////
		var l = e.pageX; //left 
		var t = e.pageY; //top
		showBlankDialogInMiddle(l, t);	
		///////////////////////////////////
		
		if (callback) callback();
		
  	}, 'html' ).error(dialog_error); //add type 'html' or xml

}

function dialog_error(jqXHR, textStatus, errorThrown) {
	if (console) {
		console.log("Error loading dialog. Could be invalid link.");
		console.log("Status: " + textStatus);
		console.log("Http Status: " + errorThrown);
	}
	close_dialog_click();
}

function close_dialog_click() {
	var dialog = $('#dialog'); //dialog where html will be showed in a div
	//dialog.slideUp();
	//dialog.fadeOut();
	dialog.hide();
	//dialog.css('visibility', 'hidden');	//set visibility
}


var path = "";//'./popup-dialogs/';



function popup_click(e) {
	var imgClicked = $(e.target);//, 'img');
	//console.log(imgClicked);
	
	var imgUrl = getUrlOfImage(imgClicked);
	if (imgUrl != null)
		OpenDialogWithImageContent(e, imgUrl);
}


function getUrlOfImage(imgClicked) {
	//var bigImageUrl = imgClicked.attr('href');
	
	//IF NECESSARY CAN BE MODIFIED SO THAT 
	//special attribute can be set where the image is stored for popup
	var bigImageUrl = imgClicked.siblings('a.popup').attr('href');
	return bigImageUrl;
}



function OpenDialogWithImageContent(e, image_url) {
	
	var page = "dialog-template.dwt";
	
	$.get(page, null, function(data) {
		var dialog_content=	$('#dialog_content'); //get content area of dialog
		dialog_content.html(data);	//load popup
		//console.log(data);
				
		//create the image html tag
		//might need to specify width and height but for now, don't.
		var img_html = "<img src='" + image_url + "' />";
		//console.log(img_html); 

		var img_content_area = $('#dialog_content_area', dialog_content);
		img_content_area.html(img_html); //load the image somwehere in the returned html (ajax server data)

		//var dialog = $('#dialog');
		//dialog.slideDown(); //start sliding down the dialog while an asynchronous ajax is happening

		$('#img_loading').css('visibility', 'hidden');		//stop loading img (hide)
		
		///////////////////////////////
		var l = e.pageX; //left 
		var t = e.pageY; //top
		showBlankDialogInMiddle(l, t);	
		///////////////////////////
		
  	}, 'html' ).error(dialog_error); //add type 'html' or xml

}
/*
function agra_click(e) {
	var page = path + 'agra.html';
	openPageInDialog(e, page);
}


function shanti_puri(e) {
	var page = path + 'shantipuri_friends_foundation.html';
	openPageInDialog(e, page);
	e.preventDefault();
}

*/