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
								the_title( '<h1 class="entry-title" itemprop="headline">Ihr Download: ', '</h1>' );
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
							$q_o = get_queried_object();
							$pid = $q_o->post_parent;

							$ar = array(
								'k8_acf_dwn_ver',
								'k8_acf_dwn_file',
								'k8_acf_dwn_feat',
								'k8_acf_dwn_ambieter'
							);

							foreach ($ar as $key => $value) {
								${$value} = get_field($value, $pid);
							} ?>



							<div class="dwnd dwnd__info fxw">
								<div class="dwnd__info-1 ">
									
									<form class="k8-capt__form">
										<p>
											Vergewissern Sie sich vor dem Download, dass Sie kein Roboter sind
										</p>
										<div class="g-recaptcha" data-sitekey="6LdCnLQUAAAAAMvf3hvRp8m5r9U4jobNAeOMp4v6" data-callback="k8CaptchaSucc"></div>
										<input type="hidden" name="href" value="<?php echo $q_o->guid; ?>">
										<input type="hidden" name="pid" value="<?php echo $k8_acf_dwn_ambieter; ?>">
									</form>
									
									
									<?php
									if( is_array($k8_acf_dwn_feat) && count( $k8_acf_dwn_feat ) > 0 ) : ?>
										<p>
											<?php
											foreach ($k8_acf_dwn_feat as $key => $value): ?>
												<span><i class="fa fa-check-square-o" aria-hidden="true"></i> <?php echo $value['label']; ?></span>
											<?php
											endforeach ?>
										</p>
									<?php
									endif; ?>

									<p>
										<?php
										if ($k8_acf_dwn_ver): ?>
											<em>Version: </em>
											<strong><?php echo $k8_acf_dwn_ver; ?></strong>
											 |
											<em>Dateigröße: </em>
											<strong><?php echo size_format($k8_acf_dwn_file['filesize'],2); ?></strong>
										<?php
										endif ?>
									</p>

								</div>
								<div class="dwnd__info-2 fx-70">
									<?php the_field('k8_acf_dwn_txt'); ?>
								</div>
							</div>


							<?php
							the_content();

							// echo '<br><p><u><b>Erstellt am:</b></u> <meta itemprop="datePublished" content="' . get_the_date() . '">' . get_the_date() . '</p>';

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