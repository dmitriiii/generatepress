<?php
require_once( __DIR__ . '/K8Init.php');
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


remove_action( 'do_feed_rdf',  'do_feed_rdf',  10, 1 );
remove_action( 'do_feed_rss',  'do_feed_rss',  10, 1 );
remove_action( 'do_feed_rss2', 'do_feed_rss2', 10, 1 );
remove_action( 'do_feed_atom', 'do_feed_atom', 10, 1 );

add_action( 'wp', function(){
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	remove_action( 'wp_head', 'feed_links', 2 );
	remove_action( 'wp_head', 'rsd_link' );
});




// function your_prefix_detect_shortcode()
// {
//   global $wp_query;
//   $posts = $wp_query->posts;
//   $pattern = get_shortcode_regex();


//   foreach ($posts as $post){
// 	if (   preg_match_all( '/'. $pattern .'/s', $post->post_content, $matches )
// 		&& array_key_exists( 2, $matches )
// 		&& in_array( 'pt_view', $matches[2] ) ){
// 		// enque my css and js
// 			echo '<pre>';
// 			print_r( $matches );
// 			echo '</pre>';
// 			// break;
// 		}
//   }
// }
// add_action( 'wp', 'your_prefix_detect_shortcode' );
// 
// 
function pippin_filter_content_sample($content) {
	$new_content = preg_replace('/\[pt_view/', '[k8fake shrt="pt_view"' , $content);
	return $new_content;
}
add_filter('the_content', 'pippin_filter_content_sample');