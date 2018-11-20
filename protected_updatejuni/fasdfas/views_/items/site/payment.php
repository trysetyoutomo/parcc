<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<script>
    $(document).ready( function(){
        $(".cb-enable").click(function(){
            var parent = $(this).parents('.switch');
            $('.cb-disable',parent).removeClass('selected');
            $(this).addClass('selected');
            $('.checkbox',parent).attr('checked', true);
        });
        $(".cb-disable").click(function(){
            var parent = $(this).parents('.switch');
            $('.cb-enable',parent).removeClass('selected');
            $(this).addClass('selected');
            $('.checkbox',parent).attr('checked', false);
        });
    });
	
	function baru()
	{
	   liveSearchPanel_SalesItems.store.removeAll();
		show_meja("Meja");
		
		kalkulasi1();
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
		$('#dialog_bayar2').dialog('close');
	}
</script>

<?php
// echo CHtml::textField('pembayaran', '0', array('onkeypress' => 'return runScript(event,"id_bayar")'));
// echo CHtml::dropDownList('payment', '0', Sales::model()->payment());
?>

<div class="konten-bayar">
    <div class="line" style="font-size:14px;font-weight:bold">Total Bayar : <label id="total_bayar">0</label></div>
    
	<div class="line"><label style="font-size:50px">Cash&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="cash" value="0" onkeyup="changebayar()" type="text" placeholder="Bayar" class="myinput" style="width:400px;height:70px;font-size:50px"></input></label></div>
    <div class="line"><label style="font-size:50px">EDC BCA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input value="0" onkeyup="changebayar()" id="edcbca" type="text" placeholder="Bayar" class="myinput" style="width:400px;height:70px;font-size:50px"></input>&nbsp;</label> </div>
    <div class="line"><label style="font-size:50px">EDC NIAGA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input value="0" onkeyup="changebayar()" id="edcniaga" type="text" placeholder="Bayar" class="myinput" style="width:400px;height:70px;font-size:50px"></input>&nbsp;</label> </div>
    <div class="line"><label style="font-size:50px">Voucher &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="voucher" onkeyup="changebayar()" value="0" type="text" placeholder="Bayar" class="myinput" style="margin-right:20px;width:400px;height:70px;font-size:50px"></input></label></div>
    <div class="line"><label style="font-size:50px">Compliment&nbsp;&nbsp;&nbsp;&nbsp;<input id="compliment" type="text" placeholder="Bayar" class="myinput" value="0" onkeyup="changebayar()" style="width:400px;height:70px;font-size:50px"></input></label></div>
    <div class="line"><label style="font-size:50px">Dll&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input value="0"	 id="dll" onkeyup="changebayar()" type="text" placeholder="Bayar" class="myinput" style="width:400px;height:70px;font-size:50px"></input></label></div>
    <div class="line"><?php //echo CHtml::dropDownList('payment', '0', Sales::model()->payment(), array('style'=>'width:200px')); ?></div>
    <!--div style="clear:both"></div-->
    <div class="line"><label><input type="text" class="myinput" readonly="readonly" placeholder="Kembalian" style="width:200px" id="kembalian"></input></label></div>
	<input id="btnbayar" type="button" value="Bayar" onclick="nextpayment()" class="mybutton" />
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
<script>
	function nextpayment(){
		var kmb = $('#kembalian').val();
		if (kmb==0){
			var kembalian = estimate($("#total_bayar").html())-$("#sum_sale_total").html();
			$('#tb2').html($('#total_bayar').html());
			$('#bayar').val(estimate($('#total_bayar').html()));
			$('#kembali').val(kembalian);
			$('#dialog_bayar2').dialog('open');
		}else{
			alert("Silahkan atur keuangan terlebih dahulu	");
		}
	}

    function collect_data()
    {
        $(function(){
            alert($("#sum_sub_total").html());            
        });
    }
    
    function kalkulasi()
    {
        $("#kembalian").val();
    }
	
	
</script>

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
<!--input id="id_bayar" type="button" onclick='bayar(1,2,sale_id)' value="Bayar"-->