
	$(window).load(function(){
      $('.flexslider').flexslider({
        animation: "slide",
		directionNav: false, 
        start: function(slider){
          $('body').removeClass('loading');
        }
      });
    });
	
	$(document).ready(function() {
		$(".fancybox").fancybox({
			openEffect	: 'none',
			closeEffect	: 'none'
		});
	});
	