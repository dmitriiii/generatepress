<?php /* Template Name: Test1 */ 

get_header();



$res =  wp_remote_get( 'https://vpn-anbieter-vergleich-test.de/wp-json/my-route/my-posts/40' );
$decc = json_decode( $res['body'], true );

echo '<pre>';
print_r( $decc );
echo '</pre>';

die();




$args = array(
	'post_type'   => 'post',
	'posts_per_page' => -1,	
	'category_name' => 'anbieter'
);

$the_query = new WP_Query( $args );

echo "<h1>" . $the_query->found_posts .  "</h1>";

 if ( $the_query->have_posts() ) : 

	while ( $the_query->have_posts() ) : $the_query->the_post(); 
		// the_title();
		// the_field('k8_acf_vpnid');
		$pid = get_the_ID();

		$k8_acf_vpnid =	get_field('k8_acf_vpnid', $pid);

		


    // echo '<pre>';
    // print_r( $decc );
    // echo '</pre>';  

		echo '<hr>';
	endwhile; 
	wp_reset_postdata();

endif; 


get_footer();

?>