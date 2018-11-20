<style type="text/css">
	.meja-list{
		float:left;
		width:120px;
		margin-right:10px;
	}
	.meja-tombol{
		float:left;
		width:500px;
	}
	#meja{
		width:120px;
	}
	#dialog_meja,.meja{
		/*background:red;*/
	}
</style>
<script type="text/javascript">
	$(document).ready(function(){
		// $('#modal').load('index.php?r=site/table');
	})
</script>
<div class="meja-modal" id="modal">
	
	<?php
	$username = Yii::app()->user->name;
	$user = Users::model()->find('username=:un',array(':un'=>$username));
	$model = Sales::model()->findAllByAttributes(array('status' => 0));
	$data = CHtml::listData($model, 'table', 'id');
	?>
	
	<div class="meja-list">
	<select id="meja" name="meja" multiple size=20 onKeypress="hold_bill_press(event)">
	<?php
	$sqlno_meja = "
		select no_meja from meja
	";
	$valno_meja = Yii::app()->db->createCommand($sqlno_meja)->queryAll();
	// for ($a = 1; $a <= 75; $a++) {
	foreach($valno_meja as $valno_meja){
		$a = $valno_meja['no_meja'];	
		if (isset($data[$a]))
			echo '<option value='.$a.'-1-'.$data[$a].'>'.$a.' Terisi </option>';
		else
			echo '<option value='.$a.'-0-0'.'>'.$a.'</option>';
	}
	// }
	?>
	</select>
	</form>
	</div>
	
	<div class="meja-tombol">
	<?php
	$sqlno_meja = "
		select no_meja from meja
	";
	$valno_meja = Yii::app()->db->createCommand($sqlno_meja)->queryAll();
	// for ($a = 1; $a <= 75; $a++) {
	foreach($valno_meja as $valno_meja){
		$a = $valno_meja['no_meja'];
	$x = Sales::model()->find("t.table=$a and t.status = 0");
		if (isset($data[$a])){
			//echo '<input onClick="hold_bill(' . $a . ',1,' . $data[$a] . ')" type="button" value="' . $a . ' Terisi" data-dropdown="#dropdown-4" class="table-button" />';
			// echo '<input type="button"  value="' . $a . '" style="background:red;font-color:white" data-dropdown="#dropdown-4" class="table-button" />';
			echo '<input title="Perbaharui pada tanggal '.$x->date.'" type="button"  value="' . $a . '" style="background:green;font-color:white" data-dropdown="#dropdown-4" class="table-button" />';
		
		}
		else
			//echo '<input onClick="hold_bill(' . $a . ',0,0)" type="button" value="' . $a . '" data-dropdown="#dropdown-4" class="table-button"  />';
			echo '<input type="button" value="' . $a . '" data-dropdown="#dropdown-4" class="table-button"  />';
	}
	// }
	?>
	</div>
</div>
<script>
    function hold_bill(meja,mode,data)
    {
        if (mode===0)
            bayar(0,meja);
        else
        {
            load_bill(meja,data);
            sale_id = data;
            show_meja("Meja ("+meja+")");
            $('#dialog_meja').dialog('close');
//            alert(sale_id);
        }
        $('#dialog_meja').load('index.php?r=site/table');
    }
    function show_meja(val)
    {
        $("#tombol_meja").attr('value', val);
		$('#dialog_meja').load('index.php?r=site/table');
    }
	
	function cekisigrid(){
		var inc = 0;
		 liveSearchPanel_SalesItems.store.each(function (rec) {
			inc=inc+1;
		});
		// alert(inc);
		return inc;
	}
	
	function hold_bill_press(e){
		// alert(data);
		//cek isi grid
		
		
		
		var key;
		if (window.event)
			key = window.event.keyCode;     //IE
		else
			key = e.which;     //firefox
		
			//jika enter di tekan
				var meja = $("#meja").val().toString();
				var nilai = meja.split("-");
				no_meja = nilai[0];
				// alert(no_meja);
				meja_cetak = no_meja;
				mode = nilai[1];
				data = nilai[2];
			if (key == 13) {
				
				var number_meja= $("#tombol_meja").attr('value');
				number_meja =  number_meja.replace(/[^0-9]+/g, '');
				// alert(no_meja);
				// return false;
				if (mode==0)
				{
					var inc = 0;
					 liveSearchPanel_SalesItems.store.each(function (rec) {
						inc=inc+1;
					});
					
					if(inc == 0){
						alert('Tidak ada data');
						return false;
					}
					//cek meja kosong atau isi
					if(number_meja != ''){
						// alert('no meja tidak kosong\npindah meja dilakukan');
						var r=confirm("pindah meja ?")
						if (r==true)
						{
							$.ajax({
								url:'<?php echo $this->createUrl('sales/pindahmeja');?>',
								data:'meja='+no_meja,
								success: function(){
									// alert(data);
									// bayar(0,no_meja);
									show_meja("Meja");
									
									$("#dialog_bayar").dialog("close");
									liveSearchPanel_SalesItems.store.removeAll();
									$('#sum_sub_total').html(0);
									$('#sum_sale_discount').html(0);
									$('#sum_sale_service').html(0);
									$('#sum_sale_tax').html(0);
									$('#sum_sale_total').html(0);
									$('#pembayaran').val(0);
									$('#payment').val(0);
									$("#e1").select2("close");
									
								},
								error: function(data){
									alert(data);
								}
							});
						}else{
							return false;
						}
					}else{
						alert("mode holdbill");
						bayar(0,no_meja);
						show_meja("Meja");
					}
				}
				else if (number_meja == no_meja)
				{
					alert("mode update holdbill");
					bayar(0,no_meja,data);
					show_meja("Meja");  
				}
				else
				{
					alert("mode load holdbill");
				
			        // var number_meja= $("#tombol_meja").attr('value');
					// //alert(number_meja);
										// sale_id = data;

					// if (number_meja != '')
					// {
// //						alert('bill');
						// bayar(0,no_meja,data);
						// show_meja("Meja");  

					// }else{
						load_bill(meja,data);
						$.ajax({
							url:'<?php echo $this->createUrl('sales/sessid')?>',
							data:'id='+data,
							success:function(data){
								// alert('success'+data);
							},
							error: function(){
								// alert('gagal'+data);
							}
							
						});
						show_meja("Meja ("+no_meja+")");  
					// }
				} 
				
				$('#dialog_meja').load('index.php?r=site/table');
				$("#dialog_meja").dialog('close');
			
		}
		<?php if (Yii::app()->user->getLevel()==2){ ?>
		else if (key == 32){
			var tanya = confirm('yakin hapus data pada meja ?');
		if (tanya==true){
			$.ajax({
			url:'<?php echo $this->createUrl('sales/del');?>',
			data:'id='+no_meja,
			success: function(){
				// alert('sukses hapus');
				// bayar(0,no_meja);
					show_meja("Meja");
					$('#dialog_meja').dialog('close');
				
			},
			error: function(data){
				alert(data);
			}
			});
		}
		
		
		}
		<?php } ?>
		
		
		// alert("asdasd");
	}
</script>
