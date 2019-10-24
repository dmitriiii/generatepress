<?php
class K8Assets
{
	public function __construct()
	{
		#Add scripts on front
		add_action( 'wp_enqueue_scripts', array( $this, 'load_scripts') );
		#add for admin dashboard
		add_action('admin_enqueue_scripts', array($this, 'admin_style'));
	}
	public function load_scripts() {
		if( is_single() && get_post_type()=='downloads' ){
			wp_register_script( 'k8-slick-js', get_template_directory_uri() . '/k8/assets/js/slick.min.js', array('jquery'), null, false );
			wp_enqueue_script( 'k8-slick-js' );
			wp_register_script( 'k8-sticky-js', get_template_directory_uri() . '/k8/assets/js/jquery.sticky-kit.min.js', array('jquery'), null, false );
			wp_enqueue_script( 'k8-sticky-js' );
			wp_register_style( 'k8-slick-css', get_template_directory_uri() . '/k8/assets/css/slick.css', array(), false, 'all' );
			wp_enqueue_style( 'k8-slick-css' );
		}
		if(is_attachment()){
			wp_register_script( 'k8-recaptcha-js', 'https://www.google.com/recaptcha/api.js', array(), null, false );
			wp_enqueue_script( 'k8-recaptcha-js' );
		}
		if( is_page_template( 'k8tpl-post-vpn-security.php' ) ){
			wp_register_style( 'k8-boot4grid-css', get_template_directory_uri() . '/k8/assets/css/grid.min.css', array(), false, 'all' );
			wp_enqueue_style( 'k8-boot4grid-css' );
		}
		wp_enqueue_style( 'reacher89-my-css', get_template_directory_uri() . '/k8/assets/css/my.css', array(), rand(1,1000), 'all' );
		wp_register_script( 'reacher89-my-js', get_template_directory_uri() . '/k8/assets/js/my.js', array(), rand(1,1000), true );
		wp_localize_script( 'reacher89-my-js', 'k8All', array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
		));
		wp_enqueue_script('reacher89-my-js');
	}
	#add css for admin dashboard
	public function admin_style(){
		wp_enqueue_style('admin-styles', get_template_directory_uri().'/admin.css');
		wp_register_style( 'k8-admin-style-css', get_template_directory_uri() . '/k8/admin/css/k8-admin-style.css', array(), false, 'all' );
		wp_enqueue_style( 'k8-admin-style-css' );
	}
}
new K8Assets;