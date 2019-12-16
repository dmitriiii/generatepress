<?php
if( !is_array( $pid_arr ) || count( $pid_arr ) == 0 ){
	echo __('Sorry nothing found. Please check shortcode attributes!' , 'k8lang_domain');
	return;
}
$span = count( $pid_arr ) + 1;

echo K8Html::tbl_start(['add_clss' => strtolower( $tag )]) .
	$this->tr . K8Html::tdHead( [
		'format' => "<th colspan='".$span."'><span>%s</span></th>",
		'txt' => __('Download und Torrent' , 'k8lang_domain')
	] ) . $this->_tr;

	#Show names of vpn Services if it is compare tables
	if( count( $pid_arr ) > 1 ):
		echo $this->tr . $this->td . __('VPN-Dienstname' , 'k8lang_domain') . $this->_td;
		foreach ( $pid_arr as $item ) {
			echo $this->td . $this->mark1 . get_post_meta( $item['pid'], 'cwp_rev_product_name', true ) . $this->_mark1 . $this->_td;
		}
		echo $this->_tr;
	endif;

	echo $this->tr . K8Html::tdHead( ['txt'=>__('Torrent Nutzung erlaubt' , 'k8lang_domain')] );
	foreach ($pid_arr as $item) {
		echo $this->td .
					((has_term( 'tauschboersen-torrent', 'anwendungen', $item['pid'] ) ) ? $this->true_icon : $this->false_icon) .
				 $this->_td;
	}
	echo $this->_tr .

	$this->tr . K8Html::tdHead( ['txt'=>__('Eigene Torrent Server' , 'k8lang_domain')] );
	foreach ($pid_arr as $item) {
		echo $this->td .
					((has_term( 'own-torrent-server', 'sonderfunktionen', $item['pid'] ) ) ? $this->true_icon : $this->false_icon) .
				 $this->_td;
	}
	echo $this->_tr .

	$this->tr . K8Html::tdHead( ['txt'=>__('Abmahnungen vermeiden' , 'k8lang_domain')] );
	foreach ($pid_arr as $item) {
		echo $this->td .
					((has_term( 'abmahnungen-vermeiden', 'anwendungen', $item['pid'] ) ) ? $this->true_icon : $this->false_icon) .
				 $this->_td;
	}
	echo $this->_tr .

	$this->tr . K8Html::tdHead( ['txt'=>__('Portweiterleitungen' , 'k8lang_domain')] );
	foreach ($pid_arr as $item) {
		echo $this->td .
					((has_term( 'portweiterleitungen', 'sonderfunktionen', $item['pid'] ) ) ? $this->true_icon : $this->false_icon) .
				 $this->_td;
	}
	echo $this->_tr;

echo K8Html::tbl_end();