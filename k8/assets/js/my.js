jQuery(document).ready(function($){

	// console.log(k8All);

	// SLIDER
	if( $('.k8-sl').length > 0 ){
		
		$('.k8-sl').each(function(index, el) {
			var $wrr = $(el).parents('.k8-sl__wrr'),
					$prev = $wrr.find('.k8-sl__prev'),
					$next = $wrr.find('.k8-sl__next');
			
			// console.log(el);

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