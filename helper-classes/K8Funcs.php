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

		if ( ! function_exists('write_log')) :
		 function write_log ( $log )  {
			if ( is_array( $log ) || is_object( $log ) ) {
				 error_log( print_r( $log, true ) );
			} else {
				 error_log( $log );
			}
		 }
		endif;

		if ( ! function_exists('rrmdir')) :
			function rrmdir($dir) {
				if (is_dir($dir)) {
					$objects = scandir($dir);
					foreach ($objects as $object) {
						if ($object != "." && $object != "..") {
							if (filetype($dir."/".$object) == "dir")
								 rrmdir($dir."/".$object);
							else unlink   ($dir."/".$object);
						}
					}
					reset($objects);
					rmdir($dir);
				}
			 }
		endif;
		#check if AMP
		// if ( ! function_exists('is_amp')) {
		// 	function is_amp(){
		// 		$ampp = false;
		// 		if(strpos($_SERVER['REQUEST_URI'], '/amp/'))
		// 			$ampp = true;
		// 		return $ampp;
		// 	}
		// }

	}
}

new K8Funcs();