<?php
$this->breadcrumbs=array(
	'Outlets'=>array('index'),
	$model->kode_outlet=>array('view','id'=>$model->kode_outlet),
	'Update',
);

$this->menu=array(
	array('label'=>'List Outlet', 'url'=>array('index')),
	array('label'=>'Create Outlet', 'url'=>array('create')),
	array('label'=>'View Outlet', 'url'=>array('view', 'id'=>$model->kode_outlet)),
	array('label'=>'Manage Outlet', 'url'=>array('admin')),
);
?>

<h1>Update Outlet <?php echo $model->kode_outlet; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>