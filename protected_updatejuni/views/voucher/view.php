<?php
$this->breadcrumbs=array(
	'Vouchers'=>array('index'),
	$model->kode_voucher,
);

$this->menu=array(
	array('label'=>'List Voucher', 'url'=>array('index')),
	array('label'=>'Create Voucher', 'url'=>array('create')),
	array('label'=>'Update Voucher', 'url'=>array('update', 'id'=>$model->kode_voucher)),
	array('label'=>'Delete Voucher', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->kode_voucher),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Voucher', 'url'=>array('admin')),
);
?>

<h1>View Voucher #<?php echo $model->kode_voucher; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'kode_voucher',
		'jenis',
		'nominal',
		'masa_berlaku',
	),
)); ?>
