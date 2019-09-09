<?php
class K8Html
{
	/**
	 * [getButt description]
	 * @param  [type] $args [
	 *  'class' - string ( def - 'dwnd__butt' )
	 *  'nofollow' - string ( def - '' )
	 *  'target' - string ( def - '' )
	 *  'href' - string ( def - '#' )
	 *  'img_src' - string( def - '' )
	 *  'img_alt' - string( def - '' )
	 *  'text' - string( def - 'Download' )
	 * ]
	 * @return [type]       [description]
	 */
	static function getButt( $args ){
		if( !isset( $args['nofollow'] ) ){
			$args['nofollow'] = '';
		}
		if( !isset( $args['class'] ) ){
			$args['class'] = 'dwnd__butt';
		}
		if( !isset( $args['target'] ) ){
			$args['target'] = '';
		}
		if( !isset( $args['href'] ) ){
			$args['href'] = '#';
		}
		if( !isset( $args['img_src'] ) ){
			$args['img_src'] = '';
		}
		if( !isset( $args['img_alt'] ) ){
			$args['img_alt'] = '';
		}
		if( !isset( $args['text'] ) ){
			$args['text'] = 'Download';
		}

		$html = sprintf('<p>
											<a rel="%s" class="%s" target="%s" href="%s">
											 <img src="%s" alt="%s">
											 %s
											 <i class="fa fa-download" aria-hidden="true"></i>
											</a>
										</p>',
										$args['nofollow'],
										$args['class'],
										$args['target'],
										$args['href'],
										$args['img_src'],
										$args['img_alt'],
										$args['text']);
		return $html;
	}
} ?>