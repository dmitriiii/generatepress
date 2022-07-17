<?php # [K8_SHORT_PRICING]
if( !is_array( $pid_arr ) || count( $pid_arr ) == 0 ){
	echo __('Sorry nothing found. Please check shortcode attributes!' , 'k8lang_domain');
	return;
}
$span = count( $pid_arr ) + 1;

echo K8Html::tbl_start(['add_clss' => strtolower( $tag )]) .
	$this->tr . K8Html::tdHead( [
		'format' => "<th colspan='".$span."'><span>%s</span></th>",
		'txt' => __('Kosten / Tarife' , 'k8lang_domain')
	] ) . $this->_tr;

	#Show names of vpn Services if it is compare tables
	if( count( $pid_arr ) > 1 ):
		echo $this->tr . $this->td . __('VPN-Dienstname' , 'k8lang_domain') . $this->_td .
					K8Html::getPolyThs( $this, $pid_arr ) . 
				 $this->_tr;
	endif;

	echo $this->tr . K8Html::tdHead( ['txt'=>__('Kostenlose Nutzung' , 'k8lang_domain')] );
		foreach ($pid_arr as $item) {
			echo $this->td . $this->false_icon . $this->_td;
		}
	echo $this->_tr;

	K8H::priceCompare( $this, $pid_arr );

	echo $this->tr . K8Html::tdHead( ['txt'=>__('Anzahl gleichzeitiger Verbindungen pro Konto' , 'k8lang_domain')] );
		foreach ($pid_arr as $item) {
			echo $this->td;
				$k8_acf_vpndet_conn = get_field( 'k8_acf_vpndet_conn', $item['pid'] );
				if ( is_array($k8_acf_vpndet_conn) && count($k8_acf_vpndet_conn) > 0 )
					echo $this->b . $k8_acf_vpndet_conn['label'] . $this->_b;
			echo $this->_td;
		}
	echo $this->_tr ;

	echo $this->tr . K8Html::tdHead( ['txt'=>__('Testmöglichkeiten' , 'k8lang_domain')] );
		foreach ($pid_arr as $item) {
			$k8_acf_vpndet_trialz = get_field( 'k8_acf_vpndet_trialz', $item['pid'] );
			echo $this->td;
				if ( is_array($k8_acf_vpndet_trialz) && count($k8_acf_vpndet_trialz) > 0 )
					echo K8H::getAcfChbx(['data'=>$k8_acf_vpndet_trialz ]);
			echo $this->_td;
		}
	echo $this->_tr;

echo K8Html::tbl_end();