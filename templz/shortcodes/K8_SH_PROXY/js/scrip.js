jQuery(document).ready(function($) {
	function validURL(str) {
		var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
		  '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name
		  '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
		  '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
		  '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
		  '(\\#[-a-z\\d_]*)?$','i'); // fragment locator
		return !!pattern.test(str);
	}

	$('body').on('submit', '.proxx__form', function(event) {
		event.preventDefault();
		let $form = $(this),
				$input = $form.find("[name='url']"),
				$res = $('.proxx__res'),
				value = $input.val().trim(),
				proxy_base = $form.attr('action');

		$res.html("");

		//Check if empty
		if( !value ) {
			$res.html("<p class='proxx__warn'>Url-Feld darf nicht leer sein</p>");
			return;
		}

		//Check if url entered
		if( !validURL(value) ){
			$res.html("<p class='proxx__warn'>Bitte geben Sie eine gültige Adresse für die Website ein</p>");
			return;
		}

		window.open(proxy_base + value, '_blank');

		console.log($form);
		console.log($input);
		console.log($res);
		console.log(proxy_base);
	});
});
