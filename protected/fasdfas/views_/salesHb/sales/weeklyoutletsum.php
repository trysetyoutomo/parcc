<h1>
Rekap Pendapatan Outlet & Tenant(bersih) Mingguan
</h1>
<?php $form=$this->beginWidget('CActiveForm',array(
	'action'=>Yii::app()->createUrl('sales/Salesoutletweekly'),
	'method'=>'get',
)); ?>

<div class="row">
		<?php
	
	$this->widget('zii.widgets.jui.CJuiDatePicker', array(
		'name'=>'Sales[date]',
		'attribute'=>'date',
		'value'=>$tgl,
//		'model'=>$model,
		// additional javascript options for the date picker plugin
		'options'=>array(
			'dateFormat'=>'yy-mm-dd',
			'showAnim'=>'fold', // 'show' (the default), 'slideDown', 'fadeIn', 'fold'
			'showOn'=>'button', // 'focus', 'button', 'both'
			'buttonText'=>Yii::t('ui','Select form calendar'),
			'buttonImage'=>Yii::app()->request->baseUrl.'/images/calendar.png',
			'buttonImageOnly'=>true,
		),
		'htmlOptions'=>array(
			'style'=>'height:20px;;width:80px;vertical-align:top'
		),
	));
	?>
	&nbsp;&nbsp; sampai dengan &nbsp;&nbsp;  
	<?
	$this->widget('zii.widgets.jui.CJuiDatePicker', array(
		'name'=>'Sales[tgl]',
		'attribute'=>'tgl',
		'value'=>$tgl2,
//		'model'=>$model,
		// additional javascript options for the date picker plugin
		'options'=>array(
			'dateFormat'=>'yy-mm-dd',
			'showAnim'=>'fold', // 'show' (the default), 'slideDown', 'fadeIn', 'fold'
			'showOn'=>'button', // 'focus', 'button', 'both'
			'buttonText'=>Yii::t('ui','Select form calendar'),
			'buttonImage'=>Yii::app()->request->baseUrl.'/images/calendar.png',
			'buttonImageOnly'=>true,
		),
		'htmlOptions'=>array(
			'style'=>'height:20px;;width:80px;vertical-align:top'
		),
	));
	
	
	
echo ":";
?>
<?php echo CHtml::submitButton('Search'); ?>
<?php $this->endWidget(); ?>
</div>
<?php
$columns2 = 
	array(	
		array(
			'header'=>'No.',
			'value'=>'($this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize) + array_search($data,$this->grid->dataProvider->getData())+1',
		),
	
		array(
			'name'=>'tgl',
			'header'=>'Tanggal',
			'headerHtmlOptions'=>array('style'=>'text-align:center;font-size:15px;padding-bottom:10px;margin-bottom:10px'),
	
		),
		// 'date',
		
		// 'total_cost',
		array(
			'name'=>'ba',
			'header'=>'bumi arena',
			'type'=>'number',
			'htmlOptions'=>array('style'=>'text-align:right'),
			'class'=>'ext.gridcolumns.TotalColumn',
			'footer'=>true,
			'footerHtmlOptions'=>array('style'=>'text-align:right'),
			'headerHtmlOptions'=>array('style'=>'text-align:center;font-size:10px;padding-bottom:10px;margin-bottom:10px'),
	

		),

	);
$itemdata = Outlet::model()->findAll();
$jumlah = count($itemdata);
for($a=1;$a<=$jumlah;$a++){
	$columns = 
	array(
	'name'=>'o'.$a.'',
	'header'=>Outlet::model()->findByPk($a)->nama_outlet,
	'type'=>'number',
	'htmlOptions'=>array('style'=>'text-align:right'),
	'class'=>'ext.gridcolumns.TotalColumn',
	'footer'=>true,
	'footerHtmlOptions'=>array('style'=>'text-align:right'),
	'headerHtmlOptions'=>array('style'=>'text-align:center;font-size:10px;padding-bottom:10px;margin-bottom:10px'),
	);	
	array_push($columns2,$columns);
}
/*
$columns3 = 
array(
			'name'=>'total_comp',
			'header'=>'bumi arena',
			'type'=>'number',
			'htmlOptions'=>array('style'=>'text-align:right'),
			'class'=>'ext.gridcolumns.TotalColumn',
			'footer'=>true,
			'footerHtmlOptions'=>array('style'=>'text-align:right'),

		);
	array_push($columns2,$columns3);
*/
	?>



<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'sales-grid',
	'dataProvider'=>$tot,
	'columns'=>$columns2,
	));
	/*
	array(
		array(
			'header'=>'No.',
			'value'=>'($this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize) + array_search($data,$this->grid->dataProvider->getData())+1',
		),
	
		array(
			'name'=>'tgl',
			'header'=>'Tanggal',
		),
		// 'date',
		
		// 'total_cost',
		array(
			'name'=>'o1',
			'header'=>Outlet::model()->findByPk(1)->nama_outlet,
			'type'=>'number',
			'htmlOptions'=>array('style'=>'text-align:right'),
			'class'=>'ext.gridcolumns.TotalColumn',
//			'value'=>'$data->nilai',
			// 'type'=>'number',
			'footer'=>true,
			'footerHtmlOptions'=>array('style'=>'text-align:right'),
			// 'htmlOptions'=>array('style'=>'text-align:right'),

		),
		array(
			'name'=>'o2',
			'header'=>Outlet::model()->findByPk(2)->nama_outlet,
			'type'=>'number',
			'htmlOptions'=>array('style'=>'text-align:right'),
			'class'=>'ext.gridcolumns.TotalColumn',
			'footer'=>true,
			'footerHtmlOptions'=>array('style'=>'text-align:right'),

		),	
		array(
			'name'=>'o3',
			'type'=>'number',
			'header'=>Outlet::model()->findByPk(3)->nama_outlet,
			'htmlOptions'=>array('style'=>'text-align:right'),
			'class'=>'ext.gridcolumns.TotalColumn',
			'footer'=>true,
			'footerHtmlOptions'=>array('style'=>'text-align:right'),

		),
		array(
			'name'=>'o4',
			'type'=>'number',
			'header'=>Outlet::model()->findByPk(4)->nama_outlet,
			'htmlOptions'=>array('style'=>'text-align:right'),
			'class'=>'ext.gridcolumns.TotalColumn',
			'footer'=>true,
			'footerHtmlOptions'=>array('style'=>'text-align:right'),

		),
		array(
			'name'=>'o5',
			'header'=>Outlet::model()->findByPk(5)->nama_outlet,
			'type'=>'number',
			'htmlOptions'=>array('style'=>'text-align:right'),
			'class'=>'ext.gridcolumns.TotalColumn',
			'footer'=>true,
			'footerHtmlOptions'=>array('style'=>'text-align:right'),

		),
		array(
			'name'=>'o6',
			'header'=>Outlet::model()->findByPk(6)->nama_outlet,

			'type'=>'number',
			'htmlOptions'=>array('style'=>'text-align:right'),
			'class'=>'ext.gridcolumns.TotalColumn',
			'footer'=>true,
			'footerHtmlOptions'=>array('style'=>'text-align:right'),

		),
		array(
			'name'=>'o7',
			'type'=>'number',
			'header'=>Outlet::model()->findByPk(7)->nama_outlet,
			'htmlOptions'=>array('style'=>'text-align:right'),
			'class'=>'ext.gridcolumns.TotalColumn',
			'footer'=>true,
			'footerHtmlOptions'=>array('style'=>'text-align:right'),

		),
		array(
			'name'=>'o8',
			'header'=>Outlet::model()->findByPk(8)->nama_outlet,
			'type'=>'number',
			'htmlOptions'=>array('style'=>'text-align:right'),
			'class'=>'ext.gridcolumns.TotalColumn',
			'footer'=>true,
			'footerHtmlOptions'=>array('style'=>'text-align:right'),


		),
		array(
			'name'=>'total_comp',
			'header'=>'bumi arena',
			'type'=>'number',
			'htmlOptions'=>array('style'=>'text-align:right'),
			'class'=>'ext.gridcolumns.TotalColumn',
			'footer'=>true,
			'footerHtmlOptions'=>array('style'=>'text-align:right'),

		),
		
*/

?>

