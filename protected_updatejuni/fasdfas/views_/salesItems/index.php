<?php
$this->breadcrumbs=array(
	'Sales Items',
);

$this->menu=array(
	array('label'=>'Create SalesItems', 'url'=>array('create')),
	array('label'=>'Manage SalesItems', 'url'=>array('admin')),
);
?>

<h1>Sales Items</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
