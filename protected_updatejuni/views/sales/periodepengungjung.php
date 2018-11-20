
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
		
<h1>Laporan Pengunung Periode</h1>
	</legend>

<b>Kunjungan Tanggal <?php echo $tanggal_awal;?> s/d <?php echo $tanggal_akhir;?></b>
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
				<th><b>Jam</th>
				<th><b>Banyak Pengunjung</th>
				<!-- <th><b>Deatil Pesanan</th> -->
			</tr>	
		</thead>
	</div>
		<tbody>
					<tr>
						<td>
							00:00
						</td>
						<td>
							<?php 
							if ($nsql00['jumlah'] == null){
								echo 0;	
							}else{
								echo $nsql00['jumlah']; 
							}?>
						</td>
					</tr>
					<tr>
						<td>
							01:00
						</td>
						<td>
							<?php 
							if ($nsql01['jumlah'] == null){
								echo 0;	
							}else{
								echo $nsql01['jumlah']; 
							}?>
						</td>
					</tr>
					<tr>
						<td>
							02:00
						</td>
						<td>
							<?php 
							if ($nsql02['jumlah'] == null){
								echo 0;	
							}else{
								echo $nsql02['jumlah']; 
							}?>
						</td>
					</tr>
					<tr>
						<td>
							03:00
						</td>
						<td>
							<?php 
							if ($nsql03['jumlah'] == null){
								echo 0;	
							}else{
								echo $nsql03['jumlah']; 
							}?>
						</td>
					</tr>
					<tr>
						<td>
							04:00
						</td>
						<td>
							<?php 
							if ($nsql04['jumlah'] == null){
								echo 0;	
							}else{
								echo $nsql04['jumlah']; 
							}?>
						</td>
					</tr>
					<tr>
						<td>
							05:00
						</td>
						<td>
							<?php 
							if ($nsql05['jumlah'] == null){
								echo 0;	
							}else{
								echo $nsql05['jumlah']; 
							}?>
						</td>
					</tr>
					<tr>
						<td>
							06:00
						</td>
						<td>
							<?php 
							if ($nsql06['jumlah'] == null){
								echo 0;	
							}else{
								echo $nsql06['jumlah']; 
							}?>
						</td>
					</tr>
					<tr>
						<td>
							07:00
						</td>
						<td>
							<?php 
							if ($nsql07['jumlah'] == null){
								echo 0;	
							}else{
								echo $nsql07['jumlah']; 
							}?>
						</td>
					</tr>
					<tr>
						<td>
							08:00
						</td>
						<td>
							<?php 
							if ($nsql08['jumlah'] == null){
								echo 0;	
							}else{
								echo $nsql08['jumlah']; 
							}?>
						</td>
					</tr>
					<tr>
						<td>
							09:00
						</td>
						<td>
							<?php 
							if ($nsql09['jumlah'] == null){
								echo 0;	
							}else{
								echo $nsql09['jumlah']; 
							}?>
						</td>
					</tr>
					<tr>
						<td>
							10:00
						</td>
						<td>
							<?php 
							if ($nsql10['jumlah'] == null){
								echo 0;	
							}else{
								echo $nsql10['jumlah']; 
							}?>
						</td>
					</tr>
					<tr>
						<td>
							11:00
						</td>
						<td>
							<?php 
							if ($nsql11['jumlah'] == null){
								echo 0;	
							}else{
								echo $nsql11['jumlah']; 
							}?>
						</td>
					</tr>
					<tr>
						<td>
							12:00
						</td>
						<td>
							<?php 
							if ($nsql12['jumlah'] == null){
								echo 0;	
							}else{
								echo $nsql12['jumlah']; 
							}?>
						</td>
					</tr>
					<tr>
						<td>
							13:00
						</td>
						<td>
							<?php 
							if ($nsql13['jumlah'] == null){
								echo 0;	
							}else{
								echo $nsql13['jumlah']; 
							}?>
						</td>
					</tr>
					<tr>
						<td>
							14:00
						</td>
						<td>
							<?php 
							if ($nsql14['jumlah'] == null){
								echo 0;	
							}else{
								echo $nsql14['jumlah']; 
							}?>
						</td>
					</tr>
					<tr>
						<td>
							15:00
						</td>
						<td>
							<?php 
							if ($nsql15['jumlah'] == null){
								echo 0;	
							}else{
								echo $nsql15['jumlah']; 
							}?>
						</td>
					</tr>
					<tr>
						<td>
							16:00
						</td>
						<td>
							<?php 
							if ($nsql16['jumlah'] == null){
								echo 0;	
							}else{
								echo $nsql16['jumlah']; 
							}?>
						</td>
					</tr>
					<tr>
						<td>
							17:00
						</td>
						<td>
							<?php 
							if ($nsql17['jumlah'] == null){
								echo 0;	
							}else{
								echo $nsql17['jumlah']; 
							}?>
						</td>
					</tr>
					<tr>
						<td>
							18:00
						</td>
						<td>
							<?php 
							if ($nsql18['jumlah'] == null){
								echo 0;	
							}else{
								echo $nsql18['jumlah']; 
							}?>
						</td>
					</tr>
					<tr>
						<td>
							19:00
						</td>
						<td>
							<?php 
							if ($nsql19['jumlah'] == null){
								echo 0;	
							}else{
								echo $nsql19['jumlah']; 
							}?>
						</td>
					</tr>
					<tr>
						<td>
							20:00
						</td>
						<td>
							<?php 
							if ($nsql20['jumlah'] == null){
								echo 0;	
							}else{
								echo $nsql20['jumlah']; 
							}?>
						</td>
					</tr>
					<tr>
						<td>
							21:00
						</td>
						<td>
							<?php 
							if ($nsql21['jumlah'] == null){
								echo 0;	
							}else{
								echo $nsql21['jumlah']; 
							}?>
						</td>
					</tr>
					<tr>
						<td>
							22:00
						</td>
						<td>
							<?php 
							if ($nsql22['jumlah'] == null){
								echo 0;	
							}else{
								echo $nsql22['jumlah']; 
							}?>
						</td>
					</tr>
					<tr>
						<td>
							23:00
						</td>
						<td>
							<?php 
							if ($nsql23['jumlah'] == null){
								echo 0;	
							}else{
								echo $nsql23['jumlah']; 
							}?>
						</td>
					</tr>
		</tbody>
</table>
<!-- <?php //echo CHtml::Button('Export', array('submit'=>array('sales/reportbestsellerexport'))); ?> -->

