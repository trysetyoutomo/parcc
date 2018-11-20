<?php
/* @var $this SalesHbController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Sales Hbs',
);

$this->menu=array(
	array('label'=>'Create SalesHb', 'url'=>array('create')),
	array('label'=>'Manage SalesHb', 'url'=>array('admin')),
);
?>

<h1>Sales Hbs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
