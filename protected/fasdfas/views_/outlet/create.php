<?php
$this->breadcrumbs=array(
	'Outlets'=>array('index'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List Outlet', 'url'=>array('index')),
	array('label'=>'Mengatur Tenant', 'url'=>array('admin')),
);
?>

<h1>Membuat Tenant</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>