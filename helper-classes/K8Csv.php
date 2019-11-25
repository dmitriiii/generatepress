<?php
class K8Csv
{
	public $taxz;
	function __construct(){
		if ( defined('K8_VPN_TAX') ) {
			$this->taxz = K8_VPN_TAX;
		}
	}
	public function outputCsv($file_name, $assocDataArray){
		$has_header = false;
		foreach ($assocDataArray as $c) {
			$fp = fopen($file_name, 'a');
			if (!$has_header) {
				fputcsv($fp, array_keys($c));
				$has_header = true;
			}
			fputcsv($fp, $c);
			fclose($fp);
		}
	}
	public function getTaxCsv(){
		$locale = get_locale();
		$dir = get_template_directory() . '/data/csv/taxonomies/' . $locale . '/';
		$csvFile = '';
		foreach ($this->taxz as $taxonomy) {
			$assoc_arr = array();
			$csvFile = $dir . $locale . "_" . $taxonomy . '.csv';
			$termz = get_terms( array(
				'taxonomy' => $taxonomy,
				'hide_empty' => false,
			));
			foreach ($termz as $item) {
				$assoc_arr[] = array(
					'slug' => $item->slug,
					'name' => $item->name,
				);
			}
			if (!file_exists($dir)) {
				mkdir($dir, 0777, true);
			}
			if( !file_exists( $csvFile ) ){
				$this->outputCsv( $csvFile, $assoc_arr );
			}
		}
	}
 }