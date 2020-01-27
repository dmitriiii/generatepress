<?php
class K8Help
{
	/**
	 * [genCommScore description]
	 * @param  array  $args [
	 *   'comm' - (obj)
	 * ]
	 * @return [type]       [description]
	 */
	static function genCommScore( $args = array() ){
		extract($args);
		$html = '';
		if( isset( $comm ) && $comm->comment_ID !== '' ):
			$comm_meta = get_comment_meta($comm->comment_ID);
			$p_meta = get_post_meta($comm->comment_post_ID, '', true);
			$search = 'meta_option';
			foreach ($comm_meta as $k => $v) {
				if( !preg_match("/{$search}/i", $k) ){
					unset($comm_meta[$k]);
				}
			}
			if( is_array($comm_meta) && count($comm_meta) > 0 ) :
				$ii = 1;
				$html .= '<div class="user-comments-grades">';
				foreach ( $comm_meta as $k => $v ):
					$html .= '<div class="comment-meta-option">
							<p class="comment-meta-option-name">' . $p_meta['option_' . $ii . '_content'][0] . '</p>
							<p class="comment-meta-option-grade">' . $v[0] . '</p>
							<div class="cwpr_clearfix"></div>
							<div class="comment-meta-grade-bar ' . self::ratingText( $v[0] * 10 ) . '">
								<div class="comment-meta-grade" style="width: ' . ( $v[0] * 10 ) . '%"></div>
							</div>
						</div>';
				$ii++;
				endforeach;
				$html .= '</div>';
			endif; # $comm_meta
		endif; # $comm
		return $html;
	}

	static function ratingText( $rat ){
		if ( $rat >= 75 ) {
			return 'wppr-very-good';
		} elseif ( $rat < 75 && $rat >= 50 ) {
			return 'wppr-good';
		} elseif ( $rat < 50 && $rat >= 25 ) {
			return 'wppr-not-bad';
		} else {
			return 'wppr-weak';
		}
	}

	static function UR_exists($url){
		$headers = get_headers($url);
		return stripos($headers[0],"200 OK")?true:false;
	}

	static function getDefUrl( $img ){
		return get_template_directory_uri() . '/dist/img/' . $img;
	}
	static function getFeatImgUrl( $post_id, $size = 'full' ){
		return wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size );
	}
	static function getImgUrl( $img_id, $size = 'full' ){
		return wp_get_attachment_image_src( $img_id, $size )[0];
	}
	static function getRandomFromArray( $arr ){
		$randomm = array_rand( $arr, 1 );
		return get_template_directory_uri() . '/dist/img/' . $arr[$randomm];
	}
	//Custom Length Excerpt
	static function excerpt($limit) {
		$excerpt = explode(' ', get_the_excerpt(), $limit);
		if (count($excerpt) >= $limit) {
				array_pop($excerpt);
				$excerpt = implode(" ", $excerpt) . '...';
		} else {
				$excerpt = implode(" ", $excerpt);
		}
		$excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);
		return $excerpt;
	}
	static function excerptPid($limit,$pid) {
		$excerpt = explode(' ', get_the_excerpt($pid), $limit);
		if (count($excerpt) >= $limit) {
				array_pop($excerpt);
				$excerpt = implode(" ", $excerpt) . '...';
		} else {
				$excerpt = implode(" ", $excerpt);
		}
		$excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);
		return $excerpt;
	}
	//Custom Length Content
	static function content($limit) {
		$content = explode(' ', get_the_content(), $limit);
		if (count($content) >= $limit) {
				array_pop($content);
				$content = implode(" ", $content) . '...';
		} else {
				$content = implode(" ", $content);
		}
		$content = preg_replace('/\[.+\]/','', $content);
		$content = apply_filters('the_content', $content);
		$content = str_replace(']]>', ']]&gt;', $content);
		return $content;
	}
	//Pagination
	static function pagination($pages = '', $range = 2){
		$showitems = ($range * 2)+1;
		global $paged;
		if(empty($paged)) $paged = 1;
		if($pages == ''){
			global $wp_query;
			$pages = $wp_query->max_num_pages;
			if(!$pages)
			{
				 $pages = 1;
			}
		}
		if(1 != $pages){
			echo "<div class='pagination'>";
			if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
			if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";
			for ($i=1; $i <= $pages; $i++)
			{
				 if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
				 {
						 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
				 }
			}
			if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";
			if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
			echo "</div>\n";
		}
	}


	#Return array of all image sizes
	static function getAllImgSizes(){
		global $_wp_additional_image_sizes;
		$default_image_sizes = get_intermediate_image_sizes();
		foreach ( $default_image_sizes as $size ) {
			$image_sizes[ $size ][ 'width' ] = intval( get_option( "{$size}_size_w" ) );
			$image_sizes[ $size ][ 'height' ] = intval( get_option( "{$size}_size_h" ) );
			$image_sizes[ $size ][ 'crop' ] = get_option( "{$size}_crop" ) ? get_option( "{$size}_crop" ) : false;
		}
		if ( isset( $_wp_additional_image_sizes ) && count( $_wp_additional_image_sizes ) ) {
			$image_sizes = array_merge( $image_sizes, $_wp_additional_image_sizes );
		}
		return $image_sizes;
	}
}