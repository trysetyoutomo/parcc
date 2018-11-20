<?php
$this->breadcrumbs=array(
	'Vouchers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Voucher', 'url'=>array('index')),
	array('label'=>'Manage Voucher', 'url'=>array('admin')),
);
?>
<br>
<br>
<h1> Voucher baru</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>