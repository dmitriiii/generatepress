jQuery(document).ready(function($){

	// load youtube iframe on click
	$('body').on('click', '.k8_yt-link', function(event) {
		event.preventDefault();
		var $link = $(this),
		    $wrr = $link.parents('.k8_yt-wrr'),
		    url = $link.attr('href'),
		    w = $wrr.width(),
		    h = $wrr.height();
		
		// console.log(w);
		// console.log(h);

		var htm = '<iframe width="' + w + '" height="' + h + '" src="https://www.youtube.com/embed/' + url + '?autoplay=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
		$wrr.html(htm);
		return false;
	});


	// SLIDER
	if( $('.k8-sl').length > 0 ){
		
		$('.k8-sl').each(function(index, el) {
			var $wrr = $(el).parents('.k8-sl__wrr'),
					$prev = $wrr.find('.k8-sl__prev'),
					$next = $wrr.find('.k8-sl__next');
			
			$(el).slick({
			  infinite: true,
			  slidesToShow: 3,
			  slidesToScroll: 1,
			  autoplay: true,
			  prevArrow: $prev,
			  nextArrow: $next,
			  speed: 1000,
			  autoplaySpeed: 3000,
			  responsive: [
			    {
			      breakpoint: 768,
			      settings: {
			        arrows: false,
			        centerMode: true,
			        slidesToShow: 1
			      }
			    }
		  	]
			});
		});
	}
	

	// STICKY
	if( $('.k8_sticky').length > 0 ){
		// console.log( $('#site-navigation').outerHeight() );
		var h = $('#site-navigation').outerHeight();
		h = h + 20;
		$(".k8_sticky").stick_in_parent({
			offset_top : h
		});
	}

 
	// Succesfull captcha
	function k8CaptchaSucc( $obj ){
		var $form = $('.k8-capt__form');
		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: k8All.ajaxurl,
			data: {
				'action': 'k8_ajx_captcha_succ',
				'dataSubm' : $form.serializeArray()
			},
			success: function (data) {
				$form.html(data.html);
				// console.log(data);
			}
		});
	}
	window.k8CaptchaSucc = k8CaptchaSucc;



});