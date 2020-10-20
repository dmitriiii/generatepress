<?php
// ****************************************************************************************************
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page();
}

require_once( __DIR__ . '/K8Init.php');

// AMP support
if( get_field('k8_optz_amp','option') && get_field('k8_optz_amp','option') == 1 ){
	// write_log( 'Herrre' );
	define( 'AMP_QUERY_VAR', apply_filters( 'amp_query_var', 'amp' ) );
	add_rewrite_endpoint( AMP_QUERY_VAR, EP_PERMALINK );
	add_filter( 'template_include', 'amp_page_template', 99 );
	function amp_page_template( $template ) {
		// global $wp_query;
		// $post_type = get_query_var('post_type');

		// write_log(get_defined_vars());
		if( get_query_var( AMP_QUERY_VAR, false ) !== false ) {
			if ( is_single() && has_category( get_field('k8_optz_amp_cat','option'), get_the_ID() ) ) {
				$template = get_template_directory() .  '/amp/tpl/single-news.php';
			}
		}
		return $template;
	}
}


/**
 * GeneratePress.
 *
 * Please do not make any edits to this file. All edits should be done in a child theme.
 *
 * @package GeneratePress
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
// Set our theme version.
define( 'GENERATE_VERSION', '2.2.1' );
if ( ! function_exists( 'generate_setup' ) ) {
	add_action( 'after_setup_theme', 'generate_setup' );
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * @since 0.1
	 */
	function generate_setup() {
		// Make theme available for translation.
		load_theme_textdomain( 'generatepress' );
		// Add theme support for various features.
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link', 'status' ) );
		add_theme_support( 'woocommerce' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support( 'align-wide' );
		add_theme_support( 'editor-color-palette', array() );
		add_theme_support( 'custom-logo', array(
			'height' => 70,
			'width' => 350,
			'flex-height' => true,
			'flex-width' => true,
		) );
		// Register primary menu.
		register_nav_menus( array(
			'primary' => __( 'Primary Menu', 'generatepress' ),
		) );
		/**
		 * Set the content width to something large
		 * We set a more accurate width in generate_smart_content_width()
		 */
		global $content_width;
		if ( !isset( $content_width ) ) {
			$content_width = 1200; /* pixels */
		}
		// This theme styles the visual editor to resemble the theme style.
		add_editor_style( 'css/admin/editor-style.css' );
	}
}
/**
 * Get all necessary theme files
 */
require get_template_directory() . '/inc/theme-functions.php';
require get_template_directory() . '/inc/defaults.php';
require get_template_directory() . '/inc/class-css.php';
require get_template_directory() . '/inc/css-output.php';
require get_template_directory() . '/inc/general.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/markup.php';
require get_template_directory() . '/inc/typography.php';
require get_template_directory() . '/inc/plugin-compat.php';
require get_template_directory() . '/inc/block-editor.php';
require get_template_directory() . '/inc/migrate.php';
require get_template_directory() . '/inc/deprecated.php';
if ( is_admin() ) {
	require get_template_directory() . '/inc/meta-box.php';
	require get_template_directory() . '/inc/dashboard.php';
}
/**
 * Load our theme structure
 */
require get_template_directory() . '/inc/structure/archives.php';
require get_template_directory() . '/inc/structure/comments.php';
require get_template_directory() . '/inc/structure/featured-images.php';
require get_template_directory() . '/inc/structure/footer.php';
require get_template_directory() . '/inc/structure/header.php';
require get_template_directory() . '/inc/structure/navigation.php';
require get_template_directory() . '/inc/structure/post-meta.php';
require get_template_directory() . '/inc/structure/sidebars.php';
remove_action('load-update-core.php', 'wp_update_themes' );
// add_filter('pre_site_transient_update_themes', create_function( '$a', "return null;" ) );
# no auto updates (should be manual to prevent breaking stuff without noticing)
add_filter( 'auto_update_theme', '__return_false' );
add_filter( 'auto_update_plugin', '__return_false' );
// add_filter( 'user_has_cap', function( $user_caps, $required_caps, $args, $user ) {
// 	// write_log( $user->data->user_email );
// 	if ( $user->data->user_email !== 'dk@geroy.ooo' ) {
// 		$user_caps['view_query_monitor'] = false;
// 	}
// 	return $user_caps;
// }, 10, 4 );
//
add_action( 'init', 'k8_disable_feed_for_pages' );
function k8_disable_feed_for_pages() {
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	remove_action( 'wp_head', 'feed_links', 2 );
	remove_action( 'wp_head', 'rsd_link' );
	if(!in_array($_SERVER['REQUEST_URI'],['/feed/','/blog/neuigkeiten/feed/'])) {
		remove_action( 'do_feed_rdf',  'do_feed_rdf',  10, 1 );
		remove_action( 'do_feed_rss',  'do_feed_rss',  10, 1 );
		remove_action( 'do_feed_rss2', 'do_feed_rss2', 10, 1 );
		remove_action( 'do_feed_atom', 'do_feed_atom', 10, 1 );
	}
}

// add_action( 'init', 'stop_heartbeat', 1 );
// function stop_heartbeat() {
// 	wp_deregister_script('heartbeat');
// }

add_filter( 'term_description', 'do_shortcode' );

// function k8_deregister_scripts () {
// 	$common_scripts = [
// 		'supsystic-tables-notify',
// 		'supsystic-tables-featherlight-js',
// 		'supsystic-tables-exporter-js',
// 		'supsystic-tables-datatables-fixed-headers-js',
// 		'supsystic-tables-datatables-fixed-columns-js',
// 		'generate-a11y',
// 		'generate-classlist',
// 		'affcoups-script',
// 		'eafl-public'
// 	];
// 	foreach ($common_scripts as $script) {
// 		wp_deregister_script ($script);
// 		wp_dequeue_script ($script);
// 	}
// }
// add_action ( 'wp_print_scripts', 'k8_deregister_scripts', 999);
// function k8_deregister_styles() {
// 	$common_css = [
// 		'aalb_basics_css',
// 		'generate-secondary-nav',
// 		'generate-secondary-nav-mobile',
// 		'generate-blog',
// 		'supsystic-tables-tables-featherlight-css',
// 		'supsystic-tables-datatables-fixed-headers-css'
// 	];
// 	foreach ($common_css as $css) {
// 		wp_deregister_style ($css);
// 		wp_dequeue_style ($css);
// 	}
// }
// add_action('wp_print_styles', 'k8_deregister_styles', 999);
// /* ANSPRESS FILTER */
// add_filter( 'the_content', 'k8_filter_anspress_assets' );
// function k8_filter_anspress_assets( $content ) {
// 	if(!strripos($content, '[anspress')) {
// 		$anspress_scripts = [
// 			'anspress-form',
// 			'anspress-main',
// 			'syntaxhighlighter-core',
// 			'syntaxhighlighter-autoloader',
// 			'syntaxhighlighter',
// 			'ap-recaptcha',
// 			'selectize'
// 		];
// 		foreach ($anspress_scripts as $script) {
// 			wp_deregister_script ($script);
// 			wp_dequeue_script ($script);
// 		}
// 		$anspress_css = [
// 			'syntaxhighlighter-core',
// 			'syntaxhighlighter-theme-default',
// 			'anspress-fonts',
// 			'anspress-main',
// 			'ap-overrides'
// 		];
// 		foreach ($anspress_css as $css) {
// 			wp_deregister_style ($css);
// 			wp_dequeue_style ($css);
// 		}
// 	}
// 	return $content;
// }
//
//
//
//
//
//
//

/**
 * Remove Gutenberg Block Library CSS from loading on the frontend
 */
function smartwp_remove_wp_block_library_css(){
		wp_dequeue_style( 'wp-block-library' );
		wp_dequeue_style( 'wp-block-library-theme' );
}
add_action( 'wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100 );


/**
 * Change wp product review's tables plugin output from short content to real excerpt
 */
// if(in_array(get_site_url(), ['https://vpn-anbieter-vergleich-test.de', 'https://dev.vavt.de'])) {
// 	add_filter( 'wppr_content', 'wppr_use_true_excerpt', 10, 2 );
// 	 function wppr_use_true_excerpt( $content, $id ) {
// 	 	return get_the_excerpt($id);
// 	 }
// }



add_action('admin_head','vavt_hide_login_weak');
add_action('login_enqueue_scripts','vavt_hide_login_weak');

function vavt_hide_login_weak() {
	wp_enqueue_script( 'vavt-disable-weak-password', get_template_directory_uri() . '/k8/admin/js/disable-weak.js');
}

#Redirect for routers pages
if(get_site_url() == 'https://vpn-anbieter-vergleich-test.de'){
	new M5Redirect(['slug'=>'router', 'term_id'=>12004]);
}



# Fix issue with product review plugin
add_filter('do_shortcode_tag', 'k8_clean_wppr_shortcodes', 10, 3);
function k8_clean_wppr_shortcodes($output, $tag, $attr){
	if(!in_array($tag, ['wpr_landing']) ){ //make sure it is the right shortcode
		return $output;
	}
	$regexp = '/(\[[^\[\]]+(\]|\.\.\.))/'; //displayed tag or not closed tag
	return preg_replace($regexp, '', $output);
}


// Cron Updates  Affiliates Links with today's date
add_action( 'm5_hook_cron_aff', 'm5_hook_cron_aff_fun' );
function m5_hook_cron_aff_fun(){
	global $wpdb;
	$rezz =	$wpdb->get_results( "SELECT * FROM {$wpdb->prefix}posts WHERE `post_type`='easy_affiliate_link' AND `post_status`='publish' AND `post_title` LIKE '%surfshark%' OR
																																			`post_type`='easy_affiliate_link' AND `post_status`='publish' AND `post_title` LIKE '%nordvpn%' OR
																																			`post_type`='easy_affiliate_link' AND `post_status`='publish' AND `post_title` LIKE '%vyprvpn%' OR
																																			`post_type`='easy_affiliate_link' AND `post_status`='publish' AND `post_title` LIKE '%protonvpn%'" );
	if( is_array($rezz) && count($rezz)>0 ):
		foreach ($rezz as $rez) :
			$eafl_url = get_post_meta( $rez->ID, 'eafl_url', true );
			$eafl_url_arr = explode('&', $eafl_url);
			foreach ($eafl_url_arr as $key => $url_part) {
				if (strpos($url_part, 'aff_sub3') !== false)
					unset( $eafl_url_arr[$key] );
			}
			$eafl_url_arr[] = 'aff_sub3='.date("ymd");
			update_post_meta( $rez->ID, 'eafl_url', implode('&', $eafl_url_arr) );
		endforeach;
	endif;
}

#Add aff_sub4 on the fly to Affiliate urls
function m5_eafl_redirect_callback( $link ) {
	if( strpos($_SERVER['REQUEST_URI'], 'surfshark') === FALSE &&
			strpos($_SERVER['REQUEST_URI'], 'nordvpn') === FALSE &&
			strpos($_SERVER['REQUEST_URI'], 'vyprvpn') === FALSE &&
			strpos($_SERVER['REQUEST_URI'], 'protonvpn') === FALSE )
		return ;
	
	if ( !isset($_SERVER['HTTP_REFERER']) )
		return ;

	$url = $link->url();
	$url = str_replace( '@', '%40', $url );

	// Try to prevent click register issues from breaking redirect.
	try {
		@EAFL_Clicks::register( $link );
	} catch( Exception $e ) {}

	$redirect_type = $link->redirect_type();
	if ( ! in_array( intval( $redirect_type ), array( 301, 302, 307 ) ) ) {
		$redirect_type = EAFL_Settings::get( 'default_redirect_type' );
	}
	// Noindex the redirect page.
	header( 'X-Robots-Tag: noindex' );

	$eafl_url_arr = explode('&', $url);
	foreach ($eafl_url_arr as $key => $url_part) {
		if (strpos($url_part, 'aff_sub4') !== false)
			unset( $eafl_url_arr[$key] );
	}
	$eafl_url_arr[] = 'aff_sub4='.urlencode($_SERVER['HTTP_REFERER']);
	wp_redirect( implode('&', $eafl_url_arr), intval( $redirect_type ) );
	exit();
}
add_action( 'eafl_redirect', 'm5_eafl_redirect_callback', 10, 2 );


#filter to add iframes to content
// add_filter('the_content', function($content){
// 	if( is_singular() && in_the_loop() && is_main_query() ) :
// 		$id = get_the_ID();
// 		$iframes = get_field( 'k8_acf_ifr_url',$id );
// 		if( is_array($iframes) && count($iframes)>0 && !in_category( array('anbieter','vpn-anbieter'), $id ) ) {
// 			$prod_name = get_post_meta( $id, 'cwp_rev_product_name', true );
// 			$name = $prod_name ? $prod_name : 'TempIframe';
// 			foreach ($iframes as $iframe) {
// 				$content .= '<iframe src="'.$iframe['url'].'" name="'.$name .'_'. uniqid() .'" width="0" height="0" frameborder="0" scrolling="no"></iframe>';
// 			}
// 		}
// 	endif;
// 	return $content;
// });



// if(isset($_GET['purge_cache']) && $_GET['purge_cache'] == md5($_SERVER['HTTP_HOST'])) {
// 	k8_clear_cache();
// }

// function k8_clear_cache(){
// 	if (has_action('ce_clear_cache')) {
// 		do_action('ce_clear_cache');
// 	}
// 	if(function_exists('fvm_purge_all')) {
// 		fvm_purge_all();
// 	}
// 	if(class_exists('autoptimizeCache')) {
// 		autoptimizeCache::clearall();
// 	}
// }