<?php
if( !is_array( $pid_arr ) || count( $pid_arr ) == 0 ){
	echo __('Sorry nothing found. Please check shortcode attributes!' , 'k8lang_domain');
	return;
}
$srvcs = [
	array('name'=>'net'),
	array('name'=>'amaz'),
	array('name'=>'sky'),
	array('name'=>'dazn'),
	array('name'=>'max'),
	array('name'=>'euro'),
	array('name'=>'zat')
];
$i = 0;
foreach ($srvcs as $it) {
	$srvcs[$i]['icon'] = file_get_contents( get_template_directory() . '/k8/assets/svg/' . $it['name'] . '.svg' );
	$i++;
}
echo K8Html::tbl_start(['add_clss' => strtolower( $tag )]);
foreach ( $pid_arr as $item ) :
	echo $this->tr .
				$this->td . get_post_meta( $item['pid'], 'cwp_rev_product_name', true ) . $this->_td;
	foreach ( $srvcs as $srvc ) {
		$k8_acf_vpndet_vid = get_field( 'k8_acf_vpndet_vid', $item['pid'] );
		$valz = array_column($k8_acf_vpndet_vid, 'value');

		echo ( (in_array($srvc['name'], $valz)) ? $this->td(['class'=>'act']) : $this->td() ) .
			$srvc['icon'] . $this->_td;
	}
	echo $this->_tr;
endforeach;
echo K8Html::tbl_end();
 ?>