<?php
$this->breadcrumbs=array(
	'Outlets'=>array('index'),
	$model->kode_outlet,
);

$this->menu=array(
	array('label'=>'List Outlet', 'url'=>array('index')),
	array('label'=>'Create Outlet', 'url'=>array('create')),
	array('label'=>'Update Outlet', 'url'=>array('update', 'id'=>$model->kode_outlet)),
	array('label'=>'Delete Outlet', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->kode_outlet),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Outlet', 'url'=>array('admin')),
);
?>

<h1>View Outlet #<?php echo $model->kode_outlet; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'kode_outlet',
		'nama_outlet',
		'nama_owner',
		'jenis_outlet',
		'persentase_hasil',
		'status',
	),
)); ?>
