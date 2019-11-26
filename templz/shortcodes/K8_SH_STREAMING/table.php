<?php echo K8Html::tbl_start(['add_clss' => strtolower( $tag )]); ?>
	<tr>
		<th colspan="2">
			<?php _e('Streaming von TV und Videoinhalten' , 'k8lang_domain'); ?>
		</th>
	</tr>
	<tr>
		<td>
			<?php _e('Nutzung am Heim-Router' , 'k8lang_domain'); ?>
		</td>
		<td>
			<?php
			echo ( has_term( 'vpn-router', 'anwendungen', $pid ) ) ? $this->true_icon : $this->false_icon; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php _e('Nutzung mit KODI' , 'k8lang_domain'); ?>
		</td>
		<td>
			<?php
			echo ( has_term( 'kodi-addon', 'betriebssystem', $pid ) ) ? $this->true_icon : $this->false_icon; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php _e('SmartDNS' , 'k8lang_domain'); ?>
		</td>
		<td>
			<?php
			echo ( has_term( 'smartdns', 'sonderfunktionen', $pid ) ) ? $this->true_icon : $this->false_icon; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php _e('FireTV App' , 'k8lang_domain'); ?>
		</td>
		<td>
			<?php
			echo ( has_term( 'firetv', 'betriebssystem', $pid ) ) ? $this->true_icon : $this->false_icon; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php _e('Abmahnungen vermeiden' , 'k8lang_domain'); ?>
		</td>
		<td>
			<?php
			echo ( has_term( 'abmahnungen-vermeiden', 'anwendungen', $pid ) ) ? $this->true_icon : $this->false_icon; ?>
		</td>
	</tr>
	<?php
	#k8_acf_vpndet_vid
	if ( get_field( 'k8_acf_vpndet_vid', $pid ) ):
		$k8_acf_vpndet_vid = get_field( 'k8_acf_vpndet_vid', $pid ); ?>
		<tr>
			<td>
				<?php _e('Unterstütze Streaming-Plattformen' , 'k8lang_domain'); ?>
			</td>
			<td>
				<?php
				$ccc = 1;
				foreach ($k8_acf_vpndet_vid as $it): ?>
					<strong>
						<?php echo $it['label']; ?>
					</strong>
				<?php
					echo ( count( $k8_acf_vpndet_vid ) > $ccc ) ? ', ' : '';
					$ccc++;
				endforeach ?>
			</td>
		</tr>
	<?php
	endif;
echo K8Html::tbl_end();