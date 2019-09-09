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
		if( !in_array( 'class', $args ) ){
			$args['class'] = 'dwnd__butt';
		}
		if( !in_array( 'nofollow', $args ) ){
			$args['nofollow'] = '';
		}
		if( !in_array( 'target', $args ) ){
			$args['target'] = '';
		}
		if( !in_array( 'href', $args ) ){
			$args['href'] = '#';
		}
		if( !in_array( 'img_src', $args ) ){
			$args['img_src'] = '';
		}
		if( !in_array( 'img_alt', $args ) ){
			$args['img_alt'] = '';
		}
		if( !in_array( 'text', $args ) ){
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