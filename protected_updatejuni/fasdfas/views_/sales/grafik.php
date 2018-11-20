<center>
<?php $form=$this->beginWidget('CActiveForm',array(
	'action'=>Yii::app()->createUrl('sales/grafik'),
	'method'=>'get',
)); ?>
<div class="row">
	<input name="mode" type ="hidden"value="<?=$mode?>" />
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
?>
</div>
<?php $this->endWidget(); ?>
</center>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/chart/Chart.js"></script>
<canvas id="kanvasku" height="450" width="1100" ></canvas>
<?
// echo $databar[0]["nama_outlet"];
// $z=0;
// // foreach ($databar as $key=>$value)
// {
// echo $databar[$z]["nama_outlet"] . " nilai :".$databar[$z]["persentase_hasil"]."<br>";
// $z++;
// }

// $dataku = 
?> 
<script>
var labelku = new Array();
var dataku = new Array();
</script>
<?php
$data = "";
$label = "";
$i=0;
if ($mode=='bersih'){
	foreach ($databar as $key=>$value)
	{
		$data = $data .""."'".$databar[$i][n]."'"."," ;
		$label = $label .""."'".$databar[$i][b]."'"."," ;
		$i++;
	}
}else if ($mode=='top')  {
	foreach ($databar as $key=>$value)
	{
		$data = $data .""."'".$databar[$i][nama]."'"."," ;
		$label = $label .""."'".$databar[$i][jumlah]."'"."," ;
		$i++;
	}
}

// echo $data;
?>

<script>

			
		labelku = [<?=$data?>];
		dataku = [<?=$label?>];


        var barData = {
            labels : labelku,
            datasets : [
                {
                    fillColor : "rgba(255, 0, 0, 0.8)",
                    strokeColor : "rgba(220,220,220,1)",
                    data : dataku
                },
            ]
            
        }

    var barKu = new Chart(document.getElementById("kanvasku").getContext("2d")).Bar(barData);
    
</script>