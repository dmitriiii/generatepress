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
		if ( ! isset( $content_width ) ) {
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
add_filter('pre_site_transient_update_themes', create_function( '$a', "return null;" ) );
# no auto updates (should be manual to prevent breaking stuff without noticing)
add_filter( 'auto_update_theme', '__return_false' );
add_filter( 'auto_update_plugin', '__return_false' );



add_action( 'wp_enqueue_scripts', 'reacher89_scripts' );
function reacher89_scripts() {
  wp_enqueue_style( 'reacher89-my-css', get_template_directory_uri() . '/k8/assets/css/my.css' );
  wp_enqueue_script( 'reacher89-my-js', get_template_directory_uri() . '/k8/assets/js/my.js', array(), '', true );
}

#implement only not for certain websites
#
$k8_arrr = array(
	'https://vpn-anbieter-vergleich-test.de'
);
if( in_array(get_site_url(), $k8_arrr) ){

	#REST API FOR CRON
	add_action( 'rest_api_init', 'create_api_posts_meta_field' );

	function create_api_posts_meta_field() {

	 // register_rest_field ( 'name-of-post-type', 'name-of-field-to-return', array-of-callbacks-and-schema() )
	 register_rest_field( 'affcoups_coupon', 'k8_pm', array(
		 'get_callback' => 'get_post_meta_for_api',
		 'schema' => null,
		 )
	 );

	 register_rest_field( 'affcoups_coupon', 'k8_cont', array(
		 'get_callback' => 'get_content_for_api',
		 'schema' => null,
		 )
	 );

	 register_rest_field( 'affcoups_coupon', 'k8_exc', array(
		 'get_callback' => 'get_excerpt_for_api',
		 'schema' => null,
		 )
	 );

	 register_rest_field( 'affcoups_coupon', 'k8_aff_typ', array(
		 'get_callback' => 'get_k8_aff_typ',
		 'schema' => null,
		 )
	 );

	 register_rest_field( 'affcoups_coupon', 'k8_aff_cat', array(
		 'get_callback' => 'get_k8_aff_cat',
		 'schema' => null,
		 )
	 );

	 register_rest_field( 'affcoups_coupon', 'k8_aff_cat', array(
		 'get_callback' => 'get_k8_aff_cat',
		 'schema' => null,
		 )
	 );

	 register_rest_field( 'affcoups_coupon', 'k8_feat_img', array(
		 'get_callback' => 'k8_api_coup_feat_img',
		 'schema' => null,
		 )
	 );

	 register_rest_field( 'affcoups_vendor', 'k8_vend', array(
		 'get_callback' => 'k8_add_vendors',
		 'schema' => null,
		 )
	 );

	 register_rest_field( 'affcoups_vendor', 'k8_feat_img', array(
		 'get_callback' => 'k8_api_feat_img',
		 'schema' => null,
		 )
	 );

	}

	function get_k8_aff_cat( $object ){
		$post_id = $object['id'];
		$termz = get_the_terms( $post_id, 'affcoups_coupon_category' );
		return $termz;
	}
	function get_k8_aff_typ( $object ){
		$post_id = $object['id'];
		$termz = get_the_terms( $post_id, 'affcoups_coupon_type' );
		return $termz;
	}
	function get_post_meta_for_api( $object ) {
		$post_id = $object['id'];
		return get_post_meta( $post_id );
	}
	function get_content_for_api( $object ) {
		$post_id = $object['id'];
		$post = get_post($post_id);
		$content = $post->post_content;
		return $content;
	}
	function get_excerpt_for_api( $object ) {
		$post_id = $object['id'];
		$post = get_post($post_id);
		$excerpt = $post->post_excerpt;
		return $excerpt;
	}

	function k8_api_coup_feat_img( $object ){
		$post_id = $object['id'];
		$affcoups_vendor_image = get_post_meta( $post_id, 'affcoups_coupon_image', true );
		$arr = wp_get_attachment_image_src( $affcoups_vendor_image, 'medium_large');
		return $arr[0];
	}

	function k8_add_vendors( $object ){
		$post_id = $object['id'];
		return get_post_meta( $post_id );
	}
	function k8_api_feat_img( $object ){
		$post_id = $object['id'];
		$affcoups_vendor_image = get_post_meta( $post_id, 'affcoups_vendor_image', true );
		$arr = wp_get_attachment_image_src( $affcoups_vendor_image, 'medium_large');
		return $arr[0];
	}


		/**
	 * Add REST API support to an already registered post type.
	 */
	add_filter( 'register_post_type_args', 'my_post_type_args', 10, 2 );
	function my_post_type_args( $args, $post_type ) {
    if ( 'affcoups_vendor' === $post_type ) {
      $args['show_in_rest'] = true;
    }
    return $args;
	}







	
}