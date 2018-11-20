<?php
/* @var $this SalesController */
/* @var $model Sales */

$this->breadcrumbs=array(
	'Sales'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Sales', 'url'=>array('index')),
	array('label'=>'Create Sales', 'url'=>array('create')),
	array('label'=>'Update Sales', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Sales', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Sales', 'url'=>array('admin')),
);
?>

<h1>View Sales #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'date',
		'customer_id',
		'sale_sub_total',
		'sale_discount',
		'sale_service',
		'sale_tax',
		'sale_total_cost',
		'sale_payment',
		'paidwith_id',
		'total_items',
		'branch',
		'user_id',
		'table',
		'comment',
		'status',
	),
)); ?>
