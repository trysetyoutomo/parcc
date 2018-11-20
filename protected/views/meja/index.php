<?php
/* @var $this MejaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Mejas',
);

$this->menu=array(
	array('label'=>'Create Meja', 'url'=>array('create')),
	array('label'=>'Manage Meja', 'url'=>array('admin')),
);
?>

<h1>Mejas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
