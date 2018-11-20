<?php
/* @var $this ItemsController */
/* @var $model Items */

$this->breadcrumbs=array(
	'Items'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'list menu', 'url'=>array('index')),
	array('label'=>'Membuat menu baru', 'url'=>array('create')),
	array('label'=>'Memperbaharui menu', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Menghapus menu', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Mengatur Menu', 'url'=>array('admin')),
);
?>

<h1>Melihat Detail menu #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'item_name',
		'item_number',
		'description',
		'category_id',
		'unit_price',
		'tax_percent',
		'total_cost',
		'discount',
		'image',
		'status',
	),
)); ?>
