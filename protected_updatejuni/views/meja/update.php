<?php
/* @var $this MejaController */
/* @var $model Meja */

$this->breadcrumbs=array(
	'Mejas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Meja', 'url'=>array('index')),
	array('label'=>'Create Meja', 'url'=>array('create')),
	array('label'=>'View Meja', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Meja', 'url'=>array('admin')),
);
?>

<h1>Update Meja <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>