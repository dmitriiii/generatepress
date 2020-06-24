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
				};
				// m5ga.init();

				$('body').on('click', 'a[href*="/link/"]', function(e) {
					var $link = $(this),
							href = $link.attr('href');
			  	if ( m5ga.isInArray( href, m5ga.linkz ) ) {
			  		// console.log('worki');
			  		gtag('event', 'Click on Affiliate Link', {
						  'event_category': href,
						});
			  	}
				});
			});
		</script>
		<?php
  	return ob_get_clean();
	}
}