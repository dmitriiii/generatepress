jQuery(document).ready(function($) {
	console.log( wpApiSettings );
	var count = 1,
			$tbl = $('.pills-aff-tbl'),
			count_end = parseInt( $tbl.find('tbody>tr:last-child>td[data-counter]').text() );
	console.log(count_end);

	window.m5AffCheck = function()
	{
		/* This IF block has nothing to do with the OP. It just resets everything so the demo can be ran more than once. */
		if (count===1) {
			// $('.quoteList').empty();
			// $('td[data-status]').removeClass('bg-info').addClass('bg-secondary');
			$tbl.find('tbody>tr').removeClass('m5-err').removeClass('m5-succ').addClass('m5-procc');
			// count = 0;
		}
		var $counter_td = $tbl.find("tbody>tr>td[data-counter='"+count+"']"),
		$counter_tr = $counter_td.parent('tr'),
		formData = {
			'count': count,
			'link': $counter_td.siblings('[data-link]').text(),
			'url': $counter_td.siblings('[data-url]').text()
		};
		$.ajax({
			/* The whisperingforest.org URL is not longer valid, I found a new one that is similar... */
			url: wpApiSettings.root + 'm5/affCheck/',
			async: true,
			dataType: 'json',
			method: 'POST',
			// Setting nonce to be sure that user is logged in
			beforeSend: function ( xhr ) {
	      xhr.setRequestHeader( 'X-WP-Nonce', wpApiSettings.nonce );
	    },
			data: formData,
			success:function(data){
				console.log(data);
				$counter_tr.removeClass('m5-procc').addClass(data.className);
				// $counter_td.siblings('[data-status]').removeClass('bg-secondary').addClass(data.className);
				$counter_td.siblings('[data-status]').text(data.target);
				// $('.quoteList').append('<li>' + data.quote +'</li>');
				count++;
				if (count <= count_end) m5AffCheck();
				// if (count <= 90) m5AffCheck();
			}
		});
	}
	$('body').on('submit', '.m5_gsearch', function(event) {
		event.preventDefault();
		// alert('wqdff');

		let $form = $(this);
		let $results = $form.siblings('.results');
		let $results_cont =	$results.find(">:first-child");
		let $prld = $results.find('.prld');
		let formData = {
			'what': $form.find("input[name='what']").val(),
			'caseCheck': $form.find("input[name='caseCheck']")[0].checked
		};
		$prld.addClass('active');
		$results_cont.html('');
		$.ajax({
			url: wpApiSettings.root + 'm5/globalSearch/',
			async: true,
			dataType: 'json',
			method: 'POST',
			// Setting nonce to be sure that user is logged in
			beforeSend: function ( xhr ) {
	      xhr.setRequestHeader( 'X-WP-Nonce', wpApiSettings.nonce );
	    },
			data: formData,
			success:function(data){
				$results_cont.html(data.html);
				$prld.removeClass('active');
				// console.log(data);
				// if (count <= 90) m5AffCheck();
			}
		});
		/* Act on the event */
	});


	$('body').on('click', '.show_internalz', function(event) {
		event.preventDefault();
		let $btn = $(this);
		let $form = $btn.parents('form');
		let $results = $form.siblings('.results');
		let $results_cont =	$results.find(">:first-child");
		let $prld = $results.find('.prld');
		let formData = {
			'what': $btn.attr('data-val'),
			// 'caseCheck': $form.find("input[name='caseCheck']")[0].checked
		};
		$prld.addClass('active');
		$results_cont.html('');
		
		$.ajax({
			url: wpApiSettings.root + 'm5/internalNofollow/',
			async: true,
			dataType: 'json',
			method: 'POST',
			// Setting nonce to be sure that user is logged in
			beforeSend: function ( xhr ) {
	      xhr.setRequestHeader( 'X-WP-Nonce', wpApiSettings.nonce );
	    },
			data: formData,
			success:function(data){
				$results_cont.html(data.html);
				$prld.removeClass('active');
				// console.log(data);
				// if (count <= 90) m5AffCheck();
			}
		});

	});
});
