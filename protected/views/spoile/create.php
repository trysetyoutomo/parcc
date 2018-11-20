<?php
/* @var $this SpoileController */
/* @var $model Spoile */

$this->breadcrumbs=array(
	'Spoiles'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Spoile', 'url'=>array('index')),
	array('label'=>'Manage Spoile', 'url'=>array('admin')),
);
?>

<h1>Create Spoile</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>