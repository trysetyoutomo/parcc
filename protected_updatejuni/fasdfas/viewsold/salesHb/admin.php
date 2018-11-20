<?php
/* @var $this SalesHbController */
/* @var $model SalesHb */

$this->breadcrumbs=array(
	'Sales Hbs'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List SalesHb', 'url'=>array('index')),
	array('label'=>'Create SalesHb', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#sales-hb-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Sales Hbs</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'sales-hb-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'date',
		'customer_id',
		'sale_sub_total',
		'sale_discount',
		'sale_service',
		/*
		'sale_tax',
		'sale_total_cost',
		'sale_payment',
		'paidwith_id',
		'total_items',
		'branch',
		'user_id',
		'table',
		'comment',
		'status',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
