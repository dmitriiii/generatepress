<?php /**
 * Redirect
 */
class M5Redirect
{
	public $slug;
	public $term_id;
	function __construct( $args=[] ){
		$this->slug = $args['slug'];
		$this->term_id = $args['term_id'];
		add_filter('post_link', array($this,'permalink_post'), 10, 3 );
		add_filter('term_link', array($this,'permalink_archive'), 10, 3 );
		add_action('generate_rewrite_rules', array($this,'rewrite_rules'));
		add_action('template_redirect', array($this,'redirect_post'));
	}

	## Modify the individual case study post permalinks
	public function permalink_post( $permalink, $post, $leavename ){
		# Get the categories for the post
		$category = get_the_category($post->ID);
		if ( 'publish' === get_post_status($post->ID) && !empty($category) && $category[0]->slug == $this->slug ) {
			$permalink = trailingslashit( home_url('/'.$this->slug.'/'. $post->post_name . '/' ) );
		}
		return $permalink;
	}

	## Modify the $this->slug category archive permalink
	public function permalink_archive( $permalink, $term, $taxonomy ){
		# Get the category ID
		$category_id = $term->term_id;
		# Check for desired category
		if( !empty( $category_id ) && $category_id == $this->term_id ) {
			$permalink = trailingslashit( home_url('/'.$this->slug.'/' ) );
		}
		return $permalink;
	}

	## Add rewrite rules so that WordPress delivers the correct content
	public function rewrite_rules( $wp_rewrite ) {
		# This rule will will match the post name in /case-study/%postname%/ struture
		$new_rules['^'.$this->slug.'/([^/]+)/?$'] = 'index.php?name=$matches[1]';
		$new_rules['^'.$this->slug.'/?$'] = 'index.php?cat='.$this->term_id;
		$wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
		return $wp_rewrite;
	}

	#redirects
	public function redirect_post() {
		global $wp;
		$pid = get_the_ID();
		$curr_url = home_url( $wp->request );
		#check if it is post page and is published
		if( is_single() && get_post_type( $pid ) === 'post' && 'publish' === get_post_status( $pid ) ):
			$cat = get_the_category($pid);
			$pl =	get_permalink( $pid );
			// write_log( get_defined_vars() );
			#check if post under certain category
			if( !empty($cat) && $cat[0]->slug === $this->slug ):
				#if in url no category slug
				if( !strpos( $curr_url, $this->slug ) )
					exit( wp_redirect( $pl ) );
			endif;
		endif;
	}
}