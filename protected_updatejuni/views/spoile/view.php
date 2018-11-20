<?php
/* @var $this SpoileController */
/* @var $model Spoile */

$this->breadcrumbs=array(
	'Spoiles'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Spoile', 'url'=>array('index')),
	array('label'=>'Create Spoile', 'url'=>array('create')),
	array('label'=>'Update Spoile', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Spoile', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Spoile', 'url'=>array('admin')),
);
?>

<h1>View Spoile #<?php echo $model->id; ?></h1>

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
