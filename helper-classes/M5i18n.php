<?php

class M5i18n
{
	public $radios;

	public $checkboxes;

	function __construct(){
		$this->radios = ['k8_acf_vpndet_meas','k8_acf_vpndet_conn'];
		$this->checkboxes = ['k8_acf_vpndet_trialz','k8_acf_verrechnung','k8_acf_lang_kund'];

		/*
			Fix translation labels of acf fields to make them
			translatable via loco translate
		*/
		add_filter('acf/format_value', [$this,'force_acf_translate'], 10, 3);
	}



	public function force_acf_translate($value, $post_id, $field){

		#for radio buttons
		if( in_array( $field['name'], $this->radios ) ){
			$value['label'] = __($value['label'] , 'k8lang_domain');
		}

		#For checkboxes
		if( in_array($field['name'], $this->checkboxes) ){
			if( is_array($value) && count($value)>0 ){
				for ($i=0; $i < count($value) ; $i++) {
					$value[$i]['label'] = __($value[$i]['label'] , 'k8lang_domain');
				}
			}
		}
	  return $value;
	}
}

new M5i18n();