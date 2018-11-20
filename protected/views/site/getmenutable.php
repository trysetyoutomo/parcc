<?php
$sql = "
select 
i.lokasi,
i.id iid,
item_name,
si.cetak cetak,
si.id siid,
permintaan,
quantity_purchased 
from 
sales s 
inner join
sales_items si
on 
s.id  = si.sale_id
and 
s.table = '$table'
and
s.status = 0

inner join
items i 
on i.id = si.item_id
 ";
 // echo $sql;
$query = Yii::app()->db->createCommand($sql)->queryAll();
$no = 1;
foreach ($query as $q) {
?>
<tr class="baris">
	<td style="display:none"><?php echo $no ?></td>
	<td style="display:none" cetak="<?php echo $q[cetak] ?>"  class="pk" nilai="<?php echo $q[iid] ?>" siid="<?php echo $q[siid] ?>" lokasi="<?php echo $q[lokasi] ?>"><?php echo $q[iid] ?></td>
	<td class='nama_menu'><?php echo $q[item_name] ?></td>
	<td class='jumlah'>
	 <input 
	 min="1"
	 maxlength='2'
	 style='width:40px'
	 class='input-jumlah'
	 type='number' 
	 value='<?php echo $q[quantity_purchased] ?>'
	 <?php 
		 if ($q[cetak]==1){
		 	echo "disabled";
		 }
	 ?>
	 >
	<?php //echo $q[quantity_purchased] ?>

	</td>
	<td><textarea 	 <?php if ($q[cetak]==1){echo "disabled";} ?>
	><?php echo $q[permintaan] ?>&nbsp;</textarea>
	<td><?php 
	
	if ($q[cetak]==0){
		echo "BELUM";
	}
	else{
		?>
		<!-- <img class="btn-reprint" src='<?php //echo Yii::app()->request->baseUrl; ?>/img/print.ico' style="width:20px;height:auto"> -->
		<?php 
		echo "SUDAH";
	}

	 ?></td class="spoile" siid="<?php echo $q[siid] ?>">
	<td align="center" class='hapus' >
	X
		<?php 
		// if ($q[cetak]==0){
		// 	echo "<p >X</p>";
		// }
		?>
		

	</td>
	<!-- <td align="center" class='spoile' >
	X
	</td> -->
	</td>
</tr>
<?php 
$no++;
}
 ?>
 <?php
$sqlnama = "
	select nama from sales where sales.table = '$table' and status = '0'
";
$sqlnamaval = Yii::app()->db->createCommand($sqlnama)->queryRow();
?>
<script type="text/javascript">
	$(document).ready(function(){
		// function namapel(){
			$('#namapel').val('<?php echo $sqlnamaval[nama]; ?>');
		// }
	});
</script>