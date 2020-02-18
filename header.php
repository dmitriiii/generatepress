<?php
/**
 * The template for displaying the header.
 *
 * @package GeneratePress
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
$apid = get_the_ID();
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php 
	if( is_single() && in_category('news', $apid) && get_field('k8_optz_amp','option') == 1 ) : ?>
		<link rel="amphtml" href="<?php the_permalink( $apid ); ?>amp/">
	<?php 
	endif; ?>

	<?php wp_head(); ?>
</head>
<?php 
$k8_mob_clss = "";
if ( !wp_is_mobile() ) {
	$k8_mob_clss = 'k8_desktop';
} ?>
<body <?php body_class( $k8_mob_clss ); ?> <?php generate_do_microdata( 'body' ); ?>>
	<?php
	/**
	 * generate_before_header hook.
	 *
	 * @since 0.1
	 *
	 * @hooked generate_do_skip_to_content_link - 2
	 * @hooked generate_top_bar - 5
	 * @hooked generate_add_navigation_before_header - 5
	 */
	do_action( 'generate_before_header' );

	/**
	 * generate_header hook.
	 *
	 * @since 1.3.42
	 *
	 * @hooked generate_construct_header - 10
	 */
	do_action( 'generate_header' );

	/**
	 * generate_after_header hook.
	 *
	 * @since 0.1
	 *
	 * @hooked generate_featured_page_header - 10
	 */
	do_action( 'generate_after_header' );
	?>

	<div id="page" class="hfeed site grid-container container grid-parent">
		<div id="content" class="site-content">
			<?php
			/**
			 * generate_inside_container hook.
			 *
			 * @since 0.1
			 */
			do_action( 'generate_inside_container' );
