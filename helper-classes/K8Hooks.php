<?php /**
 * USEFUL CUSTOM HOOKS
 */
class K8Hooks
{
	function __construct()
	{
		add_action('init', array( $this,'reg_sess' ));

		add_filter( 'upload_mimes', array( $this, 'upload_mimes' ) );

		#Async load for google captcha
		// add_filter('clean_url', array( $this, 'enqueue_async' ), 11, 1);
	}



	public function upload_mimes( $mimes ){
		$mimes['exe'] = 'application/octet-stream';
		$mimes['pkg'] = 'application/x-newton-compatible-pkg';
		$mimes['dmg'] = 'application/x-apple-diskimage';
		$mimes['apk'] = 'application/vnd.android.package-archive';
		
		return $mimes;
	}

	#Allow WP work with sessions
	public function reg_sess(){
    if( !session_id() )
        session_start();
	}

	#Async load for google captcha
	// public function enqueue_async( $url ){
	// 	if ( strpos($url, '#asyncload')===false )
 //    { // not our file
 //        return $url;
 //    }
 //    else{
 //    	$url = str_replace('#asyncload', '', $url);
 //    	// Must be a ', not "!
 //    	return "$url' defer='defer' async='async";
 //    }
    
	// }
}
new K8Hooks();