<?php 
if( isset( $rows ) && is_array( $rows ) && count( $rows ) > 0 ) : ?>
	<div class="k8-sl__wrr k8-dwnd__sl w-scrns">
		<div class="k8-sl__control k8-sl__prev"><i class="fa fa-chevron-left" aria-hidden="true"></i></div>
		<div class="k8-sl__control k8-sl__next"><i class="fa fa-chevron-right" aria-hidden="true"></i></div>
		<div class="k8-sl ">
			<?php
			foreach ($rows as $sld) : ?>
				<div>
					<div class="k8-sl__itt">
						<a href="<?php echo K8Help::getImgUrl( $sld['image'], 'full' ); ?>" data-lightbox="roadtrip">
							<?php 
								echo K8Html::getImgHtml(array(
									'img_id' => $sld['image'],
									'size' => 'medium',
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