<?php
class K8Hooks
{
	function __construct()
	{
		add_action('init', array( $this,'reg_sess' ));
		add_filter( 'upload_mimes', array( $this, 'upload_mimes' ) );

		# Add column with custom field vpn_id to Posts Admin Column
		add_filter('manage_posts_columns', array( $this,'add_admin_column' ));
		add_action('manage_posts_custom_column', array( $this,'add_admin_column_show' ), 10, 2);
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
    if( !session_id() ){
      session_start();
    }
	}

	public function add_admin_column($column) {
	  $column['k8vpn_id'] = '<span style="color: red; font-weight: bold;">VPN ID *</span>';
	  return $column;
	}
	public function add_admin_column_show($column_name) {
	  if ($column_name == 'k8vpn_id') {
	    echo get_field('vpn_id');
	  }
	}

}
new K8Hooks();