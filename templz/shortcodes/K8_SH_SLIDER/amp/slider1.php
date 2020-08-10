<?php
if( isset( $rows ) && is_array( $rows ) && count( $rows ) > 0 ) : ?>
<div>
	<amp-carousel lightbox width="400" height="300" layout="responsive" type="slides">
		<?php
		foreach ($rows as $sld) :
			$attach = wp_get_attachment_image_src($sld['image'],'full'); ?>
			<!-- <div> -->
				<amp-img
					src="<?php echo $attach[0]; ?>"
					width="<?php echo $attach[1]; ?>"
					height="<?php echo $attach[2]; ?>"
					layout="responsive"
				></amp-img>
				<!-- <p><?php echo $sld['text']; ?></p> -->
			<!-- </div> -->
		<?php
		endforeach; ?>
	</amp-carousel>
</div>
<?php
endif;