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

		#[K8_SHORT_FAQ] generates schema markup for FAQ pages
		add_shortcode( 'K8_SHORT_FAQ', array( $this, 'faq' ) );
	}


	public function yt( $atts ) {
		$a = shortcode_atts( array(
			'id' => 'dkPLIw9aZwY',
		), $atts );
		$str = "<div class='k8_yt-wrr'>
							<a href='%s' rel='nofollow' class='k8_yt-link'>
								<span class='btn-blu pls'><i class='fa fa-play' aria-hidden='true'></i></span>
							</a>
							<img class='of-cv' src='https://img.youtube.com/vi/%s/maxresdefault.jpg'/>
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

				#k8_acf_vpndet_vid
				if ( get_field( 'k8_acf_vpndet_vid', $pid ) ):
					$k8_acf_vpndet_vid =	get_field( 'k8_acf_vpndet_vid', $pid ); ?>
					<tr>
						<td>Videoplattformen</td>
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

	// generates schema markup for FAQ pages
	public function faq($atts){
		ob_start();
		$q_o = get_queried_object();
		$k8_acf_faq = get_field('k8_acf_faq', $q_o->ID);
		if ( $k8_acf_faq && is_array( $k8_acf_faq ) && count( $k8_acf_faq > 0 ) ) : ?>
			<div class="k8_accord-wrr">
				<div class="k8_accord">
					<?php
					$i = 1;
					foreach ($k8_acf_faq as $value): ?>
						<div class="k8_accord-blck">
					    <input type="checkbox" <?php echo ( $i !== 1 ) ? 'checked' : ''; ?>>
					    <i></i>
					    <div class="k8_accord-head">
					    	<span><?php echo $value['quest']; ?></span>
					    </div>
					    <div class="k8_accord-txt">
					    	<div class="k8_accord-inn">
					    		<?php echo $value['ans']; ?>
					    	</div>
					    </div>
					  </div>
					<?php
					$i++;
					endforeach ?>
				</div>
			</div><!-- .k8_accord-wrr -->
			<?php
			$schema = K8Schema::getFaqPage([
				'k8_acf_faq' => $k8_acf_faq
			]);
			echo '<script type="application/ld+json">' . $schema . '</script>';
		endif;
		$html = ob_get_clean();
	  return $html;
	}
}
new K8Short;