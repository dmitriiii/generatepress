<?php
class K8H
{
	static function getNumz( $str ){
		preg_match_all('!\d+!', $str, $matches);
		$matches_str = implode( '', $matches[0] );
		return $matches_str;
	}

	/**
	 * [splitAcfChbx - retrieve data from checkboxes group to comma separated html string]
	 * @param  [type] $args [
	 *   'data' - array ( Array of value - labels that comes from ACF get_field() ),
	 *   'html_tag' - string ( Name of html tag that will wrap each element in string )
	 *   'label' - string ( Name of column, from data array, which info we need. default - label  )
	 * ]
	 * @return [string]  Html string
	 */
	static function getAcfChbx( $args ){
		if( !isset( $args['label'] ) ){
			$args['label'] = 'label';
		}
		if( !isset( $args['html_tag'] ) ){
			$args['html_tag'] = 'strong';
		}
		$lab_arr = array_column( $args['data'], $args['label'] );
		return "<{$args['html_tag']}>" . implode( "</{$args['html_tag']}>, <{$args['html_tag']}>", $lab_arr ) . "</{$args['html_tag']}>";
	}

	/**
	 * [ajxHolder description]
	 * @param  array  $args [
	 *  'pid_arr' - array - vpnid-pid assoc array
	 *  'tag' - string - shortcode tag
	 *  'output' - string - table/graphic1
	 * ]
	 * @return [type]       [description]
	 */
	static function ajxHolder( $args=[] ){
		$vpnid =	implode(',', array_column ($args['pid_arr'], 'vpnid' ));
		$str = '<div class="k8laz_load k8laz_comments"
			data-nonce="%s"
			data-action="%s"
			data-vpnid="%s"
			data-tag="%s"
			data-output="%s"></div>';
		return sprintf(
			$str,
			wp_create_nonce('k8laz__nonce'),
			'k8laz_short',
			$vpnid,
			$args['tag'],
			$args['output']
		);
	}


	static function shortPrep( $a, $atts ){
		$pid_arr = array();
		#If passed list of vpnids
		if( isset( $atts['vpnid'] ) && !empty( $atts['vpnid'] ) ){
			$vpnid_arr = explode(',', $a['vpnid']);
			$vpnidPid =	json_decode( file_get_contents( K8_PATH_LOC . '/' . 'vpnidPid.json'), true );
			foreach( $vpnid_arr as $vpnid ){
				$pos = array_search((int)$vpnid, array_column($vpnidPid, 'vpnid'));
				if( $pos !== false ){
					$pid_arr[] = $vpnidPid[$pos];
				}
			}
		}
		#without vpnid list just current post id
		else{
			$pid_arr[] = array(
				'vpnid' => get_field( 'k8_acf_vpnid', (int)$a['vpnid'] ),
				'pid' => (int)$a['vpnid']
			);
		}
		return $pid_arr;
	}


	static function getPerMonth( $price, $duration ){
		$avg = $price / $duration;
		$avg = round( $avg, 2 );
		return $avg;
	}

	#Show price comparison rows for table
	static function priceCompare( $obj, $pid_arr ){
		$fieldz = [
			array(
				'duration' => 'k8_acf_vpndet_durr1',
				'price' => 'k8_acf_vpndet_prc1'
			),
			array(
				'duration' => 'k8_acf_vpndet_durr2',
				'price' => 'k8_acf_vpndet_prc2'
			),
			array(
				'duration' => 'k8_acf_vpndet_durr3',
				'price' => 'k8_acf_vpndet_prc3'
			),
			array(
				'duration' => 'k8_acf_vpndet_durr4',
				'price' => 'k8_acf_vpndet_prc4'
			),
		];

		$drn_new = array();
		foreach ( $pid_arr as $item ) {
			foreach ( $fieldz as $v ){
				if( get_field( $v['duration'], $item['pid'] ) )
					$drn_new[] = get_field( $v['duration'], $item['pid'] );
			}
		}
		sort( $drn_new );
		$drn_new = array_unique($drn_new);
		foreach ($drn_new as $row) :
			echo $obj->tr .
					 	$obj->td .
					 		__( 'Tarif', 'k8lang_domain' ) . " ($row " . (( $row == 1 ) ? __( 'Monat', 'k8lang_domain' ) : __( 'Monate', 'k8lang_domain' ) ) . " )" .
					 	$obj->_td;
					 	foreach ( $pid_arr as $item ):
					 		$hass = false;
					 		foreach( $fieldz as $d ){
					 			if( get_field( $d['duration'], $item['pid'] ) == $row ){
					 				$prcc =	get_field( $d['price'], $item['pid'] );
					 				$curcc = get_field( 'k8_acf_vpndet_curr', $item['pid'] )['label'];
					 				echo $obj->td .
					 					$obj->b . $prcc . $obj->_b . ' ' .
										$obj->em . $curcc . $obj->_em .
										(( $row != 1 ) ? " (" . __( 'pro Monat', 'k8lang_domain' ) . " " .
																			$obj->b . self::getPerMonth( $prcc, $row ) . $obj->_b . " " . $curcc . ")" : '') .
					 				$obj->_td;
					 				$hass = true;
					 			}
					 		}
					 		if( !$hass ){
					 			echo $obj->td . $obj->false_icon . $obj->_td;
					 		}
					 	endforeach;
			echo $obj->_tr;
		endforeach;
	}
}