<?php
class K8Short
{
	public $true_icon;
	public $false_icon;
	public $tbl_start;
	public $tbl_end;

	public $tbl_start_hid;
	public $tbl_end_hid;

	public function __construct(){

		$this->true_icon = file_get_contents( get_template_directory() . '/k8/assets/svg/true.svg' );
		$this->false_icon = file_get_contents( get_template_directory() . '/k8/assets/svg/false.svg' );
		$this->tbl_start = '<table class="k8_compare-tbl mtb-30"><tbody>';
		$this->tbl_end = '</tbody></table>';
		
		$this->tbl_start_hid = '<table class="k8_compare-tbl mtb-30" style="display: none;">';
		$this->tbl_end_hid = '</tbody></table>';

		#Show table with taxonomies Data
		add_shortcode( 'k8_short_prod', array( $this, 'vpn_tax') );
		#Show table with vpn details
		add_shortcode( 'k8_short_vpndet', array( $this, 'vpn_det') );
		#[K8_SHORT_YT id="dkPLIw9aZwY"]
		add_shortcode( 'K8_SHORT_YT', array( $this, 'yt' ) );
		#[K8_SHORT_FAQ] generates schema markup for FAQ pages
		add_shortcode( 'K8_SHORT_FAQ', array( $this, 'faq' ) );
		
		#[K8_SH_INTRO] 
		add_shortcode( 'K8_SH_INTRO', array( $this, 'intro' ) );

		#[K8_SH_STREAMING]
		add_shortcode( 'K8_SH_STREAMING', array( $this, 'streaming' ) );
		
		
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
		ob_start();
		echo $this->tbl_start;
		#Connections per account
		if ( get_field( 'k8_acf_vpndet_conn', $pid ) ): ?>
			<tr>
				<td>
					<?php echo __('Verbindungen pro Konto' , 'k8lang_domain'); ?>
				</td>
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
				<td>
					<?php echo __('Testmöglichkeiten' , 'k8lang_domain'); ?>
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
		#k8_acf_vpndet_vid
		if ( get_field( 'k8_acf_vpndet_vid', $pid ) ):
			$k8_acf_vpndet_vid =	get_field( 'k8_acf_vpndet_vid', $pid ); ?>
			<tr>
				<td>
					<?php echo __('Videoplattformen' , 'k8lang_domain'); ?>
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
		echo $this->tbl_end;
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
		if( is_array( $arr ) && count( $arr ) > 0 ):
			echo $this->tbl_start;
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
			endforeach;
			echo $this->tbl_end;
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

	#[K8_SH_SERVICE_INTRO] 
	public function intro( $atts ){
		$a = shortcode_atts( array(
			'output' => 'table',
			'vpnid' => get_the_ID(),
		), $atts );
		$pid = (int)$a['vpnid'];
		$pm =	get_post_meta( $pid );
		$termz =	get_the_terms( $pid, 'anwendungen' );
		ob_start();
		if( $a['output'] !== 'table' ):
		else : 
			echo $this->tbl_start_hid; ?>
				<tr>
					<td>
						<?php echo __('Produktbezeichnung' , 'k8lang_domain'); ?>
					</td>
					<td>
						<strong>
							<?php echo $pm['cwp_rev_product_name'][0]; ?>
						</strong>
					</td>
				</tr>
				<tr>
					<td>
						<?php echo __('Empfohlene Einsatzgebiete' , 'k8lang_domain'); ?>
					</td>
					<td>
						<?php 
						if ( is_array( $termz ) && count( $termz ) > 0 ) :
							$cc=1;
							foreach ($termz as $term) :
								echo "<strong>" . $term->name . "</strong>";
								echo( count( $termz ) > $cc ) ? ', ' : '';
								$cc++;
							endforeach;
						endif; ?>
					</td>
				</tr>
		<?php
			echo $this->tbl_end_hid;
		endif;
		$html = ob_get_clean();
		return $html;
	}


	#[K8_SH_STREAMING]
	public function streaming( $atts ){
		$a = shortcode_atts( array(
			'output' => 'table',
			'vpnid' => get_the_ID(),
		), $atts );
		$pid = (int)$a['vpnid'];
		$pm =	get_post_meta( $pid );
		ob_start();
		if( $a['output'] !== 'table' ):
		else : 
			echo $this->tbl_start_hid; ?>
				<tr>
					<td>
						<?php _e('Streaming von TV und Videoinhalten' , 'k8lang_domain'); ?>
					</td>
					<td></td>
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
			echo $this->tbl_end_hid;
		endif;
		$html = ob_get_clean();
		return $html;
	}


}
new K8Short;