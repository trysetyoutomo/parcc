<h1>
Rekap Pendapatan Outlet(bersih)
</h1>
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
echo CHtml::button('Submit', array('submit' => array('sales/Salesoutletmonthly')));
echo CHtml::endForm();


// echo "<table class='items'>";
// echo "<thead>";
	// echo "<tr>";
		// echo "<th>No.</th>";
		// echo "<th>Tanggal</th>";
		// echo "<th>Sale Total Cost</th>";
		// echo "<th>Pak Chi met</th>";
		// echo "<th>Paradays</th>";
		// echo "<th>Ampera</th>";
	// echo "</tr>";
// echo "</thead>";
// echo "<tbody>";
// $c=1;
// foreach($tot as $a){
	// echo "<tr>";
		// echo "<td>".$c++."</td>";
		// echo "<td>".$a['tgl']."</td>";
		// echo "<td>".number_format($a['total'])."</td>";
		// echo "<td>".number_format($a['pcm'])."</td>";
		// echo "<td>".number_format($a['paradays'])."</td>";
		// echo "<td>".number_format($a['ampera'])."</td>";
	// echo "</tr>";
	// $sst +=$a['total'];
	// $sd +=$a['pcm'];
	// $ss +=$a['paradays'];
	// $tax +=$a['ampera'];
// }
// echo "</tbody>";
// echo "<tfoot style='background-color:#ccc;'>";
	// echo "<tr>";
		// echo "<td>&nbsp;</td>";
		// echo "<td>&nbsp;</td>";
		// echo "<td>".number_format($sst)."</td>";
		// echo "<td>".number_format($sd)."</td>";
		// echo "<td>".number_format($ss)."</td>";
		// echo "<td>".number_format($tax)."</td>";
	// echo "</tr>";
// echo "</tfoot>";
// echo "</table>";
?>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'sales-grid',
	'dataProvider'=>$tot,
	'columns'=>array(
		array(
			'header'=>'No.',
			'value'=>'($this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize) + array_search($data,$this->grid->dataProvider->getData())+1',
		),
	
		array(
			'name'=>'tgl',
			'header'=>'Tanggal',
		),
		// 'date',
		
		// 'total_cost',
		array(
			'name'=>'o1',
			'header'=>Outlet::model()->findByPk(1)->nama_outlet,
			'type'=>'number',
			'htmlOptions'=>array('style'=>'text-align:right'),
			'class'=>'ext.gridcolumns.TotalColumn',
//			'value'=>'$data->nilai',
			// 'type'=>'number',
			'footer'=>true,
			'footerHtmlOptions'=>array('style'=>'text-align:right'),
			// 'htmlOptions'=>array('style'=>'text-align:right'),

		),
		array(
			'name'=>'o2',
			'header'=>Outlet::model()->findByPk(2)->nama_outlet,
			'type'=>'number',
			'htmlOptions'=>array('style'=>'text-align:right'),
			'class'=>'ext.gridcolumns.TotalColumn',
			'footer'=>true,
			'footerHtmlOptions'=>array('style'=>'text-align:right'),

		),	
		array(
			'name'=>'o3',
			'type'=>'number',
			'header'=>Outlet::model()->findByPk(3)->nama_outlet,
			'htmlOptions'=>array('style'=>'text-align:right'),
			'class'=>'ext.gridcolumns.TotalColumn',
			'footer'=>true,
			'footerHtmlOptions'=>array('style'=>'text-align:right'),

		),
		array(
			'name'=>'o4',
			'type'=>'number',
			'header'=>Outlet::model()->findByPk(4)->nama_outlet,
			'htmlOptions'=>array('style'=>'text-align:right'),
			'class'=>'ext.gridcolumns.TotalColumn',
			'footer'=>true,
			'footerHtmlOptions'=>array('style'=>'text-align:right'),

		),
		array(
			'name'=>'o5',
			'header'=>Outlet::model()->findByPk(5)->nama_outlet,
			'type'=>'number',
			'htmlOptions'=>array('style'=>'text-align:right'),
			'class'=>'ext.gridcolumns.TotalColumn',
			'footer'=>true,
			'footerHtmlOptions'=>array('style'=>'text-align:right'),

		),
		array(
			'name'=>'o6',
			'header'=>Outlet::model()->findByPk(6)->nama_outlet,

			'type'=>'number',
			'htmlOptions'=>array('style'=>'text-align:right'),
			'class'=>'ext.gridcolumns.TotalColumn',
			'footer'=>true,
			'footerHtmlOptions'=>array('style'=>'text-align:right'),

		),
		array(
			'name'=>'o7',
			'type'=>'number',
			'header'=>Outlet::model()->findByPk(7)->nama_outlet,
			'htmlOptions'=>array('style'=>'text-align:right'),
			'class'=>'ext.gridcolumns.TotalColumn',
			'footer'=>true,
			'footerHtmlOptions'=>array('style'=>'text-align:right'),

		),
		array(
			'name'=>'o8',
			'header'=>Outlet::model()->findByPk(8)->nama_outlet,
			'type'=>'number',
			'htmlOptions'=>array('style'=>'text-align:right'),
			'class'=>'ext.gridcolumns.TotalColumn',
			'footer'=>true,
			'footerHtmlOptions'=>array('style'=>'text-align:right'),


		),array(
			'name'=>'total_comp',
			'header'=>'bumi arena',
			'type'=>'number',
			'htmlOptions'=>array('style'=>'text-align:right'),
			'class'=>'ext.gridcolumns.TotalColumn',
			'footer'=>true,
			'footerHtmlOptions'=>array('style'=>'text-align:right'),

		),
		

),
)); 
?>

