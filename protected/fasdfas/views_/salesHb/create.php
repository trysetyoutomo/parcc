<?php
/* @var $this SalesHbController */
/* @var $model SalesHb */

$this->breadcrumbs=array(
	'Sales Hbs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SalesHb', 'url'=>array('index')),
	array('label'=>'Manage SalesHb', 'url'=>array('admin')),
);
?>

<h1>Create SalesHb</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>