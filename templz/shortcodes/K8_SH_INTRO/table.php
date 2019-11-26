<?php echo K8Html::tbl_start(['add_clss' => strtolower( $tag )]); ?>
	<tr>
		<td>
			<?php _e('Produktbezeichnung' , 'k8lang_domain'); ?>
		</td>
		<td>
			<strong>
				<?php echo( isset($pm['cwp_rev_product_name'][0]) ) ? $pm['cwp_rev_product_name'][0] : '' ; ?>
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
echo K8Html::tbl_end();