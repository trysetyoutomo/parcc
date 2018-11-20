<?php
$this->breadcrumbs=array(
	'Sales Items'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SalesItems','url'=>array('index')),
	array('label'=>'Create SalesItems','url'=>array('create')),
	array('label'=>'View SalesItems','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage SalesItems','url'=>array('admin')),
);
?>

<h1>Update SalesItems <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>