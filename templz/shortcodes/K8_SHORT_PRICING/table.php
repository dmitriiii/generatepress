<?php echo K8Html::tbl_start(['add_clss' => strtolower( $tag )]); ?>
	<tr>
		<th colspan="2">
			<span><?php _e('Kosten / Tarife' , 'k8lang_domain'); ?></span>
		</td>
	</tr>
	<tr>
		<td>
			<?php _e('Kostenlose Nutzung' , 'k8lang_domain'); ?>
		</td>
		<td>
			<?php
			echo $this->false_icon; ?>
		</td>
	</tr><?php
	#Duration & Prices
	$arrgz = array(
		'k8_acf_vpndet_durr1' => 'k8_acf_vpndet_prc1',
		'k8_acf_vpndet_durr2' => 'k8_acf_vpndet_prc2',
		'k8_acf_vpndet_durr3' => 'k8_acf_vpndet_prc3',
		'k8_acf_vpndet_durr4' => 'k8_acf_vpndet_prc4'
	);
	foreach ($arrgz as $k=>$v) {
		echo K8Html::getRow( array(
			'durr' => $k,
			'prc' => $v,
			'pid' => $pid,
			'curr' => $k8_acf_vpndet_curr
		));
	}
	if ( get_field( 'k8_acf_vpndet_conn', $pid ) ): ?>
		<tr>
			<td>
				<?php _e('Anzahl gleichzeitiger Verbindungen pro Konto' , 'k8lang_domain'); ?>
			</td>
			<td><strong><?php echo get_field( 'k8_acf_vpndet_conn', $pid )['label']; ?></strong></td>
		</tr>
	<?php
	endif;
	#Trials
	if ( get_field( 'k8_acf_vpndet_trialz', $pid ) ):
		$k8_acf_vpndet_trialz =	get_field( 'k8_acf_vpndet_trialz', $pid ); ?>
		<tr>
			<td>
				<?php _e('Testmöglichkeiten' , 'k8lang_domain'); ?>
			</td>
			<td>
				<?php
				$ccc = 1;
				foreach ($k8_acf_vpndet_trialz as $key=>$value): ?>
					<strong>
						<?php echo $value['label']; ?>
					</strong>
				<?php
					echo ( count( $k8_acf_vpndet_trialz ) > $ccc ) ? ', ' : '';
					$ccc++;
				endforeach ?>
			</td>
		</tr>
	<?php
	endif;
echo K8Html::tbl_end();