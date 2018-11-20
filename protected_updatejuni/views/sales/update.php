<?php
/* @var $this SalesController */
/* @var $model Sales */

$this->breadcrumbs=array(
	'Sales'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Sales', 'url'=>array('index')),
	array('label'=>'Create Sales', 'url'=>array('create')),
	array('label'=>'View Sales', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Sales', 'url'=>array('admin')),
);
?>

<h1>Update Sales <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>