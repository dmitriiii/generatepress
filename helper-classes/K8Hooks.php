<?php
class K8Hooks
{
	function __construct()
	{
		// add_action('init', array( $this,'reg_sess' ));
		add_filter( 'upload_mimes', array( $this, 'upload_mimes' ) );
		# Add column with custom field vpn_id and m5_rou_id to Posts Admin Column
		add_filter('manage_post_posts_columns', array( $this,'add_admin_column' ));
		add_action('manage_post_posts_custom_column', array( $this,'add_admin_column_show' ), 10, 2);

		#SCHEMA markup for Menus
		add_action('wp_footer', array($this,'menus_schema'));

		#Multiple Languages
		add_action('after_setup_theme', array($this,'setup_theme'));
		#Remove ACF for others
		add_action( 'admin_menu', array( $this, 'acf_rmv' ), 100 );

		#Create json array of anbieter vpnid=>postid vallues
		add_action( 'save_post', array( $this, 'onSavePost' ), 10, 3 );

		#Create json array of rouid=>postid vallues
		add_action( 'save_post', array( $this, 'rouid' ), 10, 3 );

		#Add how to shortcode to admin
		add_filter( 'manage_k8pt_howto_posts_columns', array( $this, 'k8pt_howto_cols' ) );
		add_action( 'manage_k8pt_howto_posts_custom_column' , array( $this, 'k8pt_howto_col' ), 10, 2 );

		#301 redirect on coupons single pages
		if( get_site_url() == 'https://vpntester.net' ){
			add_action( 'template_redirect', array( $this, 'redirect_to_home_page' ) );
		}


	}
	public function upload_mimes( $mimes ){
		$mimes['exe'] = 'application/octet-stream';
		$mimes['pkg'] = 'application/x-newton-compatible-pkg';
		$mimes['dmg'] = 'application/x-apple-diskimage';
		$mimes['apk'] = 'application/vnd.android.package-archive';
		$mimes['msi'] = 'application/x-msi';
		$mimes['deb'] = 'application/x-debian-package';
		$mimes['rpm'] = 'audio/x-pn-realaudio-plugin';
		$mimes['rar'] = 'application/x-rar-compressed';
		return $mimes;
	}
	#Allow WP work with sessions
	// public function reg_sess(){
 //    if( !session_id() ){
 //      session_start();
 //    }
	// }
	public function add_admin_column($column) {
		$column['k8_acf_vpnid'] = '<span style="color: red; font-weight: bold;">VPN ID</span>';
		$column['m5_rou_id'] = '<span style="color: red; font-weight: bold;">Router ID</span>';
		return $column;
	}
	public function add_admin_column_show($column_name) {
		if ($column_name == 'k8_acf_vpnid') {
			echo get_field('k8_acf_vpnid');
		}
		if ($column_name == 'm5_rou_id') {
			echo get_field('m5_rou_id');
		}
	}

	#SCHEMA markup for Menus
	public function menus_schema(){
		$menu_locations =	wp_get_nav_menus();
		// echo '<pre>';
		// print_r($m5_nav_m);
		// echo '</pre>';
		
		foreach ($menu_locations as $menu_location) :
			$menus = wp_get_nav_menu_items($menu_location->term_id);
			foreach ($menus as $link) {
				echo '<script type="application/ld+json">';
				echo K8Schema::getSiteNavEl(['link'=>$link]);
				echo '</script>';

			}
			// echo '<pre>';
			// print_r($m5_nav);
			// echo '</pre>';
			// echo K8Schema::getSiteNavEl(['menu'=>$menu]);
		endforeach;
		
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

	#Create json array of anbieter vpnid=>postid vallues
	public function onSavePost( $post_ID, $post, $update ) {
    if ( wp_is_post_revision( $post_ID ) )
    	return;
    if ( 'post' !== $post->post_type )
      return;
    if( !in_category( array( 'anbieter', 'vpn-anbieter' ), $post_ID ) )
      return;
    // write_log('anbieter Zone!');
    $args = array(
			'post_type'   => 'post',
			'post_status' => 'any',
			'category_name' => 'anbieter,vpn-anbieter',
			'posts_per_page' => -1,
		);
		$querr = new WP_Query( $args );
	 	if ( $querr->have_posts() ) :
			$vpnidPid_arr = array();
			while ( $querr->have_posts() ) : $querr->the_post();
				$pid = get_the_ID();
				$k8_acf_vpnid = get_field( 'k8_acf_vpnid', $pid );
				if( $k8_acf_vpnid )
					$vpnidPid_arr[] = array( 'vpnid' => $k8_acf_vpnid, 'pid' => $pid );
			endwhile;
			wp_reset_postdata();
		endif;
		$fp = fopen( K8_PATH_LOC . '/vpnidPid.json' , 'w');
		fwrite($fp, json_encode($vpnidPid_arr));
		fclose($fp);
	}

	#Create json array of rouid=>postid vallues
	public function rouid( $post_ID, $post, $update ) {
    if ( wp_is_post_revision( $post_ID ) )
    	return;
    if ( 'post' !== $post->post_type )
      return;
    if( !in_category( array( 'router' ), $post_ID ) )
      return;
    $args = array(
			'post_type'   => 'post',
			'post_status' => 'any',
			'category_name' => 'router',
			'posts_per_page' => -1,
		);
		$querr = new WP_Query( $args );
	 	if ( $querr->have_posts() ) :
			$rouidPid_arr = array();
			while ( $querr->have_posts() ) : $querr->the_post();
				$pid = get_the_ID();
				$m5_rou_id = get_field( 'm5_rou_id', $pid );
				if( $m5_rou_id )
					$rouidPid_arr[] = array( 'rouid' => $m5_rou_id, 'pid' => $pid );
			endwhile;
			wp_reset_postdata();
		endif;
		$fp = fopen( K8_PATH_LOC . '/rouidPid.json' , 'w');
		fwrite($fp, json_encode($rouidPid_arr));
		fclose($fp);
	}

	#Add how to shortcode to admin
	public function k8pt_howto_cols($columns){
		$columns['howto_shrt'] = __( 'Shortcode', 'k8lang_domain' );
		return $columns;
	}
	public function k8pt_howto_col($column, $post_id){
		if( $column == 'howto_shrt' ){
			echo "<code>[K8_SH_HOWTO id='$post_id']</code>";
		}
	}

	#301 redirect on coupons single pages
	public function redirect_to_home_page() {
	  if ( is_single() && 'affcoups_coupon' == get_post_type() ) {
	   wp_redirect( home_url(), 301 );
	    exit;
	  }
	}

}
new K8Hooks();