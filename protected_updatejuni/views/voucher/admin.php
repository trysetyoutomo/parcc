<?php
$this->breadcrumbs=array(
	'Vouchers'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Voucher', 'url'=>array('index')),
	array('label'=>'Create Voucher', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('voucher-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1 style="margin-top:25px">Kelola Voucher</h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'voucher-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'kode_voucher',
		'kategori',
		'jenis',
		'nominal',
		'persentase',
		'masa_berlaku',
		// array (
		// 	'name'=>'fixed',
		// 	'value'=>'Fix '
		// ),

		// array(
		// 	'name'=>'status',
		// 	'value'=>'$data->status==1 ? "telah digunakan" : "Belum digunakan" ',
		// ),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
