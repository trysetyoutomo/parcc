<h1>Laporan Pembayaran Bulanan</h1>
<?php
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
	
$curr_year = Date('Y');
for($x=$curr_year-5; $x<$curr_year+5;$x++){
	$arr_year[$x] = $x;
}

echo CHtml::beginForm();
echo CHtml::dropDownList('month', $month, $data);
echo CHtml::dropDownList('year', $year, $arr_year);
echo CHtml::button('Submit', array('submit' => array('sales/Salescashmonthly')));
echo CHtml::endForm();

// echo "<BR>";
echo "<BR>";

echo "<table class='items'>";
echo "<thead>";
	echo "<tr>";
		echo "<th>No.</th>";
		echo "<th>Tanggal</th>";
		echo "<th>total</th>";
		echo "<th>Cash</th>";
		echo "<th>Compliment</th>";
		echo "<th>BCA</th>";
		echo "<th>Niaga</th>";
		echo "<th>Voucher</th>";
		echo "<th>dll</th>";
	echo "</tr>";
echo "</thead>";
echo "<tbody>";
$x=1;
//$tot = 3;
foreach($tot as $a){
	echo "<tr>";
		echo "<td>".$x++."</td>";
		echo "<td>".$a['tanggal']."</td>";
		echo "<td>".number_format($a['grandtotal'])."</td>";
		echo "<td>".number_format($a['cash'])."</td>";
		echo "<td>".number_format($a['compliment'])."</td>";
		echo "<td>".number_format($a['edc_bca'])."</td>";
		echo "<td>".number_format($a['edc_niaga'])."</td>";
		echo "<td>".number_format($a['voucher'])."</td>";
		echo "<td>".number_format($a['dll'])."</td>";
	echo "</tr>";
	$az +=$a['cash'];
	$b +=$a['compliment'];
	$c +=$a['edc_bca'];
	$d +=$a['edc_niaga'];
	$e +=$a['voucher'];
	$f +=$a['dll'];
	$zz +=$a['grandtotal'];
}
echo "</tbody>";
echo "<tfoot style='background-color:#ccc;'>";
	echo "<tr>";
		echo "<td>&nbsp;</td>";
		echo "<td>&nbsp;</td>";
		echo "<td>".number_format($zz)."</td>";
		echo "<td>".number_format($az)."</td>";
		echo "<td>".number_format($b)."</td>";
		echo "<td>".number_format($c)."</td>";
		echo "<td>".number_format($d)."</td>";
		echo "<td>".number_format($e)."</td>";
		echo "<td>".number_format($f)."</td>";
	echo "</tr>";
echo "</tfoot>";
echo "</table>";
?>