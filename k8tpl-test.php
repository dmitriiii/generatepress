<?php /* Template Name: Test1
				Template Post Type: post, page */
get_header();
wp_enqueue_style('k8-bootstrap-css');
wp_enqueue_script('k8-bootstrap-js');

// echo '<pre>';
// print_r( K8Help::getAllImgSizes() );
// echo '</pre>';

// echo 'Bingobongo';



function smTewdedw( $ppost, $shrt='affcoups' ){
	$result = '';
	//get shortcode regex pattern wordpress function
	$pattern = get_shortcode_regex([$shrt]);
	if (  preg_match_all( '/'. $pattern .'/s', $ppost->post_content, $matches ) ){
	 $result = implode( '<br/>', $matches[0] );
	}
	return $result;
}

#Returns array of all handlews, where used AppsFlyer tracker
function getHandlesArr(){
	global $wpdb;
	$finall = [];
	$sql = $wpdb->prepare( "SELECT * FROM wp_vavt_de_wppr_privacy_report_tracker WHERE tracker_id=%d",12);
	$reports_arr = $wpdb->get_results( $sql , ARRAY_A );
	if (is_array($reports_arr) && count($reports_arr)>0) :
	foreach ($reports_arr as $report) :
		$sql2 = $wpdb->prepare( "SELECT app_name, handle FROM wp_vavt_de_wppr_privacy_report WHERE id=%d", $report['report_id']);
		$res = $wpdb->get_results( $sql2 , ARRAY_A );
		$finall[] = $res[0]['handle'];
	endforeach;
	endif;
	$finall = array_unique($finall);
	return $finall;
}
?>

<style>
	.m5-procc{
		/* color: #fff; */
		background-color: moccasin !important;
	}
	.m5-succ{
		color: #fff;
		background-color: mediumseagreen !important;
	}
	.m5-err{
		color: #fff;
		background-color: coral !important;
	}
	body .table.pills-aff-tbl td{
		padding: 5px;
	}
	.colr-wh{
		color: #fff !important;
	}
	.m5-colr-dng{
		color: #fff;
		background-color: #dc3545 !important;
	}
	.m5-colr-dng a{
		color: #fff;
	}
	.tab-content .p-2{
		padding: 0 !important;
		margin: 0 !important;
	}
	.tab-content .table td{
		padding: 10px;
	}
	.tableFixHead{
		overflow: auto;
		height: 700px;
	}
	.tableFixHead thead th {
		position: sticky;
		top: 0;
		z-index: 1;
		background: #fff;
	}
	.m5_gsearch{
		max-width: 700px;
		margin: 30px auto 50px;
		background-color: #eee;
		padding: 30px 30px 10px;
	}
	.results{
		min-height: 300px;
		position: relative;
	}

	/* Preloader Styles */
	.prld{
		position: absolute;
		left: 0;
		top: 0;
		width: 100%;
		height: 100%;
		background: rgba(0,0,0,0.7);
		align-items: center;
		justify-content: center;
		display: none;
	}
	.prld.active{
		display: flex;
	}
	.lds-ellipsis {
	  display: inline-block;
	  position: relative;
	  width: 80px;
	  height: 80px;
	}
	.lds-ellipsis div {
	  position: absolute;
	  top: 33px;
	  width: 13px;
	  height: 13px;
	  border-radius: 50%;
	  background: #fff;
	  animation-timing-function: cubic-bezier(0, 1, 1, 0);
	}
	.lds-ellipsis div:nth-child(1) {
	  left: 8px;
	  animation: lds-ellipsis1 0.6s infinite;
	}
	.lds-ellipsis div:nth-child(2) {
	  left: 8px;
	  animation: lds-ellipsis2 0.6s infinite;
	}
	.lds-ellipsis div:nth-child(3) {
	  left: 32px;
	  animation: lds-ellipsis2 0.6s infinite;
	}
	.lds-ellipsis div:nth-child(4) {
	  left: 56px;
	  animation: lds-ellipsis3 0.6s infinite;
	}
	@keyframes lds-ellipsis1 {
	  0% {
	    transform: scale(0);
	  }
	  100% {
	    transform: scale(1);
	  }
	}
	@keyframes lds-ellipsis3 {
	  0% {
	    transform: scale(1);
	  }
	  100% {
	    transform: scale(0);
	  }
	}
	@keyframes lds-ellipsis2 {
	  0% {
	    transform: translate(0, 0);
	  }
	  100% {
	    transform: translate(24px, 0);
	  }
	}
</style>


<?php

if ( isset($_GET['create_tax']) && $_GET['create_tax'] == 777 ) {
	$m5country = new M5Country();
	// $m5country->createTax();
	echo '<pre>';
	print_r($m5country->createTax());
	echo '</pre>';
}

#dinalically change aff links
if( isset($_GET['repl_frame']) && $_GET['repl_frame'] == 777 ){

	global $wpdb;
	$rezz =	$wpdb->get_results( "SELECT * FROM {$wpdb->prefix}posts WHERE `post_type`='easy_affiliate_link' AND `post_status`='publish' AND `post_title` LIKE '%surfshark%' OR
																																			`post_type`='easy_affiliate_link' AND `post_status`='publish' AND `post_title` LIKE '%nordvpn%' OR
																																			`post_type`='easy_affiliate_link' AND `post_status`='publish' AND `post_title` LIKE '%vyprvpn%' OR
																																			`post_type`='easy_affiliate_link' AND `post_status`='publish' AND `post_title` LIKE '%protonvpn%'" );
	if( is_array($rezz) && count($rezz)>0 ):
		foreach ($rezz as $rez) :
			$eafl_url = get_post_meta( $rez->ID, 'eafl_url', true );
			$eafl_url_arr = explode('&', $eafl_url);

			foreach ($eafl_url_arr as $key => $url_part) {
				#if && signs in url - remove
				if($url_part == '')
					unset( $eafl_url_arr[$key] );

				#if contains sub3 - remove
				if (strpos($url_part, 'aff_sub3') !== false)
					unset( $eafl_url_arr[$key] );

				#replace frame to mars
				if (strpos($url_part, 'frame') !== false)
					$eafl_url_arr[$key] = str_replace( 'frame', 'mars', $url_part );

				#replace popup to apollo
				if (strpos($url_part, 'popup') !== false)
					$eafl_url_arr[$key] = str_replace( 'popup', 'apollo', $url_part );

			}
			$eafl_url_arr[] = 'aff_sub3='.date("ymd");
			update_post_meta( $rez->ID, 'eafl_url', implode('&', $eafl_url_arr) );
		endforeach;
	endif;

}

// echo '<pre>';
// print_r($_SERVER);
// echo '</pre>';

// $browser = get_browser(null, true);
// echo '<pre>';
// print_r($browser);
// echo '</pre>';
//
//
//


// $arr_browsers = ["Opera", "Edg", "Chrome", "Safari", "Firefox", "MSIE", "Trident"];

// $agent = $_SERVER['HTTP_USER_AGENT'];

// $user_browser = '';
// foreach ($arr_browsers as $browser) {
//     if (strpos($agent, $browser) !== false) {
//         $user_browser = $browser;
//         break;
//     }
// }

// switch ($user_browser) {
//     case 'MSIE':
//         $user_browser = 'Internet Explorer';
//         break;

//     case 'Trident':
//         $user_browser = 'Internet Explorer';
//         break;

//     case 'Edg':
//         $user_browser = 'Microsoft Edge';
//         break;
// }

// echo "You are using ".$user_browser." browser";


// echo '<pre>';
// print_r(get_post_meta( 28666 ));
// echo '</pre>';

// echo '<pre>';
// print_r(get_post_meta( 28970 ));
// echo '</pre>';


// echo '<pre>';
// print_r(get_post_meta( 28970, 'm5_acf_pop_url' ));
// echo '</pre>';

// echo '<pre>';
// print_r(get_post_meta( 28970, 'm5_acf_pop_url',true ));
// echo '</pre>';

// get_post_meta( $post_id, $key = '', $single = false )







if ( isset($_GET['gpt']) && $_GET['gpt'] == 777 ) {
	global $wpdb;
	$rezz =	$wpdb->get_results( "SELECT * FROM `wp_vavt_de_posts` WHERE `post_type`='easy_affiliate_link' AND `post_status`='publish' AND `post_title` LIKE '%surfshark%' OR
																																			`post_type`='easy_affiliate_link' AND `post_status`='publish' AND `post_title` LIKE '%nordvpn%' OR
																																			`post_type`='easy_affiliate_link' AND `post_status`='publish' AND `post_title` LIKE '%vyprvpn%'" );
	if( is_array($rezz) && count($rezz)>0 ):
		foreach ($rezz as $rez) :
			$eafl_url = get_post_meta( $rez->ID, 'eafl_url', true );
			$eafl_url_arr = explode('&', $eafl_url);
			foreach ($eafl_url_arr as $key => $url_part) {
				if (strpos($url_part, 'aff_sub3') !== false)
					unset( $eafl_url_arr[$key] );
			}
			$eafl_url_arr[] = 'aff_sub3='.date("ymd");
			update_post_meta( $rez->ID, 'eafl_url', implode('&', $eafl_url_arr) );
		endforeach;
	endif;
}


#Checking if aff. links are really redirects
if ( isset($_GET['chk_aff']) && $_GET['chk_aff'] == 88 ) {
	$args = array(
		'post_type'   => 'easy_affiliate_link',
		'post_status' => 'any',
		'posts_per_page' => -1,
		'orderby'       => 'date',
		'order'         => 'DESC',
	);

	$the_query = new WP_Query( $args );
	 if ( $the_query->have_posts() ) :
		while ( $the_query->have_posts() ) : $the_query->the_post();
			$pid = get_the_ID();
			$pm = get_post_meta( $pid );
			echo '<pre>';
			// print_r( $pm );
			// print_r( unserialize( $pm['eafl_status_details'][0] ) );
			// print_r( get_the_content( $pid ) );
			$aff_link_id = url_to_postid( get_the_permalink($pid));
			$aff_url = get_post_meta( $aff_link_id, 'eafl_url', true);

			// print_r( $aff_link_id );
			print_r( $aff_url );
			echo '</pre>';
			echo "<p>" . get_the_title($pid) . "<br>" . get_the_permalink($pid) . "</p><hr/>";
		endwhile;
		wp_reset_postdata();
	endif;
}




if ( isset($_GET['chk_coup']) && $_GET['chk_coup'] == 88 ) {
	$args = array(
		'post_type'   => 'affcoups_coupon',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'orderby'       => 'date',
		'order'         => 'DESC',
		'meta_key'     => 'affcoups_coupon_valid_until',
    'meta_value'   => time(),
    'meta_compare' => '>',
	);

	$the_query = new WP_Query( $args );
	 if ( $the_query->have_posts() ) :
	 	$ccc = 1;
		while ( $the_query->have_posts() ) : $the_query->the_post();
			$pid = get_the_ID();
			$pm = get_post_meta( $pid );
			echo '<pre>';
			print_r(get_the_title($pid));
			print_r($pm);
			echo '</pre>';
			echo $ccc . '<hr>';
			$ccc++;
		endwhile;
		wp_reset_postdata();
	endif;
}


//$data[1] - 1
//$data[2] - 2
//$data[3] - 3
//$data[4] - 4
//$data[5] - 5
//$data[6] - 6
//$data[7] - 11
//$data[8] - 12
//$data[9] - 14
//$data[10] - 16
//$data[11] - 17
//$data[12] - 18
//$data[13] - 19
//$data[14] - 20
//$data[15] - 21
//$data[16] - 22
//$data[17] - 23
//$data[18] - 24
//$data[19] - 25
//$data[20] - 26
//$data[21] - 27
//$data[22] - 28
//$data[23] - 29
//$data[24] - 30
//$data[25] - 31
//$data[26] - 32
//$data[27] - 33
//$data[28] - 35
//$data[29] - 36
//$data[30] - 38
//$data[31] - 39
//$data[32] - 41
//$data[33] - 42
//$data[34] - 43
//$data[35] - 44
//$data[36] - 45
//$data[37] - 46
//$data[38] - 47
//$data[39] - 49
//$data[40] - 50

// $vpn_names = [];
// $vpn_id_arr = [	0, 1, 2, 3, 4, 5, 6, 11, 12, 14, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 35, 36, 38, 39, 41, 42, 43, 44, 45, 46, 47, 49, 50 ];
// // $combinedd = [];
// $srch = [];

// $tax_label = '';
// $taxx;


// $csv_file = K8_PATH_LOC . '/csv/countries-vpn.csv';
// $row = 0;
// if (($handle = fopen($csv_file, "r")) !== FALSE) {
// 	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
// 		// if( $row >  )
// 		// 	break;

// 		if( $row == 0 ){
// 			$vpn_names = $data;
// 			$row++;
// 			continue;
// 		}

// 		$srch =	array_keys($data, 'X');
// 		$tax_label = $data[0];

// 		$taxx = get_term_by( 'name', $tax_label, 'vpnstandortelaender' );


// 		echo '<pre>';
// 		print_r( $row );
// 		echo '<hr>';
// 		print_r( $taxx );
// 		print_r( $srch );
// 		print_r( $data );
// 		print_r( $tax_label );
// 		echo '</pre>';

// 		$row++;



// 	}
// 	fclose($handle);
// }

// echo '<h2>VPN ID List</h2>';
// echo '<pre> ';
// print_r($vpn_id_arr );
// echo '</pre>';




#Importing tax translates
// $k8_loc = get_locale();
// $k8_path = get_template_directory() . '/data/csv/taxonomies/' . $k8_loc;
// $k8_files = array_diff(scandir($k8_path), array('.', '..'));
// $tax_arr = [];
// echo '<pre>';
// print_r( $k8_loc );
// echo '<br>';
// print_r( $k8_path );
// echo '<br>';
// print_r( $k8_files );
// echo '</pre>';
// if( is_array($k8_files) && count($k8_files) > 0 ){
// 	foreach ($k8_files as $k8_file) {
// 		$tax = str_replace( '.csv', '', $k8_file );
// 		$tax = str_replace( $k8_loc .'_', '', $tax );
// 		$tax_arr[] = $tax;
// 		echo '<h2>' . $tax . '</h2>' ;
// 		if (($handle = fopen( $k8_path . '/' . $k8_file, "r" )) !== FALSE) {
// 			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
// 				$exist = get_term_by( 'slug', $data[0], $tax, OBJECT);
// 				if ( $exist ) {
// 					$argzz = array(
// 						'name' => $data[1],
// 					);
// 					wp_update_term( $exist->term_id, $tax, $argzz );
// 				}
// 			}
// 			fclose($handle);
// 		}
// 		echo '<hr>';
// 	}
// }



#Translating

// if(isset($_GET['k8transl']) && $_GET['k8transl'] == 1){
// 	$countries = file_get_contents( get_template_directory() . "/data/json/countries/countries.json" );
// 	$countries_arr = json_decode($countries, true);
// 	$tax = 'unternehmen';
// 	foreach ($countries_arr as $country) :

// 		$exist = get_term_by( 'slug', strtolower( $country['cca2'] ), $tax, OBJECT );
// 		if ( $exist ) {
// 			$argzz = array(
// 				'name' => $country['translations']['rus']['common'],
// 			);
// 			wp_update_term( $exist->term_id, $tax, $argzz );
// 		}
// 	endforeach;
// }


#Importing speedtest data
# $data[1] - $k8_acf_vpnid
# $data[5] - $k8_acf_vpndet_down
# $data[6] - $k8_acf_vpndet_up
# $data[7] - $k8_acf_vpndet_ping
# $data[8] - $k8_acf_vpndet_jitter
// $row = 1;
// if (($handle = fopen("speed2.csv", "r")) !== FALSE) {
//   while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
//     $num = count($data);
//     echo "<h3> $num fields in line $row: <br /></h3>\n";
//     $row++;
//     echo $data[0] . ' | ' . $data[1] . ' | ' . $data[5] . ' | ' . $data[6] . ' | ' . $data[7] . ' | ' . $data[8] . ' | ';

//     $k8_acf_vpnid = $data[1];
//     $k8_acf_vpndet_down = (int) $data[5];
//     $k8_acf_vpndet_up = (int) $data[6];
//     $k8_acf_vpndet_ping = (int) $data[7];
//     $k8_acf_vpndet_jitter = (int) $data[8];

//   	$args = array(
// 			'post_type'   => 'post',
// 			'category_name' => 'vpn-anbieter',
// 			'posts_per_page' => -1,
// 			'meta_key'		=> 'k8_acf_vpnid',
// 			'meta_value'	=> $k8_acf_vpnid
// 		);

// 		$the_query = new WP_Query( $args );

// 		 if ( $the_query->have_posts() ) :
// 			while ( $the_query->have_posts() ) : $the_query->the_post();
// 				$pid = get_the_ID();
// 				update_field('k8_acf_vpndet_down', $k8_acf_vpndet_down, $pid);
// 				update_field('k8_acf_vpndet_up', $k8_acf_vpndet_up, $pid);
// 				update_field('k8_acf_vpndet_ping', $k8_acf_vpndet_ping, $pid);
// 				update_field('k8_acf_vpndet_jitter', $k8_acf_vpndet_jitter, $pid);
// 				echo get_the_title( get_the_ID() );
// 			endwhile;
// 			wp_reset_postdata();
// 		endif;

// 		echo "<hr>";
//   }
//   fclose($handle);
// }
// else{
// 	echo 'not available!';
// }




// 	$args = array(
// 		'post_status' => 'publish',
// 		'order'       => 'DESC',
// 		'orderby'     => 'date',
// 		'posts_per_page' => -1,
// 		'offset'  => 0,
// 		'meta_query'     => array(
// 			// array(
// 			// 	'key'     => 'color',
// 			// 	'value'   => 'blue',
// 			// 	'type'    => 'CHAR',
// 			// 	'compare' => '=',
// 			// ),
// 			array(
// 				'type' => 'NUMERIC',
// 				'key'     => 'k8_acf_vpnid',
// 				'value'   => array( 1, 5 ),
// 				'compare' => 'IN',
// 			),
// 		),
// 	);

// $queryyy = new WP_Query( $args );

// echo '<pre style>';
// print_r( $queryyy );
// echo '</pre>';



// if (isset($_GET['list_ifr']) && $_GET['list_ifr'] == 88) {
		/*
		 * The WordPress Query class.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/WP_Query
		 */
// $impp_vpns = ['nordvpn','vyprvpn','surfshark','ovpn','cyberghost'];
$args = array(
	// Type & Status Parameters
	'post_type'   => 'any',
	'post_status' => 'publish',
	// Order & Orderby Parameters
	'order'               => 'DESC',
	'orderby'             => 'date',
	// Pagination Parameters
	'posts_per_page'         => -1,
	'offset'                 => 0,
);

// the query
$the_query = new WP_Query( $args );
 $ress = [];
 $popz = [];
 $noww = date("Y-m-d");
 if ( $the_query->have_posts() ) :
  while ( $the_query->have_posts() ) : $the_query->the_post();
  	$pidd =	get_the_ID();
  	$k8_acf_ifr_url =	get_field('k8_acf_ifr_url', $pidd);
  	$pcontent = get_the_content();
  	if( is_array($k8_acf_ifr_url) && count($k8_acf_ifr_url)>0 ){
  		$ress[] = [
  			'id' => $pidd,
  			'title' => get_the_title( $pidd ),
  			'url' => get_the_permalink( $pidd ),
  			'iframes' => $k8_acf_ifr_url
  		];
  	}
  	if( has_shortcode( $pcontent, 'K8_SH_POPUP' ) ){
  		$popz_ids_arr = [];
  		preg_match_all(
		    '/' . get_shortcode_regex() . '/',
		   	$pcontent,
		    $matches,
		    PREG_SET_ORDER
			);

			foreach ($matches as $shrtcd) :
				if( strpos($shrtcd[0], '[K8_SH_POPUP') !== false  ){
					preg_match_all('/[0-9]/', $shrtcd[3], $output_array);
					$popz_ids_arr[] = implode('', $output_array[0]);
				}
			endforeach;
  		$popz[] = [
  			'id' => $pidd,
  			'title' => get_the_title( $pidd ),
  			'url' => get_the_permalink( $pidd ),
  			'popz_ids' => $popz_ids_arr
  		];
  	}
  endwhile;
  wp_reset_postdata();
  else :
endif;?>

<br><br>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">


<?php
if ( have_posts() ) : while ( have_posts() ) : the_post();?>

			<ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist" style="margin-left: 0;">
			  <li class="nav-item">
			    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Popups List</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" id="pills-anbieter-tab" data-toggle="pill" href="#pills-anbieter" role="tab" aria-controls="pills-anbieter" aria-selected="false">Anbieter List</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Iframes List</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" id="pills-aff-tab" data-toggle="pill" href="#pills-aff" role="tab" aria-controls="pills-aff" aria-selected="false">Affiliate Links Checker</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" id="pills-outdated-tab" data-toggle="pill" href="#pills-outdated" role="tab" aria-controls="pills-outdated" aria-selected="false">Outdated Coupons</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" id="pills-coup-tab" data-toggle="pill" href="#pills-coup" role="tab" aria-controls="pills-coup" aria-selected="false">[affcoups] Pages List</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" id="pills-k8_sh_coup-tab" data-toggle="pill" href="#pills-k8_sh_coup" role="tab" aria-controls="pills-k8_sh_coup" aria-selected="false">[K8_SH_COUPON] Pages List</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" id="pills-supsystic-tab" data-toggle="pill" href="#pills-supsystic" role="tab" aria-controls="pills-supsystic" aria-selected="false">[supsystic-*] Supsystic Tables</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" id="pills-pt_view-tab" data-toggle="pill" href="#pills-pt_view" role="tab" aria-controls="pills-pt_view" aria-selected="false">[pt_view id*] Content Views</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" id="pills-sync-tab" data-toggle="pill" href="#pills-sync" role="tab" aria-controls="pills-coup" aria-selected="false">Bulk Sync</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" id="pills-anbtr-tab" data-toggle="pill" href="#pills-anbtr" role="tab" aria-controls="pills-coup" aria-selected="false">Global Search in website's content</a>
			  </li>
			</ul>
			<div class="tab-content" id="pills-tabContent">
			  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

			  	<table class="table table-striped table-hover table-responsive table-sm tableFixHead">
					  <thead>
					    <tr>
					      <th scope="col">#</th>
					      <th scope="col">ID</th>
					      <th scope="col">Page Title</th>
					      <th scope="col">Page URL</th>
					      <th scope="col" style="width: 400px;">Affiliate Link / Popup details</th>
								<th scope="col">Affiliate's Url</th>
					      <th scope="col">Type</th>
					      <th scope="col" style="width:110px;">Edit Page</th>
					    </tr>
					  </thead>
					  <tbody>
					    <?php
					    $i=1;
					    // echo '<pre>';
					    // print_r($popz);
					    // echo '</pre>';
					    foreach ($popz as $pop): ?>
					    	<tr>
						      <th scope="row"><?php echo $i; ?></th>
						      <td><?= $pop['id']; ?></td>
						      <td><u><strong><a rel="noreferer nofollow noopener" target="_blank" href="<?= $pop['url']; ?>"><?= $pop['title']; ?></u></a></strong></td>
						      <td><span><?= $pop['url']; ?></span></td>
						      <td>
						      	<?php
						      	if (is_array($pop['popz_ids']) && count($pop['popz_ids']) > 0):
						      		foreach ($pop['popz_ids'] as $popz_id) :
						      			$m5_acf_pop_date_to = get_field('m5_acf_pop_date_to', $popz_id);
						      			$m5_acf_pop_url = get_field('m5_acf_pop_url', $popz_id);?>
						      			<p class="<?= ( strtotime($noww) > strtotime($m5_acf_pop_date_to) ) ? 'm5-colr-dng' : ''; ?> p-2">
						      				<em>
						      					<u>
						      						<a target="_blank" href="<?= get_edit_post_link( $popz_id );?>"><?= $m5_acf_pop_url; ?></a>
						      					</u>
						      				</em>
						      				<br>
						      				<?= $m5_acf_pop_date_to; ?>
						      				- ID[<?= $popz_id;?>] -
						      				<span class="badge badge-<?=(get_post_status($popz_id) == 'publish') ? 'success' : 'warning'; ?>"><?= get_post_status($popz_id); ?></span>
						      				-
						      				<span class="badge badge-secondary"><?= (get_field('m5_acf_pop_delay',$popz_id)/1000); ?> sec.</span>
						      				-
						      				<span class="badge badge-info"><?= get_field('m5_acf_pop_maxage',$popz_id)['label']; ?> </span>
						      			</p>
						      		<?php
						      		endforeach;
						      	endif ?>
						      </td>
						      <td>
						      	<?php
						      	$aff_id = url_to_postid( get_option( 'siteurl' ) .'/'. $m5_acf_pop_url );
						      	$aff_eafl_url = get_post_meta( $aff_id, 'eafl_url', true); ?>
										<u>
		      						<a target="_blank" href="<?= $aff_eafl_url; ?>"><?= $aff_eafl_url; ?></a>
		      					</u>
						      </td>
					      	<? $m5_acf_pop_type = get_field('m5_acf_pop_type', $popz_id) ;
					      	if(!$m5_acf_pop_type || $m5_acf_pop_type == 'small'):
					      		echo '<td style="background: lightblue">'.$m5_acf_pop_type;
					      	elseif($m5_acf_pop_type == 'full'):
					      		echo '<td style="background: lightgreen">'.$m5_acf_pop_type;
					      	else:
					      		echo '<td style="background: lightsalmon">'.$m5_acf_pop_type;
					      	endif;
					      	// echo ( !$m5_acf_pop_type || $m5_acf_pop_type == 'small' ) ? '<td style="background: lightblue">small' : '<td style="background: lightgreen">' . $m5_acf_pop_type;
					      	?>
						      </td>
						      <td>
						      	<a type="button" class="btn btn-secondary colr-wh" href="<?= get_edit_post_link( $pop['id'] );?>" target="_blank">Edit</a>
						      </td>
						    </tr>
					    <?php
					    $i++;
					  	endforeach ?>
					  </tbody>
					</table>
			  </div>



			  <div class="tab-pane fade" id="pills-anbieter" role="tabpanel" aria-labelledby="pills-anbieter-tab">
			  	<?php
			  	(function() {
			  		$vpnidPid =	json_decode( file_get_contents( K8_PATH_LOC . '/' . 'vpnidPid.json'), true );
						if( is_array($vpnidPid) && count($vpnidPid)>0 ):?>
							<table class="table table-striped tableFixHead">
							  <thead>
							    <tr>
							      <th scope="col">#</th>
							      <th scope="col">Post ID</th>
							      <th scope="col">Page Title</th>
							      <th scope="col">Appsflyer<br>Tracker</th>
							      <th scope="col">VPN ID</th>
							      <th scope="col">VPN name</th>
							      <th scope="col" style="width:110px;">Edit Page</th>
							    </tr>
							  </thead>
							  <tbody>
							    <?php
							    $i=1;
							    foreach ($vpnidPid as $res):
							    	$content_post = get_post($res['pid']);?>
							    	<tr>
								      <th scope="row"><?php echo $i; ?></th>
								      <td><?= $content_post->ID; ?></td>
								      <td><a target="_blank" href="<?= get_the_permalink($content_post->ID); ?>"><?= $content_post->post_title; ?></a></td>
								      <td>
								      <?php
								      	$handless =	getHandlesArr();
								      	$glink = get_field('field_618aa63e46c84',$content_post->ID)['google_link'];
								      	$pres_or_not = false;
								      	foreach ($handless as $handle) {
								      		if(str_contains($glink,$handle)){
								      			$pres_or_not = true;
								      			break;
								      		}
								      	}
								      	echo ($pres_or_not===true)?'<b>&#10003;</b>':''; ?>
								      </td>
								      <td><h5><?= $res['vpnid']; ?></h5></td>
								      <td><b><?= get_post_meta($content_post->ID,'cwp_rev_product_name',true); ?></b></td>
								      <td><a type="button" class="btn btn-secondary colr-wh" href="<?= get_edit_post_link( $content_post->ID );?>" target="_blank">Edit</a></td>
								    </tr>
							    <?php
							    $i++;
							  	endforeach ?>
							  </tbody>
							</table>
						<?php
						endif;
					})();?>
			  </div>


			  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
			  	<table class="table table-striped tableFixHead">
					  <thead>
					    <tr>
					      <th scope="col">#</th>
					      <th scope="col">ID</th>
					      <th scope="col">Page Title</th>
					      <th scope="col">Aff Links</th>
					      <th scope="col" style="width:110px;">Edit Page</th>
					    </tr>
					  </thead>
					  <tbody>
					    <?php
					    $i=1;
					    foreach ($ress as $res): ?>
					    	<tr>
						      <th scope="row"><?php echo $i; ?></th>
						      <td><?= $res['id']; ?></td>
						      <td><strong><u><a rel="noreferer nofollow noopener" target="_blank" href="<?= $res['url']; ?>"><?= $res['title']; ?></a></u></strong></td>
						      <td>
						      	<?php
						      	foreach ($res['iframes'] as $iframe): ?>
						      		<p><em><?= $iframe['url']; ?></em></p>
						      	<?php
						      	endforeach ?>
						      </td>
						       <td>
						      	<a type="button" class="btn btn-secondary colr-wh" href="<?= get_edit_post_link( $res['id'] );?>" target="_blank">Edit</a>
						      </td>
						    </tr>
					    <?php
					    $i++;
					  	endforeach ?>
					  </tbody>
					</table>
			  </div>

			  <!-- Aff. Links checker Tool -->
			  <div class="tab-pane fade" id="pills-aff" role="tabpanel" aria-labelledby="pills-aff-tab">
			  	<p>
			  		Run checking process to be sure that affiliate links really redirects to the urls specified in Affiliate Links plugin
			  	</p>
			  	<ul class="quoteList"></ul>
			  	<p><button type="button" class="btn btn-success" onclick="m5AffCheck();">Run Checking process</button></p>
			  	<table class="table table-striped pills-aff-tbl tableFixHead" style="word-break: break-all;">
					  <thead>
					    <tr>
					      <th scope="col" width="60px">#</th>
					      <th scope="col" width="150px">Name</th>
					      <th scope="col" width="300px">Affiliate Link</th>
					      <th scope="col" width="400px">Expected Redirect To Affiliate's website</th>
					      <th scope="col">Real redirect</th>
					    </tr>
					  </thead>
					  <tbody>
					    <?php
					    $args = array(
								'post_type'   => 'easy_affiliate_link',
								'post_status' => 'any',
								'posts_per_page' => -1,
								'orderby'       => 'date',
								'order'         => 'DESC',
							);

							$the_query = new WP_Query( $args );
							 if ( $the_query->have_posts() ) :
							 	$i=1;
								while ( $the_query->have_posts() ) : $the_query->the_post();
									$pid = get_the_ID();
									$pm = get_post_meta( $pid );?>

									<tr>
							      <td data-pid="<?= $pid; ?>" data-counter="<?= $i;?>"><?= $i; ?></td>
							      <td><strong><?= get_the_title($pid); ?></strong></td>
							      <td data-link><?= get_the_permalink($pid); ?></td>
							      <td data-url><?= $pm['eafl_url'][0]; ?></td>
							      <td data-status></td>
							    </tr>
								<?php
					    	$i++;
								endwhile;
								wp_reset_postdata();
							endif;?>
					  </tbody>
					</table>
			  </div> <!-- #pills-aff -->


			   <!-- Outdated Aff Coupons -->
			  <div class="tab-pane fade" id="pills-outdated" role="tabpanel" aria-labelledby="pills-outdated-tab">
			  	<h3>
			  		List of Affiliate Coupons ( outdated are highlighted )
			  	</h3>
			  	<table class="table table-striped pills-coup-tbl tableFixHead" style="word-break: break-all;">
					  <thead>
					    <tr>
					      <th scope="col" style="width: 60px;">#</th>
					      <th scope="col">Coupon</th>
					      <th scope="col">Valid until</th>
					      <th scope="col" style="width:110px;">Edit Coupon</th>
					    </tr>
					  </thead>
					  <tbody>
					  	<?php
					    $args = array(
								'post_type'   => 'affcoups_coupon',
								'post_status' => 'any',
								'posts_per_page' => -1,
								'orderby'       => 'date',
								'order'         => 'DESC',
							);

							$the_query = new WP_Query( $args );
							 if ( $the_query->have_posts() ) :
							 	$i=1;
								while ( $the_query->have_posts() ) : $the_query->the_post();
									$pid = get_the_ID();
									$untill = get_post_meta($pid,'affcoups_coupon_valid_until',true); ?>
									<tr class="<?php echo( $untill < time() ) ? 'm5-colr-dng' : ''; ?>">
							      <td data-pid="<?= $pid; ?>" data-counter="<?= $i;?>"><?= $i; ?></td>
							      <td><strong><?= get_the_title($pid); ?></strong></td>
							      <td data-link>
							      	<?php echo date('Y-m-d', $untill);?>
							      </td>
							      <td data-status>
							      	<a type="button" class="btn btn-secondary colr-wh" href="<?= get_edit_post_link( $id );?>" target="_blank">Edit</a>
							      </td>
							    </tr>
								<?php
					    	$i++;
								endwhile;
								wp_reset_postdata();
							endif;?>
					  </tbody>
					</table>
			  </div> <!-- #pills-aff -->


			  <!-- Coupons pages list -->
			  <div class="tab-pane fade" id="pills-coup" role="tabpanel" aria-labelledby="pills-coup-tab">
			  	<h3>
			  		List of Posts and Pages where used [affcoups] shortcode (affiliate coupons)
			  	</h3>
			  	<table class="table table-striped pills-coup-tbl tableFixHead" style="word-break: break-all;">
					  <thead>
					    <tr>
					      <th scope="col" style="width: 60px;">#</th>
					      <th scope="col">Page/Post</th>
					      <th scope="col">Coupons Shortcode</th>
					      <th scope="col" style="width:110px;">Edit Page</th>
					    </tr>
					  </thead>
					  <tbody>
					  	<?php
					  	global $wpdb;
    					$affcoups = $wpdb->get_results("SELECT ID FROM {$wpdb->posts} WHERE (post_type LIKE 'post' OR post_type LIKE 'page') AND post_status='publish' AND post_content LIKE '%[affcoups%'", ARRAY_N);
    					$ii = 1;
    					foreach ($affcoups as $affcoup) :
    						$ppost = get_post( $affcoup[0] ); ?>
    						<tr>
						      <td scope="col"><?= $ii; ?></td>
						      <td scope="col"><strong><u><a target="_blank" rel="nofollow" href="<?= get_the_permalink( $affcoup[0] );?>"><?= get_the_title( $affcoup[0] ); ?></a></u></strong></td>
						      <td scope="col"><?= smTewdedw( $ppost );?></td>
						      <td>
						      	<a type="button" class="btn btn-secondary colr-wh" href="<?= get_edit_post_link( $affcoup[0] );?>" target="_blank">Edit</a>
						      </td>
						    </tr>
    					<?php
    					$ii++;
    					endforeach;?>
					  </tbody>
					</table>
			  </div> <!-- #pills-aff -->


			  <!-- K8_SH_COUPON  pages list -->
			  <div class="tab-pane fade" id="pills-k8_sh_coup" role="tabpanel" aria-labelledby="pills-k8_sh_coup-tab">
			  	<h3>
			  		List of Posts and Pages where used [K8_SH_COUPON] shortcode (affiliate coupons)
			  	</h3>
			  	<table class="table table-striped pills-coup-tbl tableFixHead" style="word-break: break-all;">
					  <thead>
					    <tr>
					      <th scope="col" style="width: 60px;">#</th>
					      <th scope="col">Page/Post</th>
					      <th scope="col">Coupons Shortcode</th>
					      <th scope="col" style="width:110px;">Edit Page</th>
					    </tr>
					  </thead>
					  <tbody>
					  	<?php
					  	global $wpdb;
    					$affcoups = $wpdb->get_results("SELECT ID FROM {$wpdb->posts} WHERE (post_type LIKE 'post' OR post_type LIKE 'page') AND post_status='publish' AND post_content LIKE '%[K8_SH_COUPON%'", ARRAY_N);
    					$ii = 1;
    					foreach ($affcoups as $affcoup) :
    						$ppost = get_post( $affcoup[0] ); ?>
    						<tr>
						      <td scope="col"><?= $ii; ?></td>
						      <td scope="col"><strong><u><a target="_blank" rel="nofollow" href="<?= get_the_permalink( $affcoup[0] );?>"><?= get_the_title( $affcoup[0] ); ?></a></u></strong></td>
						      <td scope="col"><?= smTewdedw( $ppost, 'K8_SH_COUPON' );?></td>
						      <td>
						      	<a type="button" class="btn btn-secondary colr-wh" href="<?= get_edit_post_link( $affcoup[0] );?>" target="_blank">Edit</a>
						      </td>
						    </tr>
    					<?php
    					$ii++;
    					endforeach;?>
					  </tbody>
					</table>
			  </div> <!-- #pills-aff -->

			  <!-- supsystic tables pages list -->
			  <div class="tab-pane fade" id="pills-supsystic" role="tabpanel" aria-labelledby="pills-supsystic-tab">
			  	<h3>
			  		List of Posts and Pages where used [supsystic-tables] shortcode
			  	</h3>
			  	<table class="table table-striped pills-coup-tbl tableFixHead" style="word-break: break-all;">
					  <thead>
					    <tr>
					      <th scope="col" style="width: 60px;">#</th>
					      <th scope="col">Page/Post</th>
					      <th scope="col">Supsystic-Tables Shortcode</th>
					      <th scope="col" style="width:110px;">Edit Page</th>
					    </tr>
					  </thead>
					  <tbody>
					  	<?php
					  	global $wpdb;
    					$suptables = $wpdb->get_results("SELECT ID FROM {$wpdb->posts} WHERE (post_type LIKE 'post' OR post_type LIKE 'page') AND post_status='publish' AND post_content LIKE '%[supsystic-tables%'", ARRAY_N);
    					$ii = 1;
    					foreach ($suptables as $suptable) :
    						$ppost = get_post( $suptable[0] ); ?>
    						<tr>
						      <td scope="col"><?= $ii; ?></td>
						      <td scope="col"><strong><u><a target="_blank" rel="nofollow" href="<?= get_the_permalink( $suptable[0] );?>"><?= get_the_title( $suptable[0] ); ?></a></u></strong></td>
						      <td scope="col"><?= smTewdedw( $ppost, 'supsystic-tables' );?></td>
						      <td>
						      	<a type="button" class="btn btn-secondary colr-wh" href="<?= get_edit_post_link( $suptable[0] );?>" target="_blank">Edit</a>
						      </td>
						    </tr>
    					<?php
    					$ii++;
    					endforeach;?>
					  </tbody>
				</table>
			  </div> <!-- #pills-aff -->

			  <!-- pt_view -->
			  <div class="tab-pane fade" id="pills-pt_view" role="tabpanel" aria-labelledby="pills-pt_view-tab">
			  	<h3>
			  		List of Posts and Pages where used Content views [pt_view] shortcode
			  	</h3>
			  	<table class="table table-striped pills-coup-tbl tableFixHead" style="word-break: break-all;">
					  <thead>
					    <tr>
					      <th scope="col" style="width: 60px;">#</th>
					      <th scope="col">Page/Post</th>
					      <th scope="col">Content views Shortcode</th>
					      <th scope="col" style="width:110px;">Edit Page</th>
					    </tr>
					  </thead>
					  <tbody>
					  	<?php
					  	global $wpdb;
    					$suptables = $wpdb->get_results("SELECT ID FROM {$wpdb->posts} WHERE (post_type LIKE 'post' OR post_type LIKE 'page') AND post_status='publish' AND post_content LIKE '%[pt_view%'", ARRAY_N);
    					$ii = 1;
    					foreach ($suptables as $suptable) :
    						$ppost = get_post( $suptable[0] ); ?>
    						<tr>
						      <td scope="col"><?= $ii; ?></td>
						      <td scope="col"><strong><u><a target="_blank" rel="nofollow" href="<?= get_the_permalink( $suptable[0] );?>"><?= get_the_title( $suptable[0] ); ?></a></u></strong></td>
						      <td scope="col"><?= smTewdedw( $ppost, 'pt_view' );?></td>
						      <td>
						      	<a type="button" class="btn btn-secondary colr-wh" href="<?= get_edit_post_link( $suptable[0] );?>" target="_blank">Edit</a>
						      </td>
						    </tr>
    					<?php
    					$ii++;
    					endforeach;?>
					  </tbody>
				</table>
			  </div> <!-- #pills-aff -->

			  <!-- Aff. Links checker Tool -->
			  <div class="tab-pane fade" id="pills-sync" role="tabpanel" aria-labelledby="pills-sync-tab">
			  	<h5>
			  		If you want to immediatelly syncronise anbieter info on all websites (vavt.de, .at, .ch, .de etc.) - feel free to click the button
			  	</h5>
			  	<p>
			  		<a class="btn btn-success colr-wh" target="_blank" rel="nofollow" href="http://6.web-hero.xyz/sync/anbieter/cron.php">Sync now!</a>
			  	</p>
			  </div> <!-- #pills-aff -->



			   <div class="tab-pane fade" id="pills-anbtr" role="tabpanel" aria-labelledby="pills-anbtr-tab">
			  	<h5>
			  		Global search form to find out where in content on a website appears searching words
			  	</h5>

			  	<form class="m5_gsearch" method="post">
						<div class="form-group clearfix">
						  <label>Enter What do you want to search</label>
						  <input type="text" class="form-control" name="what" minlength="4" placeholder="For ex. /vpn-anbieter/" required>
						  <!-- <br> -->
						</div>
						<div class="form-check">
					    <input type="checkbox" class="form-check-input" id="caseCheck" name="caseCheck" checked="true">
					    <label class="form-check-label" for="caseCheck">Case sensitive</label>
					  </div>
					  <br>
						<div class="form-group clearfix">
					  	<span class="float-left">Show </span>
					  	<button type="button" class="show_internalz btn btn-info btn-sm float-left" data-val="nofollow" id="show_nofollow_int">nofollow</button>
					  	<button type="button" class="show_internalz btn btn-info btn-sm float-left" data-val="noopener" id="show_noopener_int">noopener</button>
					  	<button type="button" class="show_internalz btn btn-info btn-sm float-left" data-val="noreferrer" id="show_noreferrer_int">noreferrer</button>
					  	<span class="float-left"> internal links</span>

					  	<button type="submit" class="btn btn-primary btn-sm float-right">Search</button>
						</div>
					</form>
					<div class="results">
						<div></div>
						<div class="prld">
							<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
						</div>
					</div>
			  </div> <!-- #pills-aff -->

			</div>



	<?php

	// echo '<pre>';
	// print_r( K8_VPN_CF );
	// print_r( K8_VPN_TAX );
	// echo '</pre>';


	// echo __('Geld-Zurück-Garantie' , 'k8lang_domain');
	// echo "<br>";
	// echo __('Das ist fantastish' , 'k8lang_domain');

endwhile; ?>
<?php else: ?>
<!-- no posts found -->
<?php endif;?>

		</div>
	</div>
</div><!-- .container-fluid -->

<?php
// $cust_fields = array(
// 	'k8_acf_vpndet_conn',
// 	'k8_acf_vpndet_curr',
// 	'k8_acf_vpndet_durr1',
// 	'k8_acf_vpndet_prc1',
// 	'k8_acf_vpndet_durr2',
// 	'k8_acf_vpndet_prc2',
// 	'k8_acf_vpndet_durr3',
// 	'k8_acf_vpndet_prc3',
// 	'k8_acf_vpndet_durr4',
// 	'k8_acf_vpndet_prc4',
// 	'k8_acf_vpndet_trialz',
// 	'k8_acf_vpndet_vid'
// );

// $taxz = [
// 	'betriebssystem',
// 	'zahlungsmittel',
// 	'sprache',
// 	'vpnprotokolle',
// 	'anwendungen',
// 	'sonderfunktionen',
// 	'fixeip',
// 	'vpnstandortelaender',
// 	'kundenservice',
// 	'unternehmen',
// 	'bedingungen'
// ];


// $res =  wp_remote_get( 'https://vpn-anbieter-vergleich-test.de/wp-json/my-route/my-posts/' );
// $decc = json_decode( $res['body'], true );

// echo '<pre>';
// print_r( $decc );
// echo '</pre>';

// die();

// $args = array(
// 	'post_type'   => 'post',
// 	'posts_per_page' => -1,
// 	'category_name' => 'anbieter',
// );

// $the_query = new WP_Query( $args );

// echo "<h1>" . $the_query->found_posts .  "</h1>";

//  if ( $the_query->have_posts() ) :

// 	while ( $the_query->have_posts() ) : $the_query->the_post();

// 		$pid = get_the_ID();

// 		$k8_acf_vpnid =	(int)get_field('k8_acf_vpnid', $pid);

// 		if( isset($decc[$k8_acf_vpnid]) ):

// 			#Update ACF Fields
// 			foreach ($cust_fields as $k):
// 	    	#if is Checkbox or Select
// 	    	if( is_array( $decc[$k8_acf_vpnid]['cust_fields'][$k] ) && count( $decc[$k8_acf_vpnid]['cust_fields'][$k] ) > 0 && !isset( $decc[$k8_acf_vpnid]['cust_fields'][$k]['value'] ) ){
// 	    		$vals = array();
// 	    		foreach ($decc[$k8_acf_vpnid]['cust_fields'][$k] as $it) {
// 	    			$vals[] = $it['value'];
// 	    		}
// 	    		update_field( $k, $vals, $pid );
// 	    		continue;
// 	    	}
// 	    	update_field( $k, $decc[$k8_acf_vpnid]['cust_fields'][$k], $pid );
// 	    endforeach;
// 			// END Update ACF Fields


// 	    #Update Taxonomy Fields
// 	    foreach ($taxz as $key) :
// 	    	if( is_array( $decc[$k8_acf_vpnid]['taxz'][$key] ) && count( $decc[$k8_acf_vpnid]['taxz'][$key] ) > 0 ){
// 	    		$slug_arr = array();
// 	    		foreach ($decc[$k8_acf_vpnid]['taxz'][$key] as $item) {
// 	    			$slug_arr[] = $item['slug'];
// 	    		}
// 	    		wp_set_object_terms( $pid, $slug_arr, $key, true );
// 	    	}
// 	    endforeach;
// 	    #END Update Taxonomy Fields


// 		endif;



// 		echo '<hr>';
// 	endwhile;
// 	wp_reset_postdata();

// endif;


get_footer();