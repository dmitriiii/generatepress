<?php
/**
 * Additional Functions
 */
class K8Funcs
{
	function __construct()
	{
		$this->loadFuncs();
	}
	public function loadFuncs(){
		if ( ! function_exists('write_log')) {
		 function write_log ( $log )  {
			if ( is_array( $log ) || is_object( $log ) ) {
				 error_log( print_r( $log, true ) );
			} else {
				 error_log( $log );
			}
		 }
		}
	}
}
new K8Funcs();