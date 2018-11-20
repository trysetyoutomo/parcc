<?php
/* @var $this ItemsController */
/* @var $dataProvider CActiveDataProvider */

// $this->breadcrumbs=array(
	// 'Items',
// );

$this->menu=array(
	array('label'=>'Membuat menu baru', 'url'=>array('create')),
	array('label'=>'Mengatur Menu', 'url'=>array('admin')),
);
?>

<h1>Menu</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
