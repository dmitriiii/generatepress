<?php
/*
 * Template Name: VPN Security
 * Template Post Type: post
 */

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

							<div class="k8-sec1">
								<div class="container-fluid">
									<div class="row">
										<div class="col-md-12">
											<?php the_field('tmpl_txt_1'); ?>
										</div>
									</div>
								</div>
							</div>

							<div class="k8-sec2">
								<div class="container-fluid">
									<div class="row">
										<div class="col-md-6">
											<?php 
											if (get_field('tmpl_img_1')): 
												$imid = get_field('tmpl_img_1'); ?>
												<img src="<?php echo wp_get_attachment_image_src($imid, 'medium_large')[0] ?>" alt="<?php echo get_post_meta($imid, '_wp_attachment_image_alt', TRUE) ?>" title="<?php echo get_the_title($imid) ?>">
											<?php 
											endif ?>
										</div>
										<div class="col-md-6">
											<?php the_field('tmpl_txt_2'); ?>
										</div>
									</div>
								</div>
							</div><!-- .k8-sec2 -->

							<div class="k8-sec3">
								<div class="container-fluid">
									<div class="row eq-h-row">
										<div class="col-md-6">
											<div class="k8-sec3__wrr">
												<div class="k8-sec3__blck blck-1">
													<div class="k8-sec3__head">
														<div class="tbl k8-sec3__head-tbl">
															<div class="tbl-cell cell-1 mdl">
																<div class="k8-sec3__pl">
																	<img src="<?php bloginfo( 'template_directory' ) ?>/k8/assets/img/icon-21.svg" alt="">
																</div>
															</div>
															<div class="tbl-cell cell-2 mdl">
																	<img class="k8-sec3__lock" src="<?php bloginfo( 'template_directory' ) ?>/k8/assets/img/lock-01.svg" alt="">
															</div>
														</div>
													</div>
													<div class="k8-sec3__txt eq-h-blck">
														<?php the_field('tmpl_blck_1'); ?>
													</div>
												</div><!-- END .k8-sec3__blck -->
											</div><!-- .k8-sec3__wrr -->
											<?php
												$args = array(
													'post_type'   => 'post',
													'post_status' => array(
														'publish'
													),
													'category_name' => 'vpn-anbieter',
													'posts_per_page' => 2,
													'meta_key'  => 'option_overall_score',
													'orderby'   => 'meta_value_num',
													'order'     => 'DESC',
												);

												$the_query = new WP_Query( $args );

												if ( $the_query->have_posts() ) :
													$i = 1;
													while ( $the_query->have_posts() ) : $the_query->the_post();
														$pid = get_the_ID();
														$pm = get_post_meta( $pid );
														$wppr_options = unserialize($pm['wppr_options'][0]);

														echo K8Html::getItem(array(
															'pid' => $pid,
															'pm' => $pm,
															'wppr_options' => $wppr_options,
															'i' => $i
														));

														$i++;
													endwhile;
													wp_reset_postdata();
												endif;  ?>
											<button data-targ="#modd_safe" data-typ="1" data-act="k8_ajx_safety" class="trigg k8-sec3__more butt-v-1 b-w-l" data-bg="blck-1">Alle passenden Services</button>
										</div><!-- .col-md-6 -->
										
										<div class="col-md-6">
											<div class="k8-sec3__wrr">
												<div class="k8-sec3__blck blck-2">
													<div class="k8-sec3__head">
														<div class="tbl k8-sec3__head-tbl">
															<div class="tbl-cell cell-1 mdl">
																<div class="k8-sec3__pl">
																	<img src="<?php bloginfo( 'template_directory' ) ?>/k8/assets/img/icon-20.svg" alt="">
																</div>
															</div>
															<div class="tbl-cell cell-2 mdl">
																	<img class="k8-sec3__lock" src="<?php bloginfo( 'template_directory' ) ?>/k8/assets/img/lock-02.svg" alt="">
															</div>
														</div>
													</div>
													<div class="k8-sec3__txt eq-h-blck">
														<?php the_field('tmpl_blck_2'); ?>
													</div>
												</div><!-- END .k8-sec3__blck -->
											</div><!-- .k8-sec3__wrr -->
											<?php
												$args = array(
													'post_type'   => 'post',
													'post_status' => array(
														'publish'
													),
													'category_name' => 'vpn-anbieter',
													'tax_query' => array(
										        array(
									            'taxonomy' => 'anwendungen',
									            'field'    => 'slug',
									            'terms'    => 'tauschboersen-torrent',
										        ),
											    ),
													'posts_per_page' => 2,
													'meta_key'  => 'option_overall_score',
													'orderby'   => 'meta_value_num',
													'order'     => 'DESC',
												);

												$the_query = new WP_Query( $args );

												if ( $the_query->have_posts() ) :
													$i = 1;
													while ( $the_query->have_posts() ) : $the_query->the_post();
														$pid = get_the_ID();
														$pm = get_post_meta( $pid );
														$wppr_options = unserialize($pm['wppr_options'][0]);

														echo K8Html::getItem(array(
															'pid' => $pid,
															'pm' => $pm,
															'wppr_options' => $wppr_options,
															'i' => $i
														));

														$i++;
													endwhile;
													wp_reset_postdata();
												endif;  ?>
											<button data-targ="#modd_safe" data-typ="2" data-act="k8_ajx_safety" class="trigg k8-sec3__more butt-v-1 b-w-l" data-bg="blck-2">Alle passenden Services</button>
										</div><!-- .col-md-6 -->

									</div><!-- .row -->



									<div class="row eq-h-row">
										<div class="col-md-6">
											<div class="k8-sec3__wrr">
												<div class="k8-sec3__blck blck-3">
													<div class="k8-sec3__head">
														<div class="tbl k8-sec3__head-tbl">
															<div class="tbl-cell cell-1 mdl">
																<div class="k8-sec3__pl">
																	<img src="<?php bloginfo( 'template_directory' ) ?>/k8/assets/img/icon-18.svg" alt="">
																</div>
															</div>
															<div class="tbl-cell cell-2 mdl">
																	<img class="k8-sec3__lock" src="<?php bloginfo( 'template_directory' ) ?>/k8/assets/img/lock-03.svg" alt="">
															</div>
														</div>
													</div>
													<div class="k8-sec3__txt eq-h-blck">
														<?php the_field('tmpl_blck_3'); ?>
													</div>
												</div><!-- END .k8-sec3__blck -->
											</div><!-- .k8-sec3__wrr -->
											<?php
												$args = array(
													'post_type'   => 'post',
													'post_status' => array(
														'publish'
													),
													'category_name' => 'vpn-anbieter',
													'tax_query' => array(
										        array(
									            'taxonomy' => 'anwendungen',
									            'field'    => 'slug',
									            'terms'    => 'maximale-anonymitaet',
										        ),
											    ),
													'posts_per_page' => 2,
													'meta_key'  => 'option_overall_score',
													'orderby'   => 'meta_value_num',
													'order'     => 'DESC',

												);

												$the_query = new WP_Query( $args );

												if ( $the_query->have_posts() ) :
													$i = 1;
													while ( $the_query->have_posts() ) : $the_query->the_post();
														$pid = get_the_ID();
														$pm = get_post_meta( $pid );
														$wppr_options = unserialize($pm['wppr_options'][0]);

														echo K8Html::getItem(array(
															'pid' => $pid,
															'pm' => $pm,
															'wppr_options' => $wppr_options,
															'i' => $i
														));

														$i++;
													endwhile;
													wp_reset_postdata();
												endif;  ?>
											<button data-targ="#modd_safe" data-typ="3" data-act="k8_ajx_safety" class="trigg k8-sec3__more butt-v-1 b-w-l" data-bg="blck-3">Alle passenden Services</button>
										</div><!-- .col-md-6 -->
										
										<div class="col-md-6">
											<div class="k8-sec3__wrr">
												<div class="k8-sec3__blck blck-4">
													<div class="k8-sec3__head">
														<div class="tbl k8-sec3__head-tbl">
															<div class="tbl-cell cell-1 mdl">
																<div class="k8-sec3__pl">
																	<img src="<?php bloginfo( 'template_directory' ) ?>/k8/assets/img/icon-19.svg" alt="">
																</div>
															</div>
															<div class="tbl-cell cell-2 mdl">
																	<img class="k8-sec3__lock" src="<?php bloginfo( 'template_directory' ) ?>/k8/assets/img/lock-04.svg" alt="">
															</div>
														</div>
													</div>
													<div class="k8-sec3__txt eq-h-blck">
														<?php the_field('tmpl_blck_4'); ?>
													</div>
												</div><!-- END .k8-sec3__blck -->
											</div><!-- .k8-sec3__wrr -->
											<?php
												$args = array(
													'post_type'   => 'post',
													'post_status' => array(
														'publish'
													),
													'category_name' => 'vpn-anbieter',
													'tax_query' => array(
														'relation' => 'AND',
										        array(
									            'taxonomy' => 'anwendungen',
									            'field'    => 'slug',
									            'terms'    => 'maximale-anonymitaet',
										        ),
										        array(
									            'taxonomy' => 'sonderfunktionen',
									            'field'    => 'slug',
									            'terms'    => 'multi-hop-vpn',
										        ),
											    ),
													'posts_per_page' => 2,
    											'meta_key'  => 'option_overall_score',
													'orderby'   => 'meta_value_num',
													'order'     => 'DESC',
												);

												$the_query = new WP_Query( $args );

												if ( $the_query->have_posts() ) :
													$i = 1;
													while ( $the_query->have_posts() ) : $the_query->the_post();
														$pid = get_the_ID();
														$pm = get_post_meta( $pid );
														$wppr_options = unserialize($pm['wppr_options'][0]);

														echo K8Html::getItem(array(
															'pid' => $pid,
															'pm' => $pm,
															'wppr_options' => $wppr_options,
															'i' => $i
														));

														$i++;
													endwhile;
													wp_reset_postdata();
												endif;  ?>
											<button data-targ="#modd_safe" data-typ="4" data-act="k8_ajx_safety" class="trigg k8-sec3__more butt-v-1 b-w-l" data-bg="blck-4">Alle passenden Services</button>
										</div><!-- .col-md-6 -->

									</div><!-- .row -->
								</div><!-- .container-fluid -->
							</div><!-- .k8-sec3 -->

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

get_footer();