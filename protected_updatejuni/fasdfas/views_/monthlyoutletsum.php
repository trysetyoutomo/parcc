<h1>
Rekap Pendapatan Outlet & Tenant(bersih) Bulanan
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

$columns2 = 
	array(	
		array(
			'header'=>'No.',
			'value'=>'($this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize) + array_search($data,$this->grid->dataProvider->getData())+1',
		),
	
		array(
			'name'=>'tgl',
			'header'=>'Tanggal',
			'headerHtmlOptions'=>array('style'=>'text-align:center;font-size:15px;padding-bottom:10px;margin-bottom:10px'),
	
		),
		// 'date',
		
		// 'total_cost',
		array(
					'name'=>'sales',
					'header'=>'Penjualan',
					'type'=>'number',
					'htmlOptions'=>array('style'=>'text-align:right'),
					'class'=>'ext.gridcolumns.TotalColumn',
					'footer'=>true,
					'footerHtmlOptions'=>array('style'=>'text-align:right'),
					'headerHtmlOptions'=>array('style'=>'text-align:center;font-size:10px;padding-bottom:10px;margin-bottom:10px'),
			),

		array(
			'name'=>'ba',
			'header'=>'bumi arena',
			'type'=>'number',
			'htmlOptions'=>array('style'=>'text-align:right'),
			'class'=>'ext.gridcolumns.TotalColumn',
			'footer'=>true,
			'footerHtmlOptions'=>array('style'=>'text-align:right'),
			'headerHtmlOptions'=>array('style'=>'text-align:center;font-size:10px;padding-bottom:10px;margin-bottom:10px'),
		),
		
		
	);
$itemdata = Outlet::model()->findAll();
$jumlah = count($itemdata);
foreach($itemdata as $key){
	$columns = 
	array(
	'name'=>$key["kode_outlet"],
	'header'=>Outlet::model()->findByPk($key["kode_outlet"])->nama_outlet,
	'type'=>'number',
	'htmlOptions'=>array('style'=>'text-align:right'),
	'class'=>'ext.gridcolumns.TotalColumn',
	'footer'=>true,
	'footerHtmlOptions'=>array('style'=>'text-align:right'),
	'headerHtmlOptions'=>array('style'=>'text-align:center;font-size:10px;padding-bottom:10px;margin-bottom:10px'),
	);	
	array_push($columns2,$columns);
}
/*
$columns3 = 
array(
			'name'=>'total_comp',
			'header'=>'bumi arena',
			'type'=>'number',
			'htmlOptions'=>array('style'=>'text-align:right'),
			'class'=>'ext.gridcolumns.TotalColumn',
			'footer'=>true,
			'footerHtmlOptions'=>array('style'=>'text-align:right'),

		);
	array_push($columns2,$columns3);
*/
	?>



<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'sales-grid',
	'dataProvider'=>$tot,
	'columns'=>$columns2,
	));
	/*
	array(
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


		),
		array(
			'name'=>'total_comp',
			'header'=>'bumi arena',
			'type'=>'number',
			'htmlOptions'=>array('style'=>'text-align:right'),
			'class'=>'ext.gridcolumns.TotalColumn',
			'footer'=>true,
			'footerHtmlOptions'=>array('style'=>'text-align:right'),

		),
		
*/

?>

