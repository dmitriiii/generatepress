<?php # [K8_SH_VIDEOVPN]
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

	#polylang is installed
	if($this->poly):
		$translPid = $this->getPostTranslations($item['pid']);
		#if there is no translated article - error!
		if( !isset($translPid[$this->polySlug]) ){
			echo $this->tr . $this->td .'<strong style="color:red;">Please check if vpnid has translation!</strong>' . $this->_td . $this->_tr;
			continue;
		}

		echo $this->tr .
					$this->td .
						'<a href="' . get_permalink( $translPid[$this->polySlug] ) . '">' .
							get_post_meta( $item['pid'], 'cwp_rev_product_name', true ) .
						'</a>' .
					$this->_td;

	#without polylang
	else:
		echo $this->tr .
					$this->td .
						'<a href="' . get_permalink( $item['pid'] ) . '">' .
							get_post_meta( $item['pid'], 'cwp_rev_product_name', true ) .
						'</a>' .
					$this->_td;
	endif;

	foreach ( $srvcs as $srvc ) {
		$k8_acf_vpndet_vid = get_field( 'k8_acf_vpndet_vid', $item['pid'] );
		if( is_array( $k8_acf_vpndet_vid ) && count( $k8_acf_vpndet_vid ) > 0 ){
			$valz = array_column($k8_acf_vpndet_vid, 'value');
			echo ( (in_array($srvc['name'], $valz)) ? $this->td(['class'=>'act']) : $this->td() ) .
							$srvc['icon'] .
						$this->_td;
			continue;
		}
		echo $this->td() . $srvc['icon'] . $this->_td;
	}
	echo $this->_tr;
endforeach;
echo K8Html::tbl_end();