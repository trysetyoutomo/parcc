<script>
tgl1 = $("#Sales_date").val();
tgl2 = $("#Sales_tgl").val();
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
<td style="font-weight:bold;text-decoration:none">Detail pendapatan Tenant (bersih)</td>
</tr>

<?// $count = count($summary); 

$a = 1;
while ($a <= count($bersih_d)-1){
?>
<tr>
<td><?=Outlet::model()->findByPk($a)->nama_outlet?></td>
<td style='text-align:left;'>:</td>	<td style='text-align:right;font-weight:bold'><?=number_format($bersih_d['o'.''.$a.''])?></td>
<td>
<input type="button" value="Detail" class="cetakdetail" onmousemove="$('#get').val(<?=$a?>)"  />
</td>

</tr>
<?
$total +=$bersih_d['o'.''.$a.''];
$a+=1;
}?>
<input style="display:none" type="input" id="get" />

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
<!--
<tr>
<td>Pak Chi Met</td>
<td style='text-align:left;'>:</td>
<td style='text-align:right;'><?=number_format($spcm)?></td>
</tr>
<tr>
<td>Paradays</td>
<td style='text-align:left;'>:</td>
<td style='text-align:right;'><?=number_format($sprd)?></td>
</tr>
<tr>
<td>Ampera</td>
<td style='text-align:left;'>:</td>
<td style='text-align:right;'><?=number_format($summary['ampera'])?></td>
</tr>


<td><u><i>sebelum bagi laba</i></u></td>
</tr>

<tr>
<td>Total Cost</td>
<td style='text-align:left;'>:</td>
<td style='text-align:right;font-weight:bold'><?=number_format($total_before)?></td>
</tr>
<tr>
<td>Bumi arena</td>
<td style='text-align:left;'>:</td>
<td style='text-align:right;'>0</td>
</tr>
<tr>
<td>Pak Chi Met</td>
<td style='text-align:left;'>:</td>
-<td style='text-align:right;'><?=number_format($summary['pak_chi_met'])?></td>
</tr>
<tr>
<td>Paradays</td>
<td style='text-align:left;'>:</td>
<td style='text-align:right;'><?=number_format($summary['paradays'])?></td>
</tr>
<tr>
<td>Ampera</td>
<td style='text-align:left;'>:</td>
<td style='text-align:right;'><?=number_format($summary['ampera'])?></td>
</tr>
<tr>
<td>

</td>	
</tr>
<tr>

!-->
</table>
</div>
