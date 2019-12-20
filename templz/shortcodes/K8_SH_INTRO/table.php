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
		echo $this->td . $this->mark1 . get_post_meta( $item['pid'], 'cwp_rev_product_name', true ) . $this->_mark1 . $this->_td;
	}
	echo $this->_tr;
else:
	echo $this->tr .
		K8Html::tdHead( ['txt'=>__('Produktbezeichnung' , 'k8lang_domain')] );
		foreach ($pid_arr as $item) {
			echo $this->td .
						get_post_meta( $item['pid'], 'cwp_rev_product_name', true ) .
					 $this->_td;
		}
	echo $this->_tr;
endif;

echo $this->tr .
	K8Html::tdHead( ['txt'=>__('Empfohlene Einsatzgebiete' , 'k8lang_domain')] );
	foreach ($pid_arr as $item) {
		$anwendungen = get_the_terms( $item['pid'], 'anwendungen' );
		echo $this->td;
			if ( is_array( $anwendungen ) && count( $anwendungen ) > 0 )
				echo K8H::getAcfChbx(['data'=>$anwendungen, 'label'=>'name' ]);
		echo $this->_td;
	}
echo $this->_tr .
K8Html::tbl_end();