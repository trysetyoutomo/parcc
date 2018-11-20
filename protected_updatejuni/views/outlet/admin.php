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
 
<?php 
// $this->renderPartial('_search',array(
	// 'model'=>$model,
// )); ?>
</div><!-- search-form -->
<h1>Mengelola Tenan</h1>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'outlet-grid',
	'dataProvider'=>$model,
	'filter'=>$filtersForm,
	'columns'=>array(
		array(
			'header'=>'No.',
			'value'=>'($this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize) + array_search($data,$this->grid->dataProvider->getData())+1',
		),
		array(
			'name'=>'nama_outlet',
			'header'=>'Nama Tenan ',
		),
		// 'nama_outlet',
		// 'nama_owner',
		// 'jenis_outlet',

		array(
			'name'=>'nama_owner',
			'header'=>'Owner ',
		),
		array(
		'name'=>'persentase_hasil',
		'header'=>'keuntungan (%)',
		'value'=>$data->persentasi_hasil,
		),
//		'status',
		// array(
		// 'name'=>'status',
		// 'header'=>'alias',
		// ),
		array(
			'class'=>'CButtonColumn',
			// 'visible'=>Yii::app()->user->getIdAdmin()==1,
			'template' => '{update}{delete}',
			'buttons' =>array(
			'view'=>array(
					'label'=> 'view',
					'url'=>'Yii::app()->createUrl("Outlet/view", array("id"=>$data[kode_outlet]))',      //A PHP expression for generating the URL of the button.

			),
			'update'=>array(
					'label'=> 'Update',
					'url'=>'Yii::app()->createUrl("Outlet/update", array("id"=>$data[kode_outlet],"status"=>"ubah"))',      //A PHP expression for generating the URL of the button.

			),
			'delete'=>array(
					'label'=> 'hapus',
					'url'=>'Yii::app()->createUrl("Outlet/delete", array("id"=>$data[kode_outlet]))',      //A PHP expression for generating the URL of the button.

				),
			

					
			
			),


		),
	),
)); ?>
