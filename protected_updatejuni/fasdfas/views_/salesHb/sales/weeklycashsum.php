<h1>Laporan Pembayaran Mingguan</h1>
<?php $form=$this->beginWidget('CActiveForm',array(
	'action'=>Yii::app()->createUrl('sales/salescashweekly'),
	'method'=>'get',
)); ?>
<div class="row">
	<?php
	
	$this->widget('zii.widgets.jui.CJuiDatePicker', array(
		'name'=>'Sales[date]',
		'attribute'=>'date',
		'value'=>$tgl,
//		'model'=>$model,
		// additional javascript options for the date picker plugin
		'options'=>array(
			'dateFormat'=>'yy-mm-dd',
			'showAnim'=>'fold', // 'show' (the default), 'slideDown', 'fadeIn', 'fold'
			'showOn'=>'button', // 'focus', 'button', 'both'
			'buttonText'=>Yii::t('ui','Select form calendar'),
			'buttonImage'=>Yii::app()->request->baseUrl.'/images/calendar.png',
			'buttonImageOnly'=>true,
		),
		'htmlOptions'=>array(
			'style'=>'height:20px;;width:80px;vertical-align:top'
		),
	));
	?>
	&nbsp;&nbsp; sampai dengan &nbsp;&nbsp;  
	<?
	$this->widget('zii.widgets.jui.CJuiDatePicker', array(
		'name'=>'Sales[tgl]',
		'attribute'=>'tgl',
		'value'=>$tgl2,
//		'model'=>$model,
		// additional javascript options for the date picker plugin
		'options'=>array(
			'dateFormat'=>'yy-mm-dd',
			'showAnim'=>'fold', // 'show' (the default), 'slideDown', 'fadeIn', 'fold'
			'showOn'=>'button', // 'focus', 'button', 'both'
			'buttonText'=>Yii::t('ui','Select form calendar'),
			'buttonImage'=>Yii::app()->request->baseUrl.'/images/calendar.png',
			'buttonImageOnly'=>true,
		),
		'htmlOptions'=>array(
			'style'=>'height:20px;;width:80px;vertical-align:top'
		),
	));
echo "&nbsp;&nbsp;&nbsp;";
echo CHtml::submitButton('Search'); 
// $this->renderPartial('summary',array('summary'=>$summary));
?>
</div>
<?php $this->endWidget(); ?>
<?
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