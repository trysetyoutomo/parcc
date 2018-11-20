<?php
/* @var $this LogAktivitasController */
/* @var $model LogAktivitas */

$this->breadcrumbs=array(
	'Log Aktivitases'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List LogAktivitas', 'url'=>array('index')),
	array('label'=>'Manage LogAktivitas', 'url'=>array('admin')),
);
?>

<h1>Create LogAktivitas</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>