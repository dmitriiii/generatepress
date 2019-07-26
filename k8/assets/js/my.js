jQuery(document).ready(function($){
	// Scroll to block
	$('body').on('click', '.k8-repl__link', function(e) {
		e.preventDefault();
		var blck = $(this).attr('href');
		$('html, body').animate({
      scrollTop: $(blck).offset().top
    }, 2000);
	});

});