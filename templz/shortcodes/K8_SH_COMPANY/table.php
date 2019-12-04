<?php
echo K8Html::tbl_start(['add_clss' => strtolower( $tag )]);

	if ( is_array( $unternehmen ) && count( $unternehmen ) > 0 ) :
		$compare1 = array_column( $unternehmen, 'slug' );
		echo $this->tr .
			K8Html::tdHead( ['txt'=>__('Betriebsstandort' , 'k8lang_domain')] ).
			$this->td .
				K8H::getAcfChbx(['data'=>$unternehmen, 'label'=>'name']) .
		 	$this->_td .
		 $this->_tr;
	endif;

	if ( is_array( $k8_acf_verrechnung ) && count( $k8_acf_verrechnung ) > 0 ) :
		$compare2 = array_column( $k8_acf_verrechnung, 'value' );
		echo $this->tr .
			K8Html::tdHead( ['txt'=>__('Verrechnungsstandort' , 'k8lang_domain')] ).
			$this->td .
				K8H::getAcfChbx(['data'=>$k8_acf_verrechnung]) .
		 	$this->_td .
		 $this->_tr;
	endif;

	echo	$this->tr . K8Html::tdHead( ['txt'=>__('Lokale Gesetzgebung hat Einfluss auf Schutz der Kunden' , 'k8lang_domain')] ) .
		$this->td . ( ( get_field('k8_acf_local',$pid) ) ? $this->true_icon : $this->false_icon ) . $this->_td .
	$this->_tr;


	if( (isset( $compare1 ) && is_array( $compare1 )) && (isset( $compare2 ) && is_array( $compare2 )) )
		echo	$this->tr . K8Html::tdHead( ['txt'=>__('Betrieb und Verrechnung getrennt' , 'k8lang_domain')] ) .
			$this->td . ( ( count(array_intersect($compare1, $compare2)) === 0 ) ? $this->true_icon : $this->false_icon ) . $this->_td .
		$this->_tr;

	if( is_array( $vpnstandortelaender ) && count( $vpnstandortelaender ) > 0 )
		echo	$this->tr . K8Html::tdHead( ['txt'=>__('Server-Standorte' , 'k8lang_domain')] ) .
			$this->td . $this->b . count( $vpnstandortelaender ) . $this->_b . $this->_td .
		$this->_tr;

	echo	$this->tr . K8Html::tdHead( ['txt'=>__('Logfiles' , 'k8lang_domain')] ) .
		$this->td . ( ( has_term( 'keine-logfiles', 'sonderfunktionen', $pid ) ) ? $this->true_icon : $this->false_icon ) . $this->_td .
	$this->_tr .

	$this->tr . K8Html::tdHead( ['txt'=>__('Eigene DNS Server' , 'k8lang_domain')] ) .
		$this->td . ( ( has_term( 'eigene-dns', 'sonderfunktionen', $pid ) ) ? $this->true_icon : $this->false_icon ) . $this->_td .
	$this->_tr .

	$this->tr . K8Html::tdHead( ['txt'=>__('Virtuelle Server' , 'k8lang_domain')] ) .
		$this->td . ( ( has_term( 'virtuelle-server', 'sonderfunktionen', $pid ) ) ? $this->true_icon : $this->false_icon ) . $this->_td .
	$this->_tr .

	$this->tr . K8Html::tdHead( ['txt'=>__('Dedzitierte Server' , 'k8lang_domain')] ) .
		$this->td . ( ( has_term( 'dedicated-server', 'sonderfunktionen', $pid ) ) ? $this->true_icon : $this->false_icon ) . $this->_td .
	$this->_tr .

	$this->tr . K8Html::tdHead( ['txt'=>__('RAM-Disk Server' , 'k8lang_domain')] ) .
		$this->td . ( ( has_term( 'ram-disk-k-hdd', 'sonderfunktionen', $pid ) ) ? $this->true_icon : $this->false_icon ) . $this->_td .
	$this->_tr .

	$this->tr . K8Html::tdHead( ['txt'=>__('Eigentümer der Hardware' , 'k8lang_domain')] ) .
		$this->td . ( ( has_term( 'own-hardware', 'sonderfunktionen', $pid ) ) ? $this->true_icon : $this->false_icon ) . $this->_td .
	$this->_tr .

	$this->tr . K8Html::tdHead( ['txt'=>__('Eigentümer der IP-Adressen' , 'k8lang_domain')] ) .
		$this->td . ( ( has_term( 'own-ip-adresses', 'sonderfunktionen', $pid ) ) ? $this->true_icon : $this->false_icon ) . $this->_td .
	$this->_tr;

echo K8Html::tbl_end();