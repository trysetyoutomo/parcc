	<a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php"><img  class="no-print" style="height:50px;width:50px;float:right;" src="<?php echo Yii::app()->request->baseUrl; ?>/images/home-logo.png"/></a>
		
	<title>
	Detail Bagi Hasil Format - 2 
	</title>
	<style>	
	.footer {
		color : red;
		text-width:bold;
		font-size:30px;
	}
	#header{
		text-align : left;
	}
	</style>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />

	<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
	<?php Yii::app()->getClientScript()->registerCoreScript('jquery.ui'); ?>



	<div class="data">
	 
	<h1 style="">Detail Tenant<a style="color:red;text-decoration:none"></a>
	 <?=$data['nm'];?></h1>
	 <?
	 if ($tglheader==$tgl2header)
		echo "Tanggal : ".$tglheader;
	 else
		echo "Periode : ".$tglheader." sampai ".$tgl2header; 
	 ?>
	<div style="border-color:black;font-size:10px" >
	<table border="1" cellpadding="5"  style="border:1px solid #000000;border-width:0px 0px 0px 0px;font-size:12px" colspan = "3" rowspan="3">
	<tr>
	<td>No</td>
	<td>Nama</td>
	<?php
	$date1 = $tglheader;
	$date2 = $tgl2header;
	$diff = abs(strtotime($date2) - strtotime($date1));
	$years = floor($diff / (365*60*60*24));
	$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
	$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
	// echo $days;
	if ($tglheader=="" && $tglhader2==""){ 
		$hari = date('d'); 
		$bulan = date('m'); 
		$tahun = date('Y');
	}
	else{
		$hari =  date_format(date_create($tglheader), 'd');
		$bulan =  date_format(date_create($tglheader), 'm');
		$tahun =  date_format(date_create($tglheader), 'Y');	
	}

	$h = $hari;
	$d = $days;
	$k=1;
	for($a=$hari;$a<=$hari+$days;$a++){
		
		?>
		<td>
		<?
		if(checkdate($bulan, $a, $tahun))
			echo $a."-".$bulan."-".$tahun;
		else{
			$tglakhir = strtotime($tahun."-".$bulan."-".$a);
			$akhir =  date('t',$tglakhir);			
			$date = $tahun."-".$bulan."-".$akhir;
			$date = strtotime($date);
			$date = strtotime("+ $k day", $date);
			echo date('d-m-Y', $date);
			$k++;
			// echo $akhir;
		}
			//echo  "1"."-".$bulan."-".$tahun;
			
		?>
		</td>
		
		<?}?>
		<td>Total QTY</td>
		<td>Harga</td>
		<td>Total Sales</td>
		<td><?=Outlet::model()->find("kode_outlet=$id")->persentase_hasil?>%</td>
		<td><?=100-Outlet::model()->find("kode_outlet=$id")->persentase_hasil?>%</td>
		<td>Keterangan</td>
		</tr>
		<?
			// $connection = Yii::app()->db;
			// $items = $connection->createCommand("		
			// select  from
			// 
			// where
			// 
			// group by 
			// order by i.item_name asc
			// ");
		// $items = Items::model()->findAll("kode_outlet=$id",array('order' => 'id')); 
		$items = Yii::app()->db->createCommand()
			->select('i.item_name item_name, si.item_price unit_price')
			->from('items i, sales s, sales_items si ,outlet o')
			->where("s.id = si.sale_id
				and
				si.item_id = i.id 
				and
				o.kode_outlet = i.kode_outlet
				and
				o.kode_outlet = $id")
			->group("si.item_id, si.item_price ")
			->order("i.item_name asc")
			
			->queryAll();
			
		$no = 0;
		$km =1;
		foreach($items as $values){
		$jml=0;$no++?>
		<tr style="width:100px;overflow:visible;" >
			<td><?=$no?></td>
			<td><?=$values["item_name"]?></td>
		
		<?
		$km = 1;
		for($a=$hari;$a<=$hari+$days;$a++){
			if (checkdate($bulan, $a, $tahun))
				$lengkap = $tahun."-".$bulan."-".$a;
			else{				
				$tglakhir = strtotime($tahun."-".$bulan."-".$a);
				$akhir =  date('t',$tglakhir);			
				$date = $tahun."-".$bulan."-".$akhir;
				$date = strtotime($date);
				$tambah = ($hari+$days)-$a+1;
				$date = strtotime("+ $km	 day", $date);
				$lengkap =  date('Y-m-d', $date);
				$km++;
			}
			
			$summary = Yii::app()->db->createCommand()
			->select("date(date) waktu,nama_outlet,item_name,
			
			sum(if(si.item_price<0,-quantity_purchased,quantity_purchased)) qty
			,si.item_price,(si.item_price*sum(quantity_purchased)) as 'total'")
			->from('sales_items si,items i,outlet o,sales s')
			->where("s.status = 1 and  date(date) = '".$lengkap."' and si.item_id = i.id and
			o.kode_outlet = i.kode_outlet and si.sale_id = s.id and i.kode_outlet =$id and 
			item_name = '".$values[item_name]."' and si.item_price =  '".$values[unit_price]."' ")
			->group("i.id ,date(s.date)")
			->queryRow();
			// var_dump($summary);
			
			?>
			<td  align="center"><?
			if (date_create($lengkap)==date_create($summary["waktu"])){
				echo $summary['qty'];
				$jml += $summary['qty'];
			}else{
			echo "&nbsp";
			}
			// echo $lengkap;
			?></td>
		<?}?>
			<td><?=$jml?></td>
			<td><?=number_format(abs($values['unit_price']))?></td>
			<td><?=number_format(abs($values['unit_price'])*$jml)?></td>
			<td><?=number_format((Outlet::model()->find("kode_outlet=$id")->persentase_hasil)*(abs($values['unit_price'])*$jml)/100)?></td>
			<td><?=number_format((100-(Outlet::model()->find("kode_outlet=$id")->persentase_hasil))*(abs($values['unit_price'])*$jml)/100)?></td>
			<td style="width:100px">&nbsp;</td>
		</tr>
		<?
		$total_qty += $jml;
		$total_price += ($values['unit_price']);
		$total_bruto += (abs($values['unit_price'])*$jml);
		$total_tenant += (Outlet::model()->find("kode_outlet=$id")->persentase_hasil*(abs($values['unit_price'])*$jml)/100);
		$total_bumi += ((100-(Outlet::model()->find("kode_outlet=$id")->persentase_hasil))*(abs($values['unit_price'])*$jml)/100);
	}?>
	<td></td>
	<td></td>
	<?php
	for($a=$hari;$a<=$hari+$days;$a++){
	?><td></td><?}?>
	<td><?=number_format($total_qty)?></td>
	<td>-</td>
	<td><?=number_format($total_bruto)?></td>
	<td class="footer" ><?=number_format($total_tenant)?></td>
	<td class="footer"><?=number_format($total_bumi)?></td>
	</table>
	</div>

	</div>
	<input type="button" value="cetak" class="no-print" onclick="print()" />
	<style>
	@media print
	{    
		.no-print, .no-print *
		{
			display: none !important;
		}
	}
	</style>
