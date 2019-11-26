<?php echo K8Html::tbl_start(['add_clss' => strtolower( $tag )]); ?>
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
echo K8Html::tbl_end();