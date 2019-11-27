<?php echo K8Html::tbl_start(['add_clss' => strtolower( $tag )]); ?>
	<tr>
		<th colspan="2">
			<span><?php _e('Download und Torrent' , 'k8lang_domain'); ?></span>
		</td>
	</tr>
	<tr>
		<td>
			<?php _e('Torrent Nutzung erlaubt' , 'k8lang_domain'); ?>
		</td>
		<td>
			<?php
			echo ( has_term( 'tauschboersen-torrent', 'anwendungen', $pid ) ) ? $this->true_icon : $this->false_icon; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php _e('Eigene Torrent Server' , 'k8lang_domain'); ?>
		</td>
		<td>
			<?php
			echo ( has_term( 'own-torrent-server', 'sonderfunktionen', $pid ) ) ? $this->true_icon : $this->false_icon; ?>
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
	<tr>
		<td>
			<?php _e('Portweiterleitungen' , 'k8lang_domain'); ?>
		</td>
		<td>
			<?php
			echo ( has_term( 'portweiterleitungen', 'sonderfunktionen', $pid ) ) ? $this->true_icon : $this->false_icon; ?>
		</td>
	</tr>
	<?php
echo K8Html::tbl_end();