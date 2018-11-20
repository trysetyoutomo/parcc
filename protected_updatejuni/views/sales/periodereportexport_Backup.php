
<script type="text/javascript">
    
</script>

<fieldset>
	<legend>
		
<h1>Laporan Penjualan Periode</h1>
	</legend>

<b>Penjualan Tanggal <?php echo $tanggal_awal;?> s/d <?php echo $tanggal_akhir;?></b>
<?php //echo $tal; ?>

<table width="100%" align="center"  cellpadding="3" border="2">
	<div class="layer"> 
	<thead style="background:skyblue">
		<tr style="background-color:#eaeaea;">
			<!-- <th style="width: 80%"><b>Menu</th> -->
			<th><b>Id</th>
			<th><b>Tanggal</th>
			<th><b>Sub Total</th>
			<th><b>Discount</th>
			<th><b>Service</th>
			<th><b>Pajak</th>
			<th><b>Grand Total</th>
			<!-- <th><b>Bayar</th> -->
			<th><b>Meja</th>
			<th><b>waiter</th>
			<th><b>Deatil Pesanan</th>
		</tr>	
	</thead>
		</div>
	<tbody>
	<?php foreach ($sqlval as $tg):  ?>
					<tr>
						<td><?php echo $tg['id']; ?></td>
						<td><?php echo $tg['date']; ?></td>
						<td><?php echo $tg['sale_sub_total']; ?></td>
						<td><?php echo $tg['sale_discount']; ?></td>
						<td><?php echo $tg['sale_service']; ?></td>
						<td><?php echo $tg['sale_tax']; ?></td>
						<td><?php echo $tg['sale_total_cost']; ?></td>
						<?php
							if ($tg['paidwith_id'] == 1){
								$tgtg = 'Cash';
							}else if ($tg['paidwith_id'] == 2) {
								$tgtg = 'Edc BCA';
							}else if ($tg['paidwith_id'] == 3) {
								$tgtg = 'Edc BCA';
							}
						?>
						<!-- <td><?php //echo $tgtg; ?></td> -->
						<td><?php echo $tg['aaa']; ?></td>
						<td><?php echo $tg['waiter']; ?></td>
						<td>
							<center>
								<?php 
									$sql = "
										SELECT i.item_id, i.quantity_purchased, i.item_price, i.item_total_cost
										FROM sales_items i
										INNER JOIN sales s ON i.sale_id = s.id
										WHERE s.id = '$tg[id]' 
										";
									$detail = Yii::app()->db->createCommand($sql)->queryAll();
								?>
								<table cellpadding="3" border="1">
									<div> 
										<thead>
											<tr>
												<th><b>Menu Pesanan</th>
												<th><b>Jumlah</th>
												<th><b>Harga</th>
												<th><b>Sub Total</th>
											</tr>	
										</thead>
									</div>
									<tbody>
										<?php foreach ($detail as $test){ ?>
											<tr>
											<?php 
											$sqld = "select item_name from items where id = '$test[item_id]'";
											$namamenu = Yii::app()->db->createCommand($sqld)->queryRow();
											?>
												<td><?php echo $namamenu['item_name']; ?></td>
												<td><center><?php echo $test['quantity_purchased']; ?></center></td>
												<td><?php echo $test['item_price']; ?></td>
												<td><?php echo $test['item_total_cost']; ?></td>
											</tr>
										<?php } ?>
										<?php //endforeach; ?>
										<?php //endforeach; ?>
									</tbody>
								</table>
							</center>
						</td>
						<!-- <td><center><?php //echo $nilaipd['totaljumlah']; ?></center></td> -->
						<!-- <td><center><?php //echo $nilailm['tanggal']; ?></center></td>
						<td><center><?php //echo $nilailm['pelayan']; ?></center></td>
						<td><center>Rp.<?php //echo number_format($nilailm['total']); ?></center></td>
						<td><center>Rp.<?php //echo number_format($nilailm['pajak']); ?></center></td>
						<td><center>Rp.<?php //echo number_format($nilailm['service']); ?></center></td>
						<td><center>Rp.<?php //echo number_format($nilailm['grand_total']); ?></center></td> -->
					</tr>
	<?php endforeach; ?>
	</tbody>
	<tbody>
					<tr>
						<td colspan="9"><?php //echo $tg['id']; ?></td>
						<td>
							<center>
								<?php 
									$sql = "
										select
										sum(sale_sub_total) as gross_sales, sum(sale_discount) as discount, sum(sale_service) as service, sum(sale_tax) as tax, sum(sale_total_cost) as net_sales
										from sales
										where date
										between '$tal' and '$tak'
									";
									$detailsales = Yii::app()->db->createCommand($sql)->queryAll();
								?>
								<table cellpadding="3" border="1">
									<div> 
										<thead style="background:skyblue">
											<tr>
												<th colspan="4"><center>Penjualan</center></th>
												<!-- <th></th> -->
											</tr>	
										</thead>
									</div>
									<tbody>
										<?php foreach ($detailsales as $testsales){ ?>
											<tr>
												<td colspan="2"><b>Net Sales</td>
												<td colspan="2"><?php echo $testsales['net_sales']; ?></td>
											</tr>
											<tr>
												<td colspan="2"><b>Gross Sales</td>
												<td colspan="2"><?php echo $testsales['gross_sales']; ?></td>
											</tr>
											<tr>
												<td colspan="2"><b>Discount</td>
												<td colspan="2"><?php echo $testsales['discount']; ?></td>
											</tr>
											<tr>
												<td colspan="2"><b>Service</td>
												<td colspan="2"><?php echo $testsales['service']; ?></td>
											</tr>
											<tr>
												<td colspan="2"><b>Tax</td>
												<td colspan="2"><?php echo $testsales['tax']; ?></td>
											</tr>
										<?php } ?>
										<?php //endforeach; ?>
										<?php //endforeach; ?>
									</tbody>
								</table>
							</center>
						</td>
					</tr>
	</tbody>
</table>
	<div class="row buttons">
		<?php echo CHtml::Button('Show', array('submit'=>array('sales/periodereportexport'))); ?>
	</div>
