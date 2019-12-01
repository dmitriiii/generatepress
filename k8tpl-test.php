<?php /* Template Name: Test1
				Template Post Type: post, page */
get_header();



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




	$args = array(
		'post_status' => 'publish',
		'order'       => 'DESC',
		'orderby'     => 'date',
		'posts_per_page' => -1,
		'offset'  => 0,
		'meta_query'     => array(
			// array(
			// 	'key'     => 'color',
			// 	'value'   => 'blue',
			// 	'type'    => 'CHAR',
			// 	'compare' => '=',
			// ),
			array(
				'type' => 'NUMERIC',
				'key'     => 'k8_acf_vpnid',
				'value'   => array( 1, 5 ),
				'compare' => 'IN',
			),
		),
	);

$queryyy = new WP_Query( $args );

echo '<pre style>';
print_r( $queryyy );
echo '</pre>';




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