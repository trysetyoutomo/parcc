<?php
$this->breadcrumbs=array(
	'Outlets',
);

$this->menu=array(
//	array('label'=>'Create Outlet', 'url'=>array('create')),
	array('label'=>'Manage Outlet', 'url'=>array('admin')),
);
?>

<h1>Outlets</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
