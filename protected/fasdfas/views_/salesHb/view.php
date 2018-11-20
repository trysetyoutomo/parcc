<?php
/* @var $this SalesHbController */
/* @var $model SalesHb */

$this->breadcrumbs=array(
	'Sales Hbs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SalesHb', 'url'=>array('index')),
	array('label'=>'Create SalesHb', 'url'=>array('create')),
	array('label'=>'Update SalesHb', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SalesHb', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SalesHb', 'url'=>array('admin')),
);
?>

<h1>View SalesHb #<?php echo $model->id; ?></h1>

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
