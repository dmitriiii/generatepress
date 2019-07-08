<?php
class K8Assets
{
	public function __construct()
	{
		// add_action( 'wp_enqueue_scripts', array( $this, 'wpdocs_theme_name_scripts') );
	}

	public function wpdocs_theme_name_scripts() {

		// if( is_page_template('tpl-coupon.php') ){
		// 	wp_register_script( 'k8-intUtils-js', get_template_directory_uri() . '/k8/assets/js/utils.js', array('jquery'), 1.1, false );
		// 	wp_enqueue_script( 'k8-intUtils-js' );

		// 	wp_register_script( 'k8-intlTelInput-js', get_template_directory_uri() . '/k8/assets/js/intlTelInput-jquery.min.js', array('jquery'), 1.1, false );
	 //  	wp_enqueue_script( 'k8-intlTelInput-js' );

		// 	wp_register_script( 'k8-mask-js', get_template_directory_uri() . '/k8/assets/js/jquery.mask.min.js', array('jquery'), 1.1, false );
	 // 	 	wp_enqueue_script( 'k8-mask-js' );

	 // 	 	wp_register_style( 'k8-intlTelInput-css', get_template_directory_uri() . '/k8/assets/css/intlTelInput.min.css', array(), false, 'all' );
		// 	wp_enqueue_style( 'k8-intlTelInput-css' );

		// }

		// wp_register_style( 'k8-all-css', get_template_directory_uri() . '/k8/assets/css/all.css', array(), true, 'all' );
		// wp_enqueue_style( 'k8-all-css' );

		// wp_register_script( 'k8-all-js', get_template_directory_uri() . '/k8/assets/js/code.js', array('jquery'), 1.1, false );
		// wp_enqueue_script( 'k8-all-js' );

	}

}
new K8Assets;