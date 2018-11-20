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
<center>
<h1 style="text-align:center">Menu baru</h1>
</center>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>