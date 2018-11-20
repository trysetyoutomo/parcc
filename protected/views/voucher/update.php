<?php
$this->breadcrumbs=array(
	'Vouchers'=>array('index'),
	$model->kode_voucher=>array('view','id'=>$model->kode_voucher),
	'Update',
);

$this->menu=array(
	array('label'=>'List Voucher', 'url'=>array('index')),
	array('label'=>'Create Voucher', 'url'=>array('create')),
	array('label'=>'View Voucher', 'url'=>array('view', 'id'=>$model->kode_voucher)),
	array('label'=>'Manage Voucher', 'url'=>array('admin')),
);
?>

<h1>Update Voucher <?php echo $model->kode_voucher; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>