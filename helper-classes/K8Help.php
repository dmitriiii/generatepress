<?php
	class K8Help
	{
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

	}?>