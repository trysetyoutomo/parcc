<?php
$this->breadcrumbs=array(
	'Vouchers',
);

$this->menu=array(
	array('label'=>'Create Voucher', 'url'=>array('create')),
	array('label'=>'Manage Voucher', 'url'=>array('admin')),
);
?>

<h1>Vouchers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
