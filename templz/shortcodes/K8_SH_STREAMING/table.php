<?php # [K8_SH_STREAMING]
if( !is_array( $pid_arr ) || count( $pid_arr ) == 0 ){
	echo __('Sorry nothing found. Please check shortcode attributes!' , 'k8lang_domain');
	return;
}
$span = count( $pid_arr ) + 1;

echo K8Html::tbl_start(['add_clss' => strtolower( $tag )]) .

	$this->tr . K8Html::tdHead( [
		'format' => "<th colspan='".$span."'><span>%s</span></th>",
		'txt' => __('Streaming von TV und Videoinhalten' , 'k8lang_domain')
	] ) . $this->_tr;


	#Show names of vpn Services if it is compare tables
	if( count( $pid_arr ) > 1 ):
		echo $this->tr . $this->td . __('VPN-Dienstname' , 'k8lang_domain') . $this->_td .
				K8Html::getPolyThs( $this, $pid_arr ) . 
			 $this->_tr;
	endif;


	echo $this->tr . K8Html::tdHead( ['txt'=>__('Nutzung am Heim-Router' , 'k8lang_domain')] );
	foreach ($pid_arr as $item) {
		echo $this->td .
					((has_term( 'vpn-router', 'anwendungen', $item['pid'] ) ) ? $this->true_icon : $this->false_icon) .
				 $this->_td;
	}
	echo $this->_tr .


	$this->tr . K8Html::tdHead( ['txt'=>__('Nutzung mit KODI' , 'k8lang_domain')] );
	foreach ($pid_arr as $item) {
		echo $this->td .
					((has_term( 'kodi-addon', 'betriebssystem', $item['pid'] ) ) ? $this->true_icon : $this->false_icon) .
				 $this->_td;
	}
	echo $this->_tr .


	$this->tr . K8Html::tdHead( ['txt'=>__('SmartDNS' , 'k8lang_domain')] );
	foreach ($pid_arr as $item) {
		echo $this->td .
					((has_term( 'smartdns', 'sonderfunktionen', $item['pid'] ) ) ? $this->true_icon : $this->false_icon) .
				 $this->_td;
	}
	echo $this->_tr .


	$this->tr . K8Html::tdHead( ['txt'=>__('FireTV App' , 'k8lang_domain')] );
	foreach ($pid_arr as $item) {
		echo $this->td .
					((has_term( 'firetv', 'betriebssystem', $item['pid'] ) ) ? $this->true_icon : $this->false_icon) .
				 $this->_td;
	}
	echo $this->_tr .


	$this->tr . K8Html::tdHead( ['txt'=>__('Abmahnungen vermeiden' , 'k8lang_domain')] );
	foreach ($pid_arr as $item) {
		echo $this->td .
					((has_term( 'abmahnungen-vermeiden', 'anwendungen', $item['pid'] ) ) ? $this->true_icon : $this->false_icon) .
				 $this->_td;
	}
	echo $this->_tr;


	#Version ( German, US, Or both )
	switch ( $a['ver'] ) {
		case 'all':
			echo $this->tr .
				K8Html::tdHead( ['txt'=>__('Unterstütze Streaming-Plattformen' , 'k8lang_domain')] );
				foreach ($pid_arr as $item) :
					$k8_acf_vpndet_vid = get_field( 'k8_acf_vpndet_vid', $item['pid'] );
					echo $this->td;
						if( is_array( $k8_acf_vpndet_vid ) && count( $k8_acf_vpndet_vid ) > 0 )
							echo K8H::getAcfChbx( ['data' => $k8_acf_vpndet_vid] );
					echo $this->_td;
				endforeach;
			echo $this->_tr;

			echo $this->tr .
				K8Html::tdHead( ['txt'=>__('Unterstützte internationale Streaming-Plattformen' , 'k8lang_domain')] );
				foreach ($pid_arr as $item) :
					$k8_acf_vpndet_vid_int = get_field( 'k8_acf_vpndet_vid_int', $item['pid'] );
					echo $this->td;
						if( is_array( $k8_acf_vpndet_vid_int ) && count( $k8_acf_vpndet_vid_int ) > 0 )
							echo K8H::getAcfChbx( ['data' => $k8_acf_vpndet_vid_int] );
					echo $this->_td;
				endforeach;
			echo $this->_tr;
		break;

		case 'int':
			echo $this->tr .
				K8Html::tdHead( ['txt'=>__('Unterstützte internationale Streaming-Plattformen' , 'k8lang_domain')] );
				foreach ($pid_arr as $item) :
					$k8_acf_vpndet_vid_int = get_field( 'k8_acf_vpndet_vid_int', $item['pid'] );
					echo $this->td;
						if( is_array( $k8_acf_vpndet_vid_int ) && count( $k8_acf_vpndet_vid_int ) > 0 )
							echo K8H::getAcfChbx( ['data' => $k8_acf_vpndet_vid_int] );
					echo $this->_td;
				endforeach;
			echo $this->_tr;
		break;

		default:
			echo $this->tr .
				K8Html::tdHead( ['txt'=>__('Unterstütze Streaming-Plattformen' , 'k8lang_domain')] );
				foreach ($pid_arr as $item) :
					$k8_acf_vpndet_vid = get_field( 'k8_acf_vpndet_vid', $item['pid'] );
					echo $this->td;
						if( is_array( $k8_acf_vpndet_vid ) && count( $k8_acf_vpndet_vid ) > 0 )
							echo K8H::getAcfChbx( ['data' => $k8_acf_vpndet_vid] );
					echo $this->_td;
				endforeach;
			echo $this->_tr;
		break;
	}

echo K8Html::tbl_end();