<?php /* Template Name: IP Test
Template Post Type: page */
global $wp;
if( !isset($_GET['ip']) || !filter_var($_GET['ip'], FILTER_VALIDATE_IP) || $_GET['ip'] !== $_SERVER['REMOTE_ADDR'] ){
	header("Location:" . home_url( $wp->request ) ."?ip=" . $_SERVER['REMOTE_ADDR'] );
	die;
}
get_header();?>

<div id="primary" <?php generate_do_element_classes( 'content' ); ?>>
		<main id="main" <?php generate_do_element_classes( 'main' ); ?>>
			<?php
			/**
			 * generate_before_main_content hook.
			 *
			 * @since 0.1
			 */
			do_action( 'generate_before_main_content' );

			while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php generate_do_microdata( 'article' ); ?>>
					<div class="inside-article">
						<?php
						/**
						 * generate_before_content hook.
						 *
						 * @since 0.1
						 *
						 * @hooked generate_featured_page_header_inside_single - 10
						 */
						do_action( 'generate_before_content' );
						?>

						<header class="entry-header">
							<?php
							/**
							 * generate_before_entry_title hook.
							 *
							 * @since 0.1
							 */
							do_action( 'generate_before_entry_title' );

							// if ( generate_show_title() ) {
							// 	the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' );
							// }

							/**
							 * generate_after_entry_title hook.
							 *
							 * @since 0.1
							 *
							 * @hooked generate_post_meta - 10
							 */
							// do_action( 'generate_after_entry_title' );
							?>
						</header><!-- .entry-header -->

						<?php
						/**
						 * generate_after_entry_header hook.
						 *
						 * @since 0.1
						 *
						 * @hooked generate_post_image - 10
						 */
						do_action( 'generate_after_entry_header' );
						?>

						<div class="entry-content" itemprop="text">

							<div class="k8-ip__wrr">
								<h1 style="text-align: center;">
									<?php the_title(); ?>
								</h1>
								<div class="k8_tbl-resp k8-ip__tbl">
									<table class="k8_compare-tbl mtb-30">
										<tr>
											<th class="k8-ip__tbl--main">
												IP: <?php echo $_GET['ip']; ?>
											</th>
											<th>
												<input class="k8-copy__inp" id="myInput" value="<?php echo home_url( $wp->request ) . '/?ip=' . $_GET['ip']; ?>" readonly>
												<div class="k8-tooltip">
													<button class="k8-copy__url dwnd__butt grn">
														<span class="k8-tooltiptext" id="myTooltip">Copy to clipboard</span>
														Copy Results
													</button>
												</div>
											</th>
										</tr>
										<tr>
											<td colspan="2">
												<div class="k8-ip__map">
													<img src="" alt="Your location">
												</div>
											</td>
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
										<tr data-ip='zip'>
											<td>ZIP</td>
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
									<div class="k8-ip__hidd">
										<div class="k8-ip__true">
											<?php echo file_get_contents( get_template_directory() . '/k8/assets/svg/true.svg' ); ?>
										</div>
										<div class="k8-ip__false">
											<?php echo file_get_contents( get_template_directory() . '/k8/assets/svg/false.svg' ); ?>
										</div>
									</div>
								</div>

							</div><!-- .k8-ip__wrr -->

							<?php
							the_content();

							echo '<br><p><u><b>Erstellt am:</b></u> <meta itemprop="datePublished" content="' . get_the_date() . '">' . get_the_date() . '</p>';

							wp_link_pages( array(
								'before' => '<div class="page-links">' . __( 'Pages:', 'generatepress' ),
								'after'  => '</div>',
							) );
							?>
						</div><!-- .entry-content -->

						<?php
						/**
						 * generate_after_entry_content hook.
						 *
						 * @since 0.1
						 *
						 * @hooked generate_footer_meta - 10
						 */
						do_action( 'generate_after_entry_content' );

						/**
						 * generate_after_content hook.
						 *
						 * @since 0.1
						 */
						do_action( 'generate_after_content' );
						?>
					</div><!-- .inside-article -->
				</article><!-- #post-## -->


				<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || '0' != get_comments_number() ) :
					/**
					 * generate_before_comments_container hook.
					 *
					 * @since 2.1
					 */
					do_action( 'generate_before_comments_container' );
					?>

					<div class="comments-area">
						<?php comments_template(); ?>
					</div>

					<?php
				endif;

			endwhile;

			/**
			 * generate_after_main_content hook.
			 *
			 * @since 0.1
			 */
			do_action( 'generate_after_main_content' );
			?>
		</main><!-- #main -->
	</div><!-- #primary -->

	<?php
	/**
	 * generate_after_primary_content_area hook.
	 *
	 * @since 2.0
	 */
	do_action( 'generate_after_primary_content_area' );

	generate_construct_sidebars();

get_footer();?>
<script>
	jQuery(document).ready(function($) {
		(function () {
			const ip = "<?php echo ( isset( $_GET['ip'] ) && filter_var($_GET['ip'], FILTER_VALIDATE_IP) ) ? trim($_GET['ip']) : trim($_SERVER['REMOTE_ADDR']); ?>";
			$('body').on('click', '.k8-copy__url', function(e) {
				var copyText = document.getElementById("myInput");
			  copyText.select();
			  copyText.setSelectionRange(0, 99999);
			  document.execCommand("copy");
			  var tooltip = document.getElementById("myTooltip");
			  tooltip.innerHTML = "Copied: " + copyText.value;
			});

			$('.k8-copy__url').mouseout(function(){
			  var tooltip = document.getElementById("myTooltip");
	 			tooltip.innerHTML = "Copy to clipboard";
			});

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
						window.localStorage.setItem('k8ip', data.html);
						fillData();
						// alert('Request to server');
					}
				});
			}
			function fillData(){
				var parsedObj = JSON.parse( window.localStorage.getItem('k8ip') ),
						$tbl = $('.k8-ip__tbl'),
						$img = $('.k8-ip__map img'),
						true_svg = $('.k8-ip__hidd').find('.k8-ip__true').html(),
						false_svg = $('.k8-ip__hidd').find('.k8-ip__false').html(),
						urll = '';
				$tbl.find('tr[data-ip]').each(function(index, el) {
					var $elem = $(el),
							attr = $elem.attr( 'data-ip' );

					if( parsedObj[attr] == true ){
						$elem.find('td:last-child').html( true_svg );
						return;
					}

					if( parsedObj[attr] == false ){
						$elem.find('td:last-child').html( false_svg );
						return;
					}

					if( typeof parsedObj[attr] != 'undefined' ){
						$elem.find('td strong').html( parsedObj[attr] );
					}
				});
				urll = parsedObj.lat + ',' + parsedObj.lon + '&zoom=9&size=2000x400&maptype=terrain&markers=color:blue|label:S|' + parsedObj.lat + ',' + parsedObj.lon + '&key=AIzaSyBK4XomMibqoAiojTr4ChbeEr3cbVHLXIo';
				$img.attr('src', 'https://maps.googleapis.com/maps/api/staticmap?center=' + encodeURI( urll ));
			}
			// NOT SET
			if( !window.localStorage.getItem('k8ip') ){
				reqq( ip );
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