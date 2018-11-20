<br>
<div style='width:400px;margin:5px 0;border-top:1px solid #888;border-bottom:1px solid #888;border-width:1px'>
<br>
<table border="0" >
<tr>
<td>Total pendapatan kotor (sebelum bagi hasil) : </td>
<td style='text-align:right;' >:</td>	<td style='text-align:right;' ><?=number_format($summary['total'])?></td>
</tr>
<tr>
<td>Total pendapatan bersih (Bumi arena)</td>
<td>:</td>
<td style='text-align:right;'><?=number_format($bersih['total_comp'])?></td>
</tr>
<tr>
<td></td>
<td></td>
<td style='text-align:right;margin-top:-100px;'>_________ _</td>
</tr>
<tr>
<td>Total pendapatan bersih (outlet) </td>
<td>:</td>
<td style='text-align:right;color:red;'><?=number_format($summary['total']-$bersih['total_comp'])?>*</td>
</tr>

</table>
</div>

<div style="float:left;">

<?php 
$form=$this->beginWidget('CActiveForm',array(
	'action'=>Yii::app()->createUrl('sales/outletreport'),
	'method'=>'get',
)); ?>

<div class="row">
		<?php


		
	// $this->widget('zii.widgets.jui.CJuiDatePicker', array(
		// 'name'=>'Sales[date]',
		// 'attribute'=>'date',
		// 'value'=>$tgl,
// //		'model'=>$model,
		// // additional javascript options for the date picker plugin
		// 'options'=>array(
			// 'dateFormat'=>'yy-mm-dd',
			// 'showAnim'=>'fold', // 'show' (the default), 'slideDown', 'fadeIn', 'fold'
			// 'showOn'=>'button', // 'focus', 'button', 'both'
			// 'buttonText'=>Yii::t('ui','Select form calendar'),
			// 'buttonImage'=>Yii::app()->request->baseUrl.'/images/calendar.png',
			// 'buttonImageOnly'=>true,
		// ),
		// 'htmlOptions'=>array(
			// 'style'=>'height:20px;;width:80px;vertical-align:top'
		// ),
	// ));

//$this->renderPartial('summaryoutlet',array('summary'=>$outletsum,'bersih'=>$outletbersih));
?>
	</div>
			<?php //echo CHtml::submitButton('Search'); ?>
<?php $this->endWidget(); ?>

<div style="margin-top:40px;font-weight:bold;margin-top:20px;text-decoration:none">Tabel Distribusi Pendapatan kotor Outlet 
&nbsp;
&nbsp;
&nbsp;
&nbsp;
:

</div>
<?php
$itemdata = Outlet::model()->findAll();
$jumlah = count($itemdata);
		
$columns=array();
$columns2=
	array(		
		array(
			'header'=>'No.',
			'value'=>'($this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize) + array_search($data,$this->grid->dataProvider->getData())+1',
		),
		
		 array(
			'name'=>'id',
			'header'=>'faktur',
		),
		array(
			'name'=>'time',
			'value'=>$data->date,
				'class'=>'ext.gridcolumns.TotalColumn',
			'footerHtmlOptions'=>array('style'=>'text-align:left;font-weight:bold;'),
		),
		
		




);
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
	//$columns2 = $columns2 ;

}

$columnstotal = array(
			'name'=>'total',
			'header'=>'total',
			'type'=>'number',
			'htmlOptions'=>array('style'=>'text-align:right'),
			'class'=>'ext.gridcolumns.TotalColumn',
			'footer'=>true,
			'footerHtmlOptions'=>array('style'=>'text-align:right'),

		);
array_push($columns2,$columnstotal);
echo "<pre>";
//print_r($columns2);
echo "</pre>";

?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'sales-grid',
	'dataProvider'=>$datacash,
	'columns'=>$columns2,

)); 
//echo "<hr>";
//$this->renderPartial('net_outlet',array('summary'=>$outletsum,'service'=>$outletsumservice));
//$this->renderPartial('net_outlet',array('summary'=>$outletsum,'bersih_d'=>$outletbersih_d));

/*
$this->widget('ext.pdf.EPDFGrid', array(
    'id'        => 'informe-pdf',
    'fileName'  => 'Informe en PDF',//Nombre del archivo generado sin la extension pdf (.pdf)
    'dataProvider'  => $dataProvider, //puede ser $model->search()
    'columns'   => array(
        'columnName1',
        'columnName2',
        'columnName3',
        array(
            'name'  => 'columnName4',
            'value' => '$data->relationName->value',
        ),
    ),
    'config'    => array(
        'title'     => 'Libro Diario',
        'subTitle'  => 'Informe Al: '.$model->fecha,
        'colWidths' => array(40, 90, 40, 70),
    ),
));
*/




?>
<br>
<h3 style="font-weight:bold;text-decoration:none">Detail pendapatan outlet (bersih)</h3>

<div style='width:350px;margin:5px 0;border-top:0px solid #888;border-bottom:0px solid #888;border-width:1px'>
<br>
<table border="0" colspan = "0" rowspan ="0">
<?// $count = count($summary); 
$a = 1;
while ($a <= count($bersih_d)-1){
?>
<tr>
<td><?=Outlet::model()->findByPk($a)->nama_outlet?></td>
<td><?=number_format($bersih_d['o'.''.$a.''])?></td>
</tr>
<?
$total +=$bersih_d['o'.''.$a.''];
$a+=1;
}?>
<tr>
<td style='text-align:right;margin-top:-100px;'>_______________________________ +</td>
</tr>
<tr>
<td>Total bersih outlet </td>
<td>:</td>
</tr>

</table>
<h3 style='text-align:right;'><?=number_format($total)?>*</h3>
</div>
</div>