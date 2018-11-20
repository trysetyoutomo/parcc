<?php
/* @var $this SpoileController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Spoiles',
);

$this->menu=array(
	array('label'=>'Create Spoile', 'url'=>array('create')),
	array('label'=>'Manage Spoile', 'url'=>array('admin')),
);
?>

<h1>Spoiles</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
