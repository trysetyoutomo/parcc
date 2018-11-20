
<?php
/* @var $this ItemsController */
/* @var $model Items */

$this->breadcrumbs=array(
	'Items'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Mengatur paket', 'url'=>array('items/adminpaket')),
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
<?php
$data = Items::model()->findByPk($_REQUEST['id']);
 ?>
<h1>Detail menu  dari   <?php echo  $data->item_name;?> </h1>
<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php //$this->renderPartial('_search',array('model'=>$model,)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'items-grid',
	// 'dataProvider'=>$model->search(),
	'dataProvider'=>$model,
	// 'filter'=>$model,
   'filter'=>$filtersForm,
	'columns'=>array(
		// 'id_paket',
		// 'item_name',
		// array(
		// 'name'=>'category_id',
		// 'value'=>'$data->categories->category',
		// 'filter' => CHtml::listData(Categories::model()->findall(), 'id', 'category'),
		// ),
		array(
		'name'=>'item_name',
		'header'=>'Nama',
		),
		array(
		'name'=>'unit_price',
		'header'=>'harga',
		'class'=>'ext.gridcolumns.TotalColumn',
		'type'=>'number',
		'footer'=>true,
		'htmlOptions'=>array('style'=>'text-align:right'),

		),
		// array(
		// 'name'=>'unit_price',
		// 'header'=>'detail',
		// 'value'=>'',
		// ),
		/*
		'tax_percent',
		'total_cost',
		'discount',
		'image',
		'status',
		*/
		// array(
			// 'class'=>'CButtonColumn',
			// // 'visible'=>Yii::app()->user->getIdAdmin()==1,
			// // 'template' => '{update}{delete}{view}',
			// 'buttons' =>array(
			// 'view'=>array(
					// 'label'=> 'view',
					// 'url'=>'Yii::app()->createUrl("items/detailpaket", array("id"=>$data[id_paket]))',      //A PHP expression for generating the URL of the button.

			// ),
			// // 'update'=>array(
					// // 'label'=> 'Update',
					// // 'url'=>'Yii::app()->createUrl("TblInformasi/update", array("id"=>$data[iid]))',      //A PHP expression for generating the URL of the button.

			// // ),
			// // 'delete'=>array(
					// // 'label'=> 'hapus',
					// // 'url'=>'Yii::app()->createUrl("TblInformasi/delete", array("id"=>$data[iid]))',      //A PHP expression for generating the URL of the button.

				// // ),
			

					
			
			// ),


		// ),

	),
)); ?>
