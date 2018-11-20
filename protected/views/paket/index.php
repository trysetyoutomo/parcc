<script type="text/javascript">
	$(document).ready(function(){
		// $(document).on('click','.head',function(e){
		// 	// alert('masuk');
		// 	var i = $('.head').index(this);
		// 	$('.detail').eq(i).toggle();	
		// });
	});
</script>
<?php 
if (isset($_GET['tgl'])){	
	$tgl1 = $_GET['tgl'];
	// $tgl2 = $_GET['tgl2'];
}else{
	$tgl1 = date('Y-m-d');
	// $tgl2 = date('Y-m-d');
}
?>
<div class="form">
<br>
<h1>Laporan Penjualan Paket (Harian)</h1>
<div class="row">
<?php $form=$this->beginWidget('CActiveForm',array(
	'action'=>Yii::app()->createUrl('paket/index'),
	'method'=>'get',
)); ?>	
<?php
	$this->widget('zii.widgets.jui.CJuiDatePicker', array(
		'name'=>'tgl',
		// 'attribute'=>'date',
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
		'value'=>$tgl1,
		'htmlOptions'=>array(
			// 'style'=>'height:20px;'
			'style'=>'height:20px;;width:80px;vertical-align:top'
		),
	));

?>
<?php echo CHtml::submitButton('Search'); ?>
<?php $this->endWidget(); ?>
</div>
</div>
<?php 
$dataProvider = Yii::app()->db->createCommand()
->select('items.id idi,sales.id as sid,sales.date as date,item_name ,item_price, item_discount,nama_outlet,	sum(if(item_price<0,-quantity_purchased,quantity_purchased)) jumlah, item_tax, sum((quantity_purchased*item_price)-((item_discount*item_price/100)*quantity_purchased)) total	')
->from('sales_items, sales ,items,outlet')
->where("
	sales.id = sales_items.sale_id and
	sales.status = 1 and
	sales_items.item_id = items.id and
	items.kode_outlet =  outlet.kode_outlet  and 
	outlet.kode_outlet = 26 and
	date(sales.date) = '$tgl1' 
	")
->group('sales.id,sales_items.item_id')
->order('sales.id')
->queryAll()
?>

<div class="wells" style="display:">
<!--  
<h1 style="">Detail Tenant<a style="color:red;text-decoration:none"></a>
 <?=$data['nm'];?>

 </h1> -->
 <?
 // echo $tglheader;
 
 // if ($tglheader==$tgl2header)
 // echo "Tanggal : ".$tglheader;
 // else
 // echo "Periode : ".$tglheader." sampai ".$tgl2header;
 
 
 // echo "hehe".$tglheader;
 ?>

<div style='width:570px;margin:5px 0;border-top:0px solid #888;border-bottom:0px solid #888;border-width:1px'>
<br>

</div>
<style type="text/css">
	.head:hover{
		background-color: red;
		cursor: pointer;
		color: white;
	}
	table.paket{
		width: 100%;
		
	}
	table.paket tr td{
		border:1px solid black;
	}
</style>
<div style="border-color:black">
<table class="paket" border="1" cellpadding="5"  style="border:1px solid black;border-width:0px 0px 0px 0px;" colspan = "3" rowspan="3">
<tr style="font-weight:bold">
	<td rowspan="1">No</td>
	<td rowspan="1">No Faktur</td>
	<td rowspan="1">Waktu</td>
	<td rowspan="1">Menu</td>
	<td rowspan="1">Qty</td>
	<td rowspan="1">Harga</td>
	<td rowspan="1">Diskon</td>
	<td rowspan="1">Total</td>
	<td style="text-align:center" colspan="1" >Detail</td>
	
</tr>
<!-- <tr style="font-weight:bold">
	
	<td>No</td>
	<td>Menu</td>
	<td>Tenan</td>
	<td>Harga</td>
</tr> -->
<?
$n = 0;
$total = 0;
foreach ($dataProvider as $value) { 
$n++;
$total += $value["total"];
$totaljumlah += $value["jumlah"];
?>
<tr class="head">
	<td><?=$n?></td>
	<td><?=$value["sid"];?></td>
	<td><?=$value["date"];?></td>
	<td><?=$value["item_name"];?></td>
	<td><?=$value["jumlah"];?></td>
	<td><?=number_format($value["item_price"]);?></td>
	<td><?=number_format($value["item_discount"]);?> %</td>
	<td  style="font-size:17px;font-weight:bolder"><?=number_format($value["total"]);?></td>
	<td colspan="4" >
	<table>
		<tr>
			<td>No</td>
			<td>Nama</td>
			<td>Tenan</td>
			<td>Harga</td>
		</tr>
	<?php 
 		$number = 1;
		foreach (Paket::model()->findAll("id_paket = $value[idi] ") as $lo) :?>
		<tr>
			<td><?php echo $number?></td>
			<td><?php   echo Items::model()->findByPk($lo->id_item)->item_name ?></td>
			<td><?php   echo Outlet::model()->findByPk(Items::model()->findByPk($lo->id_item)->kode_outlet)->nama_outlet ?></td>
			<td><?php   echo number_format(Items::model()->findByPk($lo->id_item)->unit_price) ?></td>
		</tr>
	<?php 
	$number++;
	endforeach;?>	
	</table>

	</td>
</tr>


<?}?>
<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td><?=$totaljumlah?></td>
<td></td>
<td>Total : </td>

<td style="font-size:20px;font-weight:bolder"><?=number_format($total);?></td>
</tr>
</table>
</div>

</div>
<!-- <input type="button" value="cetak" class="no-print" onclick="print()" /> -->
<style>
@media print
{    
    .no-print, .no-print *
    {
        display: none !important;
    }
}
</style>
