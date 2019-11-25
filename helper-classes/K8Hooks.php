<?php
class K8Hooks
{
	function __construct()
	{
		// add_action('init', array( $this,'reg_sess' ));
		add_filter( 'upload_mimes', array( $this, 'upload_mimes' ) );
		# Add column with custom field vpn_id to Posts Admin Column
		add_filter('manage_post_posts_columns', array( $this,'add_admin_column' ));
		add_action('manage_post_posts_custom_column', array( $this,'add_admin_column_show' ), 10, 2);
		#Multiple Languages
		add_action('after_setup_theme', array($this,'setup_theme'));
		#Remove ACF for others
		add_action( 'admin_menu', array( $this, 'acf_rmv' ), 100 );
	}
	public function upload_mimes( $mimes ){
		$mimes['exe'] = 'application/octet-stream';
		$mimes['pkg'] = 'application/x-newton-compatible-pkg';
		$mimes['dmg'] = 'application/x-apple-diskimage';
		$mimes['apk'] = 'application/vnd.android.package-archive';
		$mimes['msi'] = 'application/x-msi';
		$mimes['deb'] = 'application/x-debian-package';
		$mimes['rpm'] = 'audio/x-pn-realaudio-plugin';
		return $mimes;
	}
	#Allow WP work with sessions
	// public function reg_sess(){
 //    if( !session_id() ){
 //      session_start();
 //    }
	// }
	public function add_admin_column($column) {
		$column['k8_acf_vpnid'] = '<span style="color: red; font-weight: bold;">VPN ID *</span>';
		return $column;
	}
	public function add_admin_column_show($column_name) {
		if ($column_name == 'k8_acf_vpnid') {
			echo get_field('k8_acf_vpnid');
		}
	}
	#Multiple Languages
	public function setup_theme(){
		load_theme_textdomain('k8lang_domain', get_template_directory() . '/languages');
	}

	public function acf_rmv(){
		$current_user = wp_get_current_user();
		if ($current_user->user_email != 'dk@geroy.ooo'){
	    remove_menu_page( 'edit.php?post_type=acf-field-group' );
	  }
	}
}
new K8Hooks();