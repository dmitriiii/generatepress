<?php /* Template Name: Test1
				Template Post Type: post, page */
get_header();
wp_enqueue_style('k8-bootstrap-css');
wp_enqueue_script('k8-bootstrap-js');

// echo '<pre>';
// print_r( K8Help::getAllImgSizes() );
// echo '</pre>';

// echo 'Bingobongo';



function smTewdedw( $ppost ){
	$result = '';
	//get shortcode regex pattern wordpress function
	$pattern = get_shortcode_regex(['affcoups']);
	if (  preg_match_all( '/'. $pattern .'/s', $ppost->post_content, $matches ) ){
	 $result = implode( '<br/>', $matches[0] );
	}
	return $result;
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
		background-color: #dc3545;
	}
	.m5-colr-dng a{
		color: #fff;
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
			print_r( $pm );
			print_r( unserialize( $pm['eafl_status_details'][0] ) );
			print_r( get_the_content( $pid ) );
			// print_r(  );
			echo '</pre>';
			echo "<p>" . get_the_title() . "<br>" . get_the_permalink() . "</p><hr/>";
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
endif;

if ( have_posts() ) : while ( have_posts() ) : the_post();?>

			<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist" style="margin-left: 0;">
			  <li class="nav-item">
			    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Popups List</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Iframes List</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" id="pills-aff-tab" data-toggle="pill" href="#pills-aff" role="tab" aria-controls="pills-aff" aria-selected="false">Affiliate Links Checker</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" id="pills-coup-tab" data-toggle="pill" href="#pills-coup" role="tab" aria-controls="pills-coup" aria-selected="false">Affiliate Coupons Pages List</a>
			  </li>
			</ul>
			<div class="tab-content" id="pills-tabContent">
			  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
			  	<table class="table table-striped">
					  <thead>
					    <tr>
					      <th scope="col">#</th>
					      <th scope="col">ID</th>
					      <th scope="col">Page Title</th>
					      <th scope="col">Affiliate Link on Popup</th>
					      <th scope="col">Type</th>
					      <th scope="col" style="width:110px;">Edit Page</th>
					    </tr>
					  </thead>
					  <tbody>
					    <?php
					    $i=1;
					    foreach ($popz as $pop): ?>
					    	<tr>
						      <th scope="row"><?php echo $i; ?></th>
						      <td><?= $pop['id']; ?></td>
						      <td><u><a rel="noreferer nofollow noopener" target="_blank" href="<?= $pop['url']; ?>"><?= $pop['title']; ?></u></a></td>
						      <td>
						      	<?php
						      	if (is_array($pop['popz_ids']) && count($pop['popz_ids']) > 0):
						      		foreach ($pop['popz_ids'] as $popz_id) :
						      			$m5_acf_pop_date_to = get_field('m5_acf_pop_date_to', $popz_id); ?>
						      			<p class="<?= ( strtotime($noww) > strtotime($m5_acf_pop_date_to) ) ? 'm5-colr-dng' : ''; ?> p-2">
						      				<em>
						      					<u>
						      						<a target="_blank" href="<?= get_edit_post_link( $popz_id );?>"><?= get_field('m5_acf_pop_url', $popz_id); ?></a>
						      					</u>
						      				</em>
						      				<br>
						      				<?= $m5_acf_pop_date_to; ?>
						      				<br>
						      			</p>
						      		<?php
						      		endforeach;
						      	endif ?>
						      </td>
					      	<? $m5_acf_pop_type = get_field('m5_acf_pop_type', $popz_id) ;
					      	echo ( !$m5_acf_pop_type || $m5_acf_pop_type == 'small' ) ? '<td style="background: lightblue">small' : '<td style="background: lightgreen">' . $m5_acf_pop_type; ?>
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
			  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
			  	<table class="table table-striped">
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
						      <td><u><a rel="noreferer nofollow noopener" target="_blank" href="<?= $res['url']; ?>"><?= $res['title']; ?></a></u></td>
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
			  	<table class="table table-striped pills-aff-tbl" style="word-break: break-all;">
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
							      <td><?= get_the_title($pid); ?></td>
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


			  <!-- Coupons pages list -->
			  <div class="tab-pane fade" id="pills-coup" role="tabpanel" aria-labelledby="pills-coup-tab">
			  	<h2>
			  		List of Pages where are used affiliates coupons
			  	</h2>
			  	<table class="table table-striped pills-coup-tbl" style="word-break: break-all;">
					  <thead>
					    <tr>
					      <th scope="col" style="width: 60px;">#</th>
					      <th scope="col">Page/Post</th>
					      <th scope="col">Coupons Shortcode</th>
					      <th scope="col" style="width:110px;">Edit Page</th>
					     <!--  <th scope="col">Expected Redirect To Affiliate's website</th>
					      <th scope="col">Real redirect</th> -->
					    </tr>
					  </thead>
					  <tbody>
					  	<?php
					  	global $wpdb;
    					$affcoups = $wpdb->get_results("SELECT ID FROM {$wpdb->posts} WHERE post_status='publish' AND post_content LIKE '%[affcoups%'", ARRAY_N);
    					$ii = 1;
    					foreach ($affcoups as $affcoup) :
    						$ppost = get_post( $affcoup[0] ); ?>
    						<tr>
						      <td scope="col"><?= $ii; ?></td>
						      <td scope="col"><u><a target="_blank" rel="nofollow" href="<?= get_the_permalink( $affcoup[0] );?>"><?= get_the_title( $affcoup[0] ); ?></a></u></td>
						      <td scope="col"><?= smTewdedw( $ppost );?></td>
						      <td>
						      	<a type="button" class="btn btn-secondary colr-wh" href="<?= get_edit_post_link( $affcoup[0] );?>" target="_blank">Edit</a>
						      </td>
						     <!--  <th scope="col">Expected Redirect To Affiliate's website</th>
						      <th scope="col">Real redirect</th> -->
						    </tr>
    					<?php
    					$ii++;
    					endforeach;
    					// echo '<pre>';
    					// print_r($affcoups);
    					// echo '</pre>';
    					?>
					  </tbody>
					</table>
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
<?php endif;




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