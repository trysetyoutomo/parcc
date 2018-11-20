<h1>Pembayaran</h1>
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
		echo "<th>Compliment</th>";
		echo "<th>Netcash</th>";
		echo "<th>BCA</th>";
		echo "<th>Mandiri</th>";
		echo "<th>Niaga</th>";
		echo "<th>voucher</th>";
	echo "</tr>";
echo "</thead>";
echo "<tbody>";
$c=1;
//$tot = 3;
foreach($tot as $a){
	echo "<tr>";
		echo "<td>".$c++."</td>";
		echo "<td>".$a['tgl']."</td>";
		echo "<td>".number_format($a['compliment'])."</td>";
		echo "<td>".number_format($a['netcash'])."</td>";
		echo "<td>".number_format($a['BCA'])."</td>";
		echo "<td>".number_format($a['mandiri'])."</td>";
		echo "<td>".number_format($a['niaga'])."</td>";
		echo "<td>".number_format($a['voucher'])."</td>";
	echo "</tr>";
	$sst +=$a['compliment'];
	$sd +=$a['netcash'];
	$ss +=$a['BCA'];
	$tax +=$a['mandiri'];
	$stt +=$a['niaga'];
	$stt2 +=$a['voucher'];
}
echo "</tbody>";
echo "<tfoot style='background-color:#ccc;'>";
	echo "<tr>";
		echo "<td>&nbsp;</td>";
		echo "<td>&nbsp;</td>";
		echo "<td>".number_format($sst)."</td>";
		echo "<td>".number_format($sd)."</td>";
		echo "<td>".number_format($ss)."</td>";
		echo "<td>".number_format($tax)."</td>";
		echo "<td>".number_format($stt)."</td>";
		echo "<td>".number_format($stt2)."</td>";
	echo "</tr>";
echo "</tfoot>";
echo "</table>";
?>