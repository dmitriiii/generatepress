<?php
$k8_acf_vpndet_vid = get_field( 'k8_acf_vpndet_vid', $pid );
$k8_acf_vpndet_vid_int = get_field( 'k8_acf_vpndet_vid_int', $pid );

echo K8Html::tbl_start(['add_clss' => strtolower( $tag )]);

	echo $this->tr . K8Html::tdHead( [
		'format' => "<th colspan='2'><span>%s</span></th>",
		'txt' => __('Streaming von TV und Videoinhalten' , 'k8lang_domain')
	] ) . $this->_tr .

	$this->tr . K8Html::tdHead( ['txt'=>__('Nutzung am Heim-Router' , 'k8lang_domain')] ) .
		$this->td . ( ( has_term( 'vpn-router', 'anwendungen', $pid ) ) ? $this->true_icon : $this->false_icon ) . $this->_td .
	$this->_tr .

	$this->tr . K8Html::tdHead( ['txt'=>__('Nutzung mit KODI' , 'k8lang_domain')] ) .
		$this->td . ( ( has_term( 'kodi-addon', 'betriebssystem', $pid ) ) ? $this->true_icon : $this->false_icon ) . $this->_td .
	$this->_tr .

	$this->tr . K8Html::tdHead( ['txt'=>__('SmartDNS' , 'k8lang_domain')] ) .
		$this->td . ( ( has_term( 'smartdns', 'sonderfunktionen', $pid ) ) ? $this->true_icon : $this->false_icon ) . $this->_td .
	$this->_tr .

	$this->tr . K8Html::tdHead( ['txt'=>__('FireTV App' , 'k8lang_domain')] ) .
		$this->td . ( ( has_term( 'firetv', 'betriebssystem', $pid ) ) ? $this->true_icon : $this->false_icon ) . $this->_td .
	$this->_tr .

	$this->tr . K8Html::tdHead( ['txt'=>__('Abmahnungen vermeiden' , 'k8lang_domain')] ) .
		$this->td . ( ( has_term( 'abmahnungen-vermeiden', 'anwendungen', $pid ) ) ? $this->true_icon : $this->false_icon ) . $this->_td .
	$this->_tr;

	#Version ( German, US, Or both )
	switch ( $a['ver'] ) {
		case 'all':
			if( is_array( $k8_acf_vpndet_vid ) && count( $k8_acf_vpndet_vid ) > 0 ) :
				echo  $this->tr .
								K8Html::tdHead( ['txt'=>__('Unterstütze Streaming-Plattformen' , 'k8lang_domain')] ) .
								$this->td . K8H::getAcfChbx( ['data' => $k8_acf_vpndet_vid] ) . $this->_td .
							$this->_tr;
			endif;
			if( is_array( $k8_acf_vpndet_vid_int ) && count( $k8_acf_vpndet_vid_int ) > 0 ) :
				echo  $this->tr .
								K8Html::tdHead( ['txt'=>__('Unterstützte internationale Streaming-Plattformen' , 'k8lang_domain')] ) .
								$this->td . K8H::getAcfChbx( ['data' => $k8_acf_vpndet_vid_int] ) . $this->_td .
							$this->_tr;
			endif;
			break;

		case 'int':
			if( is_array( $k8_acf_vpndet_vid_int ) && count( $k8_acf_vpndet_vid_int ) > 0 ) :
				echo  $this->tr .
								K8Html::tdHead( ['txt'=>__('Unterstützte internationale Streaming-Plattformen' , 'k8lang_domain')] ) .
								$this->td . K8H::getAcfChbx( ['data' => $k8_acf_vpndet_vid_int] ) . $this->_td .
							$this->_tr;
			endif;
			break;

		default:
			if( is_array( $k8_acf_vpndet_vid ) && count( $k8_acf_vpndet_vid ) > 0 ) :
				echo  $this->tr .
								K8Html::tdHead( ['txt'=>__('Unterstütze Streaming-Plattformen' , 'k8lang_domain')] ) .
								$this->td . K8H::getAcfChbx( ['data' => $k8_acf_vpndet_vid] ) . $this->_td .
							$this->_tr;
			endif;
			break;
	}

echo K8Html::tbl_end();