<?php
class K8Acf
{
	public $f_id;
	
	function __construct(){
		$this->f_id = array(
			'5dde6878b95b0'
		);
		add_action( 'acf/init', array( $this, 'anbieter_cf' ) );
	}
	public function anbieter_cf(){
		if( function_exists('acf_add_local_field_group') ):

			acf_add_local_field_group(array(
				'key' => 'group_5c83071429237',
				'title' => 'VPN Details',
				'fields' => array(
					array(
						'key' => 'field_5d2f189bad5fc',
						'label' => 'VPN Id',
						'name' => 'k8_acf_vpnid',
						'type' => 'number',
						'instructions' => '',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '25',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'min' => '',
						'max' => '',
						'step' => '',
					),
					array(
						'key' => 'field_5d5405265be1c',
						'label' => 'Connections per account',
						'name' => 'k8_acf_vpndet_conn',
						'type' => 'radio',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							1 => '1',
							2 => '2',
							3 => '3',
							4 => '4',
							5 => '5',
							6 => '6',
							7 => '7',
							8 => '8',
							9 => '9',
							10 => '10',
							0 => __( 'unlimitiert', 'k8lang_domain' ),
						),
						'allow_null' => 0,
						'other_choice' => 0,
						'default_value' => '',
						'layout' => 'horizontal',
						'return_format' => 'array',
						'save_other_choice' => 0,
					),
					array(
						'key' => 'field_5d550ada4ea45',
						'label' => 'Currency',
						'name' => 'k8_acf_vpndet_curr',
						'type' => 'radio',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '25',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							'usd' => 'USD',
							'eur' => 'EUR',
						),
						'allow_null' => 0,
						'other_choice' => 0,
						'default_value' => '',
						'layout' => 'horizontal',
						'return_format' => 'array',
						'save_other_choice' => 0,
					),
					array(
						'key' => 'field_5d550b7b4ea46',
						'label' => 'Duration 1',
						'name' => 'k8_acf_vpndet_durr1',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '25',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
					array(
						'key' => 'field_5d550bd34ea47',
						'label' => 'Price 1',
						'name' => 'k8_acf_vpndet_prc1',
						'type' => 'number',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '25',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'min' => '',
						'max' => '',
						'step' => '',
					),
					array(
						'key' => 'field_5d550c164ea48',
						'label' => 'Duration 2',
						'name' => 'k8_acf_vpndet_durr2',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '25',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
					array(
						'key' => 'field_5d550c214ea49',
						'label' => 'Price 2',
						'name' => 'k8_acf_vpndet_prc2',
						'type' => 'number',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '25',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'min' => '',
						'max' => '',
						'step' => '',
					),
					array(
						'key' => 'field_5d550c344ea4a',
						'label' => 'Duration 3',
						'name' => 'k8_acf_vpndet_durr3',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '25',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
					array(
						'key' => 'field_5d550c454ea4b',
						'label' => 'Price 3',
						'name' => 'k8_acf_vpndet_prc3',
						'type' => 'number',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '25',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'min' => '',
						'max' => '',
						'step' => '',
					),
					array(
						'key' => 'field_5d550c524ea4c',
						'label' => 'Duration 4',
						'name' => 'k8_acf_vpndet_durr4',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '25',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
					array(
						'key' => 'field_5d550c5c4ea4d',
						'label' => 'Price 4',
						'name' => 'k8_acf_vpndet_prc4',
						'type' => 'number',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '25',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'min' => '',
						'max' => '',
						'step' => '',
					),
					array(
						'key' => 'field_5d550d2e4ea4e',
						'label' => __( 'Testmöglichkeiten', 'k8lang_domain' ),
						'name' => 'k8_acf_vpndet_trialz',
						'type' => 'checkbox',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '75',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							'free' => __( 'Kostenloser Tarif verfügbar', 'k8lang_domain' ),
							'back' => __( 'Geld-Zurück-Garantie', 'k8lang_domain' ),
							'trial' => __( 'Limitierte kostenfreie Testzeit (Ohne Zahlung)', 'k8lang_domain' ),
							'spec' => __( 'Rabattierte Testzeit (Sonderpreis für begrenzte Zeit)', 'k8lang_domain' ),
						),
						'allow_custom' => 0,
						'default_value' => array(
						),
						'layout' => 'horizontal',
						'toggle' => 0,
						'return_format' => 'array',
						'save_custom' => 0,
					),
					array(
						'key' => 'field_5d82edce9cd47',
						'label' => 'Average price per month',
						'name' => 'k8_acf_vpndet_avg',
						'type' => 'number',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '25',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => 'This price calculates automatically',
						'prepend' => '',
						'append' => '',
						'min' => '',
						'max' => '',
						'step' => '',
					),
					array(
						'key' => 'field_5d7f199971aeb',
						'label' => 'Videoplattformen (Streaming)',
						'name' => 'k8_acf_vpndet_vid',
						'type' => 'checkbox',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							'net' => __( 'Netflix (DE)', 'k8lang_domain' ),
							'amaz' => __( 'Amazon Video (DE)', 'k8lang_domain' ),
							'dazn' => __( 'DAZN (DE)', 'k8lang_domain' ),
							'sky' => __( 'Sky (DE)', 'k8lang_domain' ),
							'euro' => __( 'Eurosport (DE)', 'k8lang_domain' ),
							'max' => __( 'Maxdome', 'k8lang_domain' ),
							'zat' => __( 'zattoo (CH)', 'k8lang_domain' ),
							'wai' => __( 'Waipu', 'k8lang_domain' ),
							'joy' => __( 'JOYN', 'k8lang_domain' ),
							'tv' => __( 'TVNow', 'k8lang_domain' ),
							'ard' => __( 'ARD (DE)', 'k8lang_domain' ),
							'zdf' => __( 'ZDF (DE)', 'k8lang_domain' ),
							'br' => __( 'BR DE)', 'k8lang_domain' ),
							'n24' => __( 'N24 (DE)', 'k8lang_domain' ),
							'mdr' => __( 'MDR (DE)', 'k8lang_domain' ),
							'rbb' => __( 'rbb (DE)', 'k8lang_domain' ),
							'wdr' => __( 'WDR (DE)', 'k8lang_domain' ),
							'art' => __( 'Arte DE)', 'k8lang_domain' ),
							'sat3' => __( '3Sat (DE)', 'k8lang_domain' ),
							'pro7' => __( 'Pro7 (DE)', 'k8lang_domain' ),
							'sat1' => __( 'Sat1 (DE)', 'k8lang_domain' ),
							'kab1' => __( 'Kabel1 (DE)', 'k8lang_domain' ),
							'orf' => __( 'ORF (AT)', 'k8lang_domain' ),
							'srf' => __( 'SRF (CH)', 'k8lang_domain' ),
							'serv' => __( 'Servus TV (DE, AT, CH)', 'k8lang_domain' ),
						),
						'allow_custom' => 0,
						'default_value' => array(
						),
						'layout' => 'horizontal',
						'toggle' => 0,
						'return_format' => 'array',
						'save_custom' => 0,
					),
					array(
						'key' => $this->f_id[0],
						'label' => 'Videoplattformen International (Streaming)',
						'name' => 'k8_acf_vpndet_vid_int',
						'type' => 'checkbox',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							'disney_plus_us' => __( 'Disney+ (US)', 'k8lang_domain' ),
							'hulu_us' => __( 'Hulu (US)', 'k8lang_domain' ),
							'amazon_prime_us' => __( 'Amazon Prime Video (US)', 'k8lang_domain' ),
							'netflix_us' => __( 'Netflix (US)', 'k8lang_domain' ),
							'apple_tv_us' => __( 'Apple TV (US)', 'k8lang_domain' ),
							'watch_espn_us' => __( 'Watch ESPN (US)', 'k8lang_domain' ),
							'channel_4_us' => __( 'Channel 4 (US)', 'k8lang_domain' ),
							'nfl_gamepass_us' => __( 'NFL Gamepass (US)', 'k8lang_domain' ),
							'mlb_us' => __( 'MLB.tv (US)', 'k8lang_domain' ),
							'abc_us' => __( 'abc (US)', 'k8lang_domain' ),
							'cbs_us' => __( 'CBS (US)', 'k8lang_domain' ),
							'fox_us' => __( 'FOX (US)', 'k8lang_domain' ),
							'nbc_us' => __( 'NBC (US)', 'k8lang_domain' ),
							'showtime_us' => __( 'Showtime (US)', 'k8lang_domain' ),
							'flix_us' => __( 'FLIX (US)', 'k8lang_domain' ),
							'epix_us' => __( 'epix (US)', 'k8lang_domain' ),
							'hbo_now_us' => __( 'HBO Now (US)', 'k8lang_domain' ),
							'itv_uk' => __( 'ITV (UK)', 'k8lang_domain' ),
							'eurosport_uk' => __( 'Eurosport (UK)', 'k8lang_domain' ),
							'sky_uk' => __( 'Sky (UK)', 'k8lang_domain' ),
							'bbc_uk' => __( 'BBC iPlayer (UK)', 'k8lang_domain' ),
							'sky_news_uk' => __( 'Sky News (UK)', 'k8lang_domain' ),
							'bloomberg_uk' => __( 'Bloomberg (UK)', 'k8lang_domain' ),
							'bt_sport' => __( 'BT Sport (UK)', 'k8lang_domain' ),
							'channel_4_uk' => __( 'Channel 4 (UK)', 'k8lang_domain' ),
							'sky_go_it' => __( 'Sky Go (IT)', 'k8lang_domain' ),
							'youtube' => __( 'YouTube', 'k8lang_domain' ),
							'spotify' => __( 'Spotify', 'k8lang_domain' ),
							'starz_us' => __( 'starz (US)', 'k8lang_domain' ),
							'hustlertv_us' => __( 'hustlerTV (US)', 'k8lang_domain' ),
							'penthousetv_us' => __( 'PenthouseTV (US)', 'k8lang_domain' ),
							'playboytv_us' => __( 'PlayboyTV (US)', 'k8lang_domain' ),
						),
						'allow_custom' => 0,
						'default_value' => array(
						),
						'layout' => 'horizontal',
						'toggle' => 0,
						'return_format' => 'array',
						'save_custom' => 0,
					),
					array(
						'key' => 'field_5dcc79d3b36d2',
						'label' => 'Download speed',
						'name' => 'k8_acf_vpndet_down',
						'type' => 'number',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '20',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => 'kbps',
						'min' => 1,
						'max' => 400000,
						'step' => '',
					),
					array(
						'key' => 'field_5dcc7a39b36d3',
						'label' => 'Upload speed',
						'name' => 'k8_acf_vpndet_up',
						'type' => 'number',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '20',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => 'kbps',
						'min' => 1,
						'max' => '',
						'step' => '',
					),
					array(
						'key' => 'field_5dcc7a5cb36d4',
						'label' => 'Ping',
						'name' => 'k8_acf_vpndet_ping',
						'type' => 'number',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '20',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => 'ms',
						'min' => 1,
						'max' => 999,
						'step' => '',
					),
					array(
						'key' => 'field_5dcc7a8fb36d5',
						'label' => 'Jitter',
						'name' => 'k8_acf_vpndet_jitter',
						'type' => 'number',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '20',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => 'ms',
						'min' => 1,
						'max' => 999,
						'step' => '',
					),
					array(
						'key' => 'field_5dcc7e879001a',
						'label' => 'Country of Measurement',
						'name' => 'k8_acf_vpndet_meas',
						'type' => 'radio',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '20',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							'Germany' => __( 'Deutschland', 'k8lang_domain' ),
							'USA' => __( 'USA', 'k8lang_domain' ),
							'UK' => __( 'Großbritannien', 'k8lang_domain' ),
							'Russia' => __( 'Russland', 'k8lang_domain' ),
						),
						'allow_null' => 0,
						'other_choice' => 0,
						'default_value' => 'Germany',
						'layout' => 'horizontal',
						'return_format' => 'array',
						'save_other_choice' => 0,
					),
				),
				'location' => array(
					array(
						array(
							'param' => 'post_category',
							'operator' => '==',
							'value' => 'category:anbieter',
						),
						array(
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'post',
						),
					),
					array(
						array(
							'param' => 'post_category',
							'operator' => '==',
							'value' => 'category:vpn-anbieter',
						),
						array(
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'post',
						),
					),
				),
				'menu_order' => 0,
				'position' => 'acf_after_title',
				'style' => 'default',
				'label_placement' => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen' => array(
					0 => 'excerpt',
					1 => 'discussion',
					2 => 'comments',
					3 => 'send-trackbacks',
				),
				'active' => true,
				'description' => '',
			));

		endif;
	}
}
new K8Acf();