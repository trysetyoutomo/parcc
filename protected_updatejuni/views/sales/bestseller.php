<script type="text/javascript">
    
</script>
		
<h1>Laporan Penjualan Periode</h1>
<h2><b>Pesanan Terbanyak</b></h2>
	
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
		<b>Kategori</b>
		<select name="kategori" id="kategori">
			<option value="">---Pilih Kategori---</option>
			<option value="makanan">Makanan</option>
			<option value="minuman">Minuman</option>
			<option value="detail">Detail</option>
			<option value="dema">Detail Makanan</option>
			<option value="demi">Detail Minuman</option>
			<!-- <option value="all">Semua</option> -->
		</select>
	</div>
			
	<div class="row buttons">
		<?php echo CHtml::Button('Show', array('submit'=>array('sales/reportbestseller'))); ?>
		<?php echo CHtml::Button('Export', array('submit'=>array('sales/reportbestsellerexport'))); ?>
	</div>
<?php $this->endWidget(); ?>

