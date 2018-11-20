
<script type="text/javascript">
    
</script>

<style type="text/css">
	table th{
		background: #2eaae6;
	}
	table tr:nth-child(odd){
		background-color: skyblue;
	}
	table tr:nth-child(even){
		background-color: #eaeaea;
	}
</style>

<fieldset>
	<legend>
		
<h1>Laporan Penjualan Periode</h1>
<h2><b>Pesanan <?php echo $kategori; ?> Terbanyak</b></h2>
	</legend>

<b>Penjualan Tanggal <?php echo $tanggal_awal;?> s/d <?php echo $tanggal_akhir;?></b>
<?php //echo $tal; ?>
<?php 
// if(Yii::app()->user->getLevel() == 2){
// 	echo "berhasil";
// }else{
// 	echo "gagal";
// }
 ?>

<table width="100%" align="center"  cellpadding="3" border="2">
	<div class="layer"> 
		<thead style="background:skyblue">
			<tr style="background-color:#eaeaea;">
				<th><b>Nama Menu</th>
				<th><b>Jumlah</th>
				<th><b>Harga</th>
			</tr>	
		</thead>
	</div>
		<tbody>
		<?php foreach ($sqlv as $sqlv):  ?>
					<tr>
						<td>
							<?php echo $sqlv['item_name']; ?>
						</td>
						<td>
							<?php echo $sqlv['jumlah']; ?>
						</td>
						<td>
							<?php echo "@".$sqlv['item_price']; ?>
						</td>
					</tr>
		<?php endforeach; ?>
		</tbody>
		<tbody>
		<?php foreach ($totv as $totv):  ?>
					<tr>
						<td><b>
							Jumlah <?php echo $kategori; ?>
						</td></b>
						<td><b>
							<?php echo $totv['jumlah']; ?>
						</td></b>
						<td><b>
							<?php echo "-" ?>
						</td></b>
					</tr>
		<?php endforeach; ?>
		</tbody>
</table>
<!-- <?php //echo CHtml::Button('Export', array('submit'=>array('sales/reportbestsellerexport'))); ?> -->

