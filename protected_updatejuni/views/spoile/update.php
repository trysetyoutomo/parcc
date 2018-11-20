<?php
/* @var $this SpoileController */
/* @var $model Spoile */

$this->breadcrumbs=array(
	'Spoiles'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Spoile', 'url'=>array('index')),
	array('label'=>'Create Spoile', 'url'=>array('create')),
	array('label'=>'View Spoile', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Spoile', 'url'=>array('admin')),
);
?>

<h1>Update Spoile <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>