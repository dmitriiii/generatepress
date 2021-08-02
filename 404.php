<?php

/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package GeneratePress
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

$the_page    = null;
$error_page_id = get_option('404_page_id');
if ($error_page_id !== 0) {
	// Typecast to an integer
	$error_page_id = (int) $error_page_id;

	// Get our page
	$the_page = get_page($error_page_id);
}

get_header(); ?>

<div id="primary" <?php generate_do_element_classes('content'); ?>>
	<main id="main" <?php generate_do_element_classes('main'); ?>>
		<?php
		/**
		 * generate_before_main_content hook.
		 *
		 * @since 0.1
		 */
		do_action('generate_before_main_content');
		?>

		<div class="inside-article">

			<?php
			/**
			 * generate_before_content hook.
			 *
			 * @since 0.1
			 *
			 * @hooked generate_featured_page_header_inside_single - 10
			 */
			do_action('generate_before_content');
			?>

			<header class="entry-header">
				<h1 class="entry-title" itemprop="headline"><?php echo apply_filters('generate_404_title', __(get_field('title', $error_page_id) ?? 'Oops! That page can’t be found.', 'generatepress')); // WPCS: XSS OK. 
															?></h1>
			</header><!-- .entry-header -->

			<?php
			/**
			 * generate_after_entry_header hook.
			 *
			 * @since 0.1
			 *
			 * @hooked generate_post_image - 10
			 */
			do_action('generate_after_entry_header');
			?>

			<div class="entry-content" itemprop="text">
				<?php if ($the_page == NULL || isset($the_page->post_content) && trim($the_page->post_content == '')) { ?>
				<?php } else { ?>
					<?php echo apply_filters('the_content', $the_page->post_content); ?>
				<?php } ?>
			</div><!-- .entry-content -->

			<?php
			/**
			 * generate_after_content hook.
			 *
			 * @since 0.1
			 */
			do_action('generate_after_content');
			?>

		</div><!-- .inside-article -->

		<?php
		/**
		 * generate_after_main_content hook.
		 *
		 * @since 0.1
		 */
		do_action('generate_after_main_content');
		?>
	</main><!-- #main -->
</div><!-- #primary -->

<?php
/**
 * generate_after_primary_content_area hook.
 *
 * @since 2.0
 */
do_action('generate_after_primary_content_area');

generate_construct_sidebars();

get_footer();
