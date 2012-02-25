(function($){
	
	$.fn.customSlider = function(param) { 

		var defaults = {  
			duration: 400,
			content_selector: 'ul',
			prev_text: 'Previous',
			next_text: 'Next',
			auto_hiding: true
		};  

		var options;

		var $container;
		var $content;
		var $content_width;

		var $slider_wrapper;

		var $prev;
		var $next;

		var methods = {

			init: function() {

				options = $.extend(defaults, param);

				return this.each(function() {  

					$container = $(this).addClass('slider');

					/* create wrapper */
					$slider_wrapper = $(document.createElement('div')).addClass('slider-wrapper');

					/* select container and make it infinite */
					$content = $(options.content_selector, $container).width(9999).wrap($slider_wrapper).css({position: 'relative', left: 0});
					methods.calculateWidth();

					/* update $slider_wrapper */
					$slider_wrapper = $content.parent();

					/* add prev / next buttons */
					methods.initButtons();

					return true;

				});

			},

			prevClick: function(event) {
				event.preventDefault();

				var left = parseFloat($content.css('left'));
				var content_right_width = $content_width - ($slider_wrapper.width() - left); 
				/* if there is something left */
				if ( ($slider_wrapper.width() + content_right_width ) < $content_width ) {

					var content_left_width = $content_width - ( content_right_width + $slider_wrapper.width() );

					/* if there's more than one slide */
					if ( content_left_width > $slider_wrapper.width() ) {
						content_left_width = $slider_wrapper.width();
					}

					$content.animate({ left: left+content_left_width }, options.duration);

				}

			},

			nextClick: function(event) {
				event.preventDefault();

				var left = parseFloat($content.css('left'));
				/* if there is something right */
				if ( ($slider_wrapper.width() - left ) < $content_width ) {

					var content_right_width = $content_width - ($slider_wrapper.width() - left);

					/* if there's more than one slide */
					if ( content_right_width > $slider_wrapper.width() ) {
						content_right_width = $slider_wrapper.width();
					}

					$content.animate({ left: left-content_right_width }, options.duration);

				}

			},

			initButtons: function() {

				var left = parseFloat($content.css('left'));
				var content_right_width = $content_width - ($slider_wrapper.width() - left);
				var content_left_width = $content_width - ( content_right_width + $slider_wrapper.width() );				

				if ( !options.auto_hiding || content_right_width > 0 || content_left_width > 0) {
					$prev = $(document.createElement('a')).html(options.prev_text).addClass('prevButton').attr('href', '#').click(methods.prevClick);
					$next = $(document.createElement('a')).html(options.next_text).addClass('nextButton').attr('href', '#').click(methods.nextClick);

					$container.append($prev).append($next);
				}

			},

			calculateWidth: function() {

				$content_width = 0;

				$content.children().each(function(){
					$content_width += $(this).outerWidth(true);
				});

			}

		}

		if ( methods[param] ) {
			return methods[param].apply( this, Array.prototype.slice.call( arguments, 1 ));
		} else if ( typeof param === 'object' || ! param ) {
			return methods.init.apply( this, arguments );
		}

		return methods;

	};
	
})(jQuery);