<?php
$this->breadcrumbs=array(
	'Diskons'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Diskon', 'url'=>array('index')),
	array('label'=>'Create Diskon', 'url'=>array('create')),
	array('label'=>'View Diskon', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Diskon', 'url'=>array('admin')),
);
?>

<h1>Update Diskon <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>