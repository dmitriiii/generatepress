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
}