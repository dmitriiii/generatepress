<?php //Something ?>
<amp-accordion class="k8amp-accord">
	<?php
	$i = 1;
	foreach ($k8_acf_faq as $value): ?>
		<section <?php echo ( $i == 1 ) ? 'expanded' : ''; ?>>
	    <h4><?php echo $value['quest']; ?></h4>
	    <?php echo $value['ans']; ?>
	  </section>
	<?php
	$i++;
	endforeach ?>
</amp-accordion>