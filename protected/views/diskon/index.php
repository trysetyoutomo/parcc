<?php
$this->breadcrumbs=array(
	'Diskons',
);

$this->menu=array(
	array('label'=>'Create Diskon', 'url'=>array('create')),
	array('label'=>'Manage Diskon', 'url'=>array('admin')),
);
?>

<h1>Diskons</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
