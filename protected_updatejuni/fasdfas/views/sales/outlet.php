<div style="float:left;">

<script type="text/javascript">
$(document).ready(function(){
	$('#exportpdf').click(function(){
		$("#LoadingImage").show();
		var tanggal = $('#Sales_date').val();
		var tanggal2 = $('#Sales_tgl').val();
	    // alert(tanggal);
		$.ajax({
			url:'<?=$this->createUrl('sales/ex')?>',
			data:'tanggal='+tanggal+'&tanggal2='+tanggal2,
			success: function(data){
				$("#LoadingImage").hide();
				alert('sukses export PDF');
				//$("#dialog_export").dialog("open");
				//$("#hasil").html(data);
				//alert(data);
				// alert(data);
			},
			error: function(data){
				$("#LoadingImage").hide();
				$("#hasil").html(data);
				alert('gagal export pdf, coba perika apakah file PDF masih terbuka atau tidak, apabila terbuka silahkan close terlebih dahulu');
				// alert(data);
				// alert('data gagal di export');
			}
		});
	});
});
</script>
<style>
input[name="Properties[ref]"]
{
    max-width: 55px;
}
</style>
<h1>Rekap Pendapatan Outlet & Tenant <div id="LoadingImage" style="display:none ;"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/ajax-loader.gif" /></div>
</h1>

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
$this->renderPartial('summaryoutlet',array('summary'=>$outletsum,'bersih'=>$outletbersih));
?>

	</div>
			<?php echo CHtml::submitButton('Search'); ?>
			<?php echo CHtml::button('Cetak PDF',array('id'=>'exportpdf')); ?>
<?php $this->endWidget(); ?>

<div style="margin-top:40px;font-weight:bold;margin-top:20px;text-decoration:none">Tabel Distribusi Pendapatan kotor Tenant 
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
// for($a=1;$a<=$jumlah;$a++){
foreach($itemdata as $key){
	$columns = 
	array(
	'name'=>$key["kode_outlet"],
	'header'=>Outlet::model()->findByPk($key["kode_outlet"])->nama_outlet,
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
$this->renderPartial('net_outlet',array('summary'=>$outletsum,'bersih_d'=>$outletbersih_d));

?>

</div>