<script type="text/javascript">
    
</script>
<style type="text/css">
	@media print{
		#hilang, #header, #footer{
			display: none;
		}
		#head, #tam{
			visibility: visible;
		}
	}
	#head{
		visibility: hidden;
	}
</style>
<div id="hilang">
	<h1>Laporan Pajak</h1>
		
	<?php $form=$this->beginWidget('CActiveForm',array(
	)); ?>
		<div class="row">
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
		</div>
		<br>	
		<div class="row buttons">
			<?php echo CHtml::Button('Show', array('submit'=>array('sales/lappajak'))); ?>
			<button onclick="window.print();">Cetak</button>
			<?php //echo CHtml::Button('Export', array('submit'=>array('sales/periodereportexport'))); ?>
		</div>
	<?php $this->endWidget(); ?>
</div>		

<?php if ($bulan != ""): ?>
<div id="head">
<table id="tam">
	<tr>
		<td width="10%" style="text-align:right">
			<img width="95%" src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png">
		</td>
		<td width="90%" style="text-align:left">
			<h2><center>Parc C ( Cafe & Co-Working )</center></h2>
			<small><center>Jl. Kidang Pananjung No.5C, DAGO. Telepon (022) 2530110 / 2501954</center></small>
		</td>
	</tr>
    <tr>
        <td colspan="2" style="border-bottom: 3px solid black;"></td>
    </tr>
    <tr>
        <td colspan="2" style="border-top: 1px solid black;"></td>
    </tr>
</table>
</div>
<div id="cetak">
	<?php
	$a = 0;
	$b = 0;
	$panjangbulan = strlen($bulan);
	if ($panjangbulan == 1) {
		$bulan = "0".$bulan;
	}else{
		$bulan = $bulan;	
	}

	$aaa = $tahun."-".$bulan."-01";
	$format1 = date('F', strtotime($aaa));
	// echo $format1;
	?>
	<h2><center><b>Laporan Penjualan Bulan <?php echo $format1; ?> Tahun <?php echo $tahun; ?></b></center></h2>

	<?php if ($erorbozz != ""): ?>
		<h1 style="color:red"><center><i><?php echo $erorbozz; ?></i></center></h1>
	<?php else :?>

	<table class="table">
	<thead>
	<tr>
		<th>No</th>
		<th>No Bill</th>
		<th>Date</th>
		<th>Subtotal</th>
		<th>Discount</th>
		<th>Voucher</th>
		<th>Tot Penjualan</th>
		<th>pajak</th>
		<!--<th>Service</th>
		<th>Total</th>-->
	<tr>
	</thead>
	<tbody>
		<?php 
		$inch = 1;
		foreach ($nsqlpa2 as $nsqlpa2): ?>
		<tr>
			<td><?php echo $inch ; ?></td>
			<td><?php echo $nsqlpa2['no_bill']; ?></td>
			<?php 
			$sqlpa1 = "SELECT * FROM  sales WHERE id = $nsqlpa2[sale_id]";
			$nsqlpa1 = Yii::app()->db->createCommand($sqlpa1)->queryRow();	

			$sqlpa3 = "SELECT * FROM  sales_payment WHERE id = $nsqlpa2[sale_id]";
			$nsqlpa3 = Yii::app()->db->createCommand($sqlpa3)->queryRow();
			?>
			<td><?php echo $nsqlpa1['date']; ?></td>
			<?php
			$sqlpast = "select sum(quantity_purchased * item_price) as total from sales_items where sale_id = $nsqlpa2[sale_id]";
			$nsqlpast = Yii::app()->db->createCommand($sqlpast)->queryRow();
			?>	
			<td style="text-align:right"><?php echo number_format($nsqlpast['total']); ?></td>
			<?php 
			$subsps = $nsqlpast['total'] - ($nsqlpa1['sale_discount'] + $nsqlpa3['voucher']);
			$pajak = $subsps * (10/100);
			$service = $subsps * (5/100);
			$tot = $subsps + $pajak + $service;
			?>
			<td style="text-align:right"><?php echo number_format($nsqlpa1['sale_discount']); ?></td>
			<td style="text-align:right"><?php echo number_format($nsqlpa3['voucher']); ?></td>
			<td style="text-align:right"><?php echo number_format($subsps); ?></td>
			<td style="text-align:right"><?php echo number_format($pajak); ?></td>	
			<!--<td style="text-align:right"><?php echo number_format($service); ?></td>	
			<td style="text-align:right"><?php echo number_format($tot); ?></td>-->	
			<?php
			$a = $a + $subsps;
			$b = $b + $pajak;
			$inch++;
			?>
		</tr>
		<?php endforeach ?>
	</tbody>
	</table>
	<table class="table">
	<thead>
	<tr>
		<th>Total Penjualan</th>
		<th style="text-align:right"><?php echo number_format($a) ?></th>
	</tr>
	<tr>
		<th>Total Pajak</th>
		<th style="text-align:right"><?php echo number_format($b) ?></th>
	</tr>
	</thead>
	<tbody>
	</tbody>
	</table>
	<?php endif ?>
</div>
<?php endif ?>

