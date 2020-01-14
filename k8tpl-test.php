<?php /* Template Name: Test1
				Template Post Type: post, page */
get_header();

echo "smsgheet";


echo '<ol class="comment-list">';
$comments = get_comments( 
	array( 
		'post_id' => 166, 
		'order' => 'ASC' 
	)
);
// echo '<pre>';
// print_r( $comments );
// echo '</pre>';


echo wp_list_comments( array('callback' => 'generate_comment'), $comments );

echo '</ol>';


$shrt = new K8Short([
	'true' => '<svg class="k8-t-f" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
							 viewBox="0 0 150 150" enable-background="new 0 0 150 150" xml:space="preserve">
							<path fill="#33CC99" d="M147.7,73.9c-0.2,17.6-6.4,35.2-18.3,48.6c-2.3,2.6-4.9,5.1-7.6,7.4c-24.8,20.9-62.6,22.8-89.2,3.9
								c-3.2-2.3-6.3-4.9-9.1-7.6c-6.4-6.3-11.5-13.8-15.2-21.9C-2.6,79.7,1.2,49.8,18.5,29c5.6-6.8,12.5-12.6,20.2-16.9
								C62-1,91.4,0.3,113.6,15.3c1.1,0.7,1.4,2.2,0.7,3.3c-0.7,1.1-2.2,1.4-3.3,0.7c0,0,0,0,0,0c-7.1-3.6-13.5-7.4-21.4-9.2
								C73.4,6.4,56,9,41.7,17.3c-7,4-13.2,9.4-18.2,15.7c-5,6.3-8.9,13.5-11.2,21.2C7.5,69.5,8.6,86.4,15.4,101
								c3.4,7.2,8.1,13.8,13.8,19.3c23.5,22.5,61.7,23.5,86.3,2.2c22.2-19.3,28.2-52.9,13.7-78.7l-59.2,63.7l-0.3,0.3
								c-3.1,3.4-8.4,3.5-11.7,0.4c-0.2-0.2-0.5-0.5-0.7-0.7L32.5,78.2c-2-2.4-1.7-6,0.7-8c2.2-1.8,5.3-1.8,7.3,0l22.6,19L126,30.5l0.2-0.2
								c2.3-2.1,5.8-2,7.9,0.3c0.2,0.2,0.4,0.4,0.5,0.6C143.6,43.7,147.8,58.8,147.7,73.9z"/>
						</svg>',
	'false' => '<svg class="k8-t-f" version="1.1"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
								 viewBox="0 0 150 150" enable-background="new 0 0 150 150" xml:space="preserve">
								<path fill="#424242" d="M8.8,74.2C8.8,74.2,8.8,74.2,8.8,74.2L8.8,74.2C8.8,74.2,8.8,74.2,8.8,74.2z"/>
								<path fill="#00B2E2" d="M147.5,74.1c-0.1,7.2-1.2,14.4-3.1,21.6c-2.8,8.7-7.1,16.8-12.8,23.8c-5.7,7-12.6,13-20.4,17.5
									c-23.6,13.6-53.9,12.9-76.7-2.3c-7.4-5-13.9-11.3-19-18.6C-3.8,88.9-1.4,50.1,21.7,25.7c1.8-1.9,3.8-3.8,5.8-5.5
									C34.2,14.5,42,10,50.3,7.2c14.7-5.1,30.4-5,45.2-0.5c0,0,6.1,2.3,6.1,2.3c1.1,0.4,1.7,1.7,1.3,2.8c-0.4,1.1-1.6,1.7-2.7,1.3
									c0,0-0.2-0.1-0.2-0.1C84.2,7.4,67.9,6.2,52,12c-7.7,2.8-14.7,7-20.8,12.3C6.2,46.3,1.7,85,21.4,111.9c4.7,6.5,10.6,12,17.3,16.3
									c20.2,13,47.1,13.5,67.8,1c6.8-4.1,12.8-9.4,17.6-15.6c4.8-6.2,8.5-13.3,10.7-20.8c4.5-15,3.1-31.6-3.7-45.7
									c-2.6-5.3-5.9-10.2-9.8-14.6L83.4,72.2l23.4,23.4c3.2,3.2,3.2,8.4,0,11.6c-1.6,1.6-3.7,2.4-5.8,2.4c-2.1,0-4.2-0.8-5.8-2.4L72,84.1
									L50.2,107c-3.1,3.3-8.3,3.4-11.6,0.3c-3.3-3.1-3.4-8.3-0.3-11.6c0.1-0.1,0.2-0.2,0.3-0.3l22.9-21.8L38.5,50.6
									c-3.2-3.2-3.2-8.4,0-11.6c3.2-3.2,8.4-3.2,11.6,0l23.2,23.2l43.8-41.8l0.2-0.2c1.1-1,2.5-1.5,3.8-1.5l0.4,0c1.4,0,2.6,0.6,3.5,1.5
									c6.6,6.3,12,13.9,15.8,22.2C145.7,52.6,147.7,63.3,147.5,74.1z"/>
								<path fill="#424242" d="M8.8,74.2L8.8,74.2l0,0.1L8.8,74.2C8.8,74.2,8.8,74.2,8.8,74.2z"/>
							</svg>',
]);



echo	$shrt->company( array( 'vpnid' => 1 ), '', 'K8_SH_COMPANY' );



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

$vpn_names = [];
$vpn_id_arr = [	0, 1, 2, 3, 4, 5, 6, 11, 12, 14, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 35, 36, 38, 39, 41, 42, 43, 44, 45, 46, 47, 49, 50 ];
// $combinedd = [];
$srch = [];

$tax_label = '';
$taxx;


$csv_file = K8_PATH_LOC . '/csv/countries-vpn.csv';
$row = 0;
if (($handle = fopen($csv_file, "r")) !== FALSE) {
	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		// if( $row >  )
		// 	break;
		
		if( $row == 0 ){
			$vpn_names = $data;
			$row++;
			continue;
		}
		
		$srch =	array_keys($data, 'X');
		$tax_label = $data[0];

		$taxx = get_term_by( 'name', $tax_label, 'vpnstandortelaender' );


		echo '<pre>';
		print_r( $row );
		echo '<hr>';
		print_r( $taxx );
		print_r( $srch );
		print_r( $data );
		print_r( $tax_label );
		echo '</pre>';
		
		$row++;
		


	}
	fclose($handle);
}

echo '<h2>VPN ID List</h2>';
echo '<pre> ';
print_r($vpn_id_arr );
echo '</pre>';




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




if ( have_posts() ) : while ( have_posts() ) : the_post();

	the_title();
	echo '<hr>';
	the_content();


	echo '<pre>';
	print_r( K8_VPN_CF );
	print_r( K8_VPN_TAX );
	echo '</pre>';


	echo __('Geld-Zurück-Garantie' , 'k8lang_domain');
	echo "<br>";
	echo __('Das ist fantastish' , 'k8lang_domain');

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