<?php
class K8Rest
{
	public $k8_arrr;
	public $cust_fields;
	public $taxz;

	function __construct( $args ){

		$this->cust_fields = $args['cust_fields'];

		$this->taxz = $args['taxz'];

		$this->k8_arrr = array(
			'https://vpn-anbieter-vergleich-test.de',
			'https://dev.vavt.de'
		);

		if( in_array(get_site_url(), $this->k8_arrr) ){
			add_action( 'rest_api_init', array( $this, 'create_api_posts_meta_field' ) );
			add_filter( 'register_post_type_args', array( $this, 'my_post_type_args' ), 10, 2 );

			#Custom route for bulk update posts under VPN Ambieter
			add_action( 'rest_api_init', array( $this, 'my_register_route' ) );
		}
	}

	#Custom route for bulk update posts under VPN Ambieter
	public function my_register_route() {
    register_rest_route(
    	'my-route',
    	'my-posts',
    	array(
        'methods' => 'GET',
        'callback' => array( $this, 'my_posts' )
      )
    );
	}

	#Custom route for bulk update posts under VPN Ambieter
	public function my_posts() {
    $post_data = array();
    $argzz = array(
  		'post_type'   => 'post',
  		'posts_per_page' => -1,
  		'category_name' => 'vpn-anbieter'
  	);
  	

  	$the_query = new WP_Query( $argzz );
  	 if ( $the_query->have_posts() ) :
  		while ( $the_query->have_posts() ) : $the_query->the_post();
  			$pid = get_the_ID();
  			$k8_acf_vpnid = get_field( 'k8_acf_vpnid', $pid );

	      $post_data[ $k8_acf_vpnid ][ 'pid' ] = $pid;
	      $post_data[ $k8_acf_vpnid ][ 'title' ] = get_the_title( $pid );

	      #Custom Fields
	      foreach ($this->cust_fields as $k) {
	      	$post_data[ $k8_acf_vpnid ]['cust_fields'][ $k ] = get_field( $k, $pid );
	      }
	      #Taxonomies
	      foreach ($this->taxz as $k) {
	      	$post_data[ $k8_acf_vpnid ]['taxz'][ $k ] = get_the_terms( $pid, $k );
	      }

	      // $post_data[ $k8_acf_vpnid ]['taxz']['betriebssystem'] = get_the_terms( $pid, 'betriebssystem' );

  		endwhile;
  		wp_reset_postdata();
  	endif;

    return rest_ensure_response( $post_data );
	}



	public function create_api_posts_meta_field(){
		register_rest_field( 'affcoups_coupon', 'k8_pm', array(
		 'get_callback' => array( $this,'get_post_meta_for_api' ),
		 'schema' => null,
		 )
		);

		register_rest_field( 'affcoups_coupon', 'k8_cont', array(
		 'get_callback' => array( $this, 'get_content_for_api' ),
		 'schema' => null,
		 )
		);

		register_rest_field( 'affcoups_coupon', 'k8_exc', array(
		 'get_callback' => array( $this, 'get_excerpt_for_api' ),
		 'schema' => null,
		 )
		);

		register_rest_field( 'affcoups_coupon', 'k8_aff_typ', array(
		 'get_callback' => array( $this, 'get_k8_aff_typ' ),
		 'schema' => null,
		 )
		);

		register_rest_field( 'affcoups_coupon', 'k8_aff_cat', array(
		 'get_callback' => array( $this, 'get_k8_aff_cat' ),
		 'schema' => null,
		 )
		);

		register_rest_field( 'affcoups_coupon', 'k8_feat_img', array(
		 'get_callback' => array( $this, 'k8_api_coup_feat_img' ),
		 'schema' => null,
		 )
		);

		register_rest_field( 'affcoups_vendor', 'k8_vend', array(
		 'get_callback' => array( $this, 'k8_add_vendors' ),
		 'schema' => null,
		 )
		);

		register_rest_field( 'affcoups_vendor', 'k8_feat_img', array(
		 'get_callback' => array( $this, 'k8_api_feat_img' ),
		 'schema' => null,
		 )
		);

	}

	public function my_post_type_args( $args, $post_type ) {
    if ( 'affcoups_vendor' === $post_type ) {
      $args['show_in_rest'] = true;
    }
    return $args;
	}

	public function get_post_meta_for_api( $object ) {
		$post_id = $object['id'];
		return get_post_meta( $post_id );
	}

	public function get_content_for_api( $object ) {
		$post_id = $object['id'];
		$post = get_post($post_id);
		$content = $post->post_content;
		return $content;
	}

	public function get_excerpt_for_api( $object ) {
		$post_id = $object['id'];
		$post = get_post($post_id);
		$excerpt = $post->post_excerpt;
		return $excerpt;
	}

	public function get_k8_aff_typ( $object ){
		$post_id = $object['id'];
		$termz = get_the_terms( $post_id, 'affcoups_coupon_type' );
		return $termz;
	}

	public function get_k8_aff_cat( $object ){
		$post_id = $object['id'];
		$termz = get_the_terms( $post_id, 'affcoups_coupon_category' );
		return $termz;
	}

	public function k8_api_coup_feat_img( $object ){
		$post_id = $object['id'];
		$affcoups_vendor_image = get_post_meta( $post_id, 'affcoups_coupon_image', true );
		$arr = wp_get_attachment_image_src( $affcoups_vendor_image, 'medium_large');
		return $arr[0];
	}

	public function k8_add_vendors( $object ){
		$post_id = $object['id'];
		return get_post_meta( $post_id );
	}

	public function k8_api_feat_img( $object ){
		$post_id = $object['id'];
		$affcoups_vendor_image = get_post_meta( $post_id, 'affcoups_vendor_image', true );
		$arr = wp_get_attachment_image_src( $affcoups_vendor_image, 'medium_large');
		return $arr[0];
	}

}

new K8Rest([
	'cust_fields' => [
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
	],
	'taxz' => [
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
	]
]);