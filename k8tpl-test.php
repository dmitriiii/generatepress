<?php /* Template Name: Test1
				Template Post Type: post, page */
get_header();

function _get_all_image_sizes() {
  global $_wp_additional_image_sizes;

  $default_image_sizes = get_intermediate_image_sizes();

  foreach ( $default_image_sizes as $size ) {
      $image_sizes[ $size ][ 'width' ] = intval( get_option( "{$size}_size_w" ) );
      $image_sizes[ $size ][ 'height' ] = intval( get_option( "{$size}_size_h" ) );
      $image_sizes[ $size ][ 'crop' ] = get_option( "{$size}_crop" ) ? get_option( "{$size}_crop" ) : false;
  }

  if ( isset( $_wp_additional_image_sizes ) && count( $_wp_additional_image_sizes ) ) {
      $image_sizes = array_merge( $image_sizes, $_wp_additional_image_sizes );
  }

  return $image_sizes;
}

echo '<pre>';
print_r( _get_all_image_sizes() );
echo '</pre>';


?>





<?php



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