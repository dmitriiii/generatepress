<?php
/**
 *	Add/Change rewrite rules
 */
class M5Rewrite
{

	function __construct(){
		if( get_site_url() == 'https://vpn-anbieter-vergleich-test.de' || get_site_url() ==  'https://vpntester.org' ){
			add_action( 'init', [$this,'removeFromUrl'] );
			add_filter('post_link', [$this,'removeFromPermalink'], 10, 3);
			add_filter('post_type_link', [$this,'rmvFromAnspress'], 100, 3);
		}
	}

	#add rewrite rules to remove vpn-anbieter or anbieter category name
	# for ex. vpn-anbieter-vergleich-test.de/nordvpn instead of vpn-anbieter-vergleich-test.de/vpn-anbieter/nordvpn
	public function removeFromUrl(){
		$vpnidPid =	json_decode( file_get_contents( K8_PATH_LOC . '/' . 'vpnidPid.json'), true );
		if( is_array($vpnidPid) && count($vpnidPid)>0 ){
			foreach ($vpnidPid as $artcl) {
				if( get_post_status( $artcl['pid'] ) !== 'publish'){
					continue;
				}
				$post_slug = get_post_field( 'post_name', $artcl['pid'] );
				add_rewrite_rule( $post_slug.'$', 'index.php?p='.$artcl['pid'], 'top' );
			}
		}
	}

	#remove from permalinks /vpn-anbieter/ and /anbieter/ if it belongs from
	#array of review articles
	public function removeFromPermalink($url, $post, $leavename=false){
		$vpnidPid =	json_decode( file_get_contents( K8_PATH_LOC . '/' . 'vpnidPid.json'), true );
		$pos = array_search((int)$post->ID, array_column($vpnidPid, 'pid'));
		if( $pos !== false ){
			$url = str_replace( '/anbieter/','/', $url );
			$url = str_replace( '/vpn-anbieter/','/', $url );
		}
	  return $url;
	}

	#Fix issue with Anspress question & answer plugin
	public function rmvFromAnspress($url, $post, $leavename=false){
		if ( $post->post_type == 'question' || $post->post_type == 'answer' ){
	    $url = str_replace( '/de/','/', $url );
		}
	  return $url;
	}
}

new M5Rewrite();