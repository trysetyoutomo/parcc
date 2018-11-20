<?php
$this->breadcrumbs=array(
	'Pengguna'=>array('admin'),
	'baru',
);

$this->menu=array(
	//array('label'=>'List Users', 'url'=>array('index')),
	array('label'=>'Mengatur User', 'url'=>array('admin')),
);
?>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>