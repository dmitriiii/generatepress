<?php 
$k8_acf_vpndet_down = get_field( 'k8_acf_vpndet_down', $pid );
$k8_acf_vpndet_jitter = get_field( 'k8_acf_vpndet_jitter', $pid );
$k8_acf_vpndet_ping = get_field( 'k8_acf_vpndet_ping', $pid );
$k8_acf_vpndet_up = get_field( 'k8_acf_vpndet_up', $pid ); ?>
<div class="k8anim k8anim_lines <?php echo strtolower($tag) . '-' . $a['output']; ?> mtb-50">
	<div class="head">
		<?php _e('Maximale Geschwindigkeit getestet' , 'k8lang_domain'); ?>
	</div>
	<div class="tbl">
		<div class="tbl-row">
			<div class="tbl-cell cell-1">
				<div class="wrr">
					<div class="head-1">
						<i class="fas fa-cloud-download-alt"></i>
						<?php _e('Download' , 'k8lang_domain'); ?>
					</div>
					<div class="head-2">
						<strong class="k8anim k8anim_countup" id="cnt<?php echo uniqid(); ?>" data-from="0" data-to="<?php echo $k8_acf_vpndet_down; ?>" data-k8countup>0</strong>
					</div>
					<div class="head-3">Kbps</div>
				</div>
			</div>
			<div class="tbl-cell cell-2">
				<div class="wrr">
					<div class="head-1">
						<i class="fas fa-redo-alt"></i>
						<?php _e('Jitter' , 'k8lang_domain'); ?>
					</div>
					<div class="head-2">
						<strong class="k8anim k8anim_countup" id="cnt<?php echo uniqid(); ?>" data-from="0" data-to="<?php echo $k8_acf_vpndet_jitter; ?>" data-k8countup>0</strong>
					</div>
					<div class="head-3">Ms</div>
				</div>
			</div>
			<div class="tbl-cell cell-3">
				<div class="wrr">
					<div class="head-1">
						<i class="fas fa-redo-alt"></i>
						<?php _e('Ping' , 'k8lang_domain'); ?>
					</div>
					<div class="head-2">
						<strong class="k8anim k8anim_countup" id="cnt<?php echo uniqid(); ?>" data-from="0" data-to="<?php echo $k8_acf_vpndet_ping; ?>" data-k8countup>0</strong>
					</div>
					<div class="head-3">Ms</div>
				</div>
			</div>
			<div class="tbl-cell cell-4">
				<div class="wrr">
					<div class="head-1">
						<i class="fas fa-cloud-upload-alt"></i>
						<?php _e('Upload' , 'k8lang_domain'); ?>
					</div>
					<div class="head-2">
						<strong class="k8anim k8anim_countup" id="cnt<?php echo uniqid(); ?>" data-from="0" data-to="<?php echo $k8_acf_vpndet_up; ?>" data-k8countup>0</strong>
					</div>
					<div class="head-3">Kbps</div>
				</div>
			</div>
		</div>
	</div>
	<div class="head-4 ta-c">
		<em><?php echo get_field('k8_acf_vpndet_meas', $pid)['label']; ?></em>
		<?php 
		$stamp_old = get_the_modified_time('G' , $pid);
		echo " | " . date('d.m.Y', strtotime('-10 day', $stamp_old) ); ?>
	</div>
</div>
