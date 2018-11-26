<h1>Laporan Penjualan Bulanan (Salon)</h1>
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
echo CHtml::button('Cari', array('submit' => array('sales/Salesmonthlysalon')));
echo CHtml::endForm();

echo "<BR>";
echo "<BR>";

echo "<table class='items'>";
echo "<thead>";
	echo "<tr>";
		echo "<th>No.</th>";
		echo "<th>Tanggal</th>";
		echo "<th>Total Kotor</th>";
		echo "<th>Total  Diskon</th>";
		echo "<th>Total Biaya Pelayanan</th>";
		echo "<th>Total  Pajak </th>";
		echo "<th>Total Bersih</th>";
	echo "</tr>";
echo "</thead>";
echo "<tbody>";
$c=1;
foreach($tot as $a){
	echo "<tr>";
		echo "<td>".$c++."</td>";
		echo "<td>".$a['tgl']."</td>";
		echo "<td>".number_format($a['sst'])."</td>";
		echo "<td>".number_format($a['sd'])."</td>";
		echo "<td>".number_format($a['service'])."</td>";
		echo "<td>".number_format($a['tax'])."</td>";
		echo "<td>".number_format($a['stt'])."</td>";
	echo "</tr>";
	$sst +=$a['sst'];
	$sd +=$a['sd'];
	$ss +=$a['service'];
	$tax +=$a['tax'];
	$stt +=$a['stt'];
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
	echo "</tr>";
echo "</tfoot>";
echo "</table>";
?>