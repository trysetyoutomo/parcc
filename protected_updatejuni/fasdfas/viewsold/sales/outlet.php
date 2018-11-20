<h1>Rekap Pendapatan Outlet</h1>

<?php $form=$this->beginWidget('CActiveForm',array(
	'action'=>Yii::app()->createUrl('sales/outletreport'),
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

$this->renderPartial('summaryoutlet',array('summary'=>$outletsum,'bersih'=>$outletbersih));
?>
	</div>
			<?php echo CHtml::submitButton('Search'); ?>
<?php $this->endWidget(); ?>

<div style="margin-top:40px;font-weight:bold;margin-top:20px;text-decoration:none">Tabel Distribusi Pendapatan kotor Outlet 
&nbsp;
&nbsp;
&nbsp;
&nbsp;
:

</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'sales-grid',
	'dataProvider'=>$datacash,
	'columns'=>array(
		
		array(
			'header'=>'No.',
			'value'=>'($this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize) + array_search($data,$this->grid->dataProvider->getData())+1',
		),
		
		 array(
			'name'=>'id',
			'header'=>'faktur',
		),
		// 'date',
		array(
			'name'=>'time',
			'value'=>$data->date,
			//'footer'=>true,
				'class'=>'ext.gridcolumns.TotalColumn',
			//
			//'footerOut'=>'Total',
			'footerHtmlOptions'=>array('style'=>'text-align:left;font-weight:bold;'),
		),
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


		),array(
			'name'=>'total',
			'header'=>'total',
			'type'=>'number',
			'htmlOptions'=>array('style'=>'text-align:right'),
			'class'=>'ext.gridcolumns.TotalColumn',
			'footer'=>true,
			'footerHtmlOptions'=>array('style'=>'text-align:right'),

		),
		

),
)); 
//echo "<hr>";
//$this->renderPartial('net_outlet',array('summary'=>$outletsum,'service'=>$outletsumservice));
$this->renderPartial('net_outlet',array('summary'=>$outletsum,'bersih_d'=>$outletbersih_d));

?>

