<?php

?>
<br>
<div style='width:350px;margin:5px 0;border-top:0px solid #888;border-bottom:0px solid #888;border-width:1px'>
<br>
<table border="1" >
<tr>
<td style="font-weight:bold;text-decoration:none">Detail pendapatan outlet (bersih)</td>
</tr>

<?// $count = count($summary); 

$a = 1;
while ($a <= count($bersih_d)-1){
?>
<tr>
<td><?=Outlet::model()->findByPk($a)->nama_outlet?></td>
<td style='text-align:left;'>:</td>	<td style='text-align:right;font-weight:bold'><?=number_format($bersih_d['o'.''.$a.''])?></td>
</tr>
<?
$total +=$bersih_d['o'.''.$a.''];
$a+=1;
}?>


<tr>
<td></td>
<td></td>
<td style='text-align:right;margin-top:-100px;'>_________ +</td>
</tr>


<tr>
<td>Total bersih outlet </td>
<td>:</td>
<td style='text-align:right;color:red'><?=number_format($total)?>*</td>
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
