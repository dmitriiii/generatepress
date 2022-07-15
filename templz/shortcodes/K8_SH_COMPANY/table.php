<?php #[K8_SH_COMPANY]
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
			if ($this->poly):
				$translPid = $this->getPostTranslations($item['pid']);
				if(isset($translPid[$this->polySlug]))
					echo $this->td . $this->mark1 . $this->setUrl( $translPid[$this->polySlug] ) . get_post_meta( $item['pid'], 'cwp_rev_product_name', true ) . $this->_mark1 . $this->_td;
				else
					echo $this->td . 'Please check if vpnid has translation!' . $this->_td;
			else:
				echo $this->td . $this->mark1 . $this->setUrl($item['pid']) . get_post_meta( $item['pid'], 'cwp_rev_product_name', true ) . $this->_mark1 . $this->_td;
			endif;
		}
		echo $this->_tr;
	endif;

	echo $this->tr . K8Html::tdHead( ['txt'=>__('Betriebsstandort' , 'k8lang_domain')] );
	foreach ($pid_arr as $item) {
		$unternehmen = get_the_terms( $item['pid'], 'unternehmen' );
		echo $this->td;
			if( is_array($unternehmen) && count( $unternehmen ) > 0 ) :
				$compare1[] = array_column( $unternehmen, 'slug' );

				if($this->poly){
					$ii=0;
					foreach ($unternehmen as $objj) {
						$unternehmen[$ii]->name = get_field($this->polyLocale,'unternehmen_'.$objj->term_id);
						$ii++;
					}
				}
				echo K8H::getAcfChbx(['data'=>$unternehmen, 'label'=>'name']);
			endif;
		echo $this->_td;
	}
	echo $this->_tr .

	$this->tr . K8Html::tdHead( ['txt'=>__('Verrechnungsstandort' , 'k8lang_domain')] );
	foreach ($pid_arr as $item) {
		$k8_acf_verrechnung = get_field('k8_acf_verrechnung', $item['pid']);
		echo $this->td;
					if( is_array($k8_acf_verrechnung) && count( $k8_acf_verrechnung ) > 0 ) :
						$compare2[] = array_column( $k8_acf_verrechnung, 'value' );
						echo K8H::getAcfChbx(['data'=>$k8_acf_verrechnung]);
					endif;
		echo $this->_td;
	}
	echo $this->_tr .

	$this->tr . K8Html::tdHead( ['txt'=>__('Lokale Gesetzgebung hat Einfluss auf Schutz der Kunden' , 'k8lang_domain')] );
	foreach ($pid_arr as $item) {
		echo $this->td .
					( ( get_field('k8_acf_local',$item['pid']) ) ? $this->true_icon : $this->false_icon ) .
				 $this->_td;
	}
	echo $this->_tr;

	if( (isset( $compare1 ) && is_array( $compare1 )) && (isset( $compare2 ) && is_array( $compare2 )) ) :
		echo $this->tr . K8Html::tdHead( ['txt'=>__('Betrieb und Verrechnung getrennt' , 'k8lang_domain')] );
			foreach ( $compare1 as $k => $v ) :
				echo $this->td .
					 		(( $v == $compare2[$k] ) ? $this->false_icon : $this->true_icon ) .
					 	 $this->_td ;
			endforeach;
		echo $this->_tr;
	endif;

	echo $this->tr . K8Html::tdHead( ['txt'=>__('Server-Standorte' , 'k8lang_domain')] );
	foreach ($pid_arr as $item) {
		$vpnstandortelaender = get_the_terms( $item['pid'], 'vpnstandortelaender' );
		echo $this->td .
					$this->b . (( is_array( $vpnstandortelaender ) && count( $vpnstandortelaender ) > 0 ) ? count( $vpnstandortelaender ) : 0 )  . $this->_b .
				 $this->_td;
	}
	echo $this->_tr .

	$this->tr . K8Html::tdHead( ['txt'=>__('Keine Logfiles' , 'k8lang_domain')] );
	foreach ($pid_arr as $item) {
		echo (( has_term( 'keine-logfiles', 'sonderfunktionen', $item['pid'] ) ) ?
			$this->td . $this->true_icon :
			$this->td . $this->false_icon ) . $this->_td;
	}
	echo $this->_tr .

	$this->tr . K8Html::tdHead( ['txt'=>__('Eigene DNS Server' , 'k8lang_domain')] );
	foreach ($pid_arr as $item) {
		echo $this->td .
					((has_term( 'eigene-dns', 'sonderfunktionen', $item['pid'] ) ) ? $this->true_icon : $this->false_icon) .
				 $this->_td;
	}
	echo $this->_tr .

	$this->tr . K8Html::tdHead( ['txt'=>__('Virtuelle Server' , 'k8lang_domain')] );
	foreach ($pid_arr as $item) {

		echo ((has_term( 'virtuelle-server', 'sonderfunktionen', $item['pid'] ) ) ? $this->td(['class'=>'k8-blu']) . $this->true_icon : $this->td(['class'=>'k8-grn']) . $this->false_icon) .
				 $this->_td;
	}
	echo $this->_tr .

	$this->tr . K8Html::tdHead( ['txt'=>__('Dedzitierte Server' , 'k8lang_domain')] );
	foreach ($pid_arr as $item) {
		echo $this->td .
					((has_term( 'dedicated-server', 'sonderfunktionen', $item['pid'] ) ) ? $this->true_icon : $this->false_icon) .
				 $this->_td;
	}
	echo $this->_tr .

	$this->tr . K8Html::tdHead( ['txt'=>__('RAM-Disk Server' , 'k8lang_domain')] );
	foreach ($pid_arr as $item) {
		echo $this->td .
					((has_term( 'ram-disk-k-hdd', 'sonderfunktionen', $item['pid'] ) ) ? $this->true_icon : $this->false_icon) .
				 $this->_td;
	}
	echo $this->_tr .

	$this->tr . K8Html::tdHead( ['txt'=>__('Eigentümer der Hardware' , 'k8lang_domain')] );
	foreach ($pid_arr as $item) {
		echo $this->td .
					((has_term( 'own-hardware', 'sonderfunktionen', $item['pid'] ) ) ? $this->true_icon : $this->false_icon) .
				 $this->_td;
	}
	echo $this->_tr .

	$this->tr . K8Html::tdHead( ['txt'=>__('Eigentümer der IP-Adressen' , 'k8lang_domain')] );
	foreach ($pid_arr as $item) {
		echo $this->td .
					((has_term( 'own-ip-adresses', 'sonderfunktionen', $item['pid'] ) ) ? $this->true_icon : $this->false_icon) .
				 $this->_td;
	}
	echo $this->_tr .

K8Html::tbl_end();