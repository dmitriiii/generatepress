<?php
class K8Assets
{
	public function __construct()
	{
		#Add scripts on front
		add_action( 'wp_enqueue_scripts', array( $this, 'load_scripts') );
		#add for admin dashboard
		add_action('admin_enqueue_scripts', array($this, 'admin_style'));

		if( get_site_url() == 'https://vpn-anbieter-vergleich-test.de' ){
			add_action( 'admin_head', array($this, 'acf_fix') );
		}
	}
	public function load_scripts() {
		
		wp_register_script( 'k8-slick-js', get_template_directory_uri() . '/k8/assets/js/slick.min.js', array('jquery'), null, false );
		wp_register_style( 'k8-slick-css', get_template_directory_uri() . '/k8/assets/css/slick.css', array(), false, 'all' );
		wp_register_script( 'k8-sticky-js', get_template_directory_uri() . '/k8/assets/js/jquery.sticky-kit.min.js', array('jquery'), null, false );

		wp_register_style( 'k8-boot4grid-css', get_template_directory_uri() . '/k8/assets/css/grid.min.css', array(), false, 'all' );

		wp_register_style( 'k8-vpn-security-css', get_template_directory_uri() . '/k8/assets/css/tpl/vpn-security.css', array(), false, 'all' );
		wp_register_style( 'k8-ip-test-css', get_template_directory_uri() . '/k8/assets/css/tpl/ip-test.css', array(), false, 'all' );

		#SHORTCODE's JS & CSS
		#[K8_SH_SPEEDTEST]
		wp_register_script( 'reacher89-countUp-min-js', get_template_directory_uri() . '/k8/assets/js/shortcodes/countUp.min.js', array(), false, true );
		wp_register_style( 'k8_sh_speedtest-css', get_template_directory_uri() . '/k8/assets/css/shortcodes/k8_sh_speedtest.css', array(), rand(1,1000), 'all' );
		#END SHORTCODE's JS & CSS

		if( is_single() && get_post_type()=='downloads' ){
			wp_enqueue_script( 'k8-slick-js' );
			wp_enqueue_script( 'k8-sticky-js' );
			wp_enqueue_style( 'k8-slick-css' );
		}

		if(is_attachment()){
			wp_register_script( 'k8-recaptcha-js', 'https://www.google.com/recaptcha/api.js', array(), null, false );
			wp_enqueue_script( 'k8-recaptcha-js' );
		}

		wp_enqueue_style( 'reacher89-fa-all-css', get_template_directory_uri() . '/k8/assets/css/fa-all.css', array(), false, 'all' );
		wp_enqueue_style( 'reacher89-my-css', get_template_directory_uri() . '/k8/assets/css/my.css', array(), rand(1,1000), 'all' );
		wp_register_script( 'reacher89-my-js', get_template_directory_uri() . '/k8/assets/js/my.js', array(), rand(1,1000), true );
		wp_localize_script( 'reacher89-my-js', 'k8All', array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
		));
		wp_enqueue_script('reacher89-my-js');

		#Template with IP detection
		if( is_page_template( 'k8tpl-ip-test.php' ) ){
			wp_enqueue_style( 'k8-ip-test-css' );
		}

		#Template for Security Page
		if( is_page_template( 'k8tpl-post-vpn-security.php' ) ){
			wp_enqueue_style( 'k8-boot4grid-css' );
			wp_enqueue_style( 'k8-vpn-security-css' );
		}
	}

	#add css for admin dashboard
	public function admin_style(){
		wp_register_style( 'k8-admin-style-css', get_template_directory_uri() . '/k8/admin/css/k8-admin-style.css', array(), false, 'all' );
		wp_enqueue_style( 'k8-admin-style-css' );
	}

	#Fix ACF fonts on vavt.de issue
	public function acf_fix(){
		$st_url = get_site_url();
		echo	"<style type='text/css'>
				    @font-face {
							font-family: 'acf';
							src: url( '$st_url/wp-content/plugins/advanced-custom-fields-pro/assets/font/acf.ttf');
							src: url('$st_url/wp-content/plugins/advanced-custom-fields-pro/assets/font/acf.woff') format('woff');
						}
				    </style>";
	}
}
new K8Assets;