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
			  infinite: false,
			  slidesToShow: 3,
			  slidesToScroll: 1,
			  autoplay: false,
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


	//Safety load VPNs
	$('body').on('click', '.k8-sec3__more', function(e) {
		e.preventDefault();
		var $butt = $(this),
				$targ = $( $butt.attr('data-targ') ),
				typ = $butt.attr('data-typ'),
				act = $butt.attr('data-act'),
				$body = $('body'),
				$txt_wr = $targ.find('.modd__txt'),
				$loader = $targ.find('.modd__loader');

		$body.addClass('ov-hidd');
		$targ.css('display', 'block');

		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: k8All.ajaxurl,
			data: {
				'action': act,
				'typ' : typ
			},
			success: function (data) {
				$loader.css('display', 'none');
				$txt_wr.html(data.html);
			}
		});

	});

	$('body').on('click', '.modd__clz', function(e) {
		e.preventDefault();
		var $butt = $(this),
				$body = $('body'),
				$mod = $butt.parents('.modd');
		$body.removeClass('ov-hidd');
		$mod.css('display', 'none');

		if( $mod.is("#modd_safe") ){
			$mod.find('.modd__loader').css('display', 'block');
			$mod.find('.modd__txt').html('');
		}
	});

});