<?php
/* @var $this ItemsController */
/* @var $model Items */

$this->breadcrumbs=array(
'Items'=>array('index'),
'Create',
);

$this->menu=array(
//array('label'=>'List Items', 'url'=>array('index')),
array('label'=>'Mengatur Menu', 'url'=>array('items/adminpaket')),
);
?>

<h1>Paket baru</h1>

<script type="text/javascript">
function validasi(){
	var nama = $("#nama").val();
	var menu = $("#menu").val();
	var total = $("#total").val();
	alert(menu);
	var pesan ="";
	
		
}
	
function simpan(){
	// alert("asd");
	var pesan = "";
	var nama = $("#namasimpan").val();
	var menu = $("#menu").val();
	var total = $("#total").val();
	if (nama == "")
		pesan += "nama kosong \n";
	// if (length(menu)==0)
		// pesan += "menu kosong \n";
	if (total =="")
		pesan += "total kosong \n";
	
	if (pesan!=""){
		alert(pesan);
		return false
	}else{
		$.ajax({
		type: 'GET',
		url: '<?php echo Yii::app()->createAbsoluteUrl("items/createpaket"); ?>',
		data:'nama='+nama+'&menu='+menu+'&total='+total,
		success:function(data){
			alert("sukses");
			window.location.assign("index.php?r=items/adminpaket");
		},
		dataType:'html'
		});
	}
}
function rubah(){
	var nama = $("#namaubah").val();
	var menu = $("#menu").val();
	var total = $("#total").val();
	var id = $("#id").val();
	var pesan = "";
	if (nama == "")
		pesan += "nama kosong \n";
	// if (length(menu)==0)
		// pesan += "menu kosong \n";
	if (total =="")
		pesan += "total kosong \n";
	
	if (pesan!=""){
		alert(pesan);
		return false
	}else{
		$.ajax({
		type: 'GET',
		url: '<?php echo Yii::app()->createAbsoluteUrl("items/createpaket"); ?>',
		data:'id='+id+'&nama='+nama+'&menu='+menu+'&total='+total,
		success:function(data){
			alert('sukses');
			window.location.assign("index.php?r=items/adminpaket");
		},
		dataType:'html'
		});
	}
}

</script>
<?php
/* @var $this ItemsController */
/* @var $model Items */
/* @var $form CActiveForm */
?>

<div class="mws-panel grid_8">

<div class="mws-panel-header">


</div>

<div class="mws-panel-body no-padding">
<?php $form=$this->beginWidget('CActiveForm', array(
'id'=>'items-form',
'enableAjaxValidation'=>false,
'htmlOptions' => array(
	'class' => 'mws-form',
	'onsubmit' => 'return validasi()',
	'method' => 'GET',
	
)
)); ?>
<?php
$nilai = Categories::model()->findAll();
$data = CHtml::listData($nilai,'id','category');

$nilai2 = Outlet::model()->findAll();
$data2 = CHtml::listData($nilai2,'kode_outlet','nama_outlet');


?>
<div class="mws-form-inline">
<!--
<p class="note">Fields with <span class="required">*</span> are required.</p>
-->
<table style="border:1px;width:700px;">

<tr>
<td>Nama Paket</td>
<td>
<input type="hidden" id="id" value="<?php echo $_REQUEST["id"]?>" />
<?php 
if ($_REQUEST["status"]=="ubah"){
	echo "<body onload='getTgl()'>";
	echo Chtml::Textfield("paket[nama]","$namapaket",array("id"=>"namaubah")); 
}
else
	echo Chtml::Textfield("paket[nama]","",array("id"=>"namasimpan")); 

?>

</td>
</tr>




<tr>	
<td><?php echo 'Menu untuk paket' ; ?></td>
<?php// $ik = Kamar::model()->findByPk($model->id_kamar); ?>
<td>
<script>
function getTgl(){
var menu = $('#menu').val();
$.ajax({
type: 'GET',
url: '<?php echo Yii::app()->createAbsoluteUrl("sales/getharga"); ?>',
data:'id='+menu,
success:function(data){
$("#total").val(data);
},
dataType:'html'
});
}
</script>
<?php 
$data = Items::model()->findAll(array('condition'=>'category_id =4 '));
$li = CHtml::listData($data,'id','item_name');
?>
<?php

// $data = array ("78" => array(
			// 'selected' => true,
		// ),
		// "77" => array(
			// 'selected' => true,
		// ));
// echo "<pre>";
// print_r($data);
// echo "</pre>";
?>

<?php $this->widget('ext.select2.ESelect2', array(
'name' => 'menu',
'data' =>$li,
'htmlOptions' => array(
	'options' =>$array,
	'multiple' => true,
	'style'=>'width:220px;height:1100px',
	'id'=>'menu',
	'onchange'=>'getTgl()',
	// 'htmlOptions' => array(
			// // 'options' => array( // selected options by default
			// // 'active' => array(
					// // 'selected' => true,
				// // ),
			// // ),
	// ),
	// 'onmousemove'=>'getSisa()'
	//'empty'=>array($model->id_kamar=>$ik['id_kamar']),//kalo update
),
)); ?>
</td>
<td>
</td>
</tr>

<tr>
<td>Total</td>
<td><?php echo Chtml::Textfield("paket[total]","",array("id"=>"total","readonly"=>true)); ?></td>
</tr>



</table>






<!-- form -->
</div>
<div class="mws-button-row">
<?php if ($_REQUEST["status"]=="ubah"){ ?>
<input type="button" onclick="rubah()" value="Rubah" class="btn btn-danger">
<?php }else{ ?>
<input type="button" onclick="simpan()" value="Simpan" class="btn btn-danger">
<?php } ?>
<input type="reset" value="Batal" class="btn ">
</div>
<?php $this->endWidget(); ?>
</div>
</div>
