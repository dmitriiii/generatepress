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
?>

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