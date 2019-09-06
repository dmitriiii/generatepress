<?php
class K8Assets
{
	public function __construct()
	{
		add_action( 'wp_enqueue_scripts', array( $this, 'load_scripts') );
	}

	public function load_scripts() {

		wp_enqueue_style( 'reacher89-my-css', get_template_directory_uri() . '/k8/assets/css/my.css', array(), rand(1,1000), 'all' );
  	
  	wp_register_script( 'reacher89-my-js', get_template_directory_uri() . '/k8/assets/js/my.js', array(), rand(1,1000), true );
  	wp_localize_script( 'reacher89-my-js', 'k8All', array(
	    'ajaxurl' => admin_url( 'admin-ajax.php' ),
	  ));
  	wp_enqueue_script('reacher89-my-js');


		if( is_single() && get_post_type()=='downloads' ){
			wp_register_script( 'k8-slick-js', get_template_directory_uri() . '/k8/assets/js/slick.min.js', array('jquery'), null, false );
			wp_enqueue_script( 'k8-slick-js' );

	 	 	wp_register_style( 'k8-slick-css', get_template_directory_uri() . '/k8/assets/css/slick.css', array(), false, 'all' );
			wp_enqueue_style( 'k8-slick-css' );

		}

		if(is_attachment()){
			wp_register_script( 'k8-recaptcha-js', 'https://www.google.com/recaptcha/api.js', array(), null, false );
			wp_enqueue_script( 'k8-recaptcha-js' );
		}


		// wp_register_style( 'k8-all-css', get_template_directory_uri() . '/k8/assets/css/all.css', array(), true, 'all' );
		// wp_enqueue_style( 'k8-all-css' );

		// wp_register_script( 'k8-all-js', get_template_directory_uri() . '/k8/assets/js/code.js', array('jquery'), 1.1, false );
		// wp_enqueue_script( 'k8-all-js' );

	}

}
new K8Assets;