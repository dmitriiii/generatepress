<?php
echo K8Html::tbl_start(['add_clss' => strtolower( $tag )]);

	if ( is_array( $vpnprotokolle ) && count( $vpnprotokolle ) > 0 ) :
		echo $this->tr .
			K8Html::tdHead( ['txt'=>__('Verfügbare Protokolle' , 'k8lang_domain')] ).
			$this->td .
				K8H::getAcfChbx(['data'=>$vpnprotokolle, 'label'=>'name' ]) .
		 	$this->_td .
		 $this->_tr;
	endif;

	if ( is_array( $betriebssystem ) && count( $betriebssystem ) > 0 ) :
		echo $this->tr .
			K8Html::tdHead( ['txt'=>__('Eigene Anwendungen/Apps' , 'k8lang_domain')] ).
			$this->td .
				K8H::getAcfChbx(['data'=>$betriebssystem, 'label'=>'name' ]) .
		 	$this->_td .
		 $this->_tr;
	endif;

	echo	$this->tr . K8Html::tdHead( ['txt'=>__('KillSwitch Funktion' , 'k8lang_domain')] ) .
		$this->td . ( ( has_term( 'killswitch', 'sonderfunktionen', $pid ) ) ? $this->true_icon : $this->false_icon ) . $this->_td .
	$this->_tr;

	if ( is_array( $sprache ) && count( $sprache ) > 0 ) :
		echo $this->tr .
			K8Html::tdHead( ['txt'=>__('Sprache der Anwendungen' , 'k8lang_domain')] ).
			$this->td .
				K8H::getAcfChbx(['data'=>$sprache, 'label'=>'name' ]) .
		 	$this->_td .
		 $this->_tr;
	endif;

echo K8Html::tbl_end();