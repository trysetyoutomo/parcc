
<?php
/* @var $this ItemsController */
/* @var $model Items */



?>
<style type="text/css">
	#items-grid{
		width: 100%;
	}
</style>
<br>
<h1>Mengatur menu</h1>

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
		array(
			'header'=>'No.',
			'value'=>'($this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize) + array_search($data,$this->grid->dataProvider->getData())+1',
		),
		array(
			'name'=>'item_name',
			'header'=>'nama menu',
		),
		// 'item_number',
		// 'description',
		array(
			'name'=>'category',
			'header'=>'kategori',
		),
		array(
			'name'=>'unit_price',
			'header'=>'Harga',
		),
		// array(
		// 'name'=>'category_id',
		// 'value'=>'$data->categories->category',
		// 'filter' => CHtml::listData(Categories::model()->findall(), 'id', 'category'),
		// ),
		// 'unit_price',
		array(
			'name'=>'lokasi',
			'header'=>'Lokasi',
			// 'value'=>'$data->lokasi ? 1 : "dapur" : "bar"',
			'value'=>'$data[lokasi]==2 ? \'Dapur\':\'Bar\'',

			
			// 'value'=>'$data->outlet->nama_outlet',
			// 'filter' => CHtml::listData(Outlet::model()->findall(), 'nama_outlet', 'nama_outlet'),
		
		),
		// array(
		// 	'name'=>'lokasi',
		// 	'header'=>'Lokasi makanan',
			
		// 	'value'=>'$data[lokasi] == "1" ? "Bar" : "Dapur" ',
		// 	'filter' =>array('1'=>'Bar','2'=>'Dapur') ,
		
		// ),
		/*
		'tax_percent',
		'total_cost',
		'discount',
		'image',
		'status',
		*/
			array(
			'class'=>'CButtonColumn',
			// 'visible'=>Yii::app()->user->getIdAdmin()==1,
			'template' => '{update}{delete}',
			'buttons' =>array(
			'view'=>array(
					'label'=> 'view',
					'url'=>'Yii::app()->createUrl("items/view", array("id"=>$data[id]))',      //A PHP expression for generating the URL of the button.

			),
			'update'=>array(
					'label'=> 'Update',
					'url'=>'Yii::app()->createUrl("items/update", array("id"=>$data[id],"status"=>"ubah"))',      //A PHP expression for generating the URL of the button.

			),
			'delete'=>array(
					'label'=> 'hapus',
					'url'=>'Yii::app()->createUrl("Items/delete", array("id"=>$data[id]))',      //A PHP expression for generating the URL of the button.

				),
			

					
			
			),


		),
	),
)); ?>
