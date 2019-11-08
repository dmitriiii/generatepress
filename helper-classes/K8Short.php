<?php
class K8Short
{
	public $true_icon;
	public $false_icon;
	public $tbl_end;

	public function __construct( $atts ){

		$this->true_icon = $atts['true'];
		$this->false_icon = $atts['false'];
		$this->tbl_end = '</tbody></table></div>';

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
		#[K8_SH_STREAMING]
		add_shortcode( 'K8_SH_DOWNLOAD', array( $this, 'download' ) );

		#[K8_SH_FEATURES]
		add_shortcode( 'K8_SH_FEATURES', array( $this, 'features' ) );
		#[K8_SH_ROUTER]
		add_shortcode( 'K8_SH_ROUTER', array( $this, 'router' ) );

	}

	public function tbl_start( $attr = array() ){
		$str = '<div class="k8_tbl-resp %s"><table class="k8_compare-tbl mtb-30"><tbody>';
		( isset( $attr['add_clss'] ) ) ? $add_clss = $attr['add_clss'] : $add_clss = '';
		return sprintf( $str, $add_clss );
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
		echo $this->tbl_start(['add_clss' => 'k8_short_vpndet']);
		#Connections per account
		if ( get_field( 'k8_acf_vpndet_conn', $pid ) ): ?>
			<tr>
				<td>
					<?php _e('Verbindungen pro Konto' , 'k8lang_domain'); ?>
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
		#k8_acf_vpndet_vid
		if ( get_field( 'k8_acf_vpndet_vid', $pid ) ):
			$k8_acf_vpndet_vid =	get_field( 'k8_acf_vpndet_vid', $pid ); ?>
			<tr>
				<td>
					<?php _e('Videoplattformen' , 'k8lang_domain'); ?>
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
			echo $this->tbl_start(['add_clss' => 'k8_short_prod']);
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

	#[K8_SH_INTRO]
	public function intro( $atts, $content, $tag ){
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
			echo $this->tbl_start(['add_clss' => 'k8_sh_intro']); ?>
				<tr>
					<td>
						<?php _e('Produktbezeichnung' , 'k8lang_domain'); ?>
					</td>
					<td>
						<strong>
							<?php echo $pm['cwp_rev_product_name'][0]; ?>
						</strong>
					</td>
				</tr>
				<tr>
					<td>
						<?php _e('Empfohlene Einsatzgebiete' , 'k8lang_domain'); ?>
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
			echo $this->tbl_end;
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
		ob_start();
		if( $a['output'] !== 'table' ):
		else :
			echo $this->tbl_start(['add_clss' => 'k8_sh_streaming']); ?>
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
			echo $this->tbl_end;
		endif;
		$html = ob_get_clean();
		return $html;
	}


	#[K8_SH_DOWNLOAD]
	public function download( $atts ){
		$a = shortcode_atts( array(
			'output' => 'table',
			'vpnid' => get_the_ID(),
		), $atts );
		$pid = (int)$a['vpnid'];
		ob_start();
		if( $a['output'] !== 'table' ):
		else :
			echo $this->tbl_start(['add_clss' => 'k8_sh_download']); ?>
				<tr>
					<th colspan="2">
						<?php _e('Download und Torrent' , 'k8lang_domain'); ?>
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
			echo $this->tbl_end;
		endif;
		$html = ob_get_clean();
		return $html;
	}

	#[K8_SH_FEATURES]
	public function features( $atts ){
		$a = shortcode_atts( array(
			'output' => 'table',
			'vpnid' => get_the_ID(),
		), $atts );
		$pid = (int)$a['vpnid'];
		ob_start();
		if( $a['output'] !== 'table' ):
		else :
			$termz = get_terms( array(
		    'taxonomy' => 'sonderfunktionen',
		    'hide_empty' => false,
			) );
			echo $this->tbl_start(['add_clss' => 'k8_sh_features']); ?>
				<tr>
					<th colspan="2">
						<?php _e('Sonderfunktionen' , 'k8lang_domain'); ?>
					</td>
				</tr>
				<?php
				if ( isset($termz) && is_array($termz) && count( $termz ) > 0 ) :
					foreach ($termz as $term): ?>
						<tr>
							<td>
								<?php _e($term->name , 'k8lang_domain'); ?>
							</td>
							<td>
								<?php
								echo ( has_term( $term->slug, $term->taxonomy, $pid ) ) ? $this->true_icon : $this->false_icon; ?>
							</td>
						</tr>
					<?php
					endforeach;
				endif;
			echo $this->tbl_end;
		endif;
		$html = ob_get_clean();
		return $html;
	}

	#[K8_SH_ROUTER]
	public function router( $atts ){
		$a = shortcode_atts( array(
			'output' => 'table',
			'vpnid' => get_the_ID(),
		), $atts );
		$pid = (int)$a['vpnid'];
		$valz = array(
			'asuswrt'=>'ASUS',
			'openwrt'=>'Gl-iNet',
			'dd-wrt'=>'DD-WRT',
			'tomato'=>'Tomato',
			'openvpn-udp'=>'Vilfo Router'
		);
		ob_start();
		if( $a['output'] !== 'table' ):
		else :
			echo $this->tbl_start(['add_clss' => 'k8_sh_router']); ?>
				<tr>
					<th colspan="2">
						<?php _e('Betrieb am VPN-Client Router' , 'k8lang_domain'); ?>
					</td>
				</tr>
				<tr>
					<td>
						<?php _e('Verwendung auf Routern' , 'k8lang_domain'); ?>
					</td>
					<td>
						<?php
						echo ( has_term( 'vpn-router', 'anwendungen', $pid ) ) ? $this->true_icon : $this->false_icon; ?>
					</td>
				</tr>
				<tr>
					<td>
						<?php _e('Load Balancing' , 'k8lang_domain'); ?>
					</td>
					<td>
						<?php
						echo ( has_term( 'loadbalancing', 'sonderfunktionen', $pid ) ) ? $this->true_icon : $this->false_icon; ?>
					</td>
				</tr>
				<tr>
					<td>
						<?php _e('Ausfallsfreier Betrieb' , 'k8lang_domain'); ?>
					</td>
					<td>
						<?php
						echo ( has_term( 'loadbalancing', 'sonderfunktionen', $pid ) ) ? $this->true_icon : $this->false_icon; ?>
					</td>
				</tr>
				<tr>
					<td>
						<?php _e('Eigene Router Anwendung' , 'k8lang_domain'); ?>
					</td>
					<td>
						<?php
						echo ( has_term( 'dd-wrt', 'betriebssystem', $pid ) || has_term( 'openwrt', 'betriebssystem', $pid ) || has_term( 'tomato', 'betriebssystem', $pid ) ) ? $this->true_icon : $this->false_icon; ?>
					</td>
				</tr>
				<tr>
					<td>
						<?php _e('Kompatibel mit' , 'k8lang_domain'); ?>
					</td>
					<td>
						<?php
						$i = 1;
						foreach ($valz as $k => $v) :
						 	if( has_term( $k, 'betriebssystem', $pid ) ){
						 		echo ( $i !== 1 && count( $valz ) >= $i ) ? ', ' : '';
						 		echo $v;
						 	}
						 	$i++;
						endforeach; ?>
					</td>
				</tr>
				<?php
			echo $this->tbl_end;
		endif;
		$html = ob_get_clean();
		return $html;
	}
}
new K8Short([
	'true' => '<svg class="k8-t-f" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
							 viewBox="0 0 150 150" enable-background="new 0 0 150 150" xml:space="preserve">
							<path fill="#33CC99" d="M147.7,73.9c-0.2,17.6-6.4,35.2-18.3,48.6c-2.3,2.6-4.9,5.1-7.6,7.4c-24.8,20.9-62.6,22.8-89.2,3.9
								c-3.2-2.3-6.3-4.9-9.1-7.6c-6.4-6.3-11.5-13.8-15.2-21.9C-2.6,79.7,1.2,49.8,18.5,29c5.6-6.8,12.5-12.6,20.2-16.9
								C62-1,91.4,0.3,113.6,15.3c1.1,0.7,1.4,2.2,0.7,3.3c-0.7,1.1-2.2,1.4-3.3,0.7c0,0,0,0,0,0c-7.1-3.6-13.5-7.4-21.4-9.2
								C73.4,6.4,56,9,41.7,17.3c-7,4-13.2,9.4-18.2,15.7c-5,6.3-8.9,13.5-11.2,21.2C7.5,69.5,8.6,86.4,15.4,101
								c3.4,7.2,8.1,13.8,13.8,19.3c23.5,22.5,61.7,23.5,86.3,2.2c22.2-19.3,28.2-52.9,13.7-78.7l-59.2,63.7l-0.3,0.3
								c-3.1,3.4-8.4,3.5-11.7,0.4c-0.2-0.2-0.5-0.5-0.7-0.7L32.5,78.2c-2-2.4-1.7-6,0.7-8c2.2-1.8,5.3-1.8,7.3,0l22.6,19L126,30.5l0.2-0.2
								c2.3-2.1,5.8-2,7.9,0.3c0.2,0.2,0.4,0.4,0.5,0.6C143.6,43.7,147.8,58.8,147.7,73.9z"/>
						</svg>',
	'false' => '<svg class="k8-t-f" version="1.1"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
								 viewBox="0 0 150 150" enable-background="new 0 0 150 150" xml:space="preserve">
								<path fill="#424242" d="M8.8,74.2C8.8,74.2,8.8,74.2,8.8,74.2L8.8,74.2C8.8,74.2,8.8,74.2,8.8,74.2z"/>
								<path fill="#00B2E2" d="M147.5,74.1c-0.1,7.2-1.2,14.4-3.1,21.6c-2.8,8.7-7.1,16.8-12.8,23.8c-5.7,7-12.6,13-20.4,17.5
									c-23.6,13.6-53.9,12.9-76.7-2.3c-7.4-5-13.9-11.3-19-18.6C-3.8,88.9-1.4,50.1,21.7,25.7c1.8-1.9,3.8-3.8,5.8-5.5
									C34.2,14.5,42,10,50.3,7.2c14.7-5.1,30.4-5,45.2-0.5c0,0,6.1,2.3,6.1,2.3c1.1,0.4,1.7,1.7,1.3,2.8c-0.4,1.1-1.6,1.7-2.7,1.3
									c0,0-0.2-0.1-0.2-0.1C84.2,7.4,67.9,6.2,52,12c-7.7,2.8-14.7,7-20.8,12.3C6.2,46.3,1.7,85,21.4,111.9c4.7,6.5,10.6,12,17.3,16.3
									c20.2,13,47.1,13.5,67.8,1c6.8-4.1,12.8-9.4,17.6-15.6c4.8-6.2,8.5-13.3,10.7-20.8c4.5-15,3.1-31.6-3.7-45.7
									c-2.6-5.3-5.9-10.2-9.8-14.6L83.4,72.2l23.4,23.4c3.2,3.2,3.2,8.4,0,11.6c-1.6,1.6-3.7,2.4-5.8,2.4c-2.1,0-4.2-0.8-5.8-2.4L72,84.1
									L50.2,107c-3.1,3.3-8.3,3.4-11.6,0.3c-3.3-3.1-3.4-8.3-0.3-11.6c0.1-0.1,0.2-0.2,0.3-0.3l22.9-21.8L38.5,50.6
									c-3.2-3.2-3.2-8.4,0-11.6c3.2-3.2,8.4-3.2,11.6,0l23.2,23.2l43.8-41.8l0.2-0.2c1.1-1,2.5-1.5,3.8-1.5l0.4,0c1.4,0,2.6,0.6,3.5,1.5
									c6.6,6.3,12,13.9,15.8,22.2C145.7,52.6,147.7,63.3,147.5,74.1z"/>
								<path fill="#424242" d="M8.8,74.2L8.8,74.2l0,0.1L8.8,74.2C8.8,74.2,8.8,74.2,8.8,74.2z"/>
							</svg>',
]);