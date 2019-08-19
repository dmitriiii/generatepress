<?php /**
 * USEFUL CUSTOM HOOKS
 */
class K8Hooks
{
	function __construct()
	{
		add_action('init', array( $this,'reg_sess' ));

		add_filter( 'upload_mimes', array( $this, 'upload_mimes' ) );
	}

	public function upload_mimes( $mimes ){
		$mimes['exe'] = 'application/octet-stream';
		$mimes['pkg'] = 'application/x-newton-compatible-pkg';
		return $mimes;
	}

	#Allow WP work with sessions
	public function reg_sess(){
    if( !session_id() )
        session_start();
	}

}
new K8Hooks();