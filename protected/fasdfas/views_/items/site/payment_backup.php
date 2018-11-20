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
	}
</script>

<?php
// echo CHtml::textField('pembayaran', '0', array('onkeypress' => 'return runScript(event,"id_bayar")'));
// echo CHtml::dropDownList('payment', '0', Sales::model()->payment());
?>

<div class="konten-bayar">
    <div class="line" style="font-size:14px;font-weight:bold">Total Bayar : <label id="total_bayar">0</label></div>
    <div class="line"><label><input id="pembayaran" type="text" placeholder="Bayar" class="myinput" style="width:200px"></input></label></div>
    <div class="line">
       <?php echo CHtml::dropDownList('payment', '0', Sales::model()->payment(), array('style'=>'width:200px')); ?>
    </div>
    <!--div style="clear:both"></div-->
    <div class="line"><label><input type="text" class="myinput" readonly="readonly" placeholder="Kembalian" style="width:200px" id="kembalian"></input></label></div>
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
<script>
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