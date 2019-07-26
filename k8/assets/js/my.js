jQuery(document).ready(function($){
	// Scroll to block
	$('body').on('click', '.k8-repl__link', function(e) {
		e.preventDefault();
		var blck = $(this).attr('href'),
		point = ( $(blck).offset().top - 300 );

		console.log( $(blck).offset().top );
		console.log( point );
		
		$('html, body').animate({
      scrollTop: point
    }, 2000);
	});

});