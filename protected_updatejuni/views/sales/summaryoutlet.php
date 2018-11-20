<br>
<?php
?>
<br>
<div style='width:600px;margin:5px 0;border-top:1px solid #888;border-bottom:1px solid #888;border-width:1px'>
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
<td>Total pendapatan bersih (<?php echo Branch::model()->findByPk(1)->branch_name ?>)</td>
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

</table>
</div>
<br>
<br>
<br>