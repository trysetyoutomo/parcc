<script>
tgl1 = $("#Sales_date").val();
tgl2 = $("#Sales_tgl").val();
// $(".tanggal1").val("try");
// $(".tanggal2").val("sas");
// alert(tgl1);
// alert(tgl2);
</script>
<script type="text/javascript">
$(document).ready(function(){
	$('.cetakdetail').click(function(){
		//alert("asd");
		var a = $('#get').val();
		$("#LoadingImage").show();
		var tanggal = $('#Sales_date').val();
		var tanggal2 = $('#Sales_tgl').val();

		 // alert(a);
		$.ajax({
			url:'<?=$this->createUrl('sales/printData')?>',
			data:'id='+a+'&tgl1='+tanggal+'&tgl2='+tanggal2,
			success: function(data){
				var mywindow = window.open('', 'Cetak', 'height=400,width=600');
				$("#LoadingImage").hide();
				// alert('sukses masuk');
				mywindow.document.write(data);
				// mywindow.print();
				// data = "";
				//mywindow.close();
			
			},
			error: function(data){
				$("#LoadingImage").hide();
				$("#hasil").html(data);
				alert('gagal cetak');
				// alert(data);
				// alert('data gagal di export');
			}
		});
	});
	
});
</script>
<br>
<div style='width:350px;margin:5px 0;border-top:0px solid #888;border-bottom:0px solid #888;border-width:1px'>
<br>
<table border="1" >
<tr>
<td style="width:1000px;font-weight:bold;text-decoration:none">Detail pendapatan Tenant (bersih)</td>
</tr>
<!--<form method="GET" action="<?php echo $this->createUrl('sales/printData')?>"  /> -->
<form method="GET" action="/postech/index.php"  > 
	<select name="jenis">
		<option value="1">Format 1</option>
		<option value="2">Format 2</option>
	</select>
	<input type="hidden" name ="r" value="sales/printData" /> 
	<input type="hidden" name ="tgl1" id="date1" /> 
	<input type="hidden" name ="tgl2" id="date2" /> 
	<script>
	$("#date1").val($("#Sales_date").val());
	$("#date2").val($("#Sales_tgl").val());
	</script>
	<?// $count = count($summary); 
	$itemdata = Outlet::model()->findAll();
	foreach($itemdata as $key){
	?>
	<tr>
		<td><?=Outlet::model()->findByPk($key["kode_outlet"])->nama_outlet?></td>
		<td style='text-align:left;'>:</td>	<td style='text-align:right;font-weight:bold'><?=number_format($bersih_d[$key["kode_outlet"]])?></td>
		<td style="width:200px">
<!--		<input type="bu" value="Detail" class="cetakdetail" />-->
		<input type="SUBMIT" value="Detail" onmousemove="$('#get').val(<?=$key['kode_outlet']?>)"    />
		<?
		?>
	</td>

	</tr>
	<?
	$total +=$bersih_d[$key["kode_outlet"]];
	$a+=1;
	?>
		
	
	<?}?>
	<input type="hidden" name="id" id="get" />
</form>

<tr>
<td></td>
<td></td>
<td style='text-align:right;margin-top:-100px;'>_________ +</td>
</tr>


<tr>
<td>Total bersih outlet </td>
<td>:</td>
<td style='text-align:right;color:red'><?=number_format($total)?>*</td>
</tr>
</table>
</div>
