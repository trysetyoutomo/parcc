<div id="hasil"></div>
<!--
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/app/SalesItems/main.js"></script>
-->
<?php 
$this->renderPartial('application.views.site.main');

?>
<script type="text/javascript">
    function print() {
        document.jzebra.append("A37,503,0,1,2,3,N,PRINTED USING JZEBRA\n");
		// document.jzebra.appendPDF(window.location.href + "/../sample.pdf");
		// alert(window.location.href + "/../sample.pdf")
		// document.jzebra.printPS();

        // ZPLII
        // document.jzebra.append("^XA^FO50,50^ADN,36,20^FDPRINTED USING JZEBRA^FS^XZ");  
        document.jzebra.print();
    }
	function nilai(data){
		alert("nilai : " + data);
		return false;
	}
	
	
	
	function cetakRekap(){
		var tanggal = $('#Sales_date').val();
		
		if(tanggal==''){
			alert('Pilih tanggal terlebih dahulu');
			return false;
		}
		
		// alert(tanggal);
		// $.ajax({
			// alert('asdasd');
			// url:<?=$this->createUrl('sales/cetakrekap')?>,
			// data:'tanggal_rekap='+tanggal,
			// success: function(data){
				// alert(data);
			// },
			// error: function(data){
				// alert('error');
			// }
		// });
	}
</script>
<?php
/* @var $this SalesController */
/* @var $dataProvider CActiveDataProvider */

// $this->breadcrumbs=array(
	// 'Sales',
// );

// $this->menu=array(
	// array('label'=>'Create Sales', 'url'=>array('create')),
	// array('label'=>'Manage Sales', 'url'=>array('admin')),
// );
?>
<fieldset>
	<legend>
		
<h1>Laporan Penjualan Periode</h1>
<br>
	</legend>

<?php
 // $this->widget('zii.widgets.CListView', array(
	// 'dataProvider'=>$dataProvider,
	// 'itemView'=>'_view',
// )); 
?>

<?php $form=$this->beginWidget('CActiveForm',array(
	'action'=>Yii::app()->createUrl('sales/index'),
	'method'=>'get',
)); ?>
<!-- <div class="row"> -->
<?php
	$this->widget('zii.widgets.jui.CJuiDatePicker', array(
		'name'=>'Sales[date]',
		'attribute'=>'date',
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
		'value'=>$tgl,
		'htmlOptions'=>array(
			// 'style'=>'height:20px;'
			'style'=>'height:20px;;width:80px;display:inline-block'
		),
	));
	
// $this->renderPartial('summary',array('summary'=>$summary));

?>
<?php
	$this->widget('zii.widgets.jui.CJuiDatePicker', array(
		'name'=>'Sales[date2]',
		'attribute'=>'date',
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
		'value'=>$tgl2,
		'htmlOptions'=>array(
			// 'style'=>'height:20px;'
			'style'=>'height:20px;;width:80px;display:inline-block'
		),
	));
	
// $this->renderPartial('summary',array('summary'=>$summary));

?>

	<select name="kategori" id="kategori">
		<!-- <option value="">---Pilih Pembayaran---</option> -->
		<option value="tnpacomplmnt">Pendapatan</option>
		<?php if ($jnspembayrn == "and sp.compliment > 0"): ?>
			<option value="complmnt" selected>Compliment(Biaya)</option>
		<?php else: ?>
			<option value="complmnt">Compliment(Biaya)</option>
		<?php endif ?>
		<!-- <option value="all">Semua</option> -->
	</select>

	<!-- </div> -->
			<?php echo CHtml::submitButton('Cari'); ?>
			<?php echo CHtml::button('Cetak Rekap',array('id'=>'cetakrekap')); ?>
			<?php //echo CHtml::button('Export to CSV',array('id'=>'export')); ?>
<?php $this->endWidget(); ?>

<?php
	function getCustomer($data)
	{
		if($data == 1){
			return "Pelanggan";
		}
	}
	
	function getBarista($data)
	{
		if($data == 1){
			return "Pasir Kaliki";
		}else if($data == 2){
			return "Baltos";
		}else if($data == 3){
			return "City Link";
		}else if($data == 4){
			return "BTC";
		}
		// $cabang = Branch::model()->find('branch_name=:bn',array(':bn'=>$data));
		// return $cabang->id;
	}
	
	function getPaid($data)
	{
		if($data == 1){
			return "Cash";
		}else if($data == 3){
			return "BCA";
		}else if($data == 4){
			return "Mandiri";
		}else if($data == 5){
			return "CIMB Niaga";
		}else if($data == 12){
			return "Compl";
		}else if($data == 99){
			return "Voucher";
		}

		
	}
	
	$username = Yii::app()->user->name;
	$user = Users::model()->find('username=:un',array(':un'=>$username));
	$idk = $user->level; 
	$a = true;
	if($idk < 5)
	$a = true;
	else
	$a = false;
?>
<?php
// echo $jnspembayrn;
?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'sales-grid',
	'dataProvider'=>$dataProvider,
	// 'filter'=>$model->search(),
	'columns'=>array(
		array(
			'header'=>'No.',
			'value'=>'($this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize) + array_search($data,$this->grid->dataProvider->getData())+1',
		),
		array(
		'name'=>'id',
		'header'=>'ID'
		),
		array(
		'name'=>'date',
		'header'=>'Tanggal'
		),
		// 'date',
		array(
		'name'=>'total_items',
		'header'=>'Total Menu',
			'class'=>'ext.gridcolumns.TotalColumn',
//			'value'=>'$data->nilai',
			'type'=>'number',
			'footer'=>true,
		),	
		array(
			'name'=>'sale_sub_total',
			'header'=>'total kotor',
			'type'=>'number',
			'htmlOptions'=>array('style'=>'text-align:right'),
			'class'=>'ext.gridcolumns.TotalColumn',
//			'value'=>'$data->nilai',
			'type'=>'number',
			'footer'=>true,
			'htmlOptions'=>array('style'=>'text-align:right'),

		),	
		array(
			'name'=>'sale_discount',
			'header'=>'total diskon',
			'type'=>'number',
			'htmlOptions'=>array('style'=>'text-align:right'),
			'class'=>'ext.gridcolumns.TotalColumn',
//			'value'=>'$data->nilai',
			'type'=>'number',
			'footer'=>true,
			'htmlOptions'=>array('style'=>'text-align:right'),

		),
		
		array(
			'name'=>'voucher',
			'header'=>'voucher',
			'type'=>'number',
		),
		array(
			'name'=>'sale_dis_vouc',
			'header'=>'Total After',
			'type'=>'number',
		),
		array(
			'name'=>'sale_tax',
			'header'=>'total pajak',
			'type'=>'number',
			'htmlOptions'=>array('style'=>'text-align:right'),
//			'value'=>'$data->nilai',
			'class'=>'ext.gridcolumns.TotalColumn',
			'type'=>'number',
			'footer'=>true,
			'htmlOptions'=>array('style'=>'text-align:right'),

		),	
		array(
			'name'=>'sale_service',
			'header'=>'total service',
			'type'=>'number',
			'htmlOptions'=>array('style'=>'text-align:right'),
			'class'=>'ext.gridcolumns.TotalColumn',
//			'value'=>'$data->nilai',
			'type'=>'number',
			'footer'=>true,
			'htmlOptions'=>array('style'=>'text-align:right'),

		),	
		

		array(
			'name'=>'sale_total_cost',
			'header'=>'total bersih',
			'type'=>'number',
			'htmlOptions'=>array('style'=>'text-align:right'),
			'class'=>'ext.gridcolumns.TotalColumn',
//			'value'=>'$data->nilai',
			'type'=>'number',
			'footer'=>true,
			'htmlOptions'=>array('style'=>'text-align:right'),

		),
		array(
			'name'=>'inserter',
			'header'=>'Kasir',
			'type'=>'number',
			'htmlOptions'=>array('style'=>'text-align:right'),
			'class'=>'ext.gridcolumns.TotalColumn',
			// 'value'=>'$data->user->username',
			'type'=>'text',
			'footer'=>true,
			'htmlOptions'=>array('style'=>'text-align:right'),

		),
		array(
			'name'=>'table',
			'header'=>'Meja',
		),
		array(
			'name'=>'waiter',
			'header'=>'waiter',
		)
		// 'table'
		,
		array(
		'name'=>'bayar',

		'header'=>'bayar',
		'type'=>'number',		
		)
		,
		//'comment',
		// 'status',
		array(
		'type'=>'raw',
		'header'=>'Rincian Menu',
		'value'=>'CHtml::link("Detail",array("sales/detailitems","id"=>$data[id]),array("style"=>"text-decoration:none"))',
		
		),
		array(
			"name"=>"comment",
			"header"=>"Description",
		),
		array
		(
			'name'=>'print',
			'header'=>'Cetak',
			'type'=>'raw',
			// 'value'=>'CHtml::ajaxButton("Cetak", array("sales/CetakReport","id"=>$data->id),array())',
			'value'=>'CHtml::ajaxButton("Cetak", array("sales/CetakReport"),array(
																					"data"=>array("id"=>$data[id]),
																					"success"=>"function(data){
																						alert(data);
																						var sales = jQuery.parseJSON(data);
																						if (sales.sale_id!=\'\')
																						{
																							print_bayar(sales);
																						}
																					}",
																					"error"=>"function(data){alert(\'data\')}"
																				))',
		),	
		array(
		'class'=>'CButtonColumn',
		'template'=>'',
		'visible'=>$a,
		'buttons' => array(
			
				'delete' => array(
							'url'=>'Yii::app()->createUrl("Sales/delete", array("id"=>$data[id]))',      //A PHP expression for generating the URL of the button.
				
				),
			),
		
		), 		
	),
)); ?>
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'dialog_export',
    // additional javascript options for the dialog plugin
    'options' => array(
        'title' => 'Meja',
        'autoOpen' => false,
        'modal' => true,
        'width' => 250,
        'height' => 80,
    ),
));

echo "data sales berhasil di export";
// echo $jnspembayrn;

$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<script>
$(document).ready(function(){
	$('#export').click(function(){
		var tanggal = $('#Sales_date').val();
		$.ajax({
			url:'<?=$this->createUrl('sales/export')?>',
			data:'tanggal='+tanggal,
			success: function(data){
				$("#dialog_export").dialog("open");
				$("#hasil").html(data);
				// alert(data);
			},
			error: function(data){
				$("#hasil").html(data);
				// alert(data);
				// alert('data gagal di export');
			}
		});
	});
	

	$('#cetakrekap').click(function(){
		var tanggal = $('#Sales_date').val();
		
		if(tanggal==''){
			alert('Pilih tanggal terlebih dahulu');
			return false;
		}else{
			$.ajax({
				url:'<?=$this->createUrl('sales/cetakrekap')?>',
				data:'tanggal_rekap='+tanggal,
				success: function(data){
					var json = jQuery.parseJSON(data);
					// alert(JSON.stringify(json));
					// $('#hasiljson').html(data);
					print_rekap(json);
					// console.log(data);
					
				},
				error: function(data){
					alert('error');
				}
			});
		}
	});
});
</script>
<div id="hasil">
</div>
<applet name="jzebra" code="jzebra.PrintApplet.class" archive="jZebra/jzebra/jzebra.jar" width="0" height="0">
    <param name="printer" value="zebra">
</applet>
<system.webServer>
    <staticContent>
      <mimeMap fileExtension=".jnlp" mimeType="application/x-java-jnlp-file" />
    </staticContent>
  </system.webServer>

</fieldset>
