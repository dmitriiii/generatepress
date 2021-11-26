<?php
class K8Assets
{
	public function __construct()
	{
		#Add scripts on front
		add_action( 'wp_enqueue_scripts', array( $this, 'load_scripts') );
		#add for admin dashboard
		add_action('admin_enqueue_scripts', array($this, 'admin_style'));

		if( get_site_url() == 'https://vpn-anbieter-vergleich-test.de' || get_site_url() == 'https://vpntester.org' ){
			add_action( 'admin_head', array($this, 'acf_fix') );
		}


	}
	public function load_scripts() {

		wp_register_style( 'k8-slick-css', get_template_directory_uri() . '/k8/assets/css/slick.css', array(), false, 'all' );
		wp_register_style( 'k8-boot4grid-css', get_template_directory_uri() . '/k8/assets/css/grid.min.css', array(), false, 'all' );
		wp_register_style( 'k8tpl-authors-css', get_template_directory_uri() . '/k8/assets/css/tpl/k8tpl-authors.css', array(), false, 'all' );
		wp_register_style( 'k8-vpn-security-css', get_template_directory_uri() . '/k8/assets/css/tpl/vpn-security.css', array(), false, 'all' );

		wp_register_style( 'k8-ip-test-css', get_template_directory_uri() . '/k8/assets/css/tpl/ip-test.css', array(), false, 'all' );
		wp_register_style( 'k8-libs-lightgallery-css', get_template_directory_uri() . '/k8/assets/css/libs/lightgallery.css', array(), false, 'all' );
		wp_register_style( 'k8-my-mob-css', get_template_directory_uri() . '/k8/assets/css/my-mob.css', array(), false, 'all' );

		wp_register_style( 'k8-bootstrap-css', get_template_directory_uri() . '/k8/assets/css/libs/bootstrap.min.css', array(), false, 'all' );


		#SERVICES
		wp_register_script( 'check-mobile-js', get_template_directory_uri() . '/k8/assets/js/services/check-mobile.js', array('jquery'), null, false );
		wp_register_script( 'cookie', get_template_directory_uri() . '/k8/assets/js/services/cookie.js', array('jquery'), null, false );

		#
		wp_register_script( 'k8-slick-js', get_template_directory_uri() . '/k8/assets/js/slick.min.js', array('jquery'), null, false );
		wp_register_script( 'k8-sticky-js', get_template_directory_uri() . '/k8/assets/js/jquery.sticky-kit.min.js', array('jquery'), null, false );
		wp_register_script( 'k8-libs-lightgallery-js', get_template_directory_uri() . '/k8/assets/js/libs/lightgallery.min.js', array('jquery'), null, false );
		wp_register_script( 'k8-bootstrap-js', get_template_directory_uri() . '/k8/assets/js/libs/bootstrap.min.js', array('jquery'), null, false );


		#SHORTCODE's JS & CSS
		wp_register_script( 'reacher89-countUp-min-js', get_template_directory_uri() . '/k8/assets/js/shortcodes/countUp.min.js', array(), false, true );
		wp_register_script( 'k8-lib-progressbar-js', get_template_directory_uri() . '/k8/assets/js/libs/progressbar.min.js', array(), false, true );
		wp_register_script( 'k8_sh_router_info-js', get_template_directory_uri() . '/k8/assets/js/shortcodes/k8_sh_router_info.js', array('jquery'), rand(1,9999), true );
		wp_register_script( 'k8-pupop', get_template_directory_uri() . '/k8/assets/js/components/pupop.js', array('jquery'), rand(1,9999), true );
		wp_register_script( 'k8-timer', get_template_directory_uri() . '/k8/assets/js/components/timer.js', array('jquery'), rand(1,9999), true );
		wp_register_script( 'k8-sales-pupop', get_template_directory_uri() . '/k8/assets/js/components/sales-pupop.js', array('k8-pupop'), rand(1,9999), true );

		# [K8_SH_COUPON]
		wp_register_script( 'k8_sh_coupon-js-run', get_template_directory_uri() . '/templz/shortcodes/K8_SH_COUPON/build/static/js/runtime-main.7de392ff.js', array(), false, true );
		wp_register_script( 'k8_sh_coupon-js-2', get_template_directory_uri() . '/templz/shortcodes/K8_SH_COUPON/build/static/js/2.37ce1337.chunk.js', array(), false, true );
		wp_register_script( 'k8_sh_coupon-js-3', get_template_directory_uri() . '/templz/shortcodes/K8_SH_COUPON/build/static/js/3.b9afe8b6.chunk.js', array(), false, true );
		wp_register_script( 'k8_sh_coupon-js-main', get_template_directory_uri() . '/templz/shortcodes/K8_SH_COUPON/build/static/js/main.f0341fa0.chunk.js', array(), false, true );
		wp_register_style( 'k8_sh_coupon-css-main', get_template_directory_uri() . '/templz/shortcodes/K8_SH_COUPON/build/static/css/main.3944c5e9.chunk.css', array(), rand(1,9999), 'all' );


		# [K8_SH_ACCOUNT]
		wp_register_script( 'k8_sh_account-js-run', get_template_directory_uri() . '/templz/shortcodes/K8_SH_ACCOUNT/build/static/js/runtime-main.3094585e.js', array(), false, true );
		wp_register_script( 'k8_sh_account-js-2', get_template_directory_uri() . '/templz/shortcodes/K8_SH_ACCOUNT/build/static/js/2.24eea4d3.chunk.js', array(), false, true );
		wp_register_script( 'k8_sh_account-js-3', get_template_directory_uri() . '/templz/shortcodes/K8_SH_ACCOUNT/build/static/js/3.9d551ee8.chunk.js', array(), false, true );
		wp_register_script( 'k8_sh_account-js-main', get_template_directory_uri() . '/templz/shortcodes/K8_SH_ACCOUNT/build/static/js/main.f93ab015.chunk.js', array(), false, true );
		wp_register_style( 'k8_sh_account-css-main', get_template_directory_uri() . '/templz/shortcodes/K8_SH_ACCOUNT/build/static/css/main.bdc2b1b1.chunk.css', array(), rand(1,9999), 'all' );



		wp_register_style( 'k8-pupop', get_template_directory_uri() . '/k8/assets/css/components/pupop.css', array(), rand(1,9999), 'all' );
		wp_register_style( 'k8-timer', get_template_directory_uri() . '/k8/assets/css/components/timer.css', array(), rand(1,9999), 'all' );
		wp_register_style( 'k8_sh_speedtest-css', get_template_directory_uri() . '/k8/assets/css/shortcodes/k8_sh_speedtest.css', array(), false, 'all' );
		wp_register_style( 'k8_sh_howto-css', get_template_directory_uri() . '/k8/assets/css/shortcodes/k8_sh_howto.css', array(), false, 'all' );
		wp_register_style( 'k8_sh_best-css', get_template_directory_uri() . '/k8/assets/css/shortcodes/k8_sh_best.css', array(), false, 'all' );
		wp_register_style( 'k8_sh_router_info-css', get_template_directory_uri() . '/k8/assets/css/shortcodes/k8_sh_router_info.css', array(), rand(1,9999), 'all' );
		wp_register_style( 'K8_SHORT_FAQ-css', get_template_directory_uri() . '/templz/shortcodes/K8_SHORT_FAQ/css/style.css', array(), rand(1,9999), 'all' );
		#END SHORTCODE's JS & CSS

		#Components&Modules
		wp_register_script( 'k8-sidebar-nav-js', get_template_directory_uri() . '/k8/assets/js/components/sidebar-nav.js', array('jquery'), rand(1,9999), true );
		wp_register_style( 'k8-sidebar-nav-css', get_template_directory_uri() . '/k8/assets/css/components/sidebar-nav.css', array(), rand(1,9999), 'all' );

		#END Components&Modules

		#Fix for wppr
		wp_register_style( 'wp-product-review-widget-css', '/wp-content/plugins/wp-product-review/assets/css/cwppos-widget.css',[], rand(1,9999), 'all' );
		wp_enqueue_style( 'wp-product-review-widget-css' );
		#END fix

		if( is_single() && get_post_type()=='downloads' ){
			// wp_enqueue_script( 'k8-slick-js' );
			wp_enqueue_script( 'k8-sticky-js' );
			// wp_enqueue_style( 'k8-slick-css' );
		}

		if(is_attachment()){
			wp_register_script( 'k8-recaptcha-js', 'https://www.google.com/recaptcha/api.js', array(), null, false );
			wp_enqueue_script( 'k8-recaptcha-js' );
		}

		wp_enqueue_style( 'reacher89-fa-all-css', get_template_directory_uri() . '/k8/assets/css/fa-all.css', array(), false, 'all' );
		wp_enqueue_style( 'reacher89-my-css', get_template_directory_uri() . '/k8/assets/css/my.css', array(), rand(1,9999), 'all' );

		#MU Services
		wp_enqueue_script( 'check-mobile-js' );
		wp_enqueue_script( 'cookie' );

		#Components&Modules
		wp_enqueue_style( 'k8-sidebar-nav-css' );
		wp_enqueue_script( 'k8-sidebar-nav-js' );
		#END Components&Modules

		wp_register_script( 'reacher89-my-js', get_template_directory_uri() . '/k8/assets/js/my.js', array(), rand(1,9999), true );
		wp_localize_script( 'reacher89-my-js', 'k8All', array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
		));
		wp_enqueue_script('reacher89-my-js');

		#Template with IP detection
		if( is_page_template( 'k8tpl-ip-test.php' ) ){
			wp_enqueue_style( 'k8-ip-test-css' );
			wp_enqueue_style( 'k8-ip-test-css-2', get_template_directory_uri() . '/k8/assets/css/tpl/k8tpl-test/2.8aa5a7f8.chunk.css', array(), false, 'all' );
			wp_enqueue_style( 'k8-ip-test-css-main', get_template_directory_uri() . '/k8/assets/css/tpl/k8tpl-test/main.3c3a7fcd.chunk.css', array(), false, 'all' );

			wp_enqueue_script( 'k8-ip-test-js-run', get_template_directory_uri() . '/k8/assets/js/tpl/k8tpl-test/runtime-main.4dc7fbe5.js', array(), false, true );
			wp_enqueue_script( 'k8-ip-test-js-2', get_template_directory_uri() . '/k8/assets/js/tpl/k8tpl-test/2.2ea7d36a.chunk.js', array(), false, true );
			wp_enqueue_script( 'k8-ip-test-js-main', get_template_directory_uri() . '/k8/assets/js/tpl/k8tpl-test/main.a6d182e4.chunk.js', array(), false, true );
		}

		#Template Password Generator
		if( is_page_template( 'k8tpl-passgen.php' ) ){
			wp_enqueue_style( 'k8tpl-passgen-google-fonts', 'https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@500&display=swap', false );
			wp_enqueue_style( 'k8tpl-passgen-app-css', get_template_directory_uri() . '/modules/passgen/css/app.css', array(), false, 'all' );
			wp_enqueue_script( 'k8tpl-passgen-viewport-js', get_template_directory_uri() . '/modules/passgen/viewport.js', array(), rand(1,9999), true );
			wp_enqueue_script( 'k8tpl-passgen-app-js', get_template_directory_uri() . '/modules/passgen/app.js', array(), false, true );
		}


		#Template for Security Page
		if( is_page_template( 'k8tpl-post-vpn-security.php' ) ){
			wp_enqueue_style( 'k8-boot4grid-css' );
			wp_enqueue_style( 'k8-vpn-security-css' );
		}

		#Template for Test1
		if( is_page_template( 'k8tpl-test.php' ) ){
			wp_register_script( 'k8tpl-test-js', get_template_directory_uri() . '/k8/assets/js/tpl/k8tpl-test/index.js', array(), rand(1,9999), true );
			wp_localize_script( 'k8tpl-test-js', 'wpApiSettings', array(
				'root' => esc_url_raw( rest_url() ),
    		'nonce' => wp_create_nonce( 'wp_rest' )
			));
			wp_enqueue_script('k8tpl-test-js');
		}


		#Template for Author's Page
		if( is_page_template( 'k8tpl-authors.php' ) ){
			wp_enqueue_style( 'k8tpl-authors-css' );
		}

		#for mobile styles
		if(wp_is_mobile()){
			wp_enqueue_style( 'k8-my-mob-css' );
		}

	}

	#add css for admin dashboard
	public function admin_style(){
		wp_register_style( 'k8-admin-style-css', get_template_directory_uri() . '/k8/admin/css/k8-admin-style.css', array(), false, 'all' );
		wp_enqueue_style( 'k8-admin-style-css' );
		wp_enqueue_script('jquery-migrate');
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