<?php 
if( isset( $rows ) && is_array( $rows ) && count( $rows ) > 0 ) : ?>
	<div class="k8-sl__wrr k8-dwnd__sl w-scrns k8anim k8anim_brd mtb-40">
		<span class="k8anim_brd-item tp"></span>
		<span class="k8anim_brd-item rght"></span>
		<span class="k8anim_brd-item bttm"></span>
		<span class="k8anim_brd-item lft"></span>
		<div class="k8-sl__control k8-sl__prev"><i class="fas fa-chevron-left"></i></div>
		<div class="k8-sl__control k8-sl__next"><i class="fas fa-chevron-right"></i></div>
		<div class="k8-sl ">
			<?php
			foreach ($rows as $sld) : ?>
				<div>
					<div class="k8-sl__itt">
						<a href="<?php echo K8Help::getImgUrl( $sld['image'], 'full' ); ?>" data-lightbox="roadtrip">
							<?php 
								echo K8Html::getImgHtml(array(
									'img_id' => $sld['image'],
									'size' => array(300,300),
								)); 
							?>
						</a>
						<?php echo $sld['text']; ?>
					</div>
				</div>
				<?php
			endforeach; ?>
		</div>
	</div>
<?php
endif;
?>