<?php /* Template Name: Test1 */ 

get_header();

$cust_fields = array(
	'k8_acf_vpndet_conn',
	'k8_acf_vpndet_curr',
	'k8_acf_vpndet_durr1',
	'k8_acf_vpndet_prc1',
	'k8_acf_vpndet_durr2',
	'k8_acf_vpndet_prc2',
	'k8_acf_vpndet_durr3',
	'k8_acf_vpndet_prc3',
	'k8_acf_vpndet_durr4',
	'k8_acf_vpndet_prc4',
	'k8_acf_vpndet_trialz',
	'k8_acf_vpndet_vid'
);

$taxz = [
	'betriebssystem',
	'zahlungsmittel',
	'sprache',
	'vpnprotokolle',
	'anwendungen',
	'sonderfunktionen',
	'fixeip',
	'vpnstandortelaender',
	'kundenservice',
	'unternehmen',
	'bedingungen'
];


$res =  wp_remote_get( 'https://vpn-anbieter-vergleich-test.de/wp-json/my-route/my-posts/' );
$decc = json_decode( $res['body'], true );



$args = array(
	'post_type'   => 'post',
	'posts_per_page' => -1,	
	'category_name' => 'anbieter',
);

$the_query = new WP_Query( $args );

echo "<h1>" . $the_query->found_posts .  "</h1>";

 if ( $the_query->have_posts() ) : 

	while ( $the_query->have_posts() ) : $the_query->the_post(); 

		$pid = get_the_ID();

		$k8_acf_vpnid =	(int)get_field('k8_acf_vpnid', $pid);

		if( isset($decc[$k8_acf_vpnid]) ):

			#Update ACF Fields
			foreach ($cust_fields as $k):
	    	#if is Checkbox or Select
	    	if( is_array( $decc[$k8_acf_vpnid]['cust_fields'][$k] ) && count( $decc[$k8_acf_vpnid]['cust_fields'][$k] ) > 0 && !isset( $decc[$k8_acf_vpnid]['cust_fields'][$k]['value'] ) ){
	    		$vals = array();
	    		foreach ($decc[$k8_acf_vpnid]['cust_fields'][$k] as $it) {
	    			$vals[] = $it['value'];
	    		}
	    		update_field( $k, $vals, $pid );
	    		continue;
	    	}
	    	update_field( $k, $decc[$k8_acf_vpnid]['cust_fields'][$k], $pid );
	    endforeach;
			// END Update ACF Fields
			

	    #Update Taxonomy Fields
	    foreach ($taxz as $key) :
	    	if( is_array( $decc[$k8_acf_vpnid]['taxz'][$key] ) && count( $decc[$k8_acf_vpnid]['taxz'][$key] ) > 0 ){
	    		$slug_arr = array();
	    		foreach ($decc[$k8_acf_vpnid]['taxz'][$key] as $item) {
	    			$slug_arr[] = $item['slug'];
	    		}
	    		wp_set_object_terms( $pid, $slug_arr, $key, true );
	    	}
	    endforeach;
	    #END Update Taxonomy Fields


		endif;

		

		echo '<hr>';
	endwhile; 
	wp_reset_postdata();

endif; 


get_footer();