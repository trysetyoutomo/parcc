<?php
$this->breadcrumbs=array(
	'Outlets'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Outlet', 'url'=>array('index')),
	array('label'=>'Manage Outlet', 'url'=>array('admin')),
);
?>

<h1>Create Outlet</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>