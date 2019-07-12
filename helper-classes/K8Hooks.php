<?php /**
 * USEFUL CUSTOM HOOKS
 */
class K8Hooks
{
	function __construct()
	{
		add_action('init', array( $this,'reg_sess' ));
	}

	#Allow WP work with sessions
	public function reg_sess(){
    if( !session_id() )
        session_start();
	}

}
new K8Hooks();