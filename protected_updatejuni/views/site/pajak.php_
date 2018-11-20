<applet name="jzebra" code="jzebra.PrintApplet.class" archive="jZebra/jzebra/jzebra.jar" width="0" height="0">
    <param name="printer" value="zebra">
</applet>

<?php 
	$this->renderPartial('application.views.site.main');
?>

<?php 
	$list_id = array();
	foreach ($model as $m) {
		array_push($list_id, $m[id]);
	}
?>
<script type="text/javascript">
var s = {};
var list_id = <?php echo json_encode($list_id) ?>;

// (function theLoop (i) {
//   setTimeout(function () {
//     alert("Cheese!");
//     if (--i) {          // If i > 0, keep going
//       theLoop(i);       // Call the loop again, and pass it the current value of i
//     }
//   }, 2000);
// })(3);

// alert(list_id);
$(document).on('click','.cetak-all',function(){
	// alert("123");
	var bill = $("#bill").val();
	if (bill==""){
		alert("silahlan isi no bill ! ");
		exit;
	}
	var n = 0;
	var x = confirm("Printer akan mencetak seluruh bill yang ada, yakin ? ");
	if (!x){
		exit;
	}
	var timer = list_id.length;
	// alert(timer);
	// alert(list_id);
	// var inter = setInterval(function(){
	// 	var st_ajx;
				// 'data':{'id':value,'pajak':true,'no_fake':key },
			$.ajax({
				'data':{
					data : list_id,
					pajak : true,
					no_fake : bill
				},
				'dataType': "text", 
				'url':'index.php?r=sales/CetakReportAll',
				'cache':false,
				'success':function(data){
					s = jQuery.parseJSON(data);
					var jumlah = s.length-1;
			
						(function theLoop (i) {
						  setTimeout(function () {
						    // alert("Cheese!");
						    print_bayar(s[i]);
						     if (i>0){
					    	   i--;
					    	   theLoop(i);       // Call the loop again, and pass it the current value of i
						     }
						      
						  }, 1000);
						})(jumlah);


				},
				 complete: function(xhr, textStatus) {
			            st_ajx = textStatus;
			    } 
			});
			

		// alert(s);
		// print_bayar(s);
		
	// 	alert(timer);
	// 	if (timer==0){
	// 		clearInterval(inter);
	// 		alert("stop");
	// 	}
	// }, 3000);
	// 	console.log("sukses");
	// 	setTimeout(function(){}, 1000);
	// 	alert("sukses"+value);
	// 	// alert( key + ": " + value );
	// });


});
$(document).on('click','.cetak',function(){


	jQuery.ajax({
		'data':{
			'id':$(this).attr("sid")
		},
		'success':function(data){
			// alert(data);
			var sales = jQuery.parseJSON(data);
			if (sales.sale_id!='')
			{
				print_bayar(sales);
			}
		},
		'error':function(data){
			alert('data')
		},
		'url':'index.php?r=sales/CetakReport',
		'cache':false
	});
	return false;

});

</script>


<br>
<h1>
	LAPORAN PAJAK 
</h1>
<?php 


?>
<style type="text/css">
	.table {
		width: 100%;
	}
	.table tr td{
		text-align: right;
	}
</style>
<form>
<input required type="hidden" name="r" value="site/pajak">
Bulan
<select required name="bulan" >
	<?php for($a=1;$a<=12;$a++) {?>
		<option <?php if ($_REQUEST[bulan]==$a) echo "selected" ?> value="<?php echo $a; ?>"><?php echo $a  ?></option>
	<?php } ?>
</select>
Tahun
<select required name="tahun">
	<?php for($a=date("Y")-5;$a<=date("Y")+5;$a++) {?>
		<option <?php if ($_REQUEST[tahun]==$a) echo "selected" ?> value="<?php echo $a; ?>"><?php echo $a  ?></option>
	<?php } ?>
</select>

No mulai Bill 
<input required name="bill" id="bill" value="<?php echo $_REQUEST[bill] ?>">
<fieldset><legend>Maksimal Sub-total</legend>	
	<table>
		<tr>
			<td>Minggu ke - 1</td>
			<td><input required type="text" name="minimal[1]" value="<?php echo $_REQUEST[minimal][1] ?>" ></td>
		</tr>
		<tr>
			<td>Minggu ke - 2</td>
			<td><input required type="text" name="minimal[2]" value="<?php echo $_REQUEST[minimal][2] ?>"></td>
		</tr>
		<tr>
			<td>Minggu ke - 3</td>
			<td><input required type="text" name="minimal[3]" value="<?php echo $_REQUEST[minimal][3] ?>"></td>
		</tr>
		<tr>
			<td>Minggu ke - 4</td>
			<td><input required type="text" name="minimal[4]" value="<?php echo $_REQUEST[minimal][4] ?>"></td>
		</tr>
	</table>
</fieldset>

<input type="submit" value="cari">
<input type="button" value="cetak daftar bill" class="cetak-all">
<form>
<br>
<br>

<table class="table">
	<thead>
	<tr>
		<th>No Bill</th>
		<th>Real No Bill</th>
		<th>Date</th>
		<th>Subtotal</th>
		<th>pajak</th>
		<th>Service</th>
		<th>Total</th>
		<th>Cetak</th>
	<tr>
	</thead>
	<tbody>
	<?php 
	if (isset( $_REQUEST[bill] ) ){		
		$no = $_REQUEST[bill];
	}else{
		$no = 1;
	}
	$subtotal = 0;
	foreach ($model as $m): ?>
		<tr>
			

			<td style="text-align:left"><?php echo $no; ?></td>
			<td style="text-align:left"><?php echo $m[id]; ?></td>
			<td style="text-align:left"><?php echo $m[date]; ?></td>
			<td><?php echo number_format($m[sale_sub_total]); ?></td>
			<?php 
			$subtotal = $subtotal + $m[sale_sub_total];
			?>
			<td><?php echo number_format($m[sale_tax]); ?></td>
			<td><?php echo number_format($m[sale_service]); ?></td>
			<td><?php echo number_format($m[sale_total_cost]); ?></td>
			<td><input sid="<?php echo $m[id]; ?>" class="cetak" type="button" value="cetak"></td>
			
		</tr>
	<?php 
	$no++;
	endforeach; ?>
	</tbody>
</table>
<h1>
<?php 
echo number_format($subtotal);
?>
</h1>
