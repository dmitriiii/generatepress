<?php /* Template Name: Authors Template */
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

					<article class="post-25746 page type-page status-draft" itemtype="https://schema.org/CreativeWork" itemscope="">
						<div class="inside-article">
							<header class="entry-header">
								<h1 class="entry-title" itemprop="headline"><?php the_title(); ?></h1>			
							</header><!-- .entry-header -->
							<div class="entry-content" itemprop="text">
								<?php 
								$tmpl_auth_rep = get_field('tmpl_auth_rep');
									if (is_array($tmpl_auth_rep) && count($tmpl_auth_rep)>0) :?>
										<div class="k8aut__wr">
											<?php
											foreach ($tmpl_auth_rep as $v):
												$u_m = get_user_meta( $v['edit'] );?>
												<div class="k8aut__it">
													<div class="k8aut__pre clearfix">
														<?php echo K8Html::getImgHtml([
															'img_id'=>$u_m['k8_acf_u_ph'][0],
															'size'=>'thumbnail',
															'class'=>'k8aut__img'
														]); ?>
														<h2>
															<?php echo $u_m['first_name'][0] . ' ' . $u_m['last_name'][0]; ?>
														</h2>
														<p>
															<em>
																<?php echo $u_m['k8_acf_u_desc'][0]; ?>
															</em>
														</p>
														<p>
															<a class="dwnd__butt sm k8aut__link" tabindex="0" href="<?php echo get_author_posts_url($v['edit']); ?>">
																<span>
																	<?php _e('Beiträge des Autors' , 'k8lang_domain'); ?>
																</span> 
																<i class="fas fa-eye"></i>
															</a>
														</p>
													</div>
													<div class="k8aut__txt">
														<?php echo $v['txt']; ?>
													</div>
												</div>
											<?php
											endforeach;?>
										</div>
									<?php
									endif;
								the_content(); ?>
							</div><!-- .entry-content -->
						</div><!-- .inside-article -->
					</article>

					
				<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || '0' != get_comments_number() ) : ?>

					<div class="comments-area">
						<?php comments_template(); ?>
					</div>

				<?php endif;

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
