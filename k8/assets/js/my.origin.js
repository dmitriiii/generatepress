jQuery(document).ready(function($){


	// let retrievedObject = localStorage.getItem('k8PhnSucc');
	// console.log(){

	// }

	const retrieveLocal = function(){
		// console.log('Bananza!');
		let k8PhnSucc = localStorage.getItem('k8PhnSucc');
		if( k8PhnSucc != null ){

			let $body = $('body'),
					parsedd = JSON.parse(k8PhnSucc),
					notif = "<div class='m5-notif'>" +
										"<span class='m5-notif__close'><i class='fas fa-times'></i></span>" +
										"<div class='m5-notif__inner'>" +
											"<div class='m5-notif__txt'>" +
												"<p>Du hast die telefonische Verifikation bereits abgeschlossen.  <br />Dein Gutscheincode lautet: <b>" + parsedd.code +
												"</b>. Du kannst diesen Coupon hier <a rel='nofollow' target='_blank' href='" + parsedd.redirect_url + "'>" + parsedd.anbieter + "</a> einlösen.</p>" +
											"</div>" +
											"<div class='m5-notif__btnz'>" +
												"<button class='m5-notif__btn'>Ich habe den Coupon bereits aktiviert</button>" +
											"</div>" +
										"</div>" +
									"</div>";
			$body.prepend(notif);

			// localStorage.getItem('testObject');
			// console.log('Not null!');
			// console.log(parsedd);
		}
		// console.log(k8PhnSucc);
		$('body').on('click', '.m5-notif__close', function(e) {
			e.preventDefault();
			let $cls = $(this),
					$notif = $cls.closest('.m5-notif');
			$notif.css('display','none');
		});
		$('body').on('click', '.m5-notif__btn', function(e) {
			e.preventDefault();
			let $btn = $(this),
					$notif = $btn.closest('.m5-notif');
			$notif.css('display','none');
			localStorage.removeItem('k8PhnSucc')
		});
	}
	retrieveLocal();

	const progrezBar = function( obj ){
		// progressbar.js@1.0.0 version is used
		// Docs: http://progressbarjs.readthedocs.org/en/1.0.0/
		let bar = new ProgressBar.Circle( obj.id, {
		  color: '#3C9',
		  // This has to be the same size as the maximum width to
		  // prevent clipping
		  strokeWidth: 6,
		  trailWidth: 1,
		  easing: 'easeInOut',
		  duration: 1400,
		  text: {
		    autoStyleContainer: false
		  },
		  from: { color: '#DC143C', width: 1 },
		  to: { color: '#3C9', width: 6 },
		  // Set default step function for all animate calls
		  step: function(state, circle) {
		    circle.path.setAttribute('stroke', state.color);
		    circle.path.setAttribute('stroke-width', state.width);
		    var value = (circle.value() * 10).toFixed(1);
		    if (value === 0) {
		      circle.setText('');
		    } else {
		      circle.setText(value);
		    }
		  }
		});
		bar.text.style.fontSize = '1.4rem';
		bar.animate( obj.to/10 );  // Number from 0.0 to 1.0
	}

	if( $('.k8progress').length > 0 ){
		let $prgrs = $('.k8progress');
		$prgrs.each(function(index, el) {
			// console.log( $(el) );
			progrezBar({
				id: '#' + $(el).attr('id'),
				to: $(el).attr('data-to')
			});
		});
	}



	//Set compare tables equalwidth
	const setEqWidth = function(){
		$('.k8_compare-tbl').each(function(index, el) {
			var	$tbl = $(el),
			$tr =	$tbl.find('tbody>tr:nth-child(2)'),
			$tds = $tr.find('td'),
			amnt = $tds.length -1;
			if( $tbl.parent().hasClass('not-equal-width') ){
				return;
			}
			if( $tds.length > 2 ){
				var wdth = 70 / amnt;
				$tds.each(function(index, el) {
					if( index !== 0 ){
						$(el).css('width', wdth + '%');
					}
				});
			}
		});
	}
	setEqWidth();

	// Count to numbers
	const triggerCountUp = function(elemId,from,to){
		var options = {  
			useEasing: true,
			useGrouping: true,
			separator: ',',
			decimal: '.',
			prefix: '',
			suffix: ''
		};
		var counts = new CountUp(elemId, parseInt(from), parseInt(to), 0, 2, options);
		counts.start();
	}


	//Animation on scroll
	const k8animFun = function(){
		var k8anim = document.querySelectorAll('.k8anim');
		if( k8anim.length > 0 ){
			var observer = new IntersectionObserver((entries) => {
				entries.forEach(entry => {
					if (entry.intersectionRatio > 0) {
						entry.target.classList.add('k8anim--visible');
						//Trigger countTo Animation
						var $el = $(entry.target);
						if (typeof $el.data('k8countup') !== 'undefined') {
							triggerCountUp( $el.attr('id'), $el.attr('data-from'), $el.attr('data-to') );
						}

						// if (typeof $el.data('k8progress') !== 'undefined') {
						// 	// triggerCountUp( $el.attr('id'), $el.attr('data-from'), $el.attr('data-to') );
						// 	progrezBar({
						// 		id:'#'+$el.attr('id'),
						// 	});
						// }


					} else {
						entry.target.classList.remove('k8anim--visible');
					}
				});
			});
			k8anim.forEach(image => {
				observer.observe(image);
			});
		}
	}
	k8animFun();

	//Lazy load contents of html
	const k8laz_loadFun = function(){
		var k8laz_load = document.querySelectorAll('.k8laz_load');
		if( k8laz_load.length > 0 ){
			var observer = new IntersectionObserver((entries) => {
				entries.forEach(entry => {
			    if (entry.intersectionRatio > 0) {
			      var	$el = $(entry.target),
			      		datAtr = $el.data();
			      $.ajax({
							type: 'POST',
							dataType: 'json',
							url: k8All.ajaxurl,
							data: datAtr,
							success: function (data) {
								$el.html( data.html );
								$el.addClass('loaded');
								setEqWidth();
								k8animFun();
							} // success
						});// Ajax
			      observer.unobserve(entry.target);
			    }
			  });
			});

			k8laz_load.forEach(image => {
				observer.observe(image);
			});
		}
	}
	k8laz_loadFun();


	// Set blocks with equal height
	$(window).load(function() {
		// Select and loop the container element of the elements you want to equalise
		$('.k8_desktop .eq-h-row').each(function(){
			// Cache the highest
			var highestBox = 0;
			// Select and loop the elements you want to equalise
			$('.eq-h-blck', this).each(function(){
				// If this box is higher than the cached highest then store it
				if($(this).height() > highestBox) {
					highestBox = $(this).height();
				}
			});
			// Set the height of all those children to whichever was highest
			$('.eq-h-blck',this).height(highestBox);
		});


		if( $('.k8_acf_ifr_url').length > 0 ){
			$('.k8_acf_ifr_url').each(function(index, el) {
				var f = document.createElement('iframe');
		    f.src = $(el).attr('data-url');
		    f.hidden = true;
		    f.style.visibility = 'hidden';
		    $('body').append(f);
			});
		}

	});

	function sentGoogleAnalitic( gtagOpts ){
		if( gtag ){
			gtag(...gtagOpts);
		}
	}

	// load youtube iframe on click
	$('body').on('click', '.k8_yt-link', function(event) {
		event.preventDefault();
		sentGoogleAnalitic([
			'event', 'a1_play', {
		  'event_category': 'a1_videos',
			}
		]);
		
		var $link = $(this),
				$wrr = $link.parents('.k8_yt-wrr'),
				url = $link.attr('data-href'),
				w = $wrr.width(),
				h = $wrr.height();
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
				centerMode: false,
				variableWidth: false,
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

	//GALLERY
	if( $('.k8-lg__wrr').length > 0 ){
		$('.k8-lg__wrr').lightGallery({
			selector: '.k8-lg__item'
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
				bg = $butt.attr('data-bg'),
				$body = $('body'),
				$txt_wr = $targ.find('.modd__txt'),
				$loader = $targ.find('.modd__loader');

		$body.addClass('ov-hidd');
		$targ.css('display', 'block');
		// $txt_wr.addClass(bg);
		$txt_wr.attr('class', bg + ' modd__txt');

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