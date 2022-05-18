<?php
class K8Short
{
	public $true_icon;
	public $false_icon;
	public $notset_icon;

	public $tbl_end;
	public $templ_url;

	public $td;
	public $_td;

	public $tr;
	public $_tr;

	public $b;
	public $_b;

	public $s;
	public $_s;

	public $mark1;
	public $_mark1;

	public $_ul;

	public $url;

	public function __construct( $atts ){
		$this->url = '#';

		$this->true_icon = $atts['true'];
		$this->false_icon = $atts['false'];
		$this->notset_icon = $atts['notset'];

		$this->tbl_end = '</tbody></table></div>';
		$this->templ_url = get_template_directory() . '/templz/shortcodes/';

		$this->th = '<th scope="col">';
		$this->_th = '</th>';

		$this->td = '<td>';
		$this->_td = '</td>';

		$this->tr = '<tr>';
		$this->_tr = '</tr>';

		$this->b = '<b>';
		$this->_b = '</b>';

		$this->s = '<strong>';
		$this->_s = '</strong>';

		$this->mark1 = '<h3 class="mark">';
		$this->_mark1 = '</a></h3>';

		$this->em = '<em>';
		$this->_em = '</em>';

		$this->_ul = '</ul>';
		$this->_li = '</li>';

		


		#Show table with taxonomies Data
		add_shortcode( 'k8_short_prod', array( $this, 'vpn_tax') );

		#Show table with vpn details
		add_shortcode( 'k8_short_vpndet', array( $this, 'vpn_det') );

		#[K8_SHORT_YT id="dkPLIw9aZwY"]
		add_shortcode( 'K8_SHORT_YT', array( $this, 'yt' ) );

		#[K8_SHORT_FAQ] generates schema markup for FAQ pages
		add_shortcode( 'K8_SHORT_FAQ', array( $this, 'faq' ) );

		#[K8_SH_INTRO]
		add_shortcode( 'K8_SH_INTRO', array( $this, 'intro' ) );

		#[K8_SH_STREAMING]
		add_shortcode( 'K8_SH_STREAMING', array( $this, 'streaming' ) );

		#[K8_SH_DOWNLOAD]
		add_shortcode( 'K8_SH_DOWNLOAD', array( $this, 'download' ) );

		#[K8_SH_FEATURES]
		add_shortcode( 'K8_SH_FEATURES', array( $this, 'features' ) );

		#[K8_SH_ROUTER]
		add_shortcode( 'K8_SH_ROUTER', array( $this, 'router' ) );

		#[K8_SH_TRAVELING]
		add_shortcode( 'K8_SH_TRAVELING', array( $this, 'traveling' ) );

		#[K8_SHORT_PRICING]
		add_shortcode( 'K8_SHORT_PRICING', array( $this, 'pricing') );

		#[K8_SH_SPEEDTEST]
		add_shortcode( 'K8_SH_SPEEDTEST', array( $this, 'speedtest') );

		#[K8_SH_GAMING]
		add_shortcode( 'K8_SH_GAMING', array( $this, 'gaming') );

		#[K8_SH_COMPANY]
		add_shortcode( 'K8_SH_COMPANY', array( $this, 'company') );

		#[K8_SH_APPS]
		add_shortcode( 'K8_SH_APPS', array( $this, 'apps') );

		#[K8_SH_SUPPORT]
		add_shortcode( 'K8_SH_SUPPORT', array( $this, 'support') );

		#[K8_SH_PRIVACY]
		add_shortcode( 'K8_SH_PRIVACY', array( $this, 'privacy') );

		#[K8_SH_SLIDER]
		add_shortcode( 'K8_SH_SLIDER', array( $this, 'slider') );

		#[K8_SH_VIDEOVPN]
		add_shortcode( 'K8_SH_VIDEOVPN', array( $this, 'videovpn') );

		#[K8_SH_HOWTO]
		add_shortcode( 'K8_SH_HOWTO', array( $this, 'howto') );

		#[K8_SH_BEST]
		add_shortcode( 'K8_SH_BEST', array( $this, 'best') );

		#[K8_SH_ROUTER_INFO]
		add_shortcode( 'K8_SH_ROUTER_INFO', array( $this, 'router_info') );

		#[K8_SH_POPUP]
		add_shortcode( 'K8_SH_POPUP', array( $this, 'popup') );

		#[K8_SCHEMA_ORG]
		add_shortcode( 'K8_SCHEMA_ORG', array( $this, 'organization') );

		#[K8_SH_COUPON]
		add_shortcode( 'K8_SH_COUPON', array( $this, 'coupon') );

		#[K8_SH_ACCOUNT]
		add_shortcode( 'K8_SH_ACCOUNT', array( $this, 'account') );

		#[K8_SH_SEARCH]
		add_shortcode( 'K8_SH_SEARCH', array( $this, 'search') );

		#[K8_SH_NPERF]
		add_shortcode( 'K8_SH_NPERF', array( $this, 'nperf') );
	}

	#set url of anbieter review
	private function setUrl($pid){
		// $this->url = get_permalink($pid);
		return '<a href="'.get_permalink($pid).'">';
	}

	// private function getUrl(){
	// 	return $this->url;
	// }

	// private function getUrl(){

	// }

	/**
	 * [td description]
	 * @param  [type] $args [
	 *   'class' - str
	 * ]
	 * @return [type]       [description]
	 */
	private function td( $args = array() ){
		$str = "<td class='%s'>";
		$class = '';
		if( isset($args['class']) ){
			$class = $args['class'];
		}
		return sprintf( $str, $class );
	}

	private function th( $args = array() ){
		$str = "<th class='%s'>";
		$class = '';
		if( isset($args['class']) ){
			$class = $args['class'];
		}
		return sprintf( $str, $class );
	}

	private function ul( $args = array() ){
		$str = "<ul class='%s'>";
		$class = '';
		if( isset($args['class']) ){
			$class = $args['class'];
		}
		return sprintf( $str, $class );
	}

	private function li( $args = array() ){
		$str = "<li class='%s'>";
		$class = '';
		if( isset($args['class']) ){
			$class = $args['class'];
		}
		return sprintf( $str, $class );
	}

	public function tbl_start( $attr = array() ){
		$str = '<div class="k8_tbl-resp %s"><table class="k8_compare-tbl mtb-30"><tbody>';
		( isset( $attr['add_clss'] ) ) ? $add_clss = $attr['add_clss'] : $add_clss = '';
		return sprintf( $str, $add_clss );
	}

	#[K8_SHORT_YT id="dkPLIw9aZwY"]
	public function yt( $atts, $content, $tag ) {
		$a = shortcode_atts( array(
			'id' => 'dkPLIw9aZwY',
			'output'=>'design1'
		), $atts );
		$img_name = 'maxresdefault.jpg';
		if( !K8Help::UR_exists( "http://img.youtube.com/vi/".$a['id']."/maxresdefault.jpg" ) )
			$img_name = 'hqdefault.jpg';
		if(strpos($_SERVER['REQUEST_URI'], '/amp/'))
			$a["output"] = 'amp/'.$a["output"];
		ob_start();
		include $this->templ_url . $tag . '/' . $a["output"] . '.php';
		// if( get_site_url() == 'https://vpntester.org' && !isset($atts['skip_schema']) )
		if( get_site_url() == 'https://vpntester.org' && !isset($atts['skip_schema']) )
			echo '<script type="application/ld+json">' . K8Help::ytPrepare( ['id'=>$a['id']] ) . '</script>';
		
		$html = ob_get_clean();
		return $html;
	}

	#[k8_short_prod] Show table with taxonomies Data
	public function vpn_tax( $atts, $content, $tag ){
		$a = shortcode_atts( array(
			'output' => 'table',
			'vpnid' => get_the_ID(),
		), $atts );
		$pid = (int)$a['vpnid'];
		if( isset( $atts['vpnid'] ) && !empty( $atts['vpnid'] ) ){
			$postzz = get_posts(array(
				'numberposts'	=> 1,
				'post_type'		=> 'post',
				'meta_key'		=> 'k8_acf_vpnid',
				'meta_value'	=> $atts['vpnid']
			));
			( isset( $postzz[0]->ID ) ) ? $pid = $postzz[0]->ID : '';
		}
		$arr = array(
			'betriebssystem'=>'Betriebssysteme',
			'zahlungsmittel'=>'Zahlungsmöglichkeiten',
			'sprache'=>'Sprache / Anwendung',
			'vpnprotokolle'=>'VPN-Protokolle',
			'anwendungen'=>'Anwendungen',
			'sonderfunktionen'=>'Sonder Funktionen',
			'fixeip'=>'Fixe IP-Adressen',
			'vpnstandortelaender'=>'VPN Standorte/Länder',
			'kundenservice'=>'Kundenservices',
			'unternehmen'=>'Unternehmen',
			'bedingungen'=>'bedingungen',
			'sicherheitslevel'=>'Sicherheitslevel'
		);
		ob_start();
		if( is_array( $arr ) && count( $arr ) > 0 ):
			include $this->templ_url . $tag . '/' . $a["output"] . '.php';
		endif;
		$html = ob_get_clean();
		return $html;
	}
	// generates schema markup for FAQ pages
	// [K8_SHORT_FAQ]
	public function faq( $atts, $content, $tag ){
		$a = shortcode_atts( array(
			'output' => 'design1',
			'vpnid' => get_the_ID(),
		), $atts );
		$q_o = get_queried_object();
		$k8_acf_faq = get_field('k8_acf_faq', $q_o->ID);
		if(strpos($_SERVER['REQUEST_URI'], '/amp/')){
			$a["output"] = 'amp/'.$a["output"];
		}
		ob_start();
		if ( $k8_acf_faq && is_array( $k8_acf_faq ) && count( $k8_acf_faq ) > 0 ) :
			include $this->templ_url . $tag . '/' . $a["output"] . '.php';
			$schema = K8Schema::getFaqPage([
				'k8_acf_faq' => $k8_acf_faq
			]);
			echo '<script type="application/ld+json">' . $schema . '</script>';
		endif;
		$html = ob_get_clean();
		return $html;
	}

	#[k8_short_vpndet] Show table with vpn details
	public function vpn_det( $atts, $content, $tag ){
		$a = shortcode_atts( array(
			'output' => 'table',
			'vpnid' => get_the_ID(),
		), $atts );
		$pid_arr = K8H::shortPrep( $a, $atts );
		ob_start();
		include $this->templ_url . $tag . '/' . $a["output"] . '.php';
		$html = ob_get_clean();
		return $html;
	}

	#[K8_SH_INTRO]
	public function intro( $atts, $content, $tag ){
		$a = shortcode_atts( array(
			'output' => 'table',
			'vpnid' => get_the_ID(),
		), $atts );
		$pid_arr = K8H::shortPrep( $a, $atts );
		ob_start();
		include $this->templ_url . $tag . '/' . $a["output"] . '.php';
		$html = ob_get_clean();
		return $html;
	}


	#[K8_SH_STREAMING]
	public function streaming( $atts, $content, $tag ){
		$a = shortcode_atts( array(
			'output' => 'table',
			'vpnid' => get_the_ID(),
			'ver' => 'de'
		), $atts );
		$pid_arr = K8H::shortPrep( $a, $atts );
		ob_start();
		include $this->templ_url . $tag . '/' . $a["output"] . '.php';
		$html = ob_get_clean();
		return $html;
	}


	#[K8_SH_DOWNLOAD]
	public function download( $atts, $content, $tag ){
		$a = shortcode_atts( array(
			'output' => 'table',
			'vpnid' => get_the_ID(),
		), $atts );
		$pid_arr = K8H::shortPrep( $a, $atts );
		ob_start();
		include $this->templ_url . $tag . '/' . $a["output"] . '.php';
		$html = ob_get_clean();
		return $html;
	}

	#[K8_SH_FEATURES]
	public function features( $atts, $content, $tag ){
		$a = shortcode_atts( array(
			'output' => 'table',
			'vpnid' => get_the_ID(),
		), $atts );
		$pid_arr = K8H::shortPrep( $a, $atts );
		$termz = get_terms( array(
	    'taxonomy' => 'sonderfunktionen',
	    'hide_empty' => false,
		) );
		ob_start();
		include $this->templ_url . $tag . '/' . $a["output"] . '.php';
		$html = ob_get_clean();
		return $html;
	}

	#[K8_SH_ROUTER]
	public function router( $atts, $content, $tag ){
		$a = shortcode_atts( array(
			'output' => 'table',
			'vpnid' => get_the_ID(),
		), $atts );
		$pid_arr = K8H::shortPrep( $a, $atts );
		$valz = array(
			'asuswrt'=>'ASUS',
			'openwrt'=>'Gl-iNet',
			'dd-wrt'=>'DD-WRT',
			'tomato'=>'Tomato',
			'openvpn-udp'=>'Vilfo Router'
		);
		ob_start();
		include $this->templ_url . $tag . '/' . $a["output"] . '.php';
		$html = ob_get_clean();
		return $html;
	}

	#[K8_SH_TRAVELING]
	public function traveling( $atts, $content, $tag ){
		$a = shortcode_atts( array(
			'output' => 'table',
			'vpnid' => get_the_ID(),
		), $atts );
		$pid_arr = K8H::shortPrep( $a, $atts );
		ob_start();
		include $this->templ_url . $tag . '/' . $a["output"] . '.php';
		$html = ob_get_clean();
		return $html;
	}

	#[K8_SHORT_PRICING]
	public function pricing( $atts, $content, $tag ){
		$a = shortcode_atts( array(
			'output' => 'table',
			'vpnid' => get_the_ID(),
		), $atts );
		$pid_arr = K8H::shortPrep( $a, $atts );
		ob_start();
		include $this->templ_url . $tag . '/' . $a["output"] . '.php';
		$html = ob_get_clean();
		return $html;
	}

	#[K8_SH_SPEEDTEST]
	public function speedtest( $atts, $content, $tag ){
		$a = shortcode_atts( array(
			'output' => 'table',
			'vpnid' => get_the_ID(),
		), $atts );
		$pid_arr = K8H::shortPrep( $a, $atts );
		ob_start();
		if( $a['output'] == 'graphic1' ){
			$pid = (int)$a['vpnid'];
			if( isset( $atts['vpnid'] ) && !empty( $atts['vpnid'] ) ){
				$postzz = get_posts(array(
					'numberposts'	=> 1,
					'post_type'		=> 'post',
					'meta_key'		=> 'k8_acf_vpnid',
					'meta_value'	=> $atts['vpnid']
				));
				( isset( $postzz[0]->ID ) ) ? $pid = $postzz[0]->ID : '';
			}
			wp_enqueue_script('reacher89-countUp-min-js');
			wp_enqueue_style('k8_sh_speedtest-css');
		}
		if(strpos($_SERVER['REQUEST_URI'], '/amp/')){
			$a["output"] = 'amp/'.$a["output"];
		}
		include $this->templ_url . $tag . '/' . $a["output"] . '.php';
		$html = ob_get_clean();
		return $html;
	}

	#[K8_SH_GAMING]
	public function gaming( $atts, $content, $tag ){
		$a = shortcode_atts( array(
			'output' => 'table',
			'vpnid' => get_the_ID(),
		), $atts );
		$pid_arr = K8H::shortPrep( $a, $atts );
		ob_start();
		include $this->templ_url . $tag . '/' . $a["output"] . '.php';
		$html = ob_get_clean();
		return $html;
	}

	// [K8_SH_COMPANY]
	public function company( $atts, $content, $tag ){
		$a = shortcode_atts( array(
			'output' => 'table',
			'vpnid' => get_the_ID(),
		), $atts );
		$pid_arr = K8H::shortPrep( $a, $atts );
		ob_start();
		include $this->templ_url . $tag . '/' . $a["output"] . '.php';
		$html = ob_get_clean();
		return $html;
	}

	#[K8_SH_APPS]
	public function apps( $atts, $content, $tag ){
		$a = shortcode_atts( array(
			'output' => 'table',
			'vpnid' => get_the_ID(),
		), $atts );
		$pid_arr = K8H::shortPrep( $a, $atts );
		ob_start();
		include $this->templ_url . $tag . '/' . $a["output"] . '.php';
		$html = ob_get_clean();
		return $html;
	}

	#[K8_SH_SUPPORT]
	public function support( $atts, $content, $tag ){
		$a = shortcode_atts( array(
			'output' => 'table',
			'vpnid' => get_the_ID(),
		), $atts );
		$pid_arr = K8H::shortPrep( $a, $atts );
		ob_start();
		include $this->templ_url . $tag . '/' . $a["output"] . '.php';
		$html = ob_get_clean();
		return $html;
	}

	#[K8_SH_PRIVACY]
	public function privacy( $atts, $content, $tag ){
		$a = shortcode_atts( array(
			'output' => 'table',
			'vpnid' => get_the_ID(),
		), $atts );
		$pid_arr = K8H::shortPrep( $a, $atts );
		ob_start();
		include $this->templ_url . $tag . '/' . $a["output"] . '.php';
		return ob_get_clean();
	}

	#[K8_SH_SLIDER]
	public function slider( $atts, $content, $tag ){
		$a = shortcode_atts( array(
			'output' => 'slider1',
			'pid' => get_the_ID(),
		), $atts );
		$pid = (int)$a['pid'];
		$rows = get_field('k8_acf_dwn_slider', $pid);
		if(strpos($_SERVER['REQUEST_URI'], '/amp/')){
			$a["output"] = 'amp/'.$a["output"];
		}
		else{
			wp_enqueue_style( 'k8-slick-css' );
			wp_enqueue_style( 'k8-libs-lightgallery-css' );
			wp_enqueue_script( 'k8-slick-js' );
			wp_enqueue_script( 'k8-libs-lightgallery-js' );
		}
		ob_start();
		include $this->templ_url . $tag . '/' . $a["output"] . '.php';
		$html = ob_get_clean();
		return $html;
	}

	#[K8_SH_VIDEOVPN]
	public function videovpn( $atts, $content, $tag ){
		$a = shortcode_atts( array(
			'output' => 'table',
			'vpnid' => get_the_ID(),
		), $atts );
		$pid_arr = K8H::shortPrep( $a, $atts );
		ob_start();
		include $this->templ_url . $tag . '/' . $a["output"] . '.php';
		$html = ob_get_clean();
		return $html;
	}

	#K8_SH_HOWTO
	public function howto( $atts, $content, $tag ){
		if( !isset( $atts['id'] ) || !filter_var($atts['id'], FILTER_VALIDATE_INT) ){
			echo __('Sorry nothing found. Please pass valid howto id' , 'k8lang_domain');
			return;
		}
		if( 'publish' !== get_post_status ( $atts['id'] ) ){
			echo __('Publish how to article first, please' , 'k8lang_domain');
			return;
		}
		global $wp;
		$k8_current_url = home_url( add_query_arg( array(), $wp->request ) );

		$k8_title = get_the_title( $atts['id'] );
		$k8_content = get_the_content( null, false, $atts['id'] );
		$k8_acf_howto_stp =	get_field('k8_acf_howto_stp', $atts['id']);
		$k8_acf_howto_supply =	get_field('k8_acf_howto_supply', $atts['id']);
		$k8_acf_howto_tool =	get_field('k8_acf_howto_tool', $atts['id']);

		$schema = K8Schema::getHowTo([
			'pid' => $atts['id'],
			'k8_title' => $k8_title,
	   	'k8_content' => $k8_content,
			'k8_acf_howto_stp' => $k8_acf_howto_stp,
			'k8_current_url' => $k8_current_url,
			'k8_acf_howto_supply' => $k8_acf_howto_supply,
			'k8_acf_howto_tool' => $k8_acf_howto_tool
		]);
		wp_enqueue_style( 'k8-libs-lightgallery-css' );
		wp_enqueue_script( 'k8-libs-lightgallery-js' );
		wp_enqueue_style( 'k8_sh_howto-css' );
		ob_start();
		echo '<script type="application/ld+json">' . $schema . '</script>';
		include $this->templ_url . $tag . '/design1.php';
		$html = ob_get_clean();
		return $html;
	}


	#Best VPN Services list
	#[K8_SH_BEST]
	public function best( $atts, $content, $tag ){
		$a = shortcode_atts( array(
			'output' => 'table',
			'vpnid' => get_the_ID(),
			'cols' => 'logo,title,description,text,speed,rating,recommendation,streaming-de,streaming-int,applications,security,pricing,links'
		), $atts );
		if( !isset($atts['vpnid']) || trim($atts['vpnid']) == '' )
			return '<b>Please, provide vpn ids</b>';
		$pid_arr = K8H::shortPrep( $a, $atts );
		if( count($pid_arr) == 0 )
			return '<b>Please, provide valid vpn ids that exists on website!</b>';
		$cols_arr = explode(',', $a['cols']);
		wp_enqueue_style( 'k8_sh_best-css' );
		wp_enqueue_script( 'k8-lib-progressbar-js' );
		ob_start();
		include $this->templ_url . $tag . '/' . $a["output"] . '.php';
		$html = ob_get_clean();
		return $html;
	}


	#[K8_SH_ROUTER_INFO]
	public function router_info( $atts, $content, $tag ){
		$a = shortcode_atts( array(
			'output' => 'table',
			'rouid' => get_the_ID(),
		), $atts );
		$pid_arr = K8H::shortPrepRou( $a, $atts );
		$tabz = array(
			'm5_rou_id_' => [
				'val'=>'info',
				'label'=>__('Info' , 'k8lang_domain')
			],
			'm5_rou_vnd_' => [
				'val'=>'vendor',
				'label'=>__('Vendor' , 'k8lang_domain')
			],
			'm5_rou_sft_' => [
				'val'=>'software',
				'label'=>__('Software' , 'k8lang_domain')
			],
			'm5_rou_hrd_' => [
				'val'=>'hardware',
				'label'=>__('Hardware' , 'k8lang_domain')
			],
			'm5_rou_wn_' => [
				'val'=>'wan',
				'label'=>__('WAN' , 'k8lang_domain')
			],
			'm5_rou_wf_' => [
				'val'=>'wifi',
				'label'=>__('Wifi' , 'k8lang_domain')
			],
			'm5_rou_sw_' => [
				'val'=>'switch',
				'label'=>__('Switch' , 'k8lang_domain')
			],
			'm5_rou_vpn_' => [
				'val'=>'vpn_support',
				'label'=>__('VPN Support' , 'k8lang_domain')
			],
			'm5_rou_feat_' => [
				'val'=>'features',
				'label'=>__('Features' , 'k8lang_domain')
			]
		);
		$cust_fields = json_decode( file_get_contents( K8_PATH_GLOB . '/json/routers/routers.json' ), true );
		wp_enqueue_style( 'k8-slick-css' );
		wp_enqueue_style( 'k8-libs-lightgallery-css' );
		wp_enqueue_script( 'k8-slick-js' );
		wp_enqueue_script( 'k8-libs-lightgallery-js' );
		wp_enqueue_style( 'k8_sh_router_info-css' );
		wp_enqueue_script( 'k8_sh_router_info-js' );
		ob_start();
		include $this->templ_url . $tag . '/' . $a["output"] . '.php';
		$html = ob_get_clean();
		return $html;
	}


	#[K8_SH_POPUP]
	public function popup( $atts, $content, $tag ){
		// write_log(get_defined_vars());
		if( !isset( $atts['id'] ) || !filter_var($atts['id'], FILTER_VALIDATE_INT) )
			return __('Sorry nothing found. Please pass valid popup id' , 'k8lang_domain');

		if( 'publish' !== get_post_status ( $atts['id'] ) )
			return __('' , 'k8lang_domain');

		// global $wp_filter;
		wp_enqueue_style( 'k8-pupop' );
		wp_enqueue_script( 'k8-pupop' );
		wp_enqueue_style( 'k8-timer' );
		wp_enqueue_script( 'k8-timer' );
		wp_enqueue_script( 'k8-sales-pupop' );

		ob_start();
		// add_filter('wppr_is_review_active', false);
		include $this->templ_url . $tag . '/design1.php';
		$html = ob_get_clean();
    // array_pop( $wp_filter['wppr_is_review_active']->callbacks );
		return $html;
	}

	// generates schema markup for organization
	public function organization( $atts, $content, $tag ){
		$schema = K8Schema::getOrganization([
			'org' => get_field('k8_schema_org_data', 'option')
		]);
		return '<script type="application/ld+json">' . $schema . '</script>';
	}

	#[K8_SH_COUPON]
	public function coupon( $atts, $content, $tag ){
		$a = shortcode_atts( array(
			'output' => 'design1',
			'inrow' => 4,
			'category'=>'all',
			'type'=>'all',
			'filters'=>'yes'
		), $atts );
		wp_enqueue_style( 'k8_sh_coupon-css-main' );
		wp_enqueue_script( 'k8_sh_coupon-js-run' );
		wp_enqueue_script( 'k8_sh_coupon-js-2' );
		wp_enqueue_script( 'k8_sh_coupon-js-3' );
		wp_enqueue_script( 'k8_sh_coupon-js-main' );
		ob_start();
		include $this->templ_url . $tag . '/' . $a["output"] . '.php';
		$html = ob_get_clean();
		return $html;
	}


	#[K8_SH_ACCOUNT]
	public function account( $atts, $content, $tag ){
		$a = shortcode_atts( array(
			'output' => 'design1',
			// 'inrow' => 4,
			// 'category'=>'all',
			// 'type'=>'all',
			// 'filters'=>'yes'
		), $atts );
		wp_enqueue_style( 'k8_sh_account-css-main' );
		wp_enqueue_script( 'k8_sh_account-js-run' );
		wp_enqueue_script( 'k8_sh_account-js-2' );
		wp_enqueue_script( 'k8_sh_account-js-3' );
		wp_enqueue_script( 'k8_sh_account-js-main' );
		ob_start();
		include $this->templ_url . $tag . '/' . $a["output"] . '.php';
		$html = ob_get_clean();
		return $html;
	}

	#[K8_SH_SEARCH]
	public function search($atts, $content, $tag) {
		$a = shortcode_atts( array(
			'output' => 'search-mini',
			'title' => 'It looks like nothing was found at this location. Maybe try searching?',
		), $atts );
		$search_title = $a['title'];
		ob_start();
		include $this->templ_url . $tag . '/' . $a["output"] . '.php';

		return ob_get_clean();
	}


	#[K8_SH_NPERF]
	public function nperf( $atts, $content, $tag ){
		$src="https://ws.nperf.com/partner/js?l=7dd64821-0293-4951-b4bf-4be7e60efef6";
		if (isset($atts['src']))
			$src=$atts['src'];
		ob_start();
		echo "<script src='$src'></script>";
		$html = ob_get_clean();
		return $html;
	}

}

new K8Short([
	'true' => '&#10004;',
	'false' => '&#10008;',
	'notset' => '&#9866;'
]);