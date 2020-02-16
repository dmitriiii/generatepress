<?php
class K8Amp
{
	function __construct(){
		#Remove scripts for AMP
		// add_action('wp_print_scripts', array( $this,'rem_scripts' ), 99999999);
		#Remove styles for AMP
		// add_action('wp_print_styles', array( $this,'rem_styles' ), 99999999);

		// write_log(self::getStyleScript());
		// write_log('Сидоры');

	}

	public function rem_scripts(){
		global $wp_scripts;
    $wp_scripts->queue = array();
	}
	public function rem_styles(){
		global $wp_scripts;
    $wp_scripts->queue = array();
	}


	public static function getStyleScript(){
		$result = [];
		$result['scripts'] = [];
		$result['styles'] = [];
		// Print all loaded Scripts
		global $wp_scripts;
		foreach( $wp_scripts->queue as $script ) :
			$result['scripts'][] =  $wp_scripts->registered[$script]->src . ";";
		endforeach;

		// Print all loaded Styles (CSS)
		global $wp_styles;
		foreach( $wp_styles->queue as $style ) :
			$result['styles'][] =  $wp_styles->registered[$style]->src . ";";
		endforeach;

		return $result;
	}
}

// new K8Amp();

// if( defined('AMP_QUERY_VAR') && is_single() && in_category('news') ){
	 
// }