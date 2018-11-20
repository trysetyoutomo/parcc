<br>
<?php
$this->breadcrumbs=array(
	'Diskons'=>array('index'),
	'Create',
);
$this->menu=array(
	array('label'=>'List Diskon', 'url'=>array('index')),
	array('label'=>'Manage Diskon', 'url'=>array('admin')),
);
?>

<h1> Diskon baru</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>