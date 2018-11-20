<?php
$meja = Sales::model()->findAll("t.status = 0");
$meja = CHtml::listdata($meja,'table','table');
// print_r($meja);

 ?>
 	<option>Piih Meja</option>
 	<?php
 	$sqlno_meja = "
		select no_meja from meja
	";
	$valno_meja = Yii::app()->db->createCommand($sqlno_meja)->queryAll();
	foreach($valno_meja as $valno_meja){
		$x = $valno_meja['no_meja'];
 	?>
	<!-- <?php //for($x=1;$x<=75;$x++): ?> -->
		<?php if (!isset($meja[$x])): ?>
			<option class="option-pindah"><?php echo $x; ?></option>
		<?php endif; 
	} ?>
	<!-- <?php //endfor; ?> -->
<!-- </div> -->
<!-- <div class="option-gabung"> -->
	<?php
 	$sqlno_meja = "
		select no_meja from meja
	";
	$valno_meja = Yii::app()->db->createCommand($sqlno_meja)->queryAll();
	foreach($valno_meja as $valno_meja){
		$x = $valno_meja['no_meja'];
 	?>
	<!-- <?php //for($x=1;$x<=75;$x++): ?> -->
		<?php if (isset($meja[$x])): ?>
			<option class="option-gabung"><?php echo $x; ?></option>
		<?php endif; 
	} ?>
	<!-- <?php //endfor; ?> -->
<!-- </div> -->