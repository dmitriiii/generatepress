<?php echo K8Html::tbl_start(['add_clss' => strtolower( $tag )]);
foreach ($arr as $tax_name => $tax_label) : ?>
	<tr>
		<td><?php echo $tax_label; ?></td>
		<td>
		<?php
			$termz = get_the_terms( $pid, $tax_name );
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
echo K8Html::tbl_end();