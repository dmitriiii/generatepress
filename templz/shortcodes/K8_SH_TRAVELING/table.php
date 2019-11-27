<?php echo K8Html::tbl_start(['add_clss' => strtolower( $tag )]); ?>
	<tr>
		<th colspan="2">
			<span><?php _e('VPN für Reisen und im Ausland' , 'k8lang_domain'); ?></span>
		</td>
	</tr>
	<tr>
		<td>
			<?php _e('Nutzung in restriktiven Netzwerken (China, Hotels)' , 'k8lang_domain'); ?>
		</td>
		<td>
			<?php
			echo ( has_term( 'obfsproxy', 'sonderfunktionen', $pid ) || has_term( 'shadowsocks', 'vpnprotokolle', $pid ) || has_term( 'wireguard', 'vpnprotokolle', $pid ) ) ? $this->true_icon : $this->false_icon; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php _e('Obfusication (Maskierung)' , 'k8lang_domain'); ?>
		</td>
		<td>
			<?php
			echo ( has_term( 'obfsproxy', 'sonderfunktionen', $pid ) ) ? $this->true_icon : $this->false_icon; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php _e('Schutz in unsicheren Wifi-Netzwerken' , 'k8lang_domain'); ?>
		</td>
		<td>
			<?php
			echo ( has_term( 'lokale-sperren-umgehen', 'anwendungen', $pid ) ) ? $this->true_icon : $this->false_icon; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php _e('Shadowsocks oder SOCKS5' , 'k8lang_domain'); ?>
		</td>
		<td>
			<?php
			echo ( has_term( 'shadowsocks', 'vpnprotokolle', $pid ) || has_term( 'socks5', 'vpnprotokolle', $pid ) ) ? $this->true_icon : $this->false_icon; ?>
		</td>
	</tr>
	<?php
echo K8Html::tbl_end();