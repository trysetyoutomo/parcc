<?php
/* @var $this SalesHbController */
/* @var $model SalesHb */

$this->breadcrumbs=array(
	'Sales Hbs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SalesHb', 'url'=>array('index')),
	array('label'=>'Create SalesHb', 'url'=>array('create')),
	array('label'=>'View SalesHb', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SalesHb', 'url'=>array('admin')),
);
?>

<h1>Update SalesHb <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>