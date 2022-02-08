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
$lang_atts = get_language_attributes( 'html' );
if(get_site_url()=='https://vpn-anbieter-vergleich-test.de' || get_site_url() == 'https://vpntester.org')
	$lang_atts = str_replace('de-DE', 'de', $lang_atts)
?><!DOCTYPE html>
<html <?= $lang_atts; ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="post:type" content="<? echo get_post_type() ?>" />
	<meta name="post:id" content="<? echo $apid ?>" />
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="preload" as="font" type="font/woff2" href="/wp-content/themes/generatepress/k8/assets/webfonts/fa-solid-900.woff2" crossorigin>
    <link rel="preload" as="font" type="font/woff2" href="/wp-content/themes/generatepress/k8/assets/webfonts/fa-regular-400.woff2" crossorigin>
    <link rel="preload" as="font" type="font/woff2" href="/wp-content/themes/generatepress/fonts/generatepress.woff2" crossorigin>
    <link rel="preload" as="font" type="font/woff2" href="/wp-content/themes/generatepress/k8/assets/webfonts/fa-brands-400.woff2" crossorigin>
    <link href="https://www.googletagmanager.com" rel="preconnect" crossorigin>
	<link href="https://www.google-analytics.com" rel="preconnect" crossorigin>
	<link href="https://s.w.org" rel="preconnect" crossorigin>

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,400;0,700;1,400;1,700&family=Source+Sans+Pro:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

	<style>
		body,
		body *{
			font-family: 'Roboto Condensed', sans-serif;
			/* font-size: 16px !important; */
			line-height: 1.6;
		}
		body h1,
		body h2,
		body h3,
		body h4,
		body h5,
		body h6{
			font-family: 'Source Sans Pro', sans-serif;
			font-weight: 700;
		}

	</style>

	<script>
		/**
		 * Only for IE11
		 */
		if (navigator.userAgent.toUpperCase().indexOf("TRIDENT/") != -1 || navigator.userAgent.toUpperCase().indexOf("MSIE") != -1) {
			var polyfillScript = document.createElement('script');
			polyfillScript.src = 'https://polyfill.io/v3/polyfill.min.js?features=Symbol%2CArray.from%2CSymbol.asyncIterator%2CSymbol.for%2CSymbol.hasInstance%2CSymbol.isConcatSpreadable%2CSymbol.iterator%2CSymbol.keyFor%2CSymbol.match%2CSymbol.prototype.description%2CSymbol.replace%2CSymbol.search%2CSymbol.species%2CSymbol.split%2CSymbol.toPrimitive%2CSymbol.toStringTag%2CSymbol.unscopables%2CArray.prototype.%40%40iterator%2CIntersectionObserver%2CArray.prototype.forEach%2CNodeList.prototype.forEach';
			document.head.appendChild(polyfillScript);

			var supportStyle = document.createElement('link');
			supportStyle.rel = 'stylesheet';
			supportStyle.href = '<? echo get_template_directory_uri() ?>/k8/assets/css/ie-support.css';
			document.head.appendChild(supportStyle);
		}
	</script>
	<?php

	if( is_single() && has_category( get_field('k8_optz_amp_cat','option'), $apid ) && get_field('k8_optz_amp','option') == 1 ) : ?>
		<link rel="amphtml" href="<?php the_permalink( $apid ); ?>amp/">
	<?php
	endif; ?>

	<?php wp_head(); ?>


</head>
<?php
// (wp_is_mobile()) ? $k8_mob_clss = 'k8body__mob' : $k8_mob_clss = 'k8_desktop' ;
?>
<body <?php body_class(); ?> <?php generate_do_microdata( 'body' ); ?>>
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
	do_action('mira_snackbar_top', ['static']);
	echo '<div class="main-navigation-container">';
	do_action('mira_snackbar_top', ['sticky']);
	do_action( 'generate_before_header' );
	echo '</div>';

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
	

	if (!is_page_template('k8tpl-passgen.php') && !is_page_template('k8tpl-test.php')): ?>
	<div id="page" class="hfeed site grid-container container grid-parent">
		<div id="content" class="site-content">
			<?php
	endif;
			/**
			 * generate_inside_container hook.
			 *
			 * @since 0.1
			 */
			do_action( 'generate_inside_container' );