<?php
class K8Html
{
	/**
	 * [getButt description]
	 * @param  [type] $args [
	 *  'nofollow' - string ( def - '' )
	 *  'class' - string ( def - 'dwnd__butt' )
	 *  'target' - string ( def - '' )
	 *  'href' - string ( def - '#' )
	 *  'download' - string ( def - '' )
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
		if( !isset( $args['download'] ) ){
			$args['download'] = '';
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

		$strr = '<p>
							<a rel="%s" class="%s" target="%s" href="%s" %s>
							 <img src="%s" alt="%s">
							 %s
							 <i class="fa fa-download" aria-hidden="true"></i>
							</a>
						</p>';

		$html = sprintf($strr,
										$args['nofollow'],
										$args['class'],
										$args['target'],
										$args['href'],
										$args['download'],
										$args['img_src'],
										$args['img_alt'],
										$args['text']);
		return $html;
	}


	/**
	 * [getRow Get table price row]
	 * @param  [type] $args [
	 *  'durr' - string
	 *  'prc' - string
	 *  'pid' - int
	 *  'curr' - string
	 * ]
	 * @return [type]       [description]
	 */
	static function getRow( $args ){
		$durr = get_field( $args['durr'], $args['pid'] );
		$prc = get_field( $args['prc'], $args['pid'] );

		if( !$durr || !$prc ){
			return false;
		}

		if( $durr == 1 ) :
			$str = "<tr>
								<td>Tarif (%s Monat)</td>
								<td>
									<strong>%s</strong>	<em>%s</em>
								</td>
							</tr>";
			return sprintf( $str, $durr, $prc, $args['curr'] );

		else:
			$avg = $prc / $durr;
			$avg = round( $avg, 2 );
			$str = "<tr>
								<td>Tarif (%s Monate)</td>
								<td>
									<strong>%s</strong>	<em>%s</em>
									(pro Monat <strong>%s</strong> %s)
								</td>
							</tr>";

			return sprintf( $str, $durr, $prc, $args['curr'], $avg, $args['curr'] );
		endif;
	}


} ?>