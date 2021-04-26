<?php
if( !is_array( $pid_arr ) || count( $pid_arr ) == 0 ){
	echo __('Sorry nothing found. Please check shortcode attributes!' , 'k8lang_domain');
	return;
}
$span = count( $pid_arr ) + 1;

echo K8Html::tbl_start(['add_clss' => strtolower( $tag )]);
	
	#Show names of vpn Services if it is compare tables
	if( count( $pid_arr ) > 1 ):
		echo $this->tr . $this->td . __('VPN-Dienstname' , 'k8lang_domain') . $this->_td;
		foreach ( $pid_arr as $item ) {
			$this->setUrl($item['pid']);
			echo $this->td . $this->mark1 . get_post_meta( $item['pid'], 'cwp_rev_product_name', true ) . $this->_mark1 . $this->_td;
		}
		echo $this->_tr;
	endif;


	echo $this->tr . K8Html::tdHead( ['txt'=>__('Verfügbare Protokolle' , 'k8lang_domain')] );
	foreach ($pid_arr as $item) {
		$vpnprotokolle = get_the_terms( $item['pid'], 'vpnprotokolle' );
		echo $this->td;
			if ( is_array( $vpnprotokolle ) && count( $vpnprotokolle ) > 0 )
				echo K8H::getAcfChbx(['data'=>$vpnprotokolle, 'label'=>'name' ]);
		echo $this->_td;
	}
	echo $this->_tr.

	$this->tr . K8Html::tdHead( ['txt'=>__('Eigene Anwendungen/Apps' , 'k8lang_domain')] );
	foreach ($pid_arr as $item) {
		$betriebssystem = get_the_terms( $item['pid'], 'betriebssystem' );
		echo $this->td;
			if ( is_array( $betriebssystem ) && count( $betriebssystem ) > 0 )
				echo K8H::getAcfChbx(['data'=>$betriebssystem, 'label'=>'name' ]);
		echo $this->_td;
	}
	echo $this->_tr.


	$this->tr . K8Html::tdHead( ['txt'=>__('KillSwitch Funktion' , 'k8lang_domain')] );
	foreach ($pid_arr as $item) {
		echo $this->td .
					((has_term( 'killswitch', 'sonderfunktionen', $item['pid'] ) ) ? $this->true_icon : $this->false_icon) .
				 $this->_td;
	}
	echo $this->_tr .


	$this->tr . K8Html::tdHead( ['txt'=>__('Sprache der Anwendungen' , 'k8lang_domain')] );
	foreach ($pid_arr as $item) {
		$sprache = get_the_terms( $item['pid'], 'sprache' );
		echo $this->td;
			if ( is_array( $sprache ) && count( $sprache ) > 0 )
				echo K8H::getAcfChbx(['data'=>$sprache, 'label'=>'name' ]);
		echo $this->_td;
	}
	echo $this->_tr;

echo K8Html::tbl_end();