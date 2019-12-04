<?php
echo K8Html::tbl_start(['add_clss' => strtolower( $tag )]) .

	$this->tr . K8Html::tdHead( [
		'format' => "<th colspan='2'><span>%s</span></th>",
		'txt' => __('Kundenservice' , 'k8lang_domain')
	] ) . $this->_tr;

	if ( is_array( $sprache ) && count( $sprache ) > 0 ) :
		echo $this->tr .
			K8Html::tdHead( ['txt'=>__('Sprache der Anwendungen' , 'k8lang_domain')] ).
			$this->td .
				K8H::getAcfChbx(['data'=>$sprache, 'label'=>'name' ]) .
		 	$this->_td .
		 $this->_tr;
	endif;

	if ( is_array( $kundenservice ) && count( $kundenservice ) > 0 ) :
		echo $this->tr .
			K8Html::tdHead( ['txt'=>__('Kundenservice' , 'k8lang_domain')] ).
			$this->td .
				K8H::getAcfChbx(['data'=>$kundenservice, 'label'=>'name' ]) .
		 	$this->_td .
		 $this->_tr;
	endif;

	if ( is_array( $k8_acf_lang_kund ) && count( $k8_acf_lang_kund ) > 0 ) :
		echo $this->tr .
			K8Html::tdHead( ['txt'=>__('Sprache im Kundenservice' , 'k8lang_domain')] ).
			$this->td .
				K8H::getAcfChbx(['data'=>$k8_acf_lang_kund ]) .
		 	$this->_td .
		 $this->_tr;
	endif;

echo K8Html::tbl_end();