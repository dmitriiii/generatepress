<?php /**
 * Class for interaction with Google Analitics
 */
class M5Ga
{

	static function getGa(){
		if (!get_field('m5_opt_ga', 'option'))
			return;

		the_field('m5_opt_ga_tr', 'option');
		$m5_opt_ga_aff = get_field('m5_opt_ga_aff', 'option');

		if( !is_array($m5_opt_ga_aff) )
			return '<p>Provide Affiliate Links</p>';
		if( count($m5_opt_ga_aff) == 0 )
			return '<p>Provide valid Affiliate Links</p>';

		ob_start();
		$affArr=[];
		foreach ($m5_opt_ga_aff as $item) {
			$affArr[] = $item['aff_link'];
		}
		// echo '<pre style="display: none;">';
		// print_r($m5_opt_ga_aff);
		// print_r($affArr);
		// echo '</pre>';
		?>
    <script>
			jQuery(document).ready(function($) {
				var m5ga = {
					linkz : <?php echo json_encode($affArr); ?>,
					getLinkz : function(){
						return this.linkz
					},
					isInArray : function(value, array) {
					  return array.indexOf(value) > -1;
					}
					// setEventz: function(){

					// },
					// init: function(){
					// 	this.setEventz();
					// }
				};
				// m5ga.init();

				$('body').on('click', 'a[href*="/link/"]', function(e) {
					// e.preventDefault();
					var $link = $(this),
							href = $link.attr('href');
			  	// console.log('work2');

			  	if ( m5ga.isInArray( href, m5ga.linkz ) ) {
			  		console.log('worki');
			  		gtag('event', 'Click on Affiliate Link', {
						  'event_category': href,
						  // 'event_label': 'cust Label',
						  // 'value': '111'
						});
			  	}
					// console.log('');

					// e.preventDefault();
					// console.log('fewfewfwfw');
					// return false;
					// setTimeout( function() {
					// 	window.location = $(this).attr('href');
					// }, 500);
				});

				// console.log( m5ga.getLinkz() );
			});
		</script>
		<?php
  	return ob_get_clean();
	}
}