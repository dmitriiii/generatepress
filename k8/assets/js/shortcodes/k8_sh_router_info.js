jQuery(document).ready(function($) {
	// alert('dewqwe');
	$('body').on('click', '.m5-tab__button', function(event) {
		event.preventDefault();
		let $curr = $(this),
		    act = 'active',
				trg = $curr.attr('data-target');
		if ( $curr.hasClass(act) ) {
			return false;
		}
		$('.m5-tab__button.'+act).removeClass(act);
		$curr.addClass(act);
		$('.m5-tab__content.'+act).removeClass(act);
		$('#'+trg).addClass(act);
	});



	if ($(".m5-rou__carousel-1").length > 0) {
    $(".m5-rou__carousel-1").each(function (index, el) {
    	// console.log('heeeer');
      var $wrr = $(el).parents(".wrapper");
        // $prev = $wrr.find(".prev"),
        // $next = $wrr.find(".next");
      $(el).slick({
        infinite: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        // autoplay: true,
        autoplay: false,
        centerMode: false,
        variableWidth: false,
        // swipeToSlide: true,
        adaptiveHeight: true,
        // prevArrow: $prev,
        // nextArrow: $next,
        arrows: false,
        speed: 700,
        autoplaySpeed: 2000,
        asNavFor: '.m5-rou__carousel-2',
        responsive: [
          {
            breakpoint: 768,
            settings: {
              arrows: false,
              centerMode: false,
              slidesToShow: 1,
            },
          },
        ],
      });
    });
  }


  if ($(".m5-rou__carousel-2").length > 0) {
    $(".m5-rou__carousel-2").each(function (index, el) {
    	// console.log('heeeer');
      var $wrr = $(el).parents(".wrapper");
        // $prev = $wrr.find(".prev"),
        // $next = $wrr.find(".next");
      $(el).slick({
        infinite: false,
        slidesToShow: 5,
        slidesToScroll: 1,
        // autoplay: true,
        autoplay: false,
        // centerMode: true,
        // adaptiveHeight: true,

        variableWidth: false,
        // prevArrow: $prev,
        // nextArrow: $next,
        arrows: false,
        speed: 700,
        autoplaySpeed: 2000,
        vertical: true,
        focusOnSelect: true,
        verticalSwiping: true,
        asNavFor: '.m5-rou__carousel-1',
        responsive: [
          {
            breakpoint: 768,
            settings: {
              arrows: false,
              centerMode: false,
              slidesToShow: 1,
            },
          },
        ],
      });
    });
  }

  // $()

  //GALLERY

  if ($(".m5-rou__carousel--wrapper-1").length > 0) {
    $(".m5-rou__carousel--wrapper-1").lightGallery({
      selector: ".m5-rou__item-link",
    });
  }
});