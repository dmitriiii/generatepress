<?php 
if( !is_array( $pid_arr ) || count( $pid_arr ) == 0 ){
	echo __('Sorry nothing found. Please check shortcode attributes!' , 'k8lang_domain');
	return;
}

echo K8Html::tbl_start([
	'add_clss' => strtolower( $tag ) . ' not-equal-width',
	'scroll' => true,
	'without_head' => true,
	'anim_clss' => true
]);
if( isset($cols_arr) && is_array($cols_arr) && count($cols_arr) > 0 ) :?>
	<thead>
  	<tr>
			<?php 
			foreach ($cols_arr as $col) : 
				echo $this->th(['class'=>$col.' '.$col.'--th']);
				switch ( trim($col) ) {
					case 'title':
						_e('Anbieter' , 'k8lang_domain');
						break;
					case 'description':
						_e('Beschreibung' , 'k8lang_domain');
						break;
					case 'speed':
						_e('Download' , 'k8lang_domain');
						echo $this->_th . $this->th(['class'=>$col.' '.$col.'--th']) .
								 __('Upload' , 'k8lang_domain');
								 // $this->_th . $this->th(['class'=>$col.' '.$col.'--th']) .
								 // __('Ping' , 'k8lang_domain');
						break;
					case 'rating':
						_e('Bewertung' , 'k8lang_domain');
						break;
					case 'recommendation':
						_e('Empfehlung' , 'k8lang_domain');
						break;
					case 'streaming-de':
						_e('Streaming (DE)' , 'k8lang_domain');
						break;
					case 'streaming-int':
						_e('Streaming (Int)' , 'k8lang_domain');
						break;
					case 'applications':
						_e('Anwendungen' , 'k8lang_domain');
						break;
					case 'security':
						_e('Datenschutz' , 'k8lang_domain');
						break;
					case 'pricing':
						_e('Preis' , 'k8lang_domain');
						break;
					case 'links':
						_e('Links' , 'k8lang_domain');
						break;
					default:
						echo '';
						break;
				}
				echo $this->_th;
			endforeach;?>
		</tr>
	</thead>
<?php 
endif; ?>



<tbody>
<?php 
if( is_array($pid_arr) && count($pid_arr)>0 ): 
	foreach ($pid_arr as $p):?>
		<tr>
			<?php 
			if( is_array($cols_arr) && count($cols_arr) > 0 ) :
				$i = 1;
				foreach ($cols_arr as $col) :
					echo ( $i == 1 ) ? $this->th(['class'=>$col.' '.$col.'--th']) : $this->td(['class'=>$col.' '.$col.'--td']);
					switch (trim($col)) {
						case 'logo':
							echo K8Html::getImgHtml([
								'img_id'=>get_post_thumbnail_id($p['pid']),
								'size'=>'thumbnail'
							]);
							break;
						case 'title':
							echo get_post_meta( $p['pid'], 'cwp_rev_product_name', true );
							break;
						case 'description':
							echo K8Help::excerptPid(30,$p['pid']);
							break;
						case 'text':
							echo K8Help::excerptPid(10,$p['pid']);
							break;
						case 'speed':
							echo $this->b . get_field('k8_acf_vpndet_down', $p['pid']) . ' kbps'. $this->_b . $this->_td .
									 $this->td(['class'=>$col.' '.$col.'--td']) . $this->b .	get_field('k8_acf_vpndet_up', $p['pid']) . ' kbps' . $this->_b;
									  // . $this->_td .
									 // $this->td(['class'=>$col.' '.$col.'--td']) . $this->b . get_field('k8_acf_vpndet_ping', $p['pid']) .' ms' . $this->_b . $this->_td;
							break;
						case 'rating':
							$progr = round( (get_post_meta( $p['pid'],'wppr_rating',true ) / 10), 1);
							echo "<span class='k8progress' data-to='$progr' id='k8_prgr_" . uniqid() . "'></span>";
							break;
						case 'recommendation':
							$anwendungen = get_the_terms( $p['pid'], 'anwendungen' );
							if ( is_array( $anwendungen ) && count( $anwendungen ) > 0 )
								echo K8H::getAcfChbx(['data'=>$anwendungen, 'label'=>'name' ]);
							break;
						case 'streaming-de':
							$k8_acf_vpndet_vid = get_field( 'k8_acf_vpndet_vid', $p['pid'] );
							if( is_array( $k8_acf_vpndet_vid ) && count( $k8_acf_vpndet_vid ) > 0 )
								echo K8H::getAcfChbx( ['data' => $k8_acf_vpndet_vid] );
							break;
						case 'streaming-int':
							$k8_acf_vpndet_vid_int = get_field( 'k8_acf_vpndet_vid_int', $p['pid'] );
							if( is_array( $k8_acf_vpndet_vid_int ) && count( $k8_acf_vpndet_vid_int ) > 0 )
								echo K8H::getAcfChbx( ['data' => $k8_acf_vpndet_vid_int] );
							break;
						case 'applications':
							$arz = [
								'windows'=>'betriebssystem',
								'macosx'=>'betriebssystem',
								'android'=>'betriebssystem',
								'apple-ios'=>'betriebssystem',
								'linux'=>'betriebssystem',
								'firetv'=>'betriebssystem',
								'vpn-router'=>'anwendungen'
							];
							echo $this->ul(['class'=>'list--compare']);
							foreach ($arz as $k => $v):
								$k_term_lab = get_term_by('slug', $k, $v)->name;
								echo $this->li().
										 	$this->b.
										 		str_replace("(ASUS)", "", $k_term_lab).
										 	$this->_b.
										 	((has_term( $k, $v, $p['pid'] ) ) ? $this->true_icon : $this->false_icon).
										 $this->_li;
							endforeach;
							echo $this->_ul;
							break;
						case 'security':
							$arz = [
								'keine-logfiles'=>'sonderfunktionen',
								'killswitch'=>'sonderfunktionen',
								'eigene-dns'=>'sonderfunktionen',
								'dedicated-server'=>'sonderfunktionen',
								'vpn-zu-tor'=>'sonderfunktionen',
								'own-hardware'=>'sonderfunktionen'
							];
							echo $this->ul(['class'=>'list--compare']);
							foreach ($arz as $k => $v):
								echo $this->li().
										 	$this->b.
										 		get_term_by('slug', $k, $v)->name.
										 	$this->_b.
										 	((has_term( $k, $v, $p['pid'] ) ) ? $this->true_icon : $this->false_icon).
										 $this->_li;
							endforeach;
							echo $this->_ul;
							break;
						case 'pricing':
							echo "<p>" .
										__('ab' , 'k8lang_domain') . ' ' .
										$this->b . get_field( 'k8_acf_vpndet_avg', $p['pid'] ) . ' ' .
											$this->em . get_field('k8_acf_vpndet_curr', $p['pid'])['label'] . $this->_em  . 
										$this->_b .
									 "<br/>\n".__('pro Monat' , 'k8lang_domain')."<br/>\n".
									 		get_field('k8_acf_vpndet_conn', $p['pid'])['label'] . ' ' .
									 		__('gleichzeitige' , 'k8lang_domain') . "<br/>\n" .
									 		__('Verbindungen möglich' , 'k8lang_domain') .
									 	"</p>";
							break;
						case 'links':
							$linkz = get_post_meta( $p['pid'],'wppr_links',true );
							// print_r($linkz);
							if( is_array($linkz) && count($linkz)>0 ):
								foreach ( $linkz as $kl ) :
									echo '<a rel="nofollow" class="dwnd__butt grn" target="__blank" href="'.$kl.'" >' .
									// K8Html::getImgHtml([
									// 	'img_id'=>get_post_thumbnail_id($p['pid']),
									// 	'size'=>array(30,30)
									// ]) .
									__('Webseite' , 'k8lang_domain') .
									'<i class="fas fa-sitemap"></i> </a>';
								endforeach;
							endif;

							echo '<a class="dwnd__butt sm" href="' . get_permalink( $p['pid'] ) . '">
										 Testbericht
										 <i class="fab fa-artstation"></i>
										</a>';
							break;
						default:
							echo '';
							break;
					}
					echo ( $i == 1 ) ? $this->_th : $this->_td;
					$i++;
				endforeach;
			endif; ?>
		</tr>
	<?php 
	endforeach;
endif ?>



<?php
echo K8Html::tbl_end();
?>


<!-- <div class="table-scroll">
  <table>
   
  </table>
</div> -->