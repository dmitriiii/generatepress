<?php wp_enqueue_style('K8_SHORT_FAQ-css'); ?>
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