
<?php
?>
<br>
<div style='width:400px;margin:5px 0;border-top:1px solid #888;border-bottom:1px solid #888;border-width:1px'>
<br>
<table border="1" >
<tr>
<td><u><i></i></u></td>
</tr>
<tr>
<td>Total pendapatan kotor (sebelum bagi hasil) </td>
<td style='text-align:left;'>:</td>	<td style='text-align:right;font-weight:bold'><?=number_format($summary['total'])?></td>
</tr>
<tr>
<td>Total pendapatan bersih (Bumi arena)</td>
<td>:</td>
<td style='text-align:right;'><?=number_format($bersih['total_comp'])?></td>
</tr>
<tr>
<td></td>
<td></td>
<td style='text-align:right;margin-top:-100px;'>_________ _</td>
</tr>
<tr>
<td>Total pendapatan bersih (outlet) </td>
<td>:</td>
<td style='text-align:right;color:red;'><?=number_format($summary['total']-$bersih['total_comp'])?>*</td>
</tr>
<!--
<tr>
<td>Pak Chi Met</td>
<td style='text-align:left;'>:</td>
<td style='text-align:right;'><?=number_format($spcm)?></td>
</tr>
<tr>
<td>Paradays</td>
<td style='text-align:left;'>:</td>
<td style='text-align:right;'><?=number_format($sprd)?></td>
</tr>
<tr>
<td>Ampera</td>
<td style='text-align:left;'>:</td>
<td style='text-align:right;'><?=number_format($summary['ampera'])?></td>
</tr>


<td><u><i>sebelum bagi laba</i></u></td>
</tr>

<tr>
<td>Total Cost</td>
<td style='text-align:left;'>:</td>
<td style='text-align:right;font-weight:bold'><?=number_format($total_before)?></td>
</tr>
<tr>
<td>Bumi arena</td>
<td style='text-align:left;'>:</td>
<td style='text-align:right;'>0</td>
</tr>
<tr>
<td>Pak Chi Met</td>
<td style='text-align:left;'>:</td>
-<td style='text-align:right;'><?=number_format($summary['pak_chi_met'])?></td>
</tr>
<tr>
<td>Paradays</td>
<td style='text-align:left;'>:</td>
<td style='text-align:right;'><?=number_format($summary['paradays'])?></td>
</tr>
<tr>
<td>Ampera</td>
<td style='text-align:left;'>:</td>
<td style='text-align:right;'><?=number_format($summary['ampera'])?></td>
</tr>
<tr>
<td>

</td>	
</tr>
<tr>

!-->
</table>
</div>
