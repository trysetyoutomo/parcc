<?php
/* @var $this LogAktivitasController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Log Aktivitases',
);

$this->menu=array(
	array('label'=>'Create LogAktivitas', 'url'=>array('create')),
	array('label'=>'Manage LogAktivitas', 'url'=>array('admin')),
);
?>

<h1>Log Aktivitases</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
