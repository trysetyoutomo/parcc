<?php
$this->breadcrumbs=array(
	'Outlets'=>array('index'),
	'Manage',
);

$this->menu=array(
//	array('label'=>'List Outlet', 'url'=>array('index')),
	array('label'=>'Membuat Tenant', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('outlet-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>



<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'outlet-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'kode_outlet',
		'nama_outlet',
		'nama_owner',
		'jenis_outlet',
		array(
		'name'=>'persentase_hasil',
		'header'=>'keuntungan (%)',
		'value'=>$data->persentasi_hasil,
		),
//		'status',
		array(
		'name'=>'status',
		'header'=>'alias',
		),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
