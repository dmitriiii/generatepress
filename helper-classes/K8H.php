<?php
class K8H
{
	static function getNumz( $str ){
		preg_match_all('!\d+!', $str, $matches);
		$matches_str = implode( '', $matches[0] );
		return $matches_str;
	}
}