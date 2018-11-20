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

<div class="wells">
 
<h1 style="">Detail Tenant<a style="color:red;text-decoration:none"></a>
 <?=$data['nm'];?></h1>
 <?
 // echo $tglheader;
 
 if ($tglheader==$tgl2header)
 echo "Tanggal : ".$tglheader;
 else
 echo "Periode : ".$tglheader." sampai ".$tgl2header;
 
 
 // echo "hehe".$tglheader;
 ?>

<div style='width:570px;margin:5px 0;border-top:0px solid #888;border-bottom:0px solid #888;border-width:1px'>
<br>
<table border="0" width="570px" >
<tr>
<td style="font-weight:bold;text-decoration:none">Pendapatan Kotor  </td><td style="text-align:right"><?=number_format($data['total'])?> </td>
</tr>
<tr>
<td style="font-weight:bold;text-decoration:none">persentasi </td><td style="text-align:right"><?=number_format($data['ps'])?>% </td>
</tr>
<tr>
<td style="font-weight:bold;text-decoration:none">Pendapatan Bersih </td><td style="text-align:right;color:red"><?=number_format($data['bersih'])?> </td>
</tr>


</table>
</div>
<div style="border-color:black">
<table border="1" cellpadding="5"  style="border:1px solid #000000;border-width:0px 0px 0px 0px;" colspan = "3" rowspan="3">
<tr>
<td>No</td>
<td>No Faktur</td>
<td>Waktu</td>
<td>Menu</td>
<td>Qty</td>
<td>Harga</td>
<td>Diskon</td>
<td>Total</td>
</tr>
<?
$n = 0;
$total = 0;
foreach ($dataProvider as $value) { 
$n++;
$total += $value["total"];
$totaljumlah += $value["jumlah"];
?>
<tr>
<td><?=$n?></td>
<td><?=$value["sid"];?></td>
<td><?=$value["date"];?></td>
<td><?=$value["item_name"];?></td>
<td><?=$value["jumlah"];?></td>
<td><?=number_format($value["item_price"]);?></td>
<td><?=number_format($value["item_discount"]);?> %</td>
<td><?=number_format($value["total"]);?></td>
</tr>
<?}?>
<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td><?=$totaljumlah?></td>
<td></td>
<td>Total : </td>

<td><?=number_format($total);?></td>
</tr>
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
