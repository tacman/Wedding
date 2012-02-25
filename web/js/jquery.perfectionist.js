jQuery(function($){
	
	var img = new Image();
	img.src = 'images/perfectionist.png';

	var $bg = $(document.createElement('div'));
	$bg.css({
		position: 'absolute',
		left: 0,
		top: 0,
		zIndex: 100,
		background: 'url(images/perfectionist.png) 50% 0 no-repeat',
		opacity: 0.5,
		width: '100%',
		height: img.height
	})
	.appendTo('body');
	
	$(document).bind('keydown', 'b', function(){
		$bg.toggle();
	});
	
	$bg.hide();
	
});