<?php
/* @var $this ItemsController */
/* @var $model Items */

$this->breadcrumbs=array(
	'Items'=>array('index'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List Items', 'url'=>array('index')),
	array('label'=>'Mengatur Menu', 'url'=>array('admin')),
);
?>

<h1>Menu baru</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>