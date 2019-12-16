<?php
if( !is_array( $pid_arr ) || count( $pid_arr ) == 0 ){
	echo 'Sorry nothing found';
	return;
}
$span = count( $pid_arr ) + 1;
echo K8Html::tbl_start(['add_clss' => strtolower( $tag )]) .
	$this->tr . K8Html::tdHead( [
		'format' => "<th colspan='".$span."'><span>%s</span></th>",
		'txt' => __('VPN für Reisen und im Ausland' , 'k8lang_domain')
	] ) . $this->_tr;

	#Show names of vpn Services if it is compare tables
	if( count( $pid_arr ) > 1 ):
		echo $this->tr . $this->td . __('VPN-Dienstname' , 'k8lang_domain') . $this->_td;
		foreach ( $pid_arr as $item ) {
			echo $this->td . $this->mark1 . get_post_meta( $item['pid'], 'cwp_rev_product_name', true ) . $this->_mark1 . $this->_td;
		}
		echo $this->_tr;
	endif;

	echo $this->tr . K8Html::tdHead( ['txt'=>__('Nutzung in restriktiven Netzwerken (China, Hotels)' , 'k8lang_domain')] );
	foreach ($pid_arr as $item) {
		echo $this->td .
					(( has_term( 'obfsproxy', 'sonderfunktionen', $item['pid'] )
						|| has_term( 'shadowsocks', 'vpnprotokolle', $item['pid'] )
						|| has_term( 'wireguard', 'vpnprotokolle', $item['pid'] ) ) ? $this->true_icon : $this->false_icon) .
				 $this->_td;
	}
	echo $this->_tr .

	$this->tr . K8Html::tdHead( ['txt'=>__('Obfusication (Maskierung)' , 'k8lang_domain')] );
	foreach ($pid_arr as $item) {
		echo $this->td .
					((has_term( 'obfsproxy', 'sonderfunktionen', $item['pid'] ) ) ? $this->true_icon : $this->false_icon) .
				 $this->_td;
	}
	echo $this->_tr .

	$this->tr . K8Html::tdHead( ['txt'=>__('Schutz in unsicheren Wifi-Netzwerken' , 'k8lang_domain')] );
	foreach ($pid_arr as $item) {
		echo $this->td .
					((has_term( 'lokale-sperren-umgehen', 'anwendungen', $item['pid'] ) ) ? $this->true_icon : $this->false_icon) .
				 $this->_td;
	}
	echo $this->_tr .

	$this->tr . K8Html::tdHead( ['txt'=>__('Shadowsocks oder SOCKS5' , 'k8lang_domain')] );
	foreach ($pid_arr as $item) {
		echo $this->td .
					(( has_term( 'shadowsocks', 'vpnprotokolle', $item['pid'] )
						|| has_term( 'socks5', 'vpnprotokolle', $item['pid'] ) ) ? $this->true_icon : $this->false_icon) .
				 $this->_td;
	}
	echo $this->_tr .
K8Html::tbl_end();