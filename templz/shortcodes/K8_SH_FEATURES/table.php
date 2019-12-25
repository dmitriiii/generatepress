<?php
if( !is_array( $pid_arr ) || count( $pid_arr ) == 0 ){
	echo 'Sorry nothing found';
	return;
}
$span = count( $pid_arr ) + 1;
echo K8Html::tbl_start(['add_clss' => strtolower( $tag )]) .
	$this->tr . K8Html::tdHead( [
		'format' => "<th colspan='".$span."'><span>%s</span></th>",
		'txt' => __('Sonderfunktionen' , 'k8lang_domain')
	] ) . $this->_tr;

	#Show names of vpn Services if it is compare tables
	if( count( $pid_arr ) > 1 ):
		echo $this->tr . $this->td . __('VPN-Dienstname' , 'k8lang_domain') . $this->_td;
		foreach ( $pid_arr as $item ) {
			echo $this->td . $this->mark1 . get_post_meta( $item['pid'], 'cwp_rev_product_name', true ) . $this->_mark1 . $this->_td;
		}
		echo $this->_tr;
	endif;

	if ( isset($termz) && is_array($termz) && count( $termz ) > 0 ) :
		foreach ($termz as $term):
			echo $this->tr . K8Html::tdHead( ['txt'=>__($term->name , 'k8lang_domain')] );
			foreach ($pid_arr as $item) {
				if( $term->slug == 'virtuelle-server' ){
					echo ( (has_term( $term->slug, $term->taxonomy, $item['pid'] ) ) ?
							$this->td(['class'=>'k8-blu']) . $this->true_icon :
							$this->td(['class'=>'k8-grn']) . $this->false_icon ) .
				 		$this->_td;
					continue;
				}
				echo $this->td .
							((has_term( $term->slug, $term->taxonomy, $item['pid'] ) ) ? $this->true_icon : $this->false_icon) .
						 $this->_td;
			}
			echo $this->_tr;
		endforeach;
	endif;

echo K8Html::tbl_end();