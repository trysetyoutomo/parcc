<?php
/* @var $this MejaController */
/* @var $model Meja */

$this->breadcrumbs=array(
	'Mejas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Meja', 'url'=>array('index')),
	array('label'=>'Create Meja', 'url'=>array('create')),
	array('label'=>'Update Meja', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Meja', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Meja', 'url'=>array('admin')),
);
?>

<h1>View Meja #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'no_meja',
		'status',
	),
)); ?>
