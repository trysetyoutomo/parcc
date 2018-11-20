<?php
/* @var $this LogAktivitasController */
/* @var $model LogAktivitas */

$this->breadcrumbs=array(
	'Log Aktivitases'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List LogAktivitas', 'url'=>array('index')),
	array('label'=>'Create LogAktivitas', 'url'=>array('create')),
	array('label'=>'Update LogAktivitas', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete LogAktivitas', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage LogAktivitas', 'url'=>array('admin')),
);
?>

<h1>View LogAktivitas #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		'controller',
		'action',
		'tanggal_akses',
	),
)); ?>
