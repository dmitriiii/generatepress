<?php
class K8Short
{
	public function __construct(){
		#Show table with taxonomies Data
		add_shortcode( 'k8_short_prod', array( $this, 'vpn_tax') );

		#Show table with vpn details
		add_shortcode( 'k8_short_vpndet', array( $this, 'vpn_det') );

	}

	public function vpn_det($atts){
		$pid = get_the_ID();
		ob_start();?>
			<table class="k8_compare-tbl">
				<?php
				if ( get_field( 'k8_acf_vpndet_conn', $pid ) ): ?>
					<tr>
						<td>Verbindungen pro Konto</td>
						<td><?php the_field( 'k8_acf_vpndet_conn', $pid ); ?></td>
					</tr>
				<?php
				endif;

				if ( get_field( 'k8_acf_vpndet_durr1', $pid ) ): ?>
					<tr>
						<td>Dauer( <?php the_field( 'k8_acf_vpndet_durr1', $pid ); ?> Monat )</td>
						<td>
							<?php
							echo get_field( 'k8_acf_vpndet_prc1', $pid ) . " " . get_field( 'k8_acf_vpndet_curr', $pid )['label'];
							?>
						</td>
					</tr>
				<?php
				endif;

				if ( get_field( 'k8_acf_vpndet_durr2', $pid ) ): ?>
					<tr>
						<td>Dauer( <?php the_field( 'k8_acf_vpndet_durr2', $pid ); ?> Monat )</td>
						<td><?php the_field( 'k8_acf_vpndet_prc2', $pid ); ?></td>
					</tr>
				<?php
				endif;

				if ( get_field( 'k8_acf_vpndet_durr3', $pid ) ): ?>
					<tr>
						<td>Dauer( <?php the_field( 'k8_acf_vpndet_durr3', $pid ); ?> Monat )</td>
						<td><?php the_field( 'k8_acf_vpndet_prc3', $pid ); ?></td>
					</tr>
				<?php
				endif;

				if ( get_field( 'k8_acf_vpndet_durr4', $pid ) ): ?>
					<tr>
						<td>Dauer( <?php the_field( 'k8_acf_vpndet_durr4', $pid ); ?> Monat )</td>
						<td><?php the_field( 'k8_acf_vpndet_prc4', $pid ); ?></td>
					</tr>
				<?php
				endif;
				?>

			</table>
		<?php
	  $html = ob_get_clean();
	  return $html;
	}


	public function vpn_tax($atts){
		$arr = array(
			'betriebssystem'=>'Betriebssysteme',
			'zahlungsmittel'=>'Zahlungsmöglichkeiten',
			'sprache'=>'Sprache / Anwendung',
			'vpnprotokolle'=>'VPN-Protokolle',
			'anwendungen'=>'Anwendungen',
			'sonderfunktionen'=>'Sonder Funktionen',
			'fixeip'=>'Fixe IP-Adressen',
			'vpnstandortelaender'=>'VPN Standorte/Länder',
			'kundenservice'=>'Kundenservices',
			'unternehmen'=>'Unternehmen',
			'bedingungen'=>'bedingungen',
			'sicherheitslevel'=>'Sicherheitslevel'
		);
		ob_start();
		if( is_array( $arr ) && count( $arr ) > 0 ):?>
			<table class="k8_compare-tbl">
				<?php
				foreach ($arr as $tax_name => $tax_label) : ?>
					<tr>
						<td><?php echo $tax_label; ?></td>
						<td>
						<?php
							$termz = get_the_terms( get_the_ID(), $tax_name );
							if ( is_array( $termz ) && count( $termz ) > 0 ) :
								$cc=1;
								foreach ($termz as $term) :
									echo( count( $termz ) > $cc ) ? $term->name . ', ' : $term->name;
									$cc++;
								endforeach;
							else:
								echo '-';
							endif;?>
						</td>
					</tr>
				<?php
				endforeach; ?>
			</table>
		<?php
		endif;
	  $html = ob_get_clean();
	  return $html;
	}
}
new K8Short;