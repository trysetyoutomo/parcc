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
	$b +=$a['complimet'];
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