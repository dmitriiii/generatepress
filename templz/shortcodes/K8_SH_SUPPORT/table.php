<?php
if( !is_array( $pid_arr ) || count( $pid_arr ) == 0 ){
	echo __('Sorry nothing found. Please check shortcode attributes!' , 'k8lang_domain');
	return;
}
$span = count( $pid_arr ) + 1;

echo K8Html::tbl_start(['add_clss' => strtolower( $tag )]) .

	$this->tr . K8Html::tdHead( [
		'format' => "<th colspan='".$span."'><span>%s</span></th>",
		'txt' => __('Kundenservice' , 'k8lang_domain')
	] ) . $this->_tr;

	#Show names of vpn Services if it is compare tables
	if( count( $pid_arr ) > 1 ):
		echo $this->tr . $this->td . __('VPN-Dienstname' , 'k8lang_domain') . $this->_td;
		foreach ( $pid_arr as $item ) {
			echo $this->td . $this->mark1 . get_post_meta( $item['pid'], 'cwp_rev_product_name', true ) . $this->_mark1 . $this->_td;
		}
		echo $this->_tr;
	endif;

	echo $this->tr . K8Html::tdHead( ['txt'=>__('Sprache der Anwendungen' , 'k8lang_domain')] );
	foreach ($pid_arr as $item) {
		$sprache = get_the_terms( $item['pid'], 'sprache' );
		echo $this->td;
			if ( is_array( $sprache ) && count( $sprache ) > 0 )
				echo K8H::getAcfChbx(['data'=>$sprache, 'label'=>'name' ]);
		echo $this->_td;
	}
	echo $this->_tr.

	$this->tr . K8Html::tdHead( ['txt'=>__('Kundenservice' , 'k8lang_domain')] );
	foreach ($pid_arr as $item) {
		$kundenservice = get_the_terms( $item['pid'], 'kundenservice' );
		echo $this->td;
			if ( is_array( $kundenservice ) && count( $kundenservice ) > 0 )
				echo K8H::getAcfChbx(['data'=>$kundenservice, 'label'=>'name' ]);
		echo $this->_td;
	}
	echo $this->_tr .

	$this->tr . K8Html::tdHead( ['txt'=>__('Sprache im Kundenservice' , 'k8lang_domain')] );
	foreach ($pid_arr as $item) {
		$k8_acf_lang_kund = get_field('k8_acf_lang_kund',$item['pid']);
		echo $this->td;
			if ( is_array( $k8_acf_lang_kund ) && count( $k8_acf_lang_kund ) > 0 )
				echo	K8H::getAcfChbx(['data'=>$k8_acf_lang_kund ]);
		echo $this->_td;
	}
	echo $this->_tr;

echo K8Html::tbl_end();