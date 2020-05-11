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
});