<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<style type="text/css">
	#input-voucher{
		position: absolute;
		padding: 20px;
		background: #D3D3D3;
		top: 0px;
		left: 0px;
		width: 100%;
	    height: 100%;
	    margin: 0px;
	    display: none;
	    color: black;

	}
</style>
<div id="input-voucher">
	<form id="form-iv">
		Masukan kode voucher <input name="id_v" id="id_v" style="color:black" type="text" >
		<input type="button" id="submit" value="ok">
		<input type="button" id="close-v" value="close">
	</form>
</div>
<script>
    $(document).ready( function(){
    	$('#close-v').click(function(e){
    		$('#input-voucher').hide();
    		$('#id_v').val(" ");

    	});

    	$('#submit').click(function(e){
    		// e.preventDefault();
    		// alert('submit');
    		// alert('masuk');
    		$.ajax({
				url : "<?php echo Yii::app()->createUrl('voucher/getnominal') ?>",
				data : "id_v="+$('#id_v').val(),
				success: function(data){
					// alert(data);
		        	var obj = jQuery.parseJSON(data);
		        	// alert(JSON.stringify(obj));
		        	// alert(obj.error);
		        	if (obj.error=='error'){
						$('.error').html("Maaf, voucher tidak tersedia");
		        	}else{
		        		if (obj.jenis=='nominal'){	
							$('.tdk-lgsg').val(obj.nominal);
							changebayar();
							$('.error').html('Voucher '+obj.kategori+' Rp. '+obj.nominal+' ');
		        		}else if (obj.jenis=='persentase'){
		        			// alert('Diskon '+obj.persentase+' %')
		        			$('.error').html('Voucher '+obj.kategori+' '+obj.persentase+' %');
		        			var total = parseFloat($('#sum_sale_total').html());
		        			var total  = total  * (parseInt(obj.persentase)/100);  
		        			$('.tdk-lgsg').val(total);
							changebayar();
		        		}
		        		
		        	}
		        	$('.error').show();
					// if(data!='eror'){
					// }
					// else{
					// 	$('.error').show();
					// }
				},

				// 'dataType':""
    		});

    		$('#input-voucher').hide();

    	});

	  $('.metode').click(function(){
	  	$('.error').hide();
	  	var sst = parseFloat($('#sum_sale_total').html());
        // var isi = $(this).attr("isi");
        $('.myinput').val(0);
        // document.getElementById';(asd).asda.asd.asd.
        $(this).find('label').find('.langsung').val(sst);
        // alert(c);

        // var nilai = $('.line').find('.myinput').val();
        // alert(nilai);
        // console.log("masuk"+nilai);
   	 });
	  // $('.tdk-lgsg').click(function(){
	  // 	$('#input-voucher').show();
	  // 	// var nilai = prompt("masukan kode voucher");
	  // });



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
	<style type="text/css">
	.line :hover{
		color: red;
		cursor: pointer;
	}
	.error{
		color: red;
		font-weight: bold;
		display: none;
	}
	</style>

    <div class="line " style="font-size:14px;font-weight:bold">Total Bayar : <label id="total_bayar">0</label></div>
    
	<div class="line metode" isi="cash">
		<label  style="font-size:20px">Cash
			<input id="cash" value="0" onkeyup="changebayar()" type="text" placeholder="Bayar" class="myinput langsung" style="width:200px;height:50px;font-size:30px" >
		</label>
	</div>

    <div class="line metode"  isi="bca">
    	<label style="font-size:20px">EDC BCA
    		<input value="0" onkeyup="changebayar()" id="edcbca" type="text" placeholder="Bayar" class="myinput langsung" style="width:200px;height:50px;font-size:30px">
    	</label>
	</div>

    <div class="line metode" isi="niaga">
	    <label style="font-size:20px">EDC MANDIRI
		    <input value="0" onkeyup="changebayar()" id="edcniaga" type="text" placeholder="Bayar" class="myinput langsung" style="width:200px;height:50px;font-size:30px">
	    </label> 
    </div>

	<div class="line metode"  isi="bca1">
    	<label style="font-size:20px">CREDIT BCA
    		<input value="0" onkeyup="changebayar()" id="creditbca" type="text" placeholder="Bayar" class="myinput langsung" style="width:200px;height:50px;font-size:30px">
    	</label>
	</div>

	<div class="line metode"  isi="mandiri">
    	<label style="font-size:20px">CREDIT MANDIRI
    		<input value="0" onkeyup="changebayar()" id="creditmandiri" type="text" placeholder="Bayar" class="myinput langsung" style="width:200px;height:50px;font-size:30px">
    	</label>
	</div>

 	<div style="display:none" class="line metode" isi="voucher">
	    <label style="font-size:20px">Voucher 
	    	<input id="voucher" onkeyup="changebayar()" value="0" type="text" placeholder="Bayar" class="myinput tdk-lgsg" style="margin-right:20px;width:200px;height:50px;font-size:30px">
	    </label>
    </div>
     
    <div class="line metode" isi="compliment">
	    <label style="font-size:20px">Compliment
	    	<input id="compliment" type="text" placeholder="Bayar" class="myinput langsung" value="0" onkeyup="changebayar()" style="width:200px;height:50px;font-size:30px">
    	</label>
    </div>
    

    <div class="line metode" isi="pending">
	    <label style="font-size:20px">Pending
	    	<input value="0"	 id="dll" onkeyup="changebayar()" type="text" placeholder="Bayar" class="myinput langsung" style="width:200px;height:50px;font-size:30px">	
	    </label>
    </div>
    <div class="line"><?php //echo CHtml::dropDownList('payment', '0', Sales::model()->payment(), array('style'=>'width:200px')); ?></div>
    <!--div style="clear:both"></div-->
    
	<p class="error"></p>	
    <div class="line" style=""><label><input type="text" class="myinput" readonly="readonly" placeholder="Kembalian" style="width:200px" id="kembalian"></input></label></div>
	<input id="btnbayar" type="button" value="Bayar" onclick="nextpayment()" class="mybutton" />
   <!--input  type="button" value="Baru" onClick="baru()" class="mybutton"-->
</div>
<script>

	// function
	
	
	function nextpayment(){
		var kmb = $('#kembalian').val();
		var totaljual = $("#sum_sale_total").html();
		var totalpayment = parseInt($("#cash").val())+parseInt($("#edcbca").val())+parseInt($("#edcniaga").val())+parseInt($("#creditbca").val())+parseInt($("#creditmandiri").val())+parseInt($("#voucher").val())+parseInt($("#compliment").val())+parseInt($("#dll").val());
		 // alert(totaljual);
		 // alert(totalpayment);
		 if (parseInt(totalpayment)==parseInt(totaljual)){
			$('#tb2').html(parseInt($('#total_bayar').html())-parseInt($('#voucher').val())-parseInt($('#edcbca').val())-parseInt($('#edcniaga').val())-parseInt($('#creditbca').val())-parseInt($('#creditmandiri').val())-parseInt($('#dll').val())-parseInt($('#compliment').val())   );
			var kembalian = estimate($("#tb2").html())-$("#tb2").html();
			if ($('#tb2').html()!=0){
				$('#bayar').val(estimate($('#tb2').html()));
			}else{
				$('#bayar').val(0);
				//mulai get
					var bayar = $("#bayar").val();
					// var total = $("#tb2").html();
					var total = $("#sum_sale_total").html();
					var kembalian = parseFloat(bayar)-parseFloat(total);
					$("#kembali").val(kembalian);
				//tutup get
			}
			
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