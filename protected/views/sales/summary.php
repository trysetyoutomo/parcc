<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

//var_dump($summary);

echo "<br>";
echo "<div style='width:250px;margin:5px 0;border-top:1px solid #888;border-bottom:1px solid #888;'>";
echo "<br>";
echo "<table>";
echo "<tr>";
	echo "<td> Penjualan Kotor</td>";
	echo "<td style='text-align:left;'>:</td>";
	echo "<td style='text-align:right;font-weight:bold'>".number_format($summary['stc'])."</td>";
echo "</tr>";
echo "<tr>";
	echo "<td>Diskon</td>";
	echo "<td style='text-align:left;'>:</td>";
	echo "<td style='text-align:right;'>".number_format($summary['sd'])."</td>";
echo "</tr>";
echo "<tr>";
	echo "<td>Pajak</td>";
	echo "<td style='text-align:left;'>:</td>";
	echo "<td style='text-align:right;'>".number_format($summary['t'])."</td>";
echo "</tr>";
echo "<tr>";
	echo "<td>Pelayanan</td>";
	echo "<td style='text-align:left;'>:</td>";
	echo "<td style='text-align:right;'>".number_format($summary['svc'])."</td>";
echo "</tr>";
echo "<tr>";
	echo "<td>Penjualan Bersih</td>";
	echo "<td style='text-align:left;'>:</td>";
	echo "<td style='text-align:right;'>".number_format($summary['sst'])."</td>";
echo "</tr>";


// echo "Net Sales	: ".number_format($summary['sst'])."<br />";
// echo "Discount  : ".number_format($summary['sd'])."<br />";
// echo "Tax	    : ".number_format($summary['t'])."<br />";
// echo "Sales		: ". number_format($summary['stc'])."<br />";

echo "</table>";
echo "</div>";
//foreach ($summary as $rows)
//{
//	
//}
?>
