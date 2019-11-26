<?php echo K8Html::tbl_start(['add_clss' => strtolower( $tag )]); ?>
<tr>
	<th colspan="2">
		<?php _e('Maximale Geschwindigkeit getestet' , 'k8lang_domain'); ?>
	</th>
</tr>
<tr>
	<td>
		<?php _e('Download' , 'k8lang_domain'); ?>
	</td>
	<td>
		<strong><?php echo get_field('k8_acf_vpndet_down', $pid); ?></strong> kbps
	</td>
</tr>
<tr>
	<td>
		<?php _e('Upload' , 'k8lang_domain'); ?>
	</td>
	<td>
		<strong><?php echo get_field('k8_acf_vpndet_up', $pid); ?></strong> kbps
	</td>
</tr>
<tr>
	<td>
		<?php _e('Jitter' , 'k8lang_domain'); ?>
	</td>
	<td>
		<strong><?php echo get_field('k8_acf_vpndet_jitter', $pid); ?></strong> ms
	</td>
</tr>
<tr>
	<td>
		<?php _e('Ping' , 'k8lang_domain'); ?>
	</td>
	<td>
		<strong><?php echo get_field('k8_acf_vpndet_ping', $pid); ?></strong> ms
	</td>
</tr>
<tr>
	<td>
		<?php _e('Getestet mit OpenVPN (UDP) am' , 'k8lang_domain'); ?>
	</td>
	<td>
		<strong>
			<?php
			$stamp_old = get_the_modified_time('G' , $pid);
			echo date('d.m.Y', strtotime('-10 day', $stamp_old) ); ?>
		</strong>
	</td>
</tr>
<tr>
	<td>
		<?php _e('Verbindung innerhalb von' , 'k8lang_domain'); ?>
	</td>
	<td>
		<strong>
			<?php echo get_field('k8_acf_vpndet_meas', $pid)['label'];?>
		</strong>
	</td>
</tr>
<?php echo K8Html::tbl_end(); ?>