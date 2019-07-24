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
		 'get_callback' => 'k8_api_feat_img',
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

	// function k8_api_coup_feat_img( $object ){
	// 	$post_id = $object['id'];
	// 	return get_the_post_thumbnail_url( $post_id,'medium_large' );
	// }

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





	# add the lazy-load class to most of the other images that are missing it (filters dependent)
	function raul_add_image_placeholders( $content ) {
			// Don't lazyload for feeds, previews
			if ( is_feed() || is_preview() ) {
				return $content;
			}
			// Don't lazyload for amp-wp content
			if ( function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() ) {
				return $content;
			}
			// This is a pretty simple regex, but it works
			$content = preg_replace_callback( '#<(img)([^>]+?)(>(.*?)</\\1>|[\/]?>)#si', 'raul_process_image', $content );
			return $content;
	}
	function raul_process_image( $matches ) {
			$old_attributes_str       = $matches[2];
			$old_attributes_kses_hair = wp_kses_hair( $old_attributes_str, wp_allowed_protocols() );
			if ( empty( $old_attributes_kses_hair['src'] ) ) {
				return $matches[0];
			}
			$old_attributes = raul_flatten_kses_hair_data( $old_attributes_kses_hair );
			# Don't lazy-load if there is already a data-src present
			if(isset($old_attributes['data-src']) || isset($old_attributes['data-srcset'])){
				return $matches[0];
			}
			# Don't lazy-load if there is already a lazy class
			if ( ! empty( $old_attributes['class'] ) && false !== strpos( $old_attributes['class'], 'lazy' ) ) {
				return $matches[0];
			}
			$new_attributes     = raul_process_image_attributes( $old_attributes );
			$new_attributes_str = raul_build_attributes_string( $new_attributes );
			return sprintf( '<!-- lazy loaded by fvm --><img %1$s>', $new_attributes_str, $matches[0] );
	}
	function raul_process_image_attributes( $attributes ) {
			if ( empty( $attributes['src'] ) ) {
				return $attributes;
			}
			if ( ! empty( $attributes['class'] ) && raul_should_skip_image_with_blacklisted_class( $attributes['class'] ) ) {
				return $attributes;
			}
			$old_attributes = $attributes;
			# convert srcset and sizes to data attributes.
			foreach ( array( 'srcset', 'sizes' ) as $attribute ) {
				if ( isset( $old_attributes[ $attribute ] ) ) {
					$attributes[ "data-$attribute" ] = $old_attributes[ $attribute ];
					unset( $attributes[ $attribute ] );
				}
			}
			# add class and attributes
			$attributes["data-src"] = $old_attributes['src'];
			$attributes["src"] = raul_get_placeholder_image();
			$attributes["data-lazy-type"] = 'image';
			$attributes['class']  = sprintf('%s lazy lazyfvm', empty( $old_attributes['class']) ? '' : $old_attributes['class']);
			return $attributes;
		}

	function raul_build_attributes_string( $attributes ) {
			$string = array();
			foreach ( $attributes as $name => $value ) {
				if ( '' === $value ) {
					$string[] = sprintf( '%s', $name );
				} else {
					$string[] = sprintf( '%s="%s"', $name, esc_attr( $value ) );
				}
			}
			return implode( ' ', $string );
		}

	function raul_flatten_kses_hair_data( $attributes ) {
			$flattened_attributes = array();
			foreach ( $attributes as $name => $attribute ) {
				$flattened_attributes[ $name ] = $attribute['value'];
			}
			return $flattened_attributes;
		}
	function raul_should_skip_image_with_blacklisted_class( $classes ) {
			$blacklisted_classes = array(
				'skip-lazy',
				'gazette-featured-content-thumbnail',
			);
			return false;
		}

	function raul_get_placeholder_image() {
			return 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7';
		}
	function raul_allow_lazy_attributes( $allowed_tags ) {
			if ( ! isset( $allowed_tags['img'] ) ) {
				return $allowed_tags;
			}
			// But, if images are allowed, ensure that our attributes are allowed!
			$img_attributes = array_merge( $allowed_tags['img'], array(
				'data-src' => 1,
				'data-srcset' => 1,
				'data-sizes' => 1,
				'data-lazy-type' => 1,
			) );
			$allowed_tags['img'] = $img_attributes;
			return $allowed_tags;
		}

	# allow attributes on html
	add_action( 'template_redirect', 'raul_add_extra_attributes' );
	function raul_add_extra_attributes(){
		add_filter( 'wp_kses_allowed_html', 'raul_allow_lazy_attributes');
	}

	# apply lazy loading to HTML (check if infinite loader images still show up the images properly)
	add_action('get_header', 'raul_lazy_filter_html_start', 100);
	add_action('wp_footer', function(){ ob_end_flush(); }, 100);
	function raul_lazy_filter_html($html) {
		# replacements
		$html = str_ireplace("<link href='//fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>", '', $html);
		# icons fix
		$html = str_ireplace('<img src="" srcset=" 1x, ', '<img src="', $html);
		$html = str_ireplace(' 2x" alt="', '" alt="', $html);
		# lazy load
		$html = raul_add_image_placeholders($html);
		return $html;
	}
	function raul_lazy_filter_html_start($html) {
	    ob_start('raul_lazy_filter_html');
	}
	# add lazy load library from https://github.com/malchata/yall.js
	add_action('wp_head', 'raul_add_lazy_yall');
	function raul_add_lazy_yall() {
	echo '<script src="'.get_stylesheet_directory_uri().'/js/lazyfvm.min.js" async></script>';
	}

	# no updates for optimized plugins
	function raul_filter_plugin_updates( $value ) {
		$plugins = array('tawkto-live-chat/tawkto.php', 'content-views-query-and-display-post-page/content-views.php', 'duracelltomi-google-tag-manager/duracelltomi-google-tag-manager-for-wordpress.php', 'forget-about-shortcode-buttons/forget-about-shortcode-buttons.php');
		foreach($plugins as $plugin) {
			if (isset($value->response[$plugin])){
				unset($value->response[$plugin]);
			}
		}
		return $value;
	}
	# no theme updates, else modifications will be gone
	add_filter( 'site_transient_update_plugins', 'raul_filter_plugin_updates' );
}