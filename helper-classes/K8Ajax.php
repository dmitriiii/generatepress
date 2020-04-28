<?php
class K8Ajax
{
	function __construct()
	{
		//Success Captcha
		add_action('wp_ajax_nopriv_k8_ajx_captcha_succ', array( $this, 'k8_ajx_captcha_succ' ));
		add_action('wp_ajax_k8_ajx_captcha_succ', array( $this, 'k8_ajx_captcha_succ' ));
		#VPN security
		add_action('wp_ajax_nopriv_k8_ajx_safety', array( $this, 'k8_ajx_safety' ));
		add_action('wp_ajax_k8_ajx_safety', array( $this, 'k8_ajx_safety' ));

		#IP
		add_action('wp_ajax_nopriv_k8_ajx_ip', array( $this, 'k8_ajx_ip' ));
		add_action('wp_ajax_k8_ajx_ip', array( $this, 'k8_ajx_ip' ));

		#LazyLoad Comments
		add_action('wp_ajax_nopriv_k8laz_comments', array( $this, 'k8laz_comments' ));
		add_action('wp_ajax_k8laz_comments', array( $this, 'k8laz_comments' ));

		#LazyLoad Shortcodes
		add_action('wp_ajax_nopriv_k8laz_short', array( $this, 'k8laz_short' ));
		add_action('wp_ajax_k8laz_short', array( $this, 'k8laz_short' ));

	}
	public function final( $arrr ){
		echo json_encode( $arrr );
		exit();
	}

	#LazyLoad Shortcodes
	public function k8laz_short(){
		$arrr = array();
		$html = '';
		extract( $_POST );
		// write_log(get_defined_vars());
		// if ( !isset( $nonce ) || !wp_verify_nonce( $nonce, "k8laz__nonce") ) {
	 //    $arrr['error'] = 'Submit via website, please';
		// 	$this->final($arrr);
	 //  }
	 	$shrtcd = "[$tag vpnid='$vpnid' output='$output'";
	 	if(isset($ver))
	 		$shrtcd .= " ver='$ver'";
	 	$shrtcd .= " is_ajax='true']";
	 	$arrr['html'] = do_shortcode( $shrtcd );
		echo json_encode( $arrr );
		exit();
	}

	#Load comments
	public function k8laz_comments(){
		$arrr = array();
		$html = '';
		extract( $_POST );
		// if ( !isset( $nonce ) || !wp_verify_nonce( $nonce, "k8laz__nonce") ) {
	 //    $arrr['error'] = 'Submit via website, please';
		// 	$this->final($arrr);
	 //  }
	  ob_start();
	  echo '<ol class="comment-list">';
	 	$commz = get_comments(
			array(
				'status' => 'approve',
				'post_id' => $pid,
				'orderby' => 'comment_approved',
				'order' => 'ASC'
			)
		);
		write_log($commz);
		wp_list_comments( array('callback' => 'K8generate_comment'), $commz );
	 	echo '</ol>';
	  $html = ob_get_clean();
	 	$arrr['html'] = $html;
		echo json_encode( $arrr );
		exit();
	}



	//Success Captcha
	public function k8_ajx_captcha_succ(){
		$arrr = array();
		extract( $_POST );
		if( !isset( $action ) || $action != 'k8_ajx_captcha_succ' ){
			$arrr['error'] = 'Submit via website, please';
			$this->final($arrr);
		}
		if( is_array($dataSubm) && count($dataSubm) > 0 ){
			foreach ($dataSubm as $item) {
				switch ( $item['name'] ) {
					case 'g-recaptcha-response':
						$recaptcha = $item['value'];
						break;
					case 'href':
						$href = $item['value'];
						break;
					default:
						$pid = $item['value'];
						break;
				}
			}
		}
		#Verify captcha backend code
		if(isset( $recaptcha ) && !empty( $recaptcha ) ){
			$secret = '6LdCnLQUAAAAAFa309xFoL442plFuhYWBUEsTjvs';
			$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$recaptcha);
			$responseData = json_decode($verifyResponse);
			if($responseData->success){
				$arrr['html'] = K8Html::getButt(
					array(
						'nofollow'=> 'nofollow',
						'class'   => 'dwnd__butt grn',
						'href'    => $href,
						'download'=> 'download',
						'img_src' => get_the_post_thumbnail_url( $pid, 'thumbnail' ),
						'text'    => 'Download Starten'
					)
				);
			}
			else{
				$arrr['error'] = 'Robot verification failed, please try again.';
				$this->final($arrr);
			}
		}
		// write_log(get_defined_vars());
		echo json_encode( $arrr );
		exit();
	}
	#VPN security
	public function k8_ajx_safety(){
		$arrr = array();
		$html = '';
		extract( $_POST );
		if( !isset( $action ) || $action != 'k8_ajx_safety' ){
			$arrr['error'] = 'Submit via website, please';
			$this->final($arrr);
		}
		$args = array(
			'post_type'   => 'post',
			'post_status' => array(
				'publish'
			),
			'tax_query' => array(
				array(
					'taxonomy' => 'sicherheitslevel',
					'field'    => 'slug',
					'terms'    => 'normal',
				),
			),
			'category_name' => 'vpn-anbieter',
			'posts_per_page' => -1,
			'offset' => 0,
			'meta_key'  => 'wppr_rating',
			// 'meta_type' => 'NUMERIC',
			'orderby'   => 'meta_value_num',
			'order'     => 'DESC',
		);
		if( $typ == 2 ){
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'sicherheitslevel',
					'field'    => 'slug',
					'terms'    => 'erweitert',
				),
			);
		}
		if( $typ == 3 ){
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'sicherheitslevel',
					'field'    => 'slug',
					'terms'    => 'hoch',
				),
			);
		}
		if( $typ == 4 ){
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'sicherheitslevel',
					'field'    => 'slug',
					'terms'    => 'maximal',
				),
			);
		}
		$the_query = new WP_Query( $args );
		if ( $the_query->have_posts() ) :
			$html = $html . '<div class="container-fluid"><div class="row">';
			while ( $the_query->have_posts() ) : $the_query->the_post();
				$pid = get_the_ID();
				$pm = get_post_meta( $pid );
				$wppr_options = unserialize($pm['wppr_options'][0]);
				$html = $html . '<div class="col-md-6">' . K8Html::getItem(array(
					'pid' => $pid,
					'pm' => $pm,
					'wppr_options' => $wppr_options,
				)) . '</div>';
			endwhile;
			wp_reset_postdata();
			$html = $html . '</div></div>';
		endif;
		$arrr['html'] = $html;
		// write_log(get_defined_vars());
		echo json_encode( $arrr );
		exit();
	}

	#Load
	public function k8_ajx_ip(){
		$arrr = array();
		extract( $_POST );
		$html = file_get_contents( "http://ip-api.com/json/".$ip."?fields=status,message,continent,continentCode,country,countryCode,region,regionName,city,district,zip,lat,lon,timezone,currency,isp,org,as,asname,reverse,mobile,proxy,query" );
		$arrr['html'] = $html;
		echo json_encode( $arrr );
		exit();
	}
}
new K8Ajax;