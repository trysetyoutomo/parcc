
<?php
/* @var $this ItemsController */
/* @var $model Items */

$this->breadcrumbs=array(
	'Items'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Membuat menu baru', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#items-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Mengatur menu</h1>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'items-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'item_name',
		'item_number',
		'description',
		array(
		'name'=>'category_id',
		'value'=>'$data->categories->category',
		'filter' => CHtml::listData(Categories::model()->findall(), 'id', 'category'),
		),
		'unit_price',
		array(
		'name'=>'kode_outlet',
		'value'=>'$data->outlet->nama_outlet',
		'filter' => CHtml::listData(Outlet::model()->findall(), 'kode_outlet', 'nama_outlet'),
	
		),
		/*
		'tax_percent',
		'total_cost',
		'discount',
		'image',
		'status',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
