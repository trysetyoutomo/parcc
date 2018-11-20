<script type="text/javascript">
    
</script>
		
<h1>Laporan Penjualan Periode</h1>
	
<?php $form=$this->beginWidget('CActiveForm',array(
)); ?>
<div class="row">
<b>Start Periode</b>
<?php
	$this->widget('zii.widgets.jui.CJuiDatePicker', array(
		// 'name'=>'Sales[date]',
		'name'=>'tanggal_awal',
		'id'=>'tanggal_awal',
		'attribute'=>'date',
			//'model'=>$model,
			// additional javascript options for the date picker plugin
		'options'=>array(
			'dateFormat'=>'yy-mm-dd',
			'showAnim'=>'fold', // 'show' (the default), 'slideDown', 'fadeIn', 'fold'
			'showOn'=>'button', // 'focus', 'button', 'both'
			'buttonText'=>Yii::t('ui','Select form calendar'),
			'buttonImage'=>Yii::app()->request->baseUrl.'/images/calendar.png',
			'buttonImageOnly'=>true,
		),
		'value'=>$tgl,
		'htmlOptions'=>array(
			// 'style'=>'height:20px;'
			'style'=>'height:20px;;width:80px;vertical-align:top'
		),
	));
?>
<b>     End Periode</b>
<?php
	$this->widget('zii.widgets.jui.CJuiDatePicker', array(
		// 'name'=>'Sales[date]',
		'name'=>'tanggal_akhir',
		'id'=>'tanggal_akhir',
		'attribute'=>'date',
			//'model'=>$model,
			// additional javascript options for the date picker plugin
		'options'=>array(
			'dateFormat'=>'yy-mm-dd',
			'showAnim'=>'fold', // 'show' (the default), 'slideDown', 'fadeIn', 'fold'
			'showOn'=>'button', // 'focus', 'button', 'both'
			'buttonText'=>Yii::t('ui','Select form calendar'),
			'buttonImage'=>Yii::app()->request->baseUrl.'/images/calendar.png',
			'buttonImageOnly'=>true,
		),
		'value'=>$tgl,
		'htmlOptions'=>array(
			// 'style'=>'height:20px;'
			'style'=>'height:20px;;width:80px;vertical-align:top'
		),
	));
?>

<select name="kategori" id="kategori">
		<!-- <option value="">---Pilih Pembayaran---</option> -->
		<option value="tnpacomplmnt">Pendapatan</option>
		<option value="complmnt">Compliment(Biaya)</option>
		<!-- <option value="all">Semua</option> -->
	</select>
	</div>
			
	<div class="row buttons">
		<?php echo CHtml::Button('Show', array('submit'=>array('sales/periodereport'))); ?>
		<?php echo CHtml::Button('Export', array('submit'=>array('sales/periodereportexport'))); ?>
	</div>
<?php $this->endWidget(); ?>

