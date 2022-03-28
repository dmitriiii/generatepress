<?php /**
 * Redirect
 */
class M5Redirect
{
	function __construct(){

		#Redirect from non categories in urls to proper for vavt.de
		if( get_site_url() == 'https://vpn-anbieter-vergleich-test.de' || get_site_url() == 'https://vpntester.org' || get_site_url() == 'https://dev.vpnanbietervergleich.de' ){
			add_action('template_redirect', array($this, 'redir404vavt'));
		}

		#301 redirect on coupons single pages
		if( get_site_url() == 'https://vpntester.net' ){
			add_action( 'template_redirect', array( $this, 'redirect_to_home_page' ) );
		}

	}

	#Redirect from /post-name/ in urls to proper url structure /category/sub-category/post-name/
	#for website vavt.de
	public function redir404vavt(){
		global $wp_query;

		if( is_404() ){
			if( isset($wp_query->query_vars['post_type']) && $wp_query->query_vars['post_type'] == 'question' )
				return;

			if( isset($wp_query->query_vars['post_type']) && $wp_query->query_vars['post_type'] == 'answer' )
				return;

			$the_slug = $wp_query->query_vars['category_name'];
			$args = array(
				'name'        => $the_slug,
				'post_type'   => 'post',
				'post_status' => 'publish',
			);
			$my_posts = get_posts($args);

			if( $my_posts ) :
				 wp_redirect( get_permalink($my_posts[0]->ID), 301 );
				exit;
			endif;
		}

		#Redirect for review articles - from for ex. /vpn-anbieter/nordvpn/ to /nordvpn/
		if(is_single() && in_category('vpn-anbieter') ){
			$pid = get_the_ID();
			$vpnidPid =	json_decode( file_get_contents( K8_PATH_LOC . '/' . 'vpnidPid.json'), true );
			$pos = array_search((int)$pid, array_column($vpnidPid, 'pid'));
			if( $pos !== false && strpos($_SERVER['REQUEST_URI'], '/vpn-anbieter/') !== false ){
				wp_redirect( get_permalink($pid), 301 );
				exit;
			}
		}
	}


	#301 redirect on coupons single pages for website vpntester.net
	public function redirect_to_home_page() {
		if ( is_single() && 'affcoups_coupon' == get_post_type() ) {
		 wp_redirect( home_url(), 301 );
			exit;
		}
	}

}

new M5Redirect();