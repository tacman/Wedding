jQuery(function($){

	$(document).krioImageLoader();
	
	/* navigation */
	$('nav a').click(function(ev){
		ev.preventDefault();
		
		$.scrollTo($(this).attr('href'), 220);
	});
	
	/* slider */
	$('#slider').customSlider();
	
	/* fancybox */
	$('.fancybox').fancybox({
		//showCloseButton : false,
		overlayColor: '#68787b',
		overlayOpacity: 0.78,
		titlePosition: 'inside',
		padding: 27
	});
	
	/* photos hover */
	$('#photos').hover(
		function() {
			$('.prevButton, .nextButton').fadeIn(150);
		},
		function() {
			$('.prevButton, .nextButton').fadeOut(150);
		}
	);
	
	/* photos rotation */
	var degrees = [-1.7, 0.2, 3.2, -1.2]
	$('#photos li').each(function(e){
		var degree = degrees[e%4];
		$(this).css({
			transform: 'rotate('+degree+'deg)',
			'-webkit-transform': 'rotate('+degree+'deg)',
			'-moz-transform': 'rotate('+degree+'deg)',
			'-ms-transform': 'rotate('+degree+'deg)',
			'-o-transform': 'rotate('+degree+'deg)'
		});
	});
	
	/* photos hovers */
	$('#photos a').hover(
		function() {
			// create hover div if there's not one
			if ( !$('.hover', this).length ) {
				var $hover = $(document.createElement('div')).addClass('hover').appendTo(this);
			}
			else {
				var $hover = $('.hover', this);
			}
			$hover.fadeIn(150);
		},
		function() {
			var $hover = $('.hover', this);
			$hover.fadeOut(220);
		}
	).click(function(){
		/* beacasue of IE */
		var $hover = $('.hover', this);
		$hover.hide();
	});
	
	/* about hovers */
	$('#about_us area')
		.hover(
			function() {
				// find parent
				var $parent = $(this).parents('div').get(0);

				// fade in
				$('.hover', $parent).fadeIn(150);
			},
			function() {
				// find parent
				var $parent = $(this).parents('div').get(0);

				// fade in
				$('.hover', $parent).fadeOut(220);
			}
		)
		.fancybox({
			showCloseButton : false,
			overlayColor: '#68787b',
			overlayOpacity: 0.78
		});
	
});
