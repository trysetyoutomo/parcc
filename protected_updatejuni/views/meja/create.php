<?php
/* @var $this MejaController */
/* @var $model Meja */

$this->breadcrumbs=array(
	'Mejas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Meja', 'url'=>array('index')),
	array('label'=>'Manage Meja', 'url'=>array('admin')),
);
?>

<h1>Create Meja</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>