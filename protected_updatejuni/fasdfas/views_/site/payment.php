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
	
</script>

<?php
// echo CHtml::textField('pembayaran', '0', array('onkeypress' => 'return runScript(event,"id_bayar")'));
// echo CHtml::dropDownList('payment', '0', Sales::model()->payment());
?>

<div class="konten-bayar">
    <div class="line" style="font-size:14px;font-weight:bold">Total Bayar : <label id="total_bayar">0</label></div>
    
	<div class="line"><label style="font-size:20px">Cash&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="cash" value="0" onkeyup="changebayar()" type="text" placeholder="Bayar" class="myinput" style="width:200px;height:50px;font-size:30px" ></input></label></div>
    <div class="line"><label style="font-size:20px">EDC BCA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input value="0" onkeyup="changebayar()" id="edcbca" type="text" placeholder="Bayar" class="myinput" style="width:200px;height:50px;font-size:30px"></input>&nbsp;</label> </div>
    <div class="line"><label style="font-size:20px">EDC NIAGA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input value="0" onkeyup="changebayar()" id="edcniaga" type="text" placeholder="Bayar" class="myinput" style="width:200px;height:50px;font-size:30px"></input>&nbsp;</label> </div>
    <div class="line"><label style="font-size:20px">Voucher &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="voucher" onkeyup="changebayar()" value="0" type="text" placeholder="Bayar" class="myinput" style="margin-right:20px;width:200px;height:50px;font-size:30px"></input></label></div>
    <div class="line"><label style="font-size:20px">Compliment&nbsp;&nbsp;&nbsp;&nbsp;<input id="compliment" type="text" placeholder="Bayar" class="myinput" value="0" onkeyup="changebayar()" style="width:200px;height:50px;font-size:30px"></input></label></div>
    <div class="line"><label style="font-size:20px">Pending&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input value="0"	 id="dll" onkeyup="changebayar()" type="text" placeholder="Bayar" class="myinput" style="width:200px;height:50px;font-size:30px"></input></label></div>
    <div class="line"><?php //echo CHtml::dropDownList('payment', '0', Sales::model()->payment(), array('style'=>'width:200px')); ?></div>
    <!--div style="clear:both"></div-->
    <div class="line" style="display:none"><label><input type="text" class="myinput" readonly="readonly" placeholder="Kembalian" style="width:200px" id="kembalian"></input></label></div>
	<input id="btnbayar" type="button" value="Bayar" onclick="nextpayment()" class="mybutton" />
   <!--input  type="button" value="Baru" onClick="baru()" class="mybutton"-->
	
</div>
<script>

	// function
	
	
	function nextpayment(){
		var kmb = $('#kembalian').val();
		var totaljual = $("#sum_sale_total").html();
		var totalpayment = parseInt($("#cash").val())+parseInt($("#edcbca").val())+parseInt($("#edcniaga").val())+parseInt($("#voucher").val())+parseInt($("#compliment").val())+parseInt($("#dll").val());
		 // alert(totaljual);
		 // alert(totalpayment);
		 if (parseInt(totalpayment)==parseInt(totaljual)){
			$('#tb2').html(parseInt($('#total_bayar').html())-parseInt($('#voucher').val())-parseInt($('#edcbca').val())-parseInt($('#edcniaga').val())-parseInt($('#dll').val())-parseInt($('#compliment').val())   );
			var kembalian = estimate($("#tb2").html())-$("#tb2").html();
			$('#bayar').val(estimate($('#tb2').html()));
			$('#kembali').val(kembalian);
			$('#dialog_bayar2').dialog('open');
			
		}else{
			alert("Jumlah tidak sesuai");
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

<!--input id="id_bayar" type="button" onclick='bayar(1,2,sale_id)' value="Bayar"-->