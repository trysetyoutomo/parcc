<?php
$this->breadcrumbs=array(
	'Sales Items'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SalesItems', 'url'=>array('index')),
	array('label'=>'Create SalesItems', 'url'=>array('create')),
	array('label'=>'Update SalesItems', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SalesItems', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SalesItems', 'url'=>array('admin')),
);
?>

<h1>View SalesItems #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'sale_id',
		'item_id',
		'quantity_purchased',
		'item_tax',
		'item_price',
		'item_discount',
		'item_total_cost',
		'item_service',
	),
)); ?>
