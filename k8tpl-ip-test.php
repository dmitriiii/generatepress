<?php /* Template Name: IP Test
Template Post Type: page */
global $wp;
if( !isset($_GET['ip']) || !filter_var($_GET['ip'], FILTER_VALIDATE_IP) || $_GET['ip'] !== $_SERVER['REMOTE_ADDR'] ){
	header("Location:" . home_url( $wp->request ) ."?ip=" . $_SERVER['REMOTE_ADDR'] );
	die;
}
get_header();
if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<div class="k8-ip__wrr">
		<h1 style="text-align: center;">
			<?php the_title(); ?>
		</h1>
		<div class="k8_tbl-resp k8-ip__tbl">
			
			<table class="k8_compare-tbl mtb-30">
				<tr>
					<th><?php the_post_thumbnail('medium'); ?></th>
					<th><button>Copy Results</button></th>
				</tr>
				<tr data-ip='query'>
					<td>IP Address</td>
					<td><strong></strong></td>
				</tr>
				<tr data-ip='reverse'>
					<td>PTR</td>
					<td><strong></strong></td>
				</tr>
				<tr data-ip='country'>
					<td>Country</td>
					<td><strong></strong></td>
				</tr>
				<tr data-ip='city'>
					<td>City</td>
					<td><strong></strong></td>
				</tr>
				<tr data-ip='lat'>
					<td>Lattitude</td>
					<td><strong></strong></td>
				</tr>
				<tr data-ip='lon'>
					<td>Longitude</td>
					<td><strong></strong></td>
				</tr>
				<tr data-ip='as'>
					<td>ASN</td>
					<td><strong></strong></td>
				</tr>
				<tr data-ip='isp'>
					<td>ISP</td>
					<td><strong></strong></td>
				</tr>
				<tr data-ip='proxy'>
					<td>Proxy</td>
					<td><strong></strong></td>
				</tr>
				<tr data-ip='mobile'>
					<td>Mobile</td>
					<td><strong></strong></td>
				</tr>
				<tr>
					<td>IP type</td>
					<td><strong>Residential (ISP/Broadband)</strong></td>
				</tr>
			</table>
		</div>
		<div class="k8-ip__map">
			<img src="" alt="Your location" style="margin-left: auto; margin-right: auto; display: block;">
		</div>

	</div>
	<?php
	the_content();
endwhile;
else:
endif;

get_footer();?>

<script>
	jQuery(document).ready(function($) {

		(function () {
			const ip = "<?php echo ( isset( $_GET['ip'] ) && filter_var($_GET['ip'], FILTER_VALIDATE_IP) ) ? trim($_GET['ip']) : trim($_SERVER['REMOTE_ADDR']); ?>";
			function reqq( ipAddr ){
				$.ajax({
					type: 'POST',
					dataType: 'json',
					url: "<?php echo admin_url( 'admin-ajax.php' ); ?>",
					data: {
						'action': 'k8_ajx_ip',
						'ip' : ipAddr
					},
					success: function (data) {
						// console.log(data);
						window.localStorage.setItem('k8ip', data.html);
						fillData();
						alert('Request to server');
					}
				});
			}

			function fillData(){
				var parsedObj = JSON.parse( window.localStorage.getItem('k8ip') ),
						$tbl = $('.k8-ip__tbl'),
						$img = $('.k8-ip__map img'),
						urll = '';
				console.log( parsedObj );
				$tbl.find('tr').each(function(index, el) {
					var $elem = $(el),
							attr = $elem.attr( 'data-ip' );
							if( parsedObj[attr] ){
								$elem.find('td strong').html( parsedObj[attr] );
							}
				});
				urll = parsedObj.lat + ',' + parsedObj.lon + '&zoom=15&size=2000x400&maptype=terrain&markers=color:blue|label:S|' + parsedObj.lat + ',' + parsedObj.lon + '&key=AIzaSyBK4XomMibqoAiojTr4ChbeEr3cbVHLXIo';
				$img.attr('src', 'https://maps.googleapis.com/maps/api/staticmap?center=' + encodeURI( urll ));
			}

			// NOT SET
			if( !window.localStorage.getItem('k8ip') ){
				reqq( ip );
				fillData();
				return;
			}

			//SEt but maybe different
			if( window.localStorage.getItem('k8ip') ){
				var obj = JSON.parse( window.localStorage.getItem('k8ip') );
				if( obj.query !== ip ){
					reqq( ip );
				}
				fillData();
				return;
			}


		})();

	});
</script>