<?php echo K8Html::tbl_start(['add_clss' => strtolower( $tag )]); ?>
<tr>
	<th colspan="2">
		<span><?php _e('Online Gaming' , 'k8lang_domain'); ?></span>
	</td>
</tr>
<tr>
	<td>
		<?php _e('Geringe Latenzzeiten' , 'k8lang_domain'); ?>
	</td>
	<td>
		<?php echo ( (int) get_field('k8_acf_vpndet_ping', $pid) < 35 ) ? $this->true_icon : $this->false_icon; ?>
	</td>
</tr>
<tr>
	<td>
		<?php _e('Nutzung auf Spielekonsolen' , 'k8lang_domain'); ?>
	</td>
	<td>
		<?php
		echo ( has_term( 'smartdns', 'sonderfunktionen', $pid ) ) ? '<strong>PlayStation, XBox</strong>' : $this->false_icon; ?>
	</td>
</tr>
<tr>
	<td>
		<?php _e('DDoS Schutz' , 'k8lang_domain'); ?>
	</td>
	<td>
		<?php
		echo ( has_term( 'firewall', 'sonderfunktionen', $pid ) ) ? $this->true_icon : $this->false_icon; ?>
	</td>
</tr>
<?php echo K8Html::tbl_end(); ?>