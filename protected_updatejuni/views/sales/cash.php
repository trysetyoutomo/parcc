<?php
// $this->menu=array(
	// array('label'=>'Create Sales', 'url'=>array('create')),
	// array('label'=>'Manage Sales', 'url'=>array('admin')),
// );
?>
<fieldset>
	<legend>
		
<h1>Laporan Pembayaran Harian</h1>
	</legend>

<?php $form=$this->beginWidget('CActiveForm',array(
	'action'=>Yii::app()->createUrl('sales/cashReport'),
	'method'=>'get',
)); ?>

<div class="row">
		<?php
	
	$this->widget('zii.widgets.jui.CJuiDatePicker', array(
		'name'=>'Sales[date]',
		'attribute'=>'date',
		'value'=>$tgl,
//		'model'=>$model,
		// additional javascript options for the date picker plugin
		'options'=>array(
			'dateFormat'=>'yy-mm-dd',
			'showAnim'=>'fold', // 'show' (the default), 'slideDown', 'fadeIn', 'fold'
			'showOn'=>'button', // 'focus', 'button', 'both'
			'buttonText'=>Yii::t('ui','Select form calendar'),
			'buttonImage'=>Yii::app()->request->baseUrl.'/images/calendar.png',
			'buttonImageOnly'=>true,
		),
		'htmlOptions'=>array(
			'style'=>'height:20px;;width:80px;vertical-align:top;display:inline-block'
		),
	));

	$this->widget('zii.widgets.jui.CJuiDatePicker', array(
		'name'=>'Sales[date2]',
		'attribute'=>'date',
		'value'=>$tgl2,
//		'model'=>$model,
		// additional javascript options for the date picker plugin
		'options'=>array(
			'dateFormat'=>'yy-mm-dd',
			'showAnim'=>'fold', // 'show' (the default), 'slideDown', 'fadeIn', 'fold'
			'showOn'=>'button', // 'focus', 'button', 'both'
			'buttonText'=>Yii::t('ui','Select form calendar'),
			'buttonImage'=>Yii::app()->request->baseUrl.'/images/calendar.png',
			'buttonImageOnly'=>true,
		),
		'htmlOptions'=>array(
			'style'=>'height:20px;;width:80px;vertical-align:top;;display:inline-block'
		),
	));

$this->renderPartial('summarycash',array('summary'=>$cashsum));
?>
	</div>
			<?php echo CHtml::submitButton('Cari'); ?>
<?php $this->endWidget(); ?>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'sales-grid',
	'dataProvider'=>$datacash,
	'columns'=>array(
		array(
			'header'=>'No.',
			'value'=>'($this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize) + array_search($data,$this->grid->dataProvider->getData())+1',
		),
		// 'id',
		// 'date',
		array(
			'name'=>'id',
			'header'=>'no faktur',
			//'value'=>$data->date
			// 'value'=>'date("Y-m-d",strtotime($data->date))',
			// 'value'=>'date('d M Y', strtotime($model['date'])'
		),
		array(
			'name'=>'date',
			'header'=>'Tanggal',
			'value'=>$data->date
			// 'value'=>'date("Y-m-d",strtotime($data->date))',
			// 'value'=>'date('d M Y', strtotime($model['date'])'
		),
		// 'total_cost',
		array(
			'name'=>'total',
			'type'=>'number',
			'htmlOptions'=>array('style'=>'text-align:right'),
			'class'=>'ext.gridcolumns.TotalColumn',
//			'value'=>'$data->nilai',
			// 'type'=>'number',
			'footer'=>true,
			// 'htmlOptions'=>array('style'=>'text-align:right'),

		),
		// 'compliment',
		array(
			'name'=>'cash',
			'header'=>'KAS',
			'type'=>'number',
			'htmlOptions'=>array('style'=>'text-align:right'),
			'class'=>'ext.gridcolumns.TotalColumn',
//			'value'=>'$data->nilai',
			// 'type'=>'number',
			'footer'=>true,
			// 'htmlOptions'=>array('style'=>'text-align:right'),

		),
		array(
			'name'=>'compliment',
			'header'=>'Komplimen',
			'type'=>'number',
			'htmlOptions'=>array('style'=>'text-align:right'),
			'class'=>'ext.gridcolumns.TotalColumn',
//			'value'=>'$data->nilai',
			// 'type'=>'number',
			'footer'=>true,
			// 'htmlOptions'=>array('style'=>'text-align:right'),

		),		
		array(
			'name'=>'edc_niaga',
			'header'=>'EDC NIAGA',
			'type'=>'number',
			'htmlOptions'=>array('style'=>'text-align:right'),
			'class'=>'ext.gridcolumns.TotalColumn',
//			'value'=>'$data->nilai',
			// 'type'=>'number',
			'footer'=>true,
			// 'htmlOptions'=>array('style'=>'text-align:right'),

		),array(
			'name'=>'edc_bca',
			'header'=>'EDC BCA',
			'type'=>'number',
			'htmlOptions'=>array('style'=>'text-align:right'),
			'class'=>'ext.gridcolumns.TotalColumn',
//			'value'=>'$data->nilai',
			// 'type'=>'number',
			'footer'=>true,
			// 'htmlOptions'=>array('style'=>'text-align:right'),

		),
		array(
			'name'=>'voucher',
			'type'=>'number',
			'htmlOptions'=>array('style'=>'text-align:right'),
			'class'=>'ext.gridcolumns.TotalColumn',
//			'value'=>'$data->nilai',
			// 'type'=>'number',
			'footer'=>true,
			// 'htmlOptions'=>array('style'=>'text-align:right'),

		),array(
			'name'=>'dll',
			'type'=>'number',
			'htmlOptions'=>array('style'=>'text-align:right'),
			'class'=>'ext.gridcolumns.TotalColumn',
//			'value'=>'$data->nilai',
			// 'type'=>'number',
			'footer'=>true,
			// 'htmlOptions'=>array('style'=>'text-align:right'),

		),		
	),
)); ?>
</fieldset>
