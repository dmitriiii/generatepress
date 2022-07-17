<?php # [K8_SH_ROUTER]
if( !is_array( $pid_arr ) || count( $pid_arr ) == 0 ){
	echo 'Sorry nothing found';
	return;
}
$span = count( $pid_arr ) + 1;
echo K8Html::tbl_start(['add_clss' => strtolower( $tag )]).
	$this->tr . K8Html::tdHead( [
		'format' => "<th colspan='".$span."'><span>%s</span></th>",
		'txt' => __('Betrieb am VPN-Client Router' , 'k8lang_domain')
	] ) . $this->_tr;

	#Show names of vpn Services if it is compare tables
	if( count( $pid_arr ) > 1 ):
		echo $this->tr . $this->td . __('VPN-Dienstname' , 'k8lang_domain') . $this->_td .
					K8Html::getPolyThs( $this, $pid_arr ) . 
				 $this->_tr;
	endif;

	echo $this->tr . K8Html::tdHead( ['txt'=>__('Verwendung auf Routern' , 'k8lang_domain')] );
	foreach ($pid_arr as $item) {
		echo $this->td .
					((has_term( 'vpn-router', 'anwendungen', $item['pid'] ) ) ? $this->true_icon : $this->false_icon) .
				 $this->_td;
	}
	echo $this->_tr .

	$this->tr . K8Html::tdHead( ['txt'=>__('Load Balancing' , 'k8lang_domain')] );
	foreach ($pid_arr as $item) {
		echo $this->td .
					((has_term( 'loadbalancing', 'sonderfunktionen', $item['pid'] ) ) ? $this->true_icon : $this->false_icon) .
				 $this->_td;
	}
	echo $this->_tr .

	$this->tr . K8Html::tdHead( ['txt'=>__('Ausfallsfreier Betrieb' , 'k8lang_domain')] );
	foreach ($pid_arr as $item) {
		echo $this->td .
					((has_term( 'loadbalancing', 'sonderfunktionen', $item['pid'] ) ) ? $this->true_icon : $this->false_icon) .
				 $this->_td;
	}
	echo $this->_tr .

	$this->tr . K8Html::tdHead( ['txt'=>__('Eigene Router Anwendung' , 'k8lang_domain')] );
	foreach ($pid_arr as $item) {
		echo $this->td .
					(( has_term( 'dd-wrt', 'betriebssystem', $item['pid'] )
						|| has_term( 'openwrt', 'betriebssystem', $item['pid'] )
						|| has_term( 'tomato', 'betriebssystem', $item['pid'] ) ) ? $this->true_icon : $this->false_icon) .
				 $this->_td;
	}
	echo $this->_tr .

	$this->tr . K8Html::tdHead( ['txt'=>__('Kompatibel mit' , 'k8lang_domain')] );
	foreach ($pid_arr as $item) {
		echo $this->td;
		$new_valz_arr = array();
		foreach ($valz as $k => $v) :
		 	if( has_term( $k, 'betriebssystem', $item['pid'] ) ){
		 		$new_valz_arr[] = $v;
		 	}
		endforeach;
		echo "<strong class='labb'>" .
					implode("</strong><strong class='labb'>",$new_valz_arr) .
				 "</strong>";
		$this->_td;
	}
	echo $this->_tr .
	K8Html::tbl_end();