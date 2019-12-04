<?php
echo K8Html::tbl_start(['add_clss' => strtolower( $tag )]) .

	$this->tr . K8Html::tdHead( [
		'format' => "<th colspan='2'><span>%s</span></th>",
		'txt' => __('Anonym im Internet' , 'k8lang_domain')
	] ) . $this->_tr;

	echo	$this->tr . K8Html::tdHead( ['txt'=>__('Veränderte virtueller Standort' , 'k8lang_domain')] ) .
		$this->td . ( ( has_term( 'lokale-sperren-umgehen', 'anwendungen', $pid ) ) ? $this->true_icon : $this->false_icon ) . $this->_td .
	$this->_tr .

	$this->tr . K8Html::tdHead( ['txt'=>__('Schutz vor Auskunftsersuchen' , 'k8lang_domain')] ) .
		$this->td . ( ( has_term( 'abmahnungen-vermeiden', 'anwendungen', $pid ) ) ? $this->true_icon : $this->false_icon ) . $this->_td .
	$this->_tr .

	$this->tr . K8Html::tdHead( ['txt'=>__('Allg. Überwachung verhindern' , 'k8lang_domain')] ) .
		$this->td . ( ( get_field( 'k8_acf_prev_monit', $pid ) ) ? $this->true_icon : $this->false_icon ) . $this->_td .
	$this->_tr .

	$this->tr . K8Html::tdHead( ['txt'=>__('Gezielte Überwachung verhindern' , 'k8lang_domain')] ) .
		$this->td . ( ( get_field( 'k8_acf_prev_monit2', $pid ) ) ? $this->true_icon : $this->false_icon ) . $this->_td .
	$this->_tr .

	$this->tr . K8Html::tdHead( ['txt'=>__('Logfiles' , 'k8lang_domain')] ) .
		$this->td . ( ( has_term( 'keine-logfiles', 'sonderfunktionen', $pid ) ) ? $this->true_icon : $this->false_icon ) . $this->_td .
	$this->_tr .

	$this->tr . K8Html::tdHead( ['txt'=>__('Obfusication (Maskierung)' , 'k8lang_domain')] ) .
		$this->td . ( ( has_term( 'obfsproxy', 'sonderfunktionen', $pid ) ) ? $this->true_icon : $this->false_icon ) . $this->_td .
	$this->_tr;

echo K8Html::tbl_end();