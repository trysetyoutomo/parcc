<?php
/* @var $this LogAktivitasController */
/* @var $model LogAktivitas */

$this->breadcrumbs=array(
	'Log Aktivitases'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List LogAktivitas', 'url'=>array('index')),
	array('label'=>'Create LogAktivitas', 'url'=>array('create')),
	array('label'=>'View LogAktivitas', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage LogAktivitas', 'url'=>array('admin')),
);
?>

<h1>Update LogAktivitas <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>