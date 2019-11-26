<?php echo K8Html::tbl_start(['add_clss' => strtolower( $tag )]); ?>
	<tr>
		<th colspan="2">
			<?php _e('Betrieb am VPN-Client Router' , 'k8lang_domain'); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php _e('Verwendung auf Routern' , 'k8lang_domain'); ?>
		</td>
		<td>
			<?php
			echo ( has_term( 'vpn-router', 'anwendungen', $pid ) ) ? $this->true_icon : $this->false_icon; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php _e('Load Balancing' , 'k8lang_domain'); ?>
		</td>
		<td>
			<?php
			echo ( has_term( 'loadbalancing', 'sonderfunktionen', $pid ) ) ? $this->true_icon : $this->false_icon; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php _e('Ausfallsfreier Betrieb' , 'k8lang_domain'); ?>
		</td>
		<td>
			<?php
			echo ( has_term( 'loadbalancing', 'sonderfunktionen', $pid ) ) ? $this->true_icon : $this->false_icon; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php _e('Eigene Router Anwendung' , 'k8lang_domain'); ?>
		</td>
		<td>
			<?php
			echo ( has_term( 'dd-wrt', 'betriebssystem', $pid ) || has_term( 'openwrt', 'betriebssystem', $pid ) || has_term( 'tomato', 'betriebssystem', $pid ) ) ? $this->true_icon : $this->false_icon; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php _e('Kompatibel mit' , 'k8lang_domain'); ?>
		</td>
		<td>
			<?php
			foreach ($valz as $k => $v) :
			 	if( has_term( $k, 'betriebssystem', $pid ) ){
			 		$new_valz_arr[] = $v;
			 	}
			endforeach;
			echo implode(", ",$new_valz_arr);
			?>
		</td>
	</tr>
<?php
echo K8Html::tbl_end();