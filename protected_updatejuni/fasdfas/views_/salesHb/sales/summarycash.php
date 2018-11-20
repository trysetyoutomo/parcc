<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

//var_dump($summary);
// print_r($summary);

echo "<br>";
echo "<div style='width:250px;margin:5px 0;border-top:1px solid #888;border-bottom:1px solid #888;'>";
echo "<br>";
echo "<table>";
echo "<tr>";
	echo "<td>Total Cost</td>";
	echo "<td style='text-align:left;'>:</td>";
	echo "<td style='text-align:right;font-weight:bold'>".number_format($summary['total_cost'])."</td>";
echo "</tr>";
echo "<tr>";
	echo "<td>Compliment</td>";
	echo "<td style='text-align:left;'>:</td>";
	echo "<td style='text-align:right;'>".number_format($summary['compliment'])."</td>";
echo "</tr>";
echo "<tr>";
	echo "<td>Net Cash</td>";
	echo "<td style='text-align:left;'>:</td>";
	echo "<td style='text-align:right;'>".number_format($summary['netcash'])."</td>";
echo "</tr>";
echo "<tr>";
	echo "<td>BCA</td>";
	echo "<td style='text-align:left;'>:</td>";
	echo "<td style='text-align:right;'>".number_format($summary['BCA'])."</td>";
echo "</tr>";
echo "<tr>";
	echo "<td>Mandiri</td>";
	echo "<td style='text-align:left;'>:</td>";
	echo "<td style='text-align:right;'>".number_format($summary['mandiri'])."</td>";
echo "</tr>";
echo "<tr>";
	echo "<td>Niaga</td>";
	echo "<td style='text-align:left;'>:</td>";
	echo "<td style='text-align:right;'>".number_format($summary['niaga'])."</td>";
echo "</tr>";
echo "<tr>";
	echo "<td>Voucher</td>";
	echo "<td style='text-align:left;'>:</td>";
	echo "<td style='text-align:right;'>".number_format($summary['voucher'])."</td>";
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
