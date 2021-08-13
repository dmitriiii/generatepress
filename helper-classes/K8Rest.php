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
			'https://vpn-anbieter-vergleich-test.de'
		);
		if( in_array(get_site_url(), $this->k8_arrr) ){
			add_action( 'rest_api_init', array( $this, 'create_api_posts_meta_field' ) );
			add_filter( 'register_post_type_args', array( $this, 'my_post_type_args' ), 10, 2 );
			#Custom route for bulk update posts under VPN Ambieter
			add_action( 'rest_api_init', array( $this, 'my_register_route' ) );
			#Custom route to get all router data
			add_action( 'rest_api_init', array( $this, 'getRouters' ) );
		}

		#Custom route to Purge all cache
		add_action( 'rest_api_init', array( $this, 'purgeCache' ) );

		#custom route to manage checking aff links
		add_action( 'rest_api_init', array( $this, 'affCheck' ) );

		#custom route to global search from Statistics page
		add_action( 'rest_api_init', array( $this, 'globalSearch' ) );

		#custom route to get data about ip address
		add_action( 'rest_api_init', array( $this, 'ipaddr' ) );


		#rest api for affiliate coupons list
		// if ( get_site_url() == 'https://vpntester.at' ) {
			add_action( 'rest_api_init', array( $this, 'getCoupons' ) );
		// }
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
	#Custom route to get all router data
	public function getRouters() {
		register_rest_route(
			'm5-route',
			'm5-routers',
			array(
				'methods' => 'GET',
				'callback' => array( $this, 'routers_callback' )
			)
		);
	}
	#Custom route to Purge all cache
	public function purgeCache() {
		register_rest_route(
			'm5-cache',
			'purge',
			array(
				'methods' => 'GET',
				'callback' => array( $this, 'purgecache_callback' )
			)
		);
	}

	public function affCheck() {
		register_rest_route(
			'm5',
			'affCheck',
			array(
				'methods' => 'POST',
				'callback' => array( $this, 'affCheck_callback' )
			)
		);
	}

	public function globalSearch() {
		register_rest_route(
			'm5',
			'globalSearch',
			array(
				'methods' => 'POST',
				'callback' => array( $this, 'globalSearch_callback' )
			)
		);
	}

	#custom route to get data about ip address
	public function ipaddr() {
		register_rest_route(
			'm5',
			'ipaddr',
			array(
				'methods' => 'GET',
				'callback' => array( $this, 'ipaddr_callback' )
			)
		);
	}

	#rest api for affiliate coupons list
	public function getCoupons() {
		register_rest_route(
			'm5',
			'getCoupons',
			array(
				'methods' => 'GET',
				'callback' => array( $this, 'getCoupons_callback' )
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

	#Custom route to get all router data
	public function routers_callback() {
		$post_data = array();
		$argzz = array(
			'post_type'   => 'post',
			'posts_per_page' => -1,
			'category_name' => 'test-bericht',
			'post_status' => 'any'
		);
		$the_query = new WP_Query( $argzz );
		if ( $the_query->have_posts() ) :
			$cust_fields = json_decode( file_get_contents( K8_PATH_GLOB . '/json/routers/routers.json' ), true );
		 // 	write_log($this->cust_fields);
			// write_log($cust_fields);
			while ( $the_query->have_posts() ) : $the_query->the_post();
				$pid = get_the_ID();
				$m5_rou_id = get_field( 'm5_rou_id', $pid );
				$post_data[ $m5_rou_id ][ 'pid' ] = $pid;
				$post_data[ $m5_rou_id ][ 'title' ] = get_the_title( $pid );
				#Custom Fields
				foreach ($cust_fields as $k) {
					$post_data[ $m5_rou_id ]['cust_fields'][ $k ] = get_field( $k, $pid );
				}
				// #Taxonomies
				// foreach ($this->taxz as $k) {
				// 	$post_data[ $k8_acf_vpnid ]['taxz'][ $k ] = get_the_terms( $pid, $k );
				// }
				// $post_data[ $k8_acf_vpnid ]['taxz']['betriebssystem'] = get_the_terms( $pid, 'betriebssystem' );
			endwhile;
			wp_reset_postdata();
		endif;
		return rest_ensure_response( $post_data );
	}

	#Custom route to Purge all cache
	public function purgecache_callback() {
		$post_data=[];
		if(isset($_GET['purge_cache']) && $_GET['purge_cache'] == md5($_SERVER['HTTP_HOST'])) {
			$upOne = realpath(K8_PATH_LOC . '/..');
			$post_data = [
				'get' => $_GET,
				'vars' => get_defined_vars(),
				// 'server' => $_SERVER,
				'path' => dirname(__DIR__),
				'K8_PATH_LOC' => K8_PATH_LOC,
				'K8_PATH_GLOB' => K8_PATH_GLOB,
				'upOne' => $upOne
			];
			rrmdir($upOne."/cache/");
			rrmdir($upOne."/uploads/cache/");
			rrmdir($upOne."/uploads/fvm/");
		}
		return rest_ensure_response( $post_data );
	}


	public function affCheck_callback($request_data) {
		$post_data=[];
		$nonce = null;
		#check nonce - if request from our website and user logged in
		if( isset($_SERVER['HTTP_X_WP_NONCE']) )
			$nonce = $_SERVER['HTTP_X_WP_NONCE'];
		if ( !wp_verify_nonce( $nonce, 'wp_rest' ) )
			return new WP_Error( 'rest_cookie_invalid_nonce', __( 'Cookie nonce is invalid' ), array( 'status' => 403 ) );

		$parameters = $request_data->get_params();

		// $post_data['params'] = $parameters;
		// $post_data['body_params'] = $request_data->get_body_params();

		// $post_data['server'] = $_SERVER;
		// $post_data['errz'] = rest_cookie_check_errors(null);


		// $post_data['params'] = $parameters;
		$post_data['count'] = $parameters['count'];
		#does not match
		$post_data['className'] = 'm5-err';

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


		// curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

		// curl_setopt($ch, CURLOPT_MAXREDIRS, 2);

	  curl_setopt($ch, CURLOPT_URL, $parameters['link']);
	  $out = curl_exec($ch);

	  // line endings is the wonkiest piece of this whole thing
	  $out = str_replace("\r", "", $out);

	  // echo '<pre>';
	  // print_r( $out );
	  // echo '</pre>';

	  // $exploadedd = explode("\n\n", $out);
	  // echo '<pre>';
	  // print_r($exploadedd);
	  // echo '</pre>';



	  // only look at the headers
	  $headers_end = strpos($out, "\n\n");
	  if( $headers_end !== false ) {
	    $out = substr($out, 0, $headers_end);
	  }

	  $headers = explode("\n", $out);
	  foreach($headers as $header) :
	  	// echo '<pre>';
	  	// print_r( $header );
	  	// echo '</pre>';
      if( substr($header, 0, 10) == "Location: " ) {
        $target = substr($header, 10);
        $post_data['target'] = $target;
        if( $target == $parameters['url'] ){
        	$post_data['className'] = 'm5-succ';
        }
        // echo "[$url] redirects to [$target]<br>";
        continue 1;
      }
	  endforeach;

	  // echo "[$url] does not redirect<br>";


	  // write_log( $post_data );

		return rest_ensure_response( $post_data );
	}


	public function globalSearch_callback($request_data) {
		$result=[];
		$result['html']='<ul class="nav nav-tabs" id="myTab" role="tablist">
			  <li class="nav-item">
			    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Posts / Pages / Questions / Answers</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Categories / Tags / Question Category / Question Tags</a>
			  </li>
			</ul><div class="tab-content" id="myTabContent"><div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">';
		$nonce = null;
		global $wpdb;

		#check nonce - if request from our website and user logged in
		if( isset($_SERVER['HTTP_X_WP_NONCE']) )
			$nonce = $_SERVER['HTTP_X_WP_NONCE'];
		if ( !wp_verify_nonce( $nonce, 'wp_rest' ) )
			return new WP_Error( 'rest_cookie_invalid_nonce', __( 'Cookie nonce is invalid' ), array( 'status' => 403 ) );

		$parameters = $request_data->get_params();

		// write_log($parameters);

		if(!isset($parameters['what'])){
			$result['error'] = 'Missing searching field!';
			return rest_ensure_response( $result );
		}

		// $what = $parameters['what'];
		if (strlen($parameters['what']) < 4) {
			$result['error'] = 'Searching word should be 5 and more letters!';
			return rest_ensure_response( $result );
		}

		// $tablename = $wpdb->prefix . "my_custom_table";
		$what = '%'.$wpdb->esc_like($parameters['what']).'%';
		// $caseCheck = '';
		// if( isset($parameters['caseCheck']) && $parameters['caseCheck'] == 'on' ){
		// 	$caseCheck = 'BINARY';
		// }

		$dbRequests = [
			[
				'post_type'=>'post',
				'title'=>'Posts',
				'wp_type'=>'posts'
			],
			[
				'post_type'=>'page',
				'title'=>'Pages',
				'wp_type'=>'posts'
			],
			[
				'post_type'=>'question',
				'title'=>'Questions',
				'wp_type'=>'posts'
			],
			[
				'post_type'=>'answer',
				'title'=>'Answers',
				'wp_type'=>'posts'
			]
		];

		$c=0;
		foreach ($dbRequests as $req) {
			$sql = $wpdb->prepare( "SELECT ID AS itemID, post_title AS itemTitle, post_content AS itemContent FROM {$wpdb->posts} WHERE post_content LIKE BINARY %s AND post_type=%s AND post_status='publish' ORDER BY post_modified_gmt DESC", $what, $req['post_type'] );
			if( $parameters['caseCheck'] === 'false' )
				$sql = $wpdb->prepare( "SELECT ID AS itemID, post_title AS itemTitle, post_content AS itemContent FROM {$wpdb->posts} WHERE post_content LIKE %s AND post_type=%s AND post_status='publish' ORDER BY post_modified_gmt DESC", $what, $req['post_type'] );

			// write_log($sql);
			$results = $wpdb->get_results( $sql , ARRAY_A );
			$c += count($results);
			$result['html'] .= K8Html::buildTableHtml([
				'data'=>$results,
				'title'=>$req['title'],
				'what'=>$parameters['what'],
				'wp_typpe'=>$req['wp_type'],
				'caseCheck'=>$parameters['caseCheck'],
			]);
		}
		$result['html'] .= '</div><div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">';

		$dbRequests = [
			[
				'post_type'=>'category',
				'title'=>'Category',
				'wp_type'=>'terms'
			],
			[
				'post_type'=>'post_tag',
				'title'=>'Tags',
				'wp_type'=>'terms'
			],
			[
				'post_type'=>'question_category',
				'title'=>'Question Category',
				'wp_type'=>'terms'
			],
			[
				'post_type'=>'question_tag',
				'title'=>'Question Tags',
				'wp_type'=>'terms'
			]
		];

		foreach ($dbRequests as $req) {
			$sql = $wpdb->prepare( "SELECT t1.term_id AS itemID,
																	 t2.name AS itemTitle,
																	 t1.description AS itemContent,
																	 t2.slug AS itemSlug
																	 FROM {$wpdb->term_taxonomy} AS t1
																	 INNER JOIN {$wpdb->terms} AS t2 ON t1.term_id=t2.term_id
																	 WHERE t1.description LIKE BINARY %s AND t1.taxonomy=%s ORDER BY t2.term_order ASC", $what, $req['post_type'] );
			if( $parameters['caseCheck'] === 'false' )
				$sql = $wpdb->prepare( "SELECT t1.term_id AS itemID,
																	 t2.name AS itemTitle,
																	 t1.description AS itemContent,
																	 t2.slug AS itemSlug
																	 FROM {$wpdb->term_taxonomy} AS t1
																	 INNER JOIN {$wpdb->terms} AS t2 ON t1.term_id=t2.term_id
																	 WHERE t1.description LIKE %s AND t1.taxonomy=%s ORDER BY t2.term_order ASC", $what, $req['post_type'] );

			$results = $wpdb->get_results( $sql , ARRAY_A );
			$c += count($results);
			$result['html'] .= K8Html::buildTableHtml([
				'data'=>$results,
				'title'=>$req['title'],
				'what'=>$parameters['what'],
				'wp_typpe'=>$req['wp_type'],
				'caseCheck'=>$parameters['caseCheck'],
			]);
		}
		$result['html'] .= '</div></div>';
		$result['html'] = '<h2>Totally found items: ' . $c . '</h2>' . $result['html'];
		return rest_ensure_response( $result );
	}



	#custom route to get data about ip address
	public function ipaddr_callback($request_data) {
		$params = $request_data->get_params();
		$ip = $_SERVER['REMOTE_ADDR'];
		if( isset($params['ip']) && $params['ip'] !== '' )
			$ip = $params['ip'];
		$fgc = file_get_contents('http://ip-api.com/json/'.$ip.'?fields=status,message,continent,country,countryCode,region,regionName,city,district,zip,lat,lon,timezone,isp,org,as,asname,reverse,mobile,proxy,hosting,query');
		$post_data = ['ip_data' => json_decode( $fgc ), 'ip' => $ip];
		return rest_ensure_response( $post_data );
	}

	#rest api for affiliate coupons list
	public function getCoupons_callback(){
		$coup_data = [];
		$fill_data = [];
		$fill_data['category']['all'] = 'All VPNs';
		$fill_data['type']['all'] = 'All Types';
		$all_data = [];
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
		 	$c=0;
			while ( $the_query->have_posts() ) : $the_query->the_post();
				$pid = get_the_ID();
				$pm = get_post_meta( $pid, '', true );
				$image_atts = wp_get_attachment_image_src( $pm['affcoups_coupon_image'][0], 'thumbnail' );
				$affcoups_coupon_category = get_the_terms($pid,'affcoups_coupon_category');
				$affcoups_coupon_type = get_the_terms($pid,'affcoups_coupon_type');

				if (isset($pm['affcoups_coupon_title'][0]))
					$coup_data[$c]['title'] = $pm['affcoups_coupon_title'][0];

				if (isset($pm['affcoups_coupon_url'][0]))
					$coup_data[$c]['url'] = $pm['affcoups_coupon_url'][0];

				if( is_array($image_atts) && count($image_atts)>0 )
					$coup_data[$c]['image'] = array('url'=>$image_atts[0], 'width'=>$image_atts[1], 'height'=>$image_atts[2]);

				if (isset($pm['affcoups_coupon_discount'][0]))
					$coup_data[$c]['discount'] = $pm['affcoups_coupon_discount'][0];

				if (isset($pm['affcoups_coupon_valid_until'][0]))
					$coup_data[$c]['until'] = date('d.m.Y', $pm['affcoups_coupon_valid_until'][0]);

				if (isset($pm['affcoups_coupon_description'][0]))
					$coup_data[$c]['description'] = $pm['affcoups_coupon_description'][0];

				if (isset($pm['affcoups_coupon_code'][0]))
					$coup_data[$c]['code'] = $pm['affcoups_coupon_code'][0];

				if( is_array($affcoups_coupon_category) && count($affcoups_coupon_category)>0 ){
					foreach ($affcoups_coupon_category as $cat) {
						$coup_data[$c]['category'][] = $cat->slug;
						if( !isset($fill_data['category'][$cat->slug]) )
							$fill_data['category'][$cat->slug] = $cat->name;
					}
				}
				else{
					$coup_data[$c]['category'][] = 'undef';
				}
				if( is_array($affcoups_coupon_type) && count($affcoups_coupon_type)>0 ){
					foreach ($affcoups_coupon_type as $type) {
						$coup_data[$c]['type'][] = $type->slug;
						if( !isset($fill_data['type'][$type->slug]) )
							$fill_data['type'][$type->slug] = $type->name;
					}
				}
				else{
					$coup_data[$c]['type'][] = 'undef';
				}
				$c++;
			endwhile;
			wp_reset_postdata();
			$fill_data['type']['undef'] = 'Undefined';
			$fill_data['category']['undef'] = 'Undefined';

		endif;


		$all_data = [
			'fill_data' => $fill_data,
			'coup_data' => $coup_data
		];

		return rest_ensure_response( $all_data );
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
	'cust_fields' => K8_VPN_CF,
	'taxz' => K8_VPN_TAX
]);