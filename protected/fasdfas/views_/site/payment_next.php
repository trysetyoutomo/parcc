
<script>
function getKembalian(){
	var bayar = $("#bayar").val();
	var total = $("#tb2").html();
	var kembalian = parseFloat(bayar)-parseFloat(total);
	$("#kembali").val(kembalian);
	
}
function getSaleID(){
		var a = confirm("yakin bayar ?");
		if (a==true){
		$("#btnbayar").hide();
		$("#btnvoid").hide();
		//alert(data_detail);
		$.ajax({
			url:'<?=$this->createUrl('sales/getsaleid')?>',
			success: function(sale_id){
				var number_meja= $("#tombol_meja").attr('value');
				number_meja =  number_meja.replace(/[^0-9]+/g, '');
				if(number_meja==""){
					sale_id="";
				}
				// alert(1+" - "+number_meja+ " - "+sale_id);
				bayar(1,number_meja,sale_id);
				
				return false;
			}
		});
		}
		$("#btnbayar").show();
		$("#btnvoid").show();
		// $("#cash").val(0);
		// $("#edcniaga").val(0);
		// $("#edcbca").val(0);
		// $("#compliment").val(0);
		// $("#dll").val(0);
		// $("#voucher").val(0);
		$('#dialog_bayar2').dialog('close');
		
	}
</script>
<body onload="getData()">
<div class="konten-bayar">
		   <div class="line" style="font-size:14px;font-weight:bold">Total Bayar : <label id="tb2">0</label></div>
 
		<div class="line"><label><input id="bayar" type="text" placeholder="Bayar" onkeyup="getKembalian()" class="myinput" style="width:200px"></input></label></div>
		<div class="line"><label><input id="kembali" value="0" type="text" placeholder="kembalian" onkeyup="getKembalian()" class="myinput" style="width:200px"></input></label></div>
    <!--div style="clear:both"></div-->
    <input id="btnbayar" type="button" value="Bayar" onClick="getSaleID()" class="mybutton">
    <!--input  type="button" value="Baru" onClick="baru()" class="mybutton"-->
    <?php 
		$userlevel = Yii::app()->user->getLevel();
		if($userlevel < 5){
	?>
		<input  type="button" value="Void" id="btnvoid" onClick="void_bayar(1,2,sale_id)" class="mybutton" style="margin-left:10px;">
	<?php }else{?>
		<!--input  type="button" value="Void" onClick="void_cek()" class="mybutton" style="margin-left:10px;"-->
		<input type="button" value="Void" onclick='$("#void_cek").dialog("open"); return false;' class="mybutton">
	<?php	
	}
	?>
</div>


<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'void_cek',
    // additional javascript options for the dialog plugin
    'options' => array(
        'title' => 'Cek User Void',
        'autoOpen' => false,
        'modal' => true
    ),
));
$model = new Users;
$this->renderPartial('user_void',array('model'=>$model));

$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
</body>


