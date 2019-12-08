<?php
/**
 * Post meta elements.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'generate_content_nav' ) ) {
	/**
	 * Display navigation to next/previous pages when applicable.
	 *
	 * @since 0.1
	 *
	 * @param string $nav_id The id of our navigation.
	 */
	function generate_content_nav( $nav_id ) {
		if ( ! apply_filters( 'generate_show_post_navigation', true ) ) {
			return;
		}

		global $wp_query, $post;

		// Don't print empty markup on single pages if there's nowhere to navigate.
		if ( is_single() ) {
			$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
			$next = get_adjacent_post( false, '', false );

			if ( ! $next && ! $previous ) {
				return;
			}
		}

		// Don't print empty markup in archives if there's only one page.
		if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) ) {
			return;
		}

		$nav_class = ( is_single() ) ? 'post-navigation' : 'paging-navigation';
		$category_specific = apply_filters( 'generate_category_post_navigation', false );
		?>
		<nav id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo esc_attr( $nav_class ); ?>">
			<span class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'generatepress' ); ?></span>

			<?php if ( is_single() ) : // navigation links for single posts.

				previous_post_link( '<div class="nav-previous"><span class="prev" title="' . esc_attr__( 'Previous', 'generatepress' ) . '">%link</span></div>', '%title', $category_specific );
				next_post_link( '<div class="nav-next"><span class="next" title="' . esc_attr__( 'Next', 'generatepress' ) . '">%link</span></div>', '%title', $category_specific );

			elseif ( is_home() || is_archive() || is_search() ) : // navigation links for home, archive, and search pages.

				if ( get_next_posts_link() ) : ?>
					<div class="nav-previous"><span class="prev" title="<?php esc_attr_e( 'Previous', 'generatepress' );?>"><?php next_posts_link( __( 'Older posts', 'generatepress' ) ); ?></span></div>
				<?php endif;

				if ( get_previous_posts_link() ) : ?>
					<div class="nav-next"><span class="next" title="<?php esc_attr_e( 'Next', 'generatepress' );?>"><?php previous_posts_link( __( 'Newer posts', 'generatepress' ) ); ?></span></div>
				<?php endif;

				if ( function_exists( 'the_posts_pagination' ) ) {
					the_posts_pagination( array(
						'mid_size' => apply_filters( 'generate_pagination_mid_size', 1 ),
						'prev_text' => apply_filters( 'generate_previous_link_text', __( '&larr; Previous', 'generatepress' ) ),
						'next_text' => apply_filters( 'generate_next_link_text', __( 'Next &rarr;', 'generatepress' ) ),
					) );
				}

				/**
				 * generate_paging_navigation hook.
				 *
				 * @since 0.1
				 */
				do_action( 'generate_paging_navigation' );

			endif; ?>
		</nav><!-- #<?php echo esc_html( $nav_id ); ?> -->
		<?php
	}
}

if ( ! function_exists( 'generate_modify_posts_pagination_template' ) ) {
	add_filter( 'navigation_markup_template', 'generate_modify_posts_pagination_template', 10, 2 );
	/**
	 * Remove the container and screen reader text from the_posts_pagination()
	 * We add this in ourselves in generate_content_nav()
	 *
	 * @since 1.3.45
	 *
	 * @param string $template The default template.
	 * @param string $class The class passed by the calling function.
	 * @return string The HTML for the post navigation.
	 */
	function generate_modify_posts_pagination_template( $template, $class ) {
		if ( ! empty( $class ) && false !== strpos( $class, 'pagination' ) ) {
			$template = '<div class="nav-links">%3$s</div>';
		}

		return $template;
	}
}

if ( ! function_exists( 'generate_posted_on' ) ) {
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 *
	 * @since 0.1
	 */
	function generate_posted_on() {
		$date = apply_filters( 'generate_post_date', true );
		$author = apply_filters( 'generate_post_author', true );

		// $time_string = '<time class="entry-date published" datetime="%1$s" itemprop="datePublished">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="updated" datetime="%3$s" itemprop="dateModified">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		// If our author is enabled, show it.
		if ( $author ) {
			// echo '<pre>';
			// print_r( $author );
			// echo '</pre>';
			echo apply_filters( 'generate_post_author_output', sprintf( ' <span class="byline">%1$s</span>', // WPCS: XSS ok, sanitization ok.
				sprintf( '<span class="author vcard" %5$s>%1$s <a class="url fn n" href="%2$s" title="%3$s" rel="author" itemprop="url"><span class="author-name" itemprop="name">%4$s</span></a></span>',
					__( 'von', 'k8lang_domain' ),
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
					/* translators: 1: Author name */
					esc_attr( sprintf( __( 'Zeige alle Posts von %s', 'k8lang_domain' ), get_the_author() ) ),
					esc_html( get_the_author() ),
					generate_get_microdata( 'post-author' )
				)
			) );
		}

		// If our date is enabled, show it.
		if ( $date ) {
			echo apply_filters( 'generate_post_date_output', sprintf( '<span class="posted-on">%1$s</span>', // WPCS: XSS ok, sanitization ok.
				sprintf( '<em title="%1$s">%2$s</em>',
					esc_attr( get_the_time() ),
					$time_string
				)
			), $time_string );
		}
		// echo '<pre>';
		// print_r( get_the_author_meta( 'ID' ) );
		// echo '</pre>';

		if ( $author ) {
			$uid = get_the_author_meta( 'ID' );
			echo ( get_field('k8_acf_u_desc','user_' . $uid) ) ? sprintf('<p itemprop="description" class="k8-met__descr">%1s</p>', get_field('k8_acf_u_desc','user_' . $uid) ) : '<p itemprop="description" class="k8-met__descr">' . __( "Einige Wörter über den Autor / die Autorin", "k8lang_domain" ) . '</p>';
		}

	}
}

if ( ! function_exists( 'generate_entry_meta' ) ) {
	/**
	 * Prints HTML with meta information for the categories, tags.
	 *
	 * @since 1.2.5
	 */
	function generate_entry_meta() {
		$categories = apply_filters( 'generate_show_categories', true );
		$tags = apply_filters( 'generate_show_tags', true );
		$comments = apply_filters( 'generate_show_comments', true );

		$categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'generatepress' ) );
		if ( $categories_list && $categories ) {
			echo apply_filters( 'generate_category_list_output', sprintf( '<span class="cat-links"><span class="screen-reader-text">%1$s </span>%2$s</span>', // WPCS: XSS ok, sanitization ok.
				esc_html_x( 'Categories', 'Used before category names.', 'generatepress' ),
				$categories_list
			) );
		}

		$tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'generatepress' ) );
		if ( $tags_list && $tags ) {
			echo apply_filters( 'generate_tag_list_output', sprintf( '<span class="tags-links"><span class="screen-reader-text">%1$s </span>%2$s</span>', // WPCS: XSS ok, sanitization ok.
				esc_html_x( 'Tags', 'Used before tag names.', 'generatepress' ),
				$tags_list
			) );
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) && $comments ) {
			echo '<span class="comments-link">';
				comments_popup_link( __( 'Leave a comment', 'generatepress' ), __( '1 Comment', 'generatepress' ), __( '% Comments', 'generatepress' ) );
			echo '</span>';
		}
	}
}

if ( ! function_exists( 'generate_excerpt_more' ) ) {
	add_filter( 'excerpt_more', 'generate_excerpt_more' );
	/**
	 * Prints the read more HTML to post excerpts.
	 *
	 * @since 0.1
	 *
	 * @param string $more The string shown within the more link.
	 * @return string The HTML for the more link.
	 */
	function generate_excerpt_more( $more ) {
		return apply_filters( 'generate_excerpt_more_output', sprintf( ' ... <a title="%1$s" class="read-more" href="%2$s">%3$s%4$s</a>',
			the_title_attribute( 'echo=0' ),
			esc_url( get_permalink( get_the_ID() ) ),
			__( 'Read more', 'generatepress' ),
			'<span class="screen-reader-text">' . get_the_title() . '</span>'
		) );
	}
}

if ( ! function_exists( 'generate_content_more' ) ) {
	add_filter( 'the_content_more_link', 'generate_content_more' );
	/**
	 * Prints the read more HTML to post content using the more tag.
	 *
	 * @since 0.1
	 *
	 * @param string $more The string shown within the more link.
	 * @return string The HTML for the more link
	 */
	function generate_content_more( $more ) {
		return apply_filters( 'generate_content_more_link_output', sprintf( '<p class="read-more-container"><a title="%1$s" class="read-more content-read-more" href="%2$s">%3$s%4$s</a></p>',
			the_title_attribute( 'echo=0' ),
			esc_url( get_permalink( get_the_ID() ) . apply_filters( 'generate_more_jump','#more-' . get_the_ID() ) ),
			__( 'Read more', 'generatepress' ),
			'<span class="screen-reader-text">' . get_the_title() . '</span>'
		) );
	}
}

if ( ! function_exists( 'generate_post_meta' ) ) {
	add_action( 'generate_after_entry_title', 'generate_post_meta' );
	/**
	 * Build the post meta.
	 *
	 * @since 1.3.29
	 */
	function generate_post_meta() {
		$post_types = apply_filters( 'generate_entry_meta_post_types', array(
			'post',
		) );

		if ( in_array( get_post_type(), $post_types ) ) :
			$uid = get_the_author_meta( 'ID' );
			$k8_acf_u_ph = get_field( 'k8_acf_u_ph', 'user_' . $uid );?>
			<div class="entry-meta tbl k8-meta__tbl">
				<div class="tbl-cell mdl k8-meta__img">
					<img class="k8-round" src="<?php echo ( $k8_acf_u_ph ) ? K8Help::getImgUrl( $k8_acf_u_ph, 'thumbnail' ) : bloginfo( 'template_directory' ) . '/img/default-user-100.jpg' ; ?>">
				</div>
				<div class="tbl-cell mdl k8-meta__txt">
					<?php generate_posted_on(); ?>
				</div>
			</div><!-- .entry-meta -->
		<?php endif;

		#Show leave a reply button
		if( is_single() && in_category('VPN-Anbieter') ) :?>
			<a href="#respond" class='k8-repl__link'>
				<?php _e('Hinterlasse eine Bewertung' , 'k8lang_domain'); ?>
			</a>
		<?php
		endif;

	}
}

if ( ! function_exists( 'generate_footer_meta' ) ) {
	add_action( 'generate_after_entry_content', 'generate_footer_meta' );
	/**
	 * Build the footer post meta.
	 *
	 * @since 1.3.30
	 */
	function generate_footer_meta() {
		$post_types = apply_filters( 'generate_footer_meta_post_types', array(
			'post',
		) );

		if ( in_array( get_post_type(), $post_types ) ) : ?>
			<footer class="entry-meta">
				<?php
				generate_entry_meta();

				if ( is_single() ) {
					generate_content_nav( 'nav-below' );
				}
				?>
			</footer><!-- .entry-meta -->
		<?php endif;
	}
}
