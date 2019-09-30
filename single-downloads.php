<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

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

							if ( generate_show_title() ) {
								the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' );
							}

							/**
							 * generate_after_entry_title hook.
							 *
							 * @since 0.1
							 *
							 * @hooked generate_post_meta - 10
							 */
							do_action( 'generate_after_entry_title' );
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
							<?php
							$pid = get_the_ID();

							$ar = array(
								'k8_acf_dwn_ver',
								'k8_acf_dwn_cat1',
								'k8_acf_dwn_cat2',
								'k8_acf_dwn_file',
								'k8_acf_dwn_feat',
								'k8_acf_dwn_act',
								'k8_acf_dwn_os',
								'k8_acf_dwn_typ',
								'k8_acf_dwn_preis',
								'k8_acf_dwn_lang',
								'k8_acf_dwn_count',
								'k8_acf_dwn_her_home',
								'k8_acf_dwn_unin',
								'k8_acf_dwn_ambieter',
								'k8_acf_dwn_title1',
								'k8_acf_dwn_title2',
								'k8_acf_dwn_title3',
							);

							foreach ($ar as $key => $value) {
								${$value} = get_field($value, $pid);
							}



							$pm = get_post_meta( $k8_acf_dwn_ambieter );
							$wppr_pros = unserialize($pm['wppr_pros'][0]);
							$wppr_cons = unserialize($pm['wppr_cons'][0]);

							// $wppr_options = unserialize($pm['wppr_options'][0]);
							// $wppr_review_custom_fields = unserialize($pm['wppr_review_custom_fields'][0]);
							$wppr_links = unserialize($pm['wppr_links'][0]);




							$k8_tax_brand =	get_the_terms( $pid, 'k8_tax_brand' )[0];
							// echo '<pre>';
							// print_r( $k8_tax_brand );
							// echo '</pre>';

							$k8_acf_dwn_varrs = get_field( 'k8_acf_dwn_varrs', $k8_tax_brand->taxonomy .'_' . $k8_tax_brand->term_id );

							// echo '<pre>';
							// print_r( $k8_acf_dwn_varrs );
							// echo '</pre>';

							$comz = get_comments(array(
								'post_id' => $k8_acf_dwn_ambieter,
								'status' => 'approve',
								'meta_key' => 'meta_option_1'
							));

							// foreach ($comz as $k => $v) {
							// 	$meta_values = get_comment_meta( $v->comment_ID );
							// 	// echo '<pre>';
							// 	// print_r( $meta_values );
							// 	// echo '</pre>';
							// }

							// echo '<pre>';
							// print_r( $pm );
							// echo '</pre>';

							// echo '<pre>';
							// print_r( $comz );
							// echo '</pre>';

							// echo '<pre>';
							// print_r($wppr_options);
							// echo '</pre>';

							// echo '<pre>';
							// print_r($wppr_review_custom_fields);
							// echo '</pre>';

							// echo '<pre style="display: none;">';
							// print_r($wppr_links);
							// echo '</pre>';


							global $wp;
							$curr_url = home_url( $wp->request ) . '/';
							// echo '<pre>';
							// print_r( $curr_url );
							// echo '</pre>';
							// echo '<pre>';
							// print_r( unserialize($pm['wppr_pros'][0]) );
							// echo '</pre>';

							// echo '<pre>';
							// print_r( unserialize($pm['wppr_cons'][0]) );
							// echo '</pre>';

							?>





							<div class="dwnd dwnd__blck dwnd__blck-1">
								<?php
								if ($k8_acf_dwn_ver): ?>
									<strong>Version:</strong> <?php echo $k8_acf_dwn_ver; ?> |
								<?php
								endif ?>
								<strong>Hauptkategorie:</strong> <?php echo $k8_acf_dwn_cat1['label']; ?> |
								<strong>Unterkategorien:</strong> <?php echo $k8_acf_dwn_cat2['label']; ?>
							</div>

							<div class="dwnd dwnd__info fxw">
								<div class="dwnd__info-1 fx-40">

									<div class="k8_sticky">
										
									
										<?php
										echo K8Html::getButt(
											array(
												'nofollow'=> 'nofollow',
												'class'   => 'dwnd__butt grn',
												'target'  => '_blank',
												'href'    => $k8_acf_dwn_file['link'],
												'img_src' => get_the_post_thumbnail_url( $k8_acf_dwn_ambieter, 'thumbnail' ),
											)
										);


										if( is_array( $k8_acf_dwn_feat ) && count( $k8_acf_dwn_feat ) > 0 ) : ?>
											<p>
												<?php
												foreach ($k8_acf_dwn_feat as $key => $value): ?>
													<span><i class="fa fa-check-square-o" aria-hidden="true"></i> <?php echo $value['label']; ?></span>
												<?php
												endforeach ?>
											</p>
										<?php
										endif;

										if ( is_array( $k8_acf_dwn_varrs ) && count( $k8_acf_dwn_varrs ) > 0 ) :
											$ara = array(
												'windows' => array(
													'label'=>'Windows',
													'icon'=>'fa-windows'
												),
												'mac' => array(
													'label'=>'Mac',
													'icon'=>'fa-apple'
												),
												'android' => array(
													'label'=>'Android',
													'icon'=>'fa-android'
												),
												'ios' => array(
													'label'=>'iOS',
													'icon'=>'fa-apple'
												)
											); ?>
											<div class="dwnd__ot fx">
												<?php
												foreach ($ara as $key => $item) :
													if ( $k8_acf_dwn_varrs[0][$key]['url'] !== '' ): ?>
														<a <?php echo( $k8_acf_dwn_varrs[0][$key]['target'] == '_blank' ) ? 'target="_blank" rel="nofollow"' : ''; ?>
															href="<?php echo $k8_acf_dwn_varrs[0][$key]['url']; ?>"
															class="dwnd__ot-link <?php echo ($curr_url == $k8_acf_dwn_varrs[0][$key]['url']) ? 'act' : ''; ?>">

																<i class="fa <?php echo $item['icon']; ?>" aria-hidden="true"></i>
																<?php echo $item['label']; ?>

														</a>
													<?php
													endif;
												endforeach; ?>
											</div>
										<?php
										endif;

										if (is_array($wppr_links) && count($wppr_links)>0) :
											$c = 0;
											foreach ($wppr_links as $k => $v) : 
												if( $c>= 1 ) : 
													break;
												endif; ?>
												<p>
													<a href="<?php echo $v; ?>" target="_blank" rel="nofollow" class="k8_kauph">
														<span>Kaufen</span>
														<i class="fa fa-shopping-cart" aria-hidden="true"></i>
													</a>
												</p>
											<?php
												$c++;
											endforeach;
										endif; ?>
									
									</div>
								</div><!-- .dwnd__info-1 fx-40 -->
								<div class="dwnd__info-2 fx-60">
									<?php the_field('k8_acf_dwn_txt'); ?>
								</div>
							</div>

							<!-- PROS&CONS -->
							<?php 
							if ( $k8_acf_dwn_title1 ):
								echo sprintf('<h3>%s</h3>',$k8_acf_dwn_title1);
							endif; ?>
							<div class="dwnd__pscs fx">
								<div class="fx-50 pros">
									<div class="dwnd__pscs-title">
										Vorteile
									</div>
									<?php
									if ( is_array($wppr_pros) && count($wppr_pros) > 0 ): ?>
										<ul>
											<?php
											foreach ($wppr_pros as $k => $v):
												if ( $v !== '' ):?>
													<li><i class="fa fa-plus-square" aria-hidden="true"></i><?php echo $v; ?></li>
												<?php
												endif;
											endforeach; ?>
										</ul>
									<?php
									endif ?>
								</div>
								<div class="fx-50 cons">
									<div class="dwnd__pscs-title">
										Nachteile
									</div>
									<?php
									if ( is_array($wppr_cons) && count($wppr_cons) > 0 ): ?>
										<ul>
											<?php
											foreach ($wppr_cons as $k => $v):
												if ( $v !== '' ) : ?>
													<li><i class="fa fa-minus-square" aria-hidden="true"></i><?php echo $v; ?></li>
												<?php
												endif;
											endforeach; ?>
										</ul>
									<?php
									endif ?>
								</div>
							</div><!-- .dwnd__pscs -->

							<?php
							$args = array(
								'post_type'   => 'downloads',
								'post_status' => array(
									'publish'
								),
								'post__not_in' => array($pid),
								'posts_per_page' => 5,
								'orderby'       => 'rand',
								// 'order'         => 'DESC',
							);

							$the_query = new WP_Query( $args );
							 ?>

							 <?php
							 if ( $the_query->have_posts() ) :
							 	$i=1;?>

								<div class="k8-dwnd__head">
									Top-5-Alternativen dieser Kategorie
								</div>

								<div class="k8-sl__wrr k8-dwnd__sl">
									<div class="k8-sl__control k8-sl__prev"><i class="fa fa-chevron-left" aria-hidden="true"></i></div>
									<div class="k8-sl__control k8-sl__next"><i class="fa fa-chevron-right" aria-hidden="true"></i></div>
									<div class="k8-sl ">

										<?php
										while ( $the_query->have_posts() ) : $the_query->the_post();
											$curr_id = get_the_ID();
											$ambieter = get_field('k8_acf_dwn_ambieter', $curr_id);
											?>
											<div>
												<div class="k8-sl__itt">
													<img src="<?php echo get_the_post_thumbnail_url( $ambieter, 'medium' ); ?>" alt="" class="k8-sl__img">
													<div class="k8-sl__cont">
														<div class="k8-sl__head1 ta-c">
															<?php echo $i; ?>.
														</div>
														<div class="k8-sl__head2 ta-c">
															<?php the_title(); ?>
														</div>
														<p>
															<?php echo K8Help::excerpt(20); ?>
														</p>
														<?php 
														echo K8Html::getButt(
															array(
																'class'   => 'dwnd__butt sm',
																'href'    => get_the_permalink($curr_id),
																'img_src' => get_the_post_thumbnail_url( $ambieter, 'thumbnail' ),
															)
														); ?>

													</div>
												</div>
											</div>
										<?php
										$i++;
										endwhile; ?>
										<?php wp_reset_postdata(); ?>

									</div>
								</div> <!--.k8-sl__wrr-->

							<?php
							else : ?>
								<p><?php esc_html_e( 'Sorry, nothing found' ); ?></p>
							<?php
							endif;  ?>



							<?php
							if ( $k8_acf_dwn_title2 ):
								echo sprintf('<h3>%s</h3>',$k8_acf_dwn_title2);
							endif;

							if( have_rows('k8_acf_dwn_slider') ):?>
								<div class="k8-sl__wrr k8-dwnd__sl w-scrns">
									<div class="k8-sl__control k8-sl__prev"><i class="fa fa-chevron-left" aria-hidden="true"></i></div>
									<div class="k8-sl__control k8-sl__next"><i class="fa fa-chevron-right" aria-hidden="true"></i></div>
									<div class="k8-sl ">

										<?php
										while ( have_rows('k8_acf_dwn_slider') ) : the_row(); ?>
											<div>
												<div class="k8-sl__itt">
													<a href="<?php echo K8Help::getImgUrl( get_sub_field('image'), 'full' ); ?>" data-lightbox="roadtrip">
														<img src="<?php echo K8Help::getImgUrl( get_sub_field('image'), 'medium' ); ?>" alt="">
													</a>

												</div>
											</div>
											<?php
										endwhile; ?>
									</div>
								</div>
							<?php
							endif; ?>




							<h2>Spezifikationen</h2>

							<table class="k8_compare-tbl k8_dwnd-tbl mtb-30">

								<?php
								if($k8_acf_dwn_act) : ?>
									<tr>
										<td>Aktualisiert</td>
										<td><strong><?php echo $k8_acf_dwn_act; ?></strong></td>
									</tr>
								<?php
								endif;

								if(is_array($k8_acf_dwn_os) && count($k8_acf_dwn_os) > 0) : ?>
									<tr>
										<td><strong>Kompatible Betriebssysteme</strong></td>
										<td>
											<?php
											$ccc = 1;
											foreach ($k8_acf_dwn_os as $key=>$value): ?>
												<strong>
													<?php echo $value['label']; ?>
												</strong>
											<?php
												echo ( count( $k8_acf_dwn_os ) > $ccc ) ? ', ' : '';
												$ccc++;
											endforeach ?>
										</td>
									</tr>
								<?php
								endif;

								if( is_array($k8_acf_dwn_typ) && count($k8_acf_dwn_typ) > 0) : ?>
									<tr>
										<td>Programmart</td>
										<td>
											<?php
											$ccc = 1;
											foreach ($k8_acf_dwn_typ as $key=>$value): ?>
												<strong>
													<?php echo $value['label']; ?>
												</strong>
											<?php
												echo ( count( $k8_acf_dwn_typ ) > $ccc ) ? ', ' : '';
												$ccc++;
											endforeach ?>
										</td>
									</tr>
								<?php
								endif;

								if( get_field( 'k8_acf_vpndet_avg', $k8_acf_dwn_ambieter ) ) : ?>
									<tr>
										<td>Kaufpreis</td>
										<td>
											<strong>
												<?php echo get_field( 'k8_acf_vpndet_avg', $k8_acf_dwn_ambieter ); ?>
											</strong>
											<?php echo get_field( 'k8_acf_vpndet_curr', $k8_acf_dwn_ambieter )['label']; ?>
										</td>
									</tr>
								<?php
								endif;



								if(is_array($k8_acf_dwn_lang) && count($k8_acf_dwn_lang) > 0) : ?>
									<tr>
										<td>Sprache</td>
										<td>
											<?php
											$ccc = 1;
											foreach ($k8_acf_dwn_lang as $key=>$value): ?>
												<strong>
													<?php echo $value['label']; ?>
												</strong>
											<?php
												echo ( count( $k8_acf_dwn_lang ) > $ccc ) ? ', ' : '';
												$ccc++;
											endforeach ?>
										</td>
									</tr>
								<?php
								endif;

								if($k8_acf_dwn_count) : ?>
									<tr>
										<td>Anzahl der Downloads</td>
										<td><strong><?php echo $k8_acf_dwn_count; ?></strong></td>
									</tr>
								<?php
								endif;


								if($k8_acf_dwn_file) : ?>
									<tr>
										<td>Dateigröße</td>
										<td><strong><?php echo size_format($k8_acf_dwn_file['filesize'],2); ?></strong></td>
									</tr>
								<?php
								endif;

								if($k8_tax_brand) : ?>
									<tr>
										<td>Hersteller</td>
										<td>
											<strong>
												<?php echo $k8_tax_brand->name; ?>
											</strong>
											<?php
											if ($k8_acf_dwn_her_home): ?>
												<br>
												<a target="_blank" href="<?php echo $k8_acf_dwn_her_home; ?>">Zur Homepage des Herstellers</a>
											<?php
											endif ?>
										</td>
									</tr>
								<?php
								endif;

								if($k8_acf_dwn_cat1) : ?>
									<tr>
										<td>Kategorie</td>
										<td><strong><?php echo $k8_acf_dwn_cat1['label']; ?></strong> | <strong><?php echo $k8_acf_dwn_cat2['label']; ?></strong></td>
									</tr>
								<?php
								endif;


								if($k8_acf_dwn_unin) : ?>
									<tr>
										<td>Deinstallation</td>
										<td><?php echo $k8_acf_dwn_unin; ?></td>
									</tr>
								<?php
								endif;


								?>

							</table>


							<!-- SCHEMA ORG-->
							<script type="application/ld+json">{
								"@context":"http:\/\/schema.org\/",
								"@type":"SoftwareApplication",
								"name":"<?php the_title(); ?>",
								<?php
								if($k8_acf_dwn_cat1) : ?>
									"applicationCategory":"<?php echo $k8_acf_dwn_cat1['label']; ?>",
								<?php
								endif;

								if($k8_acf_dwn_cat2) : ?>
									"applicationSubCategory":"<?php echo $k8_acf_dwn_cat2['label']; ?>",
								<?php
								endif;

								if(is_array($k8_acf_dwn_lang) && count($k8_acf_dwn_lang) > 0) : ?>
									"inLanguage":["<?php
										$ccc = 1;
										foreach ($k8_acf_dwn_lang as $key=>$value):
											echo $value['label'];
											echo ( count( $k8_acf_dwn_lang ) > $ccc ) ? ', ' : '';
											$ccc++;
										endforeach; ?>"],
								<?php
								endif;?>

								"downloadUrl":"<?php echo addslashes($curr_url); ?>",

								<?php
								if( is_array( $k8_acf_dwn_feat ) && count( $k8_acf_dwn_feat ) > 0 ) : ?>
									"featureList":["<?php
										$ccc = 1;
										foreach ($k8_acf_dwn_feat as $key => $value):
											echo $value['label'];
											echo ( count( $k8_acf_dwn_feat ) > $ccc ) ? ', ' : '';
											$ccc++;
										endforeach ?>"],
								<?php
								endif;

								if($k8_acf_dwn_file) : ?>
									"fileSize":"<?php echo size_format($k8_acf_dwn_file['filesize'],2); ?>",
								<?php
								endif;

								if(is_array($k8_acf_dwn_os) && count($k8_acf_dwn_os) > 0) : ?>
									"operatingSystem":["<?php
										$ccc = 1;
										foreach ($k8_acf_dwn_os as $key=>$value):
											echo $value['label'];
											echo ( count( $k8_acf_dwn_os ) > $ccc ) ? ', ' : '';
											$ccc++;
										endforeach ?>"],
								<?php
								endif;?>

								"screenshot":"<?php echo esc_url_raw( get_the_post_thumbnail_url( $k8_acf_dwn_ambieter, 'medium' ) ); ?>",
								"thumbnailUrl":"<?php echo esc_url( get_the_post_thumbnail_url( $k8_acf_dwn_ambieter, 'thumbnail' ) ); ?>",

								<?php
								if ($k8_acf_dwn_ver): ?>
									"softwareVersion":"<?php echo $k8_acf_dwn_ver; ?>",
								<?php
								endif ?>

								"aggregateRating":{
									"@type":"AggregateRating",
									"ratingCount":<?php echo ( count( $comz ) > 0 ) ? count( $comz ) : 1; ?>,
									"bestRating":10,
									"ratingValue":<?php echo ($pm['wppr_rating'][0] / 10); ?>,
									"worstRating":0
								},

								"dateModified":"<?php the_modified_date(); ?>",

								<?php
								if($k8_acf_dwn_count) : ?>
									"interactionStatistic":{
										"@type":"InteractionCounter",
										"userInteractionCount":"<?php echo addslashes($k8_acf_dwn_count); ?>"
									},
								<?php
								endif;

								if( get_field( 'k8_acf_vpndet_avg', $k8_acf_dwn_ambieter ) ) : ?>
									"offers":{
										"@type":"Offer",
										"price":<?php echo get_field( 'k8_acf_vpndet_avg', $k8_acf_dwn_ambieter ); ?>,
										"priceCurrency":"<?php echo get_field( 'k8_acf_vpndet_curr', $k8_acf_dwn_ambieter )['label']; ?>"
									},
								<?php
								endif;

								if($k8_tax_brand) : ?>
									"producer" : "<?php
									echo $k8_tax_brand->name; ?>",
								<?php
								endif; ?>


								"publisher":"<?php echo addslashes( get_bloginfo( 'name' ) ); ?>",
								"description":"<?php echo addslashes( strip_tags(K8Help::excerpt(120)) ); ?>"
							}</script>



							<?php
							the_content();
								
							if ( $k8_acf_dwn_title3 ):
								echo sprintf('<h3>%s</h3>',$k8_acf_dwn_title3);
							endif;

							echo '<div class="k8-rew__wrr">';
								echo do_shortcode( "[P_REVIEW post_id=" . $k8_acf_dwn_ambieter . " visual='rating-options']" );
							echo '</div>';

							wp_link_pages( array(
								'before' => '<div class="page-links">' . __( 'Pages:', 'generatepress' ),
								'after'  => '</div>',
							) );
							?>


							<br><br>

							<h2>Aktivieren Sie jetzt den Update-Alarm</h2>
							<p>Sie möchten über wichtige Programm-Updates immer informiert werden? Dann aktivieren Sie hier einfach den Update-Alarm und Sie verpassen kein Update mehr!</p>

							<form action="" class="k8_cnt" onsubmit="return false;">
								<label>E-Mail-Adresse*</label>

								<div class="fxw">
									<input class="fx1" type="email" name="email" required>
									<button type="submit" class="dwnd__butt sm">Anmelden</button>
								</div>


							</form>

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

get_footer();