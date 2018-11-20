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
$(document).on('click','.set-pajak',function(){
	if (confirm("Yakin ?")==false) return;
	var arr = [];
	var arr1 = [];
	// $.each('.sale_id',)
	$( ".sale_id" ).each(function( index ) {
		var nilai = $(this).text();
		arr.push(nilai);
	});
	$( ".fsale_id" ).each(function( index ) {
		var nilai = $(this).text();
		arr1.push(nilai);
	});
	// $( ".sale_id" ).each(function( index ) {
	// 	var nilai = $(this).text();
	// 	arr.push(nilai);
	// });
	// alert(JSON.stringify(arr));
	// arr.push();
	$.ajax({
		'data':{
			persen_jb : $("#val_jb").html(),
			persen_jp : $("#val_jp").html(),
			bulan : $("#bulan").val(),
			tahun : $("#tahun").val(),
			detail : arr,
			detail1 : arr1,
		},
		'dataType': "text", 
		'type': "POST", 
		'url':'index.php?r=site/setpajak',
		'cache':false,
		'success':function(data){
			alert(data);
		},
		 complete: function(xhr, textStatus) {
	            // st_ajx = textStatus;
	    } 
	});
	// alert("123");
});

$(document).on('change','#bulan',function(){
	var bulan = $("#bulan").val();
	var tahun = $("#tahun").val();
	var nilaibulan = bulan.length;
	if (nilaibulan == 1) {
		nilaibulan = "0"+bulan;
	}else{
		nilaibulan = bulan; 
	};
	var nilaitahun = tahun.substr(2,2);
	var hasil = nilaitahun+nilaibulan+"0001";
	$("#bill").val(hasil);
	// alert(hasil);
});

$(document).on('change','#tahun',function(){
	var bulan = $("#bulan").val();
	var tahun = $("#tahun").val();
	var nilaibulan = bulan.length;
	if (nilaibulan == 1) {
		nilaibulan = "0"+bulan;
	}else{
		nilaibulan = bulan; 
	};
	var nilaitahun = tahun.substr(2,2);
	var hasil = nilaitahun+nilaibulan+"0001";
	$("#bill").val(hasil);
	// alert(hasil);
});


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
					// alert(data);

					var s = JSON.parse(data);
					// alert(sx);
					var jumlah = s.length-1;
			
						(function theLoop (i) {
						  setTimeout(function () {
						    // alert("Cheese!");
						    print_bayar(s[i],1);
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
			'id':$(this).attr("sid"),
			'no_fake':"123"
		},
		'success':function(data){
			// alert(data);
			var sales = jQuery.parseJSON(data);
			if (sales.sale_id!='')
			{
				print_bayar(sales,0);
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
	.table tr:hover{
		background-color: skyblue;
	}
	.last-pajak tr td{
		border: 1px solid black;
	}
	.last-pajak tr th{
		background-color: rgba(163,0,0,1);
		color: white;
	}

	#footer{
		display: none;
	}
</style>
<form>
<input required type="hidden" name="r" value="site/pajak">
Bulan
<select required name="bulan" id="bulan" >
	<?php for($a=1;$a<=12;$a++) {?>
		<option <?php if ($_REQUEST[bulan]==$a) echo "selected" ?> value="<?php echo $a; ?>"><?php echo $a  ?></option>
	<?php } ?>
</select>
Tahun
<select required name="tahun" id="tahun">
	<?php for($a=date("Y")-5;$a<=date("Y")+5;$a++) {?>
		<option <?php if ($_REQUEST[tahun]==$a) echo "selected" ?> value="<?php echo $a; ?>"><?php echo $a  ?></option>
	<?php } ?>
</select>

No mulai Bill 
<input readonly="" name="bill" id="bill" value="<?php echo $_REQUEST[bill] ?>">
<fieldset><legend>Maksimal Sub-total</legend>	
	<table>
	<?php 
	$p = Parameter::model()->findByPk(1);
	?>
		<tr>
			<td>Minggu ke - 1</td>
			<td><input required type="text" name="minimal[1]" value="<?php 
				if ( $_REQUEST[minimal][1]!='' ){
				echo $_REQUEST[minimal][1];
				}else{
				echo $p->pajak_1;
				}
				
				 ?>

			" ></td>
		</tr>
		<tr>
			<td>Minggu ke - 2</td>
			<td><input required type="text" name="minimal[2]" value="<?php 
				if ( $_REQUEST[minimal][2]!='' ){
				echo $_REQUEST[minimal][2];
				}else{
				echo $p->pajak_2;
				}
				
				 ?>"></td>
		</tr>
		<tr>
			<td>Minggu ke - 3</td>
			<td><input required type="text" name="minimal[3]" value="<?php 
				if ( $_REQUEST[minimal][3]!='' ){
				echo $_REQUEST[minimal][3];
				}else{
				echo $p->pajak_3;
				}
				
				 ?>"></td>
		</tr>
		<tr>
			<td>Minggu ke - 4</td>
			<td><input required type="text" name="minimal[4]" 
			value="<?php 
				if ( $_REQUEST[minimal][4]!='' ){
					echo $_REQUEST[minimal][4];
				}else{
					echo $p->pajak_4;
				}	
			 ?>">
			 </td>
		</tr>
	</table>
</fieldset>

<input type="submit" value="cari">
<input type="button" value="Set Pajak Bulan ini" class="set-pajak">
<?php 
$tahun = $_REQUEST['tahun'];
$bulan = $_REQUEST['bulan'];
$detail = $_REQUEST['detail'];
$detail1 = $_REQUEST['detail1'];
$z = SalesPajakHead::model()->findAll("bulan='$bulan' and tahun='$tahun' ");

// echo "string";
if (count($z)==0){
?>
<style type="text/css">
	#pajak-data{
		display: none!important;
	}
	.cetak-all{
		display: none;
	}
</style>
<?php
}

?>
<input type="button" value="cetak daftar bill" class="cetak-all">


<form>
<br>
<br>

<?php 
if (isset($_REQUEST['bulan'])):

?>
<table class="table" id="pajak-data">
	<thead>
	<tr>
		<th>Modified Bill ID</th>
		<th style="display: none;">Real No Bill</th>
		<th>Bill ID</th>
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
			

			<td class="fsale_id" style="text-align:left"><?php echo $no; ?></td>
			<td style="display: none;" class="sale_id" style="text-align:left"><?php echo $m[id]; ?></td>
			<td class="f_sale_id" style="text-align:left"><?php echo $m[fid]; ?></td>
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
	$sum_stc += $m[sale_sub_total];
	$subsps += $m['sale_sub_total'] - ($m['sale_discount'] + $m['voucher']);
	endforeach; ?>
	</tbody>
	<tfoot>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td><?php echo number_format($sum_stc) ?></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
	</tfoot>
</table>

<?php 
endif;
// }
?>
<style type="text/css">
	.summary{
		position: fixed;
		top: 50px;
		right: 40px;
	}
</style>









<?php 
function getLastMonth(){
	$sql = "SELECT s.bayar,
	s.table,inserter, s.comment COMMENT,
	s.id,SUM(si.quantity_purchased) AS total_items,
	DATE,
	month(DATE) bulan,
	year(DATE) tahun,
	s.waiter waiter,

	SUM(si.item_price*si.quantity_purchased) subtotal,

	SUM(si.item_tax) pajak,
	sph.persen_jp persen

	FROM
	sales s,
	sales_items si ,
	users u ,
	items i,
	sales_pajak_detail spd,
	sales_pajak_head sph
	WHERE
	s.status = 1
	and
	spd.sale_id = s.id
	AND
	sph.id = spd.head_id
	AND
	i.id = si.item_id AND

	s.id = si.sale_id  AND s.status=1 AND inserter = u.id 
	and 

	month(s.date)<month(now())

	GROUP BY MONTH(s.date)

	ORDER BY MONTH(s.date) ASC
	LIMIT 3 ";
	$model = Yii::app()->db->createCommand($sql)->queryAll();
	return $model;
}
$data = array(
1=>'Januari',
2=>'Februari',
3=>'Maret',
4=>'April',
5=>'Mei',
6=>'Juni',
7=>'July',
8=>'Agustus',
9=>'September',
10=>'Oktober',
11=>'November',
12=>'Desember');
?>

<div class="summary">
<?php 
if (isset($_REQUEST['minimal']) ):
$Subtotal2 = 0;
foreach ($model2 as $m2):
	// $Subtotal2 = $Subtotal2 + $m2["sale_sub_total"]; 
	$Subtotal2 += $m2['sale_sub_total'];
	$pajak2 += $m2['sale_sub_total'] - ($m2['sale_discount'] + $m2['voucher']);
endforeach;
endif;
?>
	<table style="width:150px;background:white;">
		<tr>
			<td>Real Subtotal</td>
			<td><h1><?php echo number_format($Subtotal2);?></h1></td>
		</tr>
		<tr>
			<td>Jumlah Bill</td>
			<td><?php echo count($model2) ?></td>
		</tr>
		<tr>
			<td>Jumlah Pajak</td>
			<td><h1><?php echo number_format($pajak2 *0.1);?></h1></td>
	
		</tr>
		<tr>
			<td>================================================</td>
		</tr>
		<tr>
			<td>Perubahan Subtotal</td>
			<td ><h1 style="color:red"><?php echo number_format($sum_stc);?></h1></td>
		</tr>
		<tr>
			<td>Jumlah Bill</td>
			<td style="color:red"><?php echo count($model) ?></td>
		</tr>
		<tr>
			<td>Jumlah Pajak</td>
			<td><h1 style="color:red"><?php echo number_format($subsps *0.1);?></h1></td>
		</tr>
		<tr>
			<td>================================================</td>
		</tr>
		<tr>
			<td>Persentase Jumlah Bill</td>
			<td><h1 class="val-persen">
				<?php
				try{
					$bila = count($model);
					$bilb = count($model2);
					if ($bilb > 0) {
						echo round(($bila/$bilb) * 100)." %";
					?>
					<?php
					}
				}catch(Exception $err){
					echo "$err";
				}
				?>
				<?php if ($bilb > 0) { ?>
				<div id="val_jb" style="display:none"><?php echo round(($bila/$bilb) * 100); ?></div>
				<?php } ?>
			</h1>
			
			</td>
		</tr>
		<tr>
			<td>Persentase Jumlah Pajak</td>
			<td><h1 class="val-persen">
			<?php 
			if (isset($_REQUEST[minimal])){
				try{	
					// echo $subtotal;
					// echo "<br>";
					// echo $subsps;
					if ($subtotal!=0 && $Subtotal2!=0){
					echo round( ($subsps/$pajak2) * 100)." %" ;
					}	
				}
				catch (Exception $e) {
	 			   echo 'Caught exception: ',  $e->getMessage(), "\n";
				}
			}
			?>
			<?php if ($subtotal!=0 && $Subtotal2!=0){ ?>
				<div id="val_jp" style="display:none"><?php echo round(($subsps/$pajak2) * 100 ); ?></div>
				<?php } ?>
			</h1></td>
		</tr>
		<tr>
			<td colspan="3" style="border:1px solid">
				<center>Laporan Set Pajak 3 Bulan Terakhir</center>
				<table class="last-pajak">
					<tr>
						<th>Bulan</th>
						<th>Tahun</th>
						<th>Subtotal</th>
						<th>Persentasi</th>
						<th>Pajak</th>
					</tr>
					<?php 
					// print_r(getLastMonth());
					foreach(getLastMonth() as $x ): ?>
					<tr>
						<td><?php echo $data[$x['bulan']] ?></td>
						<td><?php echo $x['tahun'] ?></td>
						<td style="text-align:right"><?php echo number_format($x['subtotal']); ?></td>
						<td style="text-align:right"><?php echo number_format($x['pajak']); ?></td>
						<td style="text-align:right"><?php echo number_format($x['persen'])." %"; ?></td>
					</tr>
				<?php endforeach; ?>
				</table>
			</td>
		</tr>
	</table>
</div>
