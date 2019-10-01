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
											<h2>
												Viele Leser suchen den "sichersten VPN Anbieter"
											</h2>
											<br>
											<p>
												Allerdings muss man dazu festhalten, dass es eben sehr viele verschiedene Bedrohungszenarien geben kann. Also was für den einen ausreichende Sicherheit darstellt, mag für den anderen überhaupt kein Schutz darstellen. Kurz gesagt: Sicherheit ist relativ und subjektiv zu betrachten. 
											</p>
											<p>
												Die wichtigsten Unterscheidungsmerkmale habe ich einmal hier zusammen geführt und versucht dies in 4 einfache Sicherheitsgruppen sortiert. Klar man kann darüber streiten, welche Eigenschaft nun wichtiger wäre usw.. es ist aber eine ganz gute Unterscheidung, die vielen meiner Leser bisher geholfen hat. 
											</p>
											<br>
											<h2>
												Welchen VPN suchst Du? Finde die passenden VPN-Anbieter für Deinen Bedarf 
											</h2>
										</div>
									</div>
								</div>
							</div>
							
							<div class="k8-sec2">
								<div class="container-fluid">
									<div class="row">
										<div class="col-md-6">
											<img src="<?php bloginfo( 'template_directory' ); ?>/k8/assets/img/levlz.png" alt="">
										</div>
										<div class="col-md-6">
											<br>
											<p>
												Allerdings muss man dazu festhalten, dass es eben sehr viele verschiedene Bedrohungszenarien geben kann. Also was für den einen ausreichende Sicherheit darstellt, mag für den anderen überhaupt kein Schutz darstellen. Kurz gesagt: Sicherheit ist relativ und subjektiv zu betrachten.
											</p>
											<p>
												Die wichtigsten Unterscheidungsmerkmale habe ich einmal hier zusammen geführt und versucht dies in 4 einfache Sicherheitsgruppen sortiert. Klar man kann darüber streiten, welche Eigenschaft nun wichtiger wäre usw.. es ist aber eine ganz gute Unterscheidung, die vielen meiner Leser bisher geholfen hat.
											</p>
										</div>
									</div>
								</div>
							</div><!-- .k8-sec2 -->
							
							<div class="k8-sec3">
								<div class="container-fluid">
									<div class="row">
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
													<div class="k8-sec3__txt">
														<h3 style="text-align: center;">
															Gewechselte IP-Adresse 
															& einfacher Schutz 
														</h3>
														<p><em>Schützt vor Ausforschungen wegen Zivilrecht (Urheberrecht)</em></p>
														<h4>Merkmale: </h4>
														<ul>
															<li>Standorte im Ausland (IP-Adressen)</li>
															<li>Verbindungen zu einzelnen VPN Servern</li>
															<li>Geschütze Verbindungen von Endgerät bis zum VPN-Standort</li>
														</ul>
														<h4>
															Ideal für: 
														</h4>
														<ul>
															<li>Nutzung einer IP-Adresse aus dem Ausland</li>
															<li>Sichere verschlüsselte Datenübertragung zwischen Endgerät und VPN-Server</li>
															<li>Streaming (Urheberrecht)</li>
															<li>Geographische Sperren umgehen</li>
														</ul>
													</div>
												</div><!-- END .k8-sec3__blck -->
											</div><!-- .k8-sec3__wrr -->
											
											<div class="k8-sec3__it">
												<div class="tbl k8-sec3__it-tbl">
													<div class="tbl-cell cell-1 mdl">
														<img src="https://api.fnkr.net/testimg/100x100/00CED1/FFF/?text=img+placeholder">
													</div>
													<div class="tbl-cell cell-2 mdl">
														<ul class="k8-sec3__it-list">
															<li>
																<span>3.49</span>
																Preis/Mon ab $
															</li>
															<li>
																<span>100</span>
																Geschwindig
															</li>
															<li>
																<span>96</span>
																Privatsphäre
															</li>
															<li>
																<span>96</span>
																Ausstattung
															</li>
															<li>
																<span>100</span>
																Kundendienst
															</li>
															<li>
																<span>95.60</span>
																Leserwertung
															</li>
														</ul>
													</div>
													<div class="tbl-cell cell-3 mdl">
														<p>
															NordVPN klingt wie ein skandinavischer VPN-Service in der Realität ist das Unternehmen aber in Panama (offshore) beheimatet, da dies aus Gründen des Datenschutzes für die eigenen Kunden wichtig ist. ab $3.00/Monat ...
														</p>
														<a href="#">
															zum Testberichte
														</a>
													</div>
												</div>
											</div>

										</div><!-- .col-md-6 -->
										<div class="col-md-6">
											
										</div>
									</div>
								</div>
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