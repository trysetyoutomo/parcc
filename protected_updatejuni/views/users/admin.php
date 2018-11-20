<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'List Users', 'url'=>array('index')),
	array('label'=>'Mengatur User', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('users-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>&nbsp;&nbsp;&nbsp;Mengelola User</h1>
<br>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'users-grid',
	'dataProvider'=>$model,
	'filter'=>$filtersForm,
	'columns'=>array(
		array(
			'header'=>'No.',
			'value'=>'($this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize) + array_search($data,$this->grid->dataProvider->getData())+1',
		),
		'username',
		'name',
		array(
			'name'=>'password',
			'value'=>'md5($data[password])',
			'type'=>'raw'
		),
		array(
			'name'=>'level',
			// 'value'=>'Akses::model()->findByPk($data->level)->akses',
			'type'=>'raw',	
		),
		array(
			'header'=>'Keterangan',	
			'name'=>'level',
			'value'=>'Akses::model()->findByPk($data[level])->akses',
			'type'=>'raw',

		),
		// 'status',
		/*
		'branch_id',
		*/
		array(
			'class'=>'CButtonColumn',
			// 'visible'=>Yii::app()->user->getIdAdmin()==1,
			'template' => '{update}',
			'buttons' =>array(
			// 'view'=>array(
			// 		'label'=> 'view',
			// 		'url'=>'Yii::app()->createUrl("Users/view", array("id"=>$data[id]))',      //A PHP expression for generating the URL of the button.

			// ),
			'update'=>array(
					'label'=> 'Update',
					'url'=>'Yii::app()->createUrl("Users/update", array("id"=>$data[id],"status"=>"ubah"))',      //A PHP expression for generating the URL of the button.

			),
			// 'delete'=>array(
			// 		'label'=> 'hapus',
			// 		'url'=>'Yii::app()->createUrl("Users/delete", array("id"=>$data[id]))',      //A PHP expression for generating the URL of the button.

			// ),
			

					
			
			),


		),
	),
)); ?>
