<?php if( !is_array( $pid_arr ) || count( $pid_arr ) == 0 ){
	echo 'Sorry nothing found';
	return;
}

if( !is_array( $tabz ) || count( $tabz ) == 0 ){
	echo 'Sorry no tabs found';
	return;
}

if( !is_array( $cust_fields ) || count( $pid_arr ) == 0 ){
	echo 'Sorry no custom fields found';
	return;
}
// echo '<pre>';
// print_r( get_defined_vars() );
// echo '</pre>';

// echo '<pre>';
$m5_rou_id_prod_img = get_field('m5_rou_id_prod_img',$pid_arr[0]['pid']);
$m5_rou_id_var_img = get_field('m5_rou_id_var_img',$pid_arr[0]['pid']); 

$img_ids = array_merge( [$m5_rou_id_prod_img], $m5_rou_id_var_img );

// print_r( get_field('m5_rou_id_prod_img',$pid_arr[0]['pid']) );
// print_r( get_field('m5_rou_id_var_img',$pid_arr[0]['pid']) );

// echo '<pre>';
// print_r( $img_ids );
// echo '</pre>';

// echo '</pre>';
?>


<?php 
if ( is_array($img_ids) && count($img_ids) > 0 ): ?>
	<div class="m5-rou__wrapper">
		<div class="m5-rou__carousel--wrapper m5-rou__carousel--wrapper-1 wrapper">
			<div class="m5-rou__carousel m5-rou__carousel-1">
				<?php 
				foreach ($img_ids as $img_id): ?>
					<div>
						<div class="m5-rou__item">
							<a href="<?php echo wp_get_attachment_image_src( $img_id, 'full' )[0]; ?>" class="m5-rou__item-link" rel="nofollow noreferer noopener">
								<?php echo wp_get_attachment_image( $img_id, 'medium_large', false, $attr = ['class'=>'m5-rou__img'] ); ?>
							</a>
						</div>
					</div>
				<?php 
				endforeach ?>
			</div>
		</div>

		<div class="m5-rou__carousel--wrapper m5-rou__carousel--wrapper-2 wrapper">
			<div class="m5-rou__carousel m5-rou__carousel-2">
				<?php 
				foreach ($img_ids as $img_id): ?>
					<div>
						<div class="m5-rou__item">
							<?php echo wp_get_attachment_image( $img_id, [80,80], false, $attr = ['class'=>'m5-rou__img'] ); ?>
						</div>
					</div>
				<?php 
				endforeach ?>
			</div>
		</div>
	</div><!-- .m5-rou__wraper -->
<?php 
endif ?>


<div class="m5-tab__wrapper">
	<ul class="m5-tab__buttons">
		<?php
		$i=1;
		foreach ($tabz as $k=>$v): ?>
			<li data-target="<?php echo $v['val']; ?>" class="m5-tab__button <?php echo($i == 1) ? 'active' : ''; ?>"><?php echo $v['label']; ?></li>
		<?php
		$i++;
		endforeach; ?>
	</ul>
	<div class="m5-tab__text">
		<?php
		$i=1;
		foreach ($tabz as $k=>$v):
			?>
			<div id="<?php echo $v['val']; ?>" class="m5-tab__content <?php echo($i == 1) ? 'active' : ''; ?>">
				<?php
				echo K8Html::tbl_start(['add_clss' => strtolower( $tag )]);

					foreach ($cust_fields as $cf) {
					 	if (strpos($cf, $k) === false)
					 		continue;

					 	$cf_obj =	get_field_object( $cf, $pid_arr[0]['pid']);
					 	switch ($cf_obj['type']) {
					 		case 'image':
					 			continue;
					 			break;
					 		case 'gallery':
					 			continue;
					 			break;
					 		case 'radio':
					 			echo $this->tr .
											K8Html::tdHead( ['txt'=>$cf_obj['label']] ) .
											$this->td .
												$cf_obj['value']['label'] .
											$this->_td .
										 $this->_tr;
					 			break;
					 		case 'checkbox':
					 			$toShow = implode( ', ', array_column($cf_obj['value'], 'label') );
					 			echo $this->tr .
											K8Html::tdHead( ['txt'=>$cf_obj['label']] ) .
											$this->td .
												( ($toShow != '') ? $toShow : $this->notset_icon ) .
											$this->_td .
										 $this->_tr;
					 			break;
					 		case 'true_false':
					 			echo $this->tr .
											K8Html::tdHead( ['txt'=>$cf_obj['label']] ) .
											$this->td .
												( ($cf_obj['value'] === 1) ? $this->true_icon : $this->false_icon) .
											$this->_td .
										 $this->_tr;
					 			break;
					 		default:
					 			echo $this->tr .
											K8Html::tdHead( ['txt'=>$cf_obj['label']] ) .
											$this->td .
												(	(trim($cf_obj['value']) != '') ? $cf_obj['value'] : $this->notset_icon ) .
											$this->_td .
										 $this->_tr;
					 			break;
					 	}
					 	// echo '<pre>';
					 	// print_r($cf_obj);
					 	// echo '</pre>';
					 }

					echo K8Html::tbl_end();
				?>
			</div><!-- END .m5-tab__content -->
		<?php
		$i++;
		endforeach; ?>
	</div>
</div>

<?php
// echo '<pre>';
// print_r( get_defined_vars() );
// echo '</pre>';