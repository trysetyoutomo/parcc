<?php
$this->breadcrumbs=array(
	'Sales Items'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SalesItems','url'=>array('index')),
	array('label'=>'Manage SalesItems','url'=>array('admin')),
);
?>

<h1>Create SalesItems</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>