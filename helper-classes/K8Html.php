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

	/**
	 * [getItem description]
	 * @param  [type] $args [
	 *   'pid' - int
	 *   'pm' - array
	 *   'wppr_options' - array
	 *   'i' - int
	 * ]
	 * @return [type]       [description]
	 */
	static function getItem( $args ){
		extract( $args );
		ob_start();?>
			<div class="k8-sec3__it <?php echo( isset($i) && $i > 1 ) ? 'blured' : ''; ?>">
				<div class="tbl k8-sec3__it-tbl">
					<div class="tbl-cell cell-1 mdl">
						<img src="<?php echo get_the_post_thumbnail_url( $pid, 'thumbnail' ) ?>">
					</div>
					<div class="tbl-cell cell-2 mdl">
						<ul class="k8-sec3__it-list">
							<li>
								<span><?php echo $pm['cwp_rev_price'][0]; ?></span>
								Preis/Mon ab $
							</li>
							<?php
							if ( is_array($wppr_options) && count($wppr_options) > 0 ):
								foreach ($wppr_options as $v): ?>
									<li>
										<span><?php echo $v['value']; ?></span>
										<?php echo $v['name']; ?>
									</li>
								<?php
								endforeach;
							endif; ?>
						</ul>
					</div>
					<div class="tbl-cell cell-3 mdl">
						<p>
							<?php echo K8Help::excerptPid( 30, $pid ); ?>
						</p>
						<a href="<?php echo get_permalink($pid); ?>" class="k8-sec3__it-link">
							zum Testberichte
						</a>
					</div>
				</div>
			</div><!-- .k8-sec3__it -->
		<?php
		$html = ob_get_clean();
	  return $html;
	}

	/**
	 * @param  [type] $args[
	 * 	'key' - string
	 * 	'item' - array,
	 *	'varrs' - array,
	 *	'curr_url' - string,
	 * ]
	 * @return [type]
	 */
	static function getOsLink( $args ){
		extract( $args );
		unset( $args );
		write_log( get_defined_vars() );
		$str = '<a %s href="%s" class="dwnd__ot-link %s">
							<i class="fa %s" aria-hidden="true"></i>
							%s
						</a>';
		$html = '';
		$active_class = '';
		$link = '#';
		$target = '';
		if( $varrs[0][$key] !== '' ){
			$link = get_permalink( (int)$varrs[0][$key] );
			write_log('Равно = ' . $link );

			if( $curr_url === $link ) :
				$active_class = 'act';
			endif;

			$html =	sprintf( $str,
										 $target,
										 $link,
										 $active_class,
										 $item['icon'],
										 $item['label']
										);
			return $html;
		}
		elseif($varrs[0][$key.'_ext'] !== '') {
			$target = 'target="_blank" rel="nofollow"';
			$link = $varrs[0][$key . '_ext'];

			$html =	sprintf( $str,
										 $target,
										 $link,
										 $active_class,
										 $item['icon'],
										 $item['label']
										);
			return $html;
		}
		else{
			return $html;
		}

	}

} ?>