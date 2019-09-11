<?php
class K8Short
{
	public function __construct(){
		#Show table with taxonomies Data
		add_shortcode( 'k8_short_prod', array( $this, 'vpn_tax') );

		#Show table with vpn details
		add_shortcode( 'k8_short_vpndet', array( $this, 'vpn_det') );

		#[K8_SHORT_YT id="dkPLIw9aZwY"]
		add_shortcode( 'K8_SHORT_YT', array( $this, 'yt' ) );
	}


	public function yt( $atts ) {
		$a = shortcode_atts( array(
			'id' => 'dkPLIw9aZwY',
		), $atts );
		$str = "<div class='k8_yt-wrr'>
							<a href='%s' rel='nofollow' class='k8_yt-link'>
								<span class='btn-blu'><i class='fa fa-play' aria-hidden='true'></i></span>
							</a>
							<img src='https://img.youtube.com/vi/%s/maxresdefault.jpg'/>
						</div>";

		return sprintf(
			$str,
			$a['id'],
			$a['id']
		);
	}


	#Show table with vpn details
	public function vpn_det($atts){
		$pid = get_the_ID();
		$k8_acf_vpndet_curr =	get_field( 'k8_acf_vpndet_curr', $pid )['label'];
		ob_start();?>
			<table class="k8_compare-tbl mtb-30">
				<?php
				#Connections per account
				if ( get_field( 'k8_acf_vpndet_conn', $pid ) ): ?>
					<tr>
						<td>Verbindungen pro Konto</td>
						<td><strong><?php echo get_field( 'k8_acf_vpndet_conn', $pid )['label']; ?></strong></td>
					</tr>
				<?php
				endif;

				#Duration 1
				if ( get_field( 'k8_acf_vpndet_durr1', $pid ) ): ?>
					<tr>
						<td>Dauer( <?php the_field( 'k8_acf_vpndet_durr1', $pid ); ?> Monat )</td>
						<td>
							<strong><?php echo get_field( 'k8_acf_vpndet_prc1', $pid ) . "</strong>	<em>" . $k8_acf_vpndet_curr; ?></em>
						</td>
					</tr>
				<?php
				endif;

				#Duration 2
				if ( get_field( 'k8_acf_vpndet_durr2', $pid ) ): ?>
					<tr>
						<td>Dauer( <?php the_field( 'k8_acf_vpndet_durr2', $pid ); ?> Monate )</td>
						<td>
							<strong><?php echo get_field( 'k8_acf_vpndet_prc2', $pid ) . "</strong>	<em>" . $k8_acf_vpndet_curr; ?></em>
						</td>
					</tr>
				<?php
				endif;

				#Duration 3
				if ( get_field( 'k8_acf_vpndet_durr3', $pid ) ): ?>
					<tr>
						<td>Dauer( <?php the_field( 'k8_acf_vpndet_durr3', $pid ); ?> Monate )</td>
						<td>
							<strong><?php echo get_field( 'k8_acf_vpndet_prc3', $pid ) . "</strong>	<em>" . $k8_acf_vpndet_curr; ?></em>
						</td>
					</tr>
				<?php
				endif;

				# Duration 4
				if ( get_field( 'k8_acf_vpndet_durr4', $pid ) ): ?>
					<tr>
						<td>Dauer( <?php the_field( 'k8_acf_vpndet_durr4', $pid ); ?> Monate )</td>
						<td>
							<strong><?php echo get_field( 'k8_acf_vpndet_prc4', $pid ) . "</strong>	<em>" . $k8_acf_vpndet_curr; ?></em>
						</td>
					</tr>
				<?php
				endif;

				#Trials
				if ( get_field( 'k8_acf_vpndet_trialz', $pid ) ):
					$k8_acf_vpndet_trialz =	get_field( 'k8_acf_vpndet_trialz', $pid ); ?>
					<tr>
						<td>Testmöglichkeiten</td>
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

				#Videoplattformen
				if ( get_field( 'Videoplattformen', $pid ) ):
					$videoplattformen =	get_field( 'Videoplattformen', $pid ); ?>
					<tr>
						<td>Videoplattformen</td>
						<td>
							<?php
							$ccc = 1;
							foreach ($videoplattformen as $key=>$value): ?>
								<strong>
									<?php echo $value; ?>
								</strong>
							<?php
								echo ( count( $videoplattformen ) > $ccc ) ? ', ' : '';
								$ccc++;
							endforeach ?>
						</td>
					</tr>
				<?php
				endif; ?>



			</table>
		<?php
	  $html = ob_get_clean();
	  return $html;
	}

	#Show table with taxonomies Data
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