<style type="text/css">
	#information-company{
                width: 100%;
                height: 150px;
                /*background-image:url('images/back-red.jpg')!important;*/
                margin-top: -20px;
            }
            #information-company img{

                float: left;
            }
            #information-company .company-name{
                float: left;
                margin-top:15px;
                margin-left:20px;
                color: white!important;
                color: black!important;
            }
             #information-company .company-addres{
                float: left;
                top: 50px;
                left: 320px;
                /*margin-top:50px;*/
                /*margin-left:-330px;*/
                color: black!important;
                position: absolute;
            }


</style>
<div id="information-company">
    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" style="width:300px;height:auto">      
    <p> <?php $company = Branch::model()->findByPk(1);  ?>
        <h1  class="company-name"><?php echo $company->branch_name ?></h1>
        <h4  class="company-addres"><?php echo $company->address ?></h1>
    </p>
</div>
<hr>
	<a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php"><img  class="no-print" style="height:50px;width:50px;float:right;" src="<?php echo Yii::app()->request->baseUrl; ?>/images/home-logo.png"/></a>
		
	<title>
	Detail Bagi Hasil Penjualan Format - 2		
	<?php echo  "Periode : ".$tglheader." sampai ".$tgl2header; ?>
 
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
	 
	<h1 style="">Detail Bagi Hasil Penjualan 
	<a style="color:red;text-decoration:none"></a>
	 <? //$data['nm'];?></h1>
	 <?
	 if ($tglheader==	$tgl2header)
		echo "Tanggal : ".$tglheader;
	 else
		echo "Periode : ".$tglheader." sampai ".$tgl2header; 
	 ?>
	<div style="border-color:black;font-size:10px" >
	<table border="1" cellpadding="5"  style="width:100%;border:1px solid #000000;border-width:0px 0px 0px 0px;font-size:12px" colspan = "3" rowspan="3">
	<tr>
	<td>No</td>
	<td>Nama</td>
	<?php
	$date1 = $tglheader;
	$date2 = $tgl2header;
	// $diff = (strtotime($date2) - strtotime($date1));
	$dif = Yii::app()->db->createCommand()
	->select("DATEDIFF('$tgl2','$tgl1') as selisih ")
	->from("sales")
	->limit("1")
	->queryRow();

	$days = $dif['selisih'];
	
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
	// echo "hehe ".$hari . " " .$days;
	// $days++;
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
		<td>Diskon</td>
		<td>Grand Total </td>
		<td><? echo Outlet::model()->find("kode_outlet=$id")->persentase_hasil?>%</td>
		<td><? echo 100-Outlet::model()->find("kode_outlet=$id")->persentase_hasil?>%</td>
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
		// echo $tgl1;
		// echo $tgl2;
		$items = Yii::app()->db->createCommand()
			->select('si.sale_id slid,i.id iid,i.item_name item_name, si.item_price unit_price')
			->from('items i, sales s, sales_items si ,outlet o')
			->where("s.id = si.sale_id
				and
				si.item_id = i.id 
				and
				o.kode_outlet = i.kode_outlet
				and
				o.kode_outlet = $id
				")
			->group("si.item_id, si.item_price ")
			->order("i.item_name asc")
			->queryAll();
				// and
				// date(s.date) > '$tgl1' and date(s.date) < '$tgl2'  				
		// print_r($items);
		$no = 0;
		$km =1;
		foreach($items as $values){
			$sqldis = "
				SELECT sale_id,item_id,
				SUM(item_discount/100*si.quantity_purchased)*unit_price diskon
				FROM 
				sales_items si,sales s,items i
				WHERE 
				si.sale_id = s.id
				AND
				si.quantity_purchased !=0
				AND
				s.date >= '$_REQUEST[tgl1]' AND s.date <= '$_REQUEST[tgl2]' 
				AND si.item_id = $values[iid]  AND si.`item_id` = i.`id` 
				GROUP BY item_id
			";
			// echo $sqldis;
			$getdiscount = Yii::app()->db->createCommand($sqldis)->queryRow();

			// print_r($getdiscount['diskon']);
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
			
			sum(if(si.item_price<0,-quantity_purchased,quantity_purchased)) qty,item_discount diskon
			,si.item_price,(si.item_price*sum(quantity_purchased)) as 'total'")
			->from('sales_items si,items i,outlet o,sales s')
			->where("s.status = 1 and  date(date) = '".$lengkap."' and si.item_id = i.id and
			o.kode_outlet = i.kode_outlet and si.sale_id = s.id and i.kode_outlet =$id and 
			i.category_id != 5 and
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
			<td>
&nbsp;
			<?
			if ($jml==0)
				$dsc = "0";
			else
				$dsc =  $getdiscount['diskon'] ;

			echo $dsc;

			?></td>
			<td>&nbsp;<?=number_format(abs($values['unit_price'])*$jml-($getdiscount['diskon'] ))?></td>
			<td>
<?
// echo $jml;
echo number_format((Outlet::model()->find("kode_outlet=$id")->persentase_hasil)*(abs($values['unit_price'])*$jml-$dsc)/100)
?></td>
			<td><?=number_format((100-(Outlet::model()->find("kode_outlet=$id")->persentase_hasil))*(abs($values['unit_price'])*$jml-$dsc)/100)?></td>
			<td style="width:100px">&nbsp;</td>
		</tr>
		<?
		$total_qty += $jml;
		$total_dsc += $dsc;
	 		
		$total_price += ($values['unit_price']);
		$total_bruto += $values['unit_price']*$jml;
		$total_tenant += (Outlet::model()->find("kode_outlet=$id")->persentase_hasil*(abs($values['unit_price'])*$jml-$dsc)/100);
		$total_bumi += ((100-(Outlet::model()->find("kode_outlet=$id")->persentase_hasil))*(abs($values['unit_price'])*$jml-$dsc)/100);
	}?>
	<td></td>
	<td></td>
	<?php
	for($a=$hari;$a<=$hari+$days;$a++){
	?><td></td><?}?>
	<td><?=number_format($total_qty)?></td>
	<td>-</td>
	<td><?=number_format($total_bruto)?></td>
	<td class="footer" ><?=number_format($total_dsc)?></td>
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
