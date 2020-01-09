<?php
if( !is_array( $pid_arr ) || count( $pid_arr ) == 0 ){
	echo __('Sorry nothing found. Please check shortcode attributes!' , 'k8lang_domain');
	return;
}
$span = count( $pid_arr ) + 1;

echo K8Html::tbl_start(['add_clss' => strtolower( $tag )]) .
	$this->tr . K8Html::tdHead( [
		'format' => "<th colspan='".$span."'><span>%s</span></th>",
		'txt' => __('Maximale Geschwindigkeit getestet' , 'k8lang_domain')
	] ) . $this->_tr;


#Show names of vpn Services if it is compare tables
if( count( $pid_arr ) > 1 ):
	echo $this->tr . $this->td . __('VPN-Dienstname' , 'k8lang_domain') . $this->_td;
	foreach ( $pid_arr as $item ) {
		echo $this->td . $this->mark1 . get_post_meta( $item['pid'], 'cwp_rev_product_name', true ) . $this->_mark1 . $this->_td;
	}
	echo $this->_tr;
endif;

echo $this->tr . K8Html::tdHead( ['txt'=>__('Download' , 'k8lang_domain')] );
	foreach ($pid_arr as $item) {
		echo $this->td .
					 $this->s . get_field('k8_acf_vpndet_down', $item['pid']) . $this->_s . ' kbps'.
				 $this->_td;
	}
echo $this->_tr .

$this->tr . K8Html::tdHead( ['txt'=>__('Upload' , 'k8lang_domain')] );
	foreach ($pid_arr as $item) {
		echo $this->td .
					 $this->s . get_field('k8_acf_vpndet_up', $item['pid']) . $this->_s . ' kbps'.
				 $this->_td;
	}
echo $this->_tr .

$this->tr . K8Html::tdHead( ['txt'=>__('Jitter' , 'k8lang_domain')] );
	foreach ($pid_arr as $item) {
		echo $this->td .
					 $this->s . get_field('k8_acf_vpndet_jitter', $item['pid']) . $this->_s . ' ms'.
				 $this->_td;
	}
echo $this->_tr .

$this->tr . K8Html::tdHead( ['txt'=>__('Ping' , 'k8lang_domain')] );
	foreach ($pid_arr as $item) {
		echo $this->td .
					 $this->s . get_field('k8_acf_vpndet_ping', $item['pid']) . $this->_s . ' ms'.
				 $this->_td;
	}
echo $this->_tr .

$this->tr . K8Html::tdHead( ['txt'=>__('Getestet mit OpenVPN (UDP) am' , 'k8lang_domain')] );
	foreach ($pid_arr as $item) {
		$stamp_old = get_the_modified_time('G' , $item['pid']);
		echo $this->td .
					 $this->s . date( 'd.m.Y', strtotime('-10 day', $stamp_old) ) . $this->_s.
				 $this->_td;
	}
echo $this->_tr .

$this->tr . K8Html::tdHead( ['txt'=>__('Verbindung innerhalb von' , 'k8lang_domain')] );
	foreach ($pid_arr as $item) {
		echo $this->td .
					 $this->s . get_field('k8_acf_vpndet_meas', $item['pid'])['label'] . $this->_s .
				 $this->_td;
	}
echo $this->_tr;

echo K8Html::tbl_end();