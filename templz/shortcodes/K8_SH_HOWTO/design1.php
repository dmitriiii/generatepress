<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// echo '<pre>';
// print_r( get_defined_vars() );
// echo '</pre>';

if( is_array( $k8_acf_howto_stp ) && count( $k8_acf_howto_stp ) > 0 ) : ?>
	<div class="k8howto__wrr clearfix">
		<h2><?php echo $k8_title; ?></h2>
		<div class="clearfix">
			<?php echo apply_filters('the_content', $k8_content); ?>
		</div>
		<?php 
		$c = 1;
		foreach ($k8_acf_howto_stp as $item): ?>
			<div class="k8howto__item" id="howto_<?php echo $c; ?>">
				<div class="k8howto__img">
					<?php echo K8Html::getImgHtml([
						'img_id' => $item['img'],
						'size' => 'medium',
					]); ?>
				</div>
				<div class="k8howto__txt clearfix">
					<div class="clearfix">
						<div class="k8howto__num">
							<?php echo $item['num']; ?>
						</div>
						<div class="k8howto__head">
							<?php echo $item['head']; ?>
						</div>
					</div>
					<div class="k8howto__txt2">
						<?php echo $item['txt']; ?>
					</div>
				</div>
			</div><!-- .k8howto__item -->
		<?php 
		$c++;
		endforeach ?>
	</div>
<?php
endif;