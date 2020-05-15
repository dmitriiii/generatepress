<?php
class M5Country
{
	protected $code_type = 'cca2';
	protected $file_json;
	protected $translation = 'deu';
	protected $country_code = 'DE';


	function __construct($args=[])
	{
		$this->file_json = K8_PATH_GLOB . '/json/countries/countries.json';
	}

	protected function loadData(){
		$countries = file_get_contents( $this->file_json );
		return json_decode($countries, true);
	}

	/**
	 * @param array $args [
	 *  'code_type' - string (cca2 || cca3)
	 *  'translation' - string (deu, rus, etc.)
	 *  'country_code' - string ( DE,RU etc.)
	 * ]
	 */
	public function getCountry( $args=[] ){
		$json_a = $this->loadData();
		$matched = [];
		if(isset($args['code_type']))
			$this->code_type = $args['code_type'];

		if(isset($args['translation']))
			$this->translation = $args['translation'];

		if(isset($args['country_code']))
			$this->country_code = $args['country_code'];

		foreach ($json_a as $country) :
			if($country[$this->code_type] == $this->country_code)
				$matched = $country;
		endforeach;
		return $matched;
	}

	/**
	 * @param array $args [
	 *  'code_type' - string (cca2 || cca3)
	 *  'translation' - string (deu, rus, etc.)
	 *  'country_code' - string ( DE,RU etc.)
	 *  'tax' - string (name of custom taxonomy)
	 * ]
	 */
	public function createTax( $args=[] ){
		$json_a = $this->loadData();
		$tax = 'vpnstandortelaender';
		$res = array();
		if(isset($args['tax']))
			$tax = $args['tax'];

		if(isset($args['code_type']))
			$this->code_type = $args['code_type'];

		if(isset($args['translation']))
			$this->translation = $args['translation'];

		if(isset($args['country_code']))
			$this->country_code = $args['country_code'];

		foreach ( $json_a as $country ):
			#skip if term already exist
			if( term_exists( $country[$this->code_type], $tax ) ){
				continue;
			}
			$res[] =	wp_insert_term(
				$country['translations'][$this->translation]['common'],
				$tax,
				array(
					'slug' => $country[$this->code_type]
				)
			);
		endforeach;
		return $res;
		// echo '<pre>';
		// print_r($json_a);
		// echo '</pre>';
	}
}