<?php
// $row = Yii::app()->db->createCommand()
					// ->select('distinct(nama)')
					// ->from('viewdetailtransaksi')
					// // ->join('bayar','bayar.id_penghuni=pelanggan.id_pelanggan')
					// ->where('id_penghuni=:ip', array(':ip' => $_GET['id'] ))
					// // ->group('pelanggan.nama')
					// ->queryRow();
?>

<h1 class="well"> Detail penjualan <?php echo ' '.$row['nama']; ?></h1>

<?php


// $this->menu=array(
	// array('label'=>'List Pelanggan', 'url'=>array('index')),
	// array('label'=>'Create Pelanggan', 'url'=>array('create')),
// );

// Yii::app()->clientScript->registerScript('search', "
// $('.search-button').click(function(){
	// $('.search-form').toggle();
	// return false;
// });
// $('.search-form form').submit(function(){
	// $.fn.yiiGridView.update('pelanggan-grid', {
		// data: $(this).serialize()
	// });
	// return false;
// });
// ");
?>


<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php 
// $this->renderPartial('_search',array(
	// 'model'=>$model,
// )); 
?>
</div><!-- search-form -->


<div class="well">
 
<?php 
// $this->widget('zii.widgets.grid.CGridView', array(
	// 'dataProvider'=>$detailtransaksi,
    // 'filter'=>$model,
	// //'htmlOptions'=>('class'=>'well'),
	 // //'template'=>"{items}",
	 // 'itemsCssClass'=>'gridtablecss',
	 // 'emptyText'=>'Pelanggan masih tidak ada',


	// 'columns'=>array(
	// 'item_name',
	
	// ),
	// ),
// );	
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	//'id'=>'outlet-grid',
	'dataProvider'=>$detailtransaksi,
	'filter'=>$model,
	'columns'=>array(
		// array(
		// 'name'=>'id',
		// 'header'=>'ID',
		
		// ),
		array(
		'name'=>'name',
		'header'=>'nama menu',
		//'footer'=>true,
		),
		array(
		'name'=>'price',
		'header'=>'harga ',
		'footer'=>true,
		'class'=>'ext.gridcolumns.TotalColumn',
		'type'=>'number',
		'htmlOptions'=>array('style'=>'text-align:right'),
		//'footerHtmloptions'=>array('style'=>'text-align:right'),
		'footerHtmlOptions'=>array('style'=>'text-align:right;font-weight:bold;'),
		),
		array(
		'name'=>'qty',
		'header'=>'jumlah',
		'footer'=>true,
		'class'=>'ext.gridcolumns.TotalColumn',
		'type'=>'number',
		'htmlOptions'=>array('style'=>'text-align:right'),
		'footerHtmlOptions'=>array('style'=>'text-align:right;font-weight:bold;'),


		),
		array(
		'name'=>'tax',
		'header'=>'pajak',
		'footer'=>true,
		'class'=>'ext.gridcolumns.TotalColumn',
		'type'=>'number',
		'htmlOptions'=>array('style'=>'text-align:right'),
		'footerHtmlOptions'=>array('style'=>'text-align:right;font-weight:bold;'),

		),
		// array(
		// 'name'=>'svc',
		// 'header'=>'service',
		// 'footer'=>true,
		// 'class'=>'ext.gridcolumns.TotalColumn',
		// 'type'=>'number',
		// 'htmlOptions'=>array('style'=>'text-align:right'),
		// 'footerHtmlOptions'=>array('style'=>'text-align:right;font-weight:bold;'),
		
		// ),
		array(
		'name'=>'idc',
		'header'=>'discount',
		'footer'=>true,
		'class'=>'ext.gridcolumns.TotalColumn',
		'type'=>'number',
		'htmlOptions'=>array('style'=>'text-align:right'),
		'footerHtmlOptions'=>array('style'=>'text-align:right;font-weight:bold;'),
		
		),
		
		array(
		'name'=>'total',
		'header'=>'total',
		'footer'=>true,
		'type'=>'number',
		'class'=>'ext.gridcolumns.TotalColumn',
		'htmlOptions'=>array('style'=>'text-align:right'),
		'footerHtmlOptions'=>array('style'=>'text-align:right;font-weight:bold;'),

		),
		
		
		

	),
)); ?>


 <?php 
// $this->widget('bootstrap.widgets.TbGridView', array(
// 'type'=>'striped bordered condensed',
	// 'id'=>'bayar-grid',
	// 'dataProvider'=>$tunggakan,
    // //'filter'=>$model,
	// //'htmlOptions'=>('class'=>'well'),
	 // 'template'=>"{items}",
	// 'columns'=>array(
		// array(
			// 'header'=>'No.',
			// 'value'=>'($this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize) + array_search($data,$this->grid->dataProvider->getData())+1',
		// ),
		// // 'id_pelanggan',
		// // array('name'=>'nama','header'=>'Nama Lengkap'),
		// // array('name'=>'tlp','header'=>'Telepon'),
		// // array('name'=>'email','header'=>'Email'),
		// // array('name'=>'no_ktp','header'=>'No KTP'),
		// // array('name'=>'tlp_ortu','header'=>'Telepon Ortu'),
		// /*
		// 'img_ktp',
		// 'alamat',
		// 'tgl_lahir',
		// 'keterangan',
		// */
		// array(
			// 'type'=>'raw',
			// 'header'=>'Bayar',
			// 'value'=>'CHtml::link("Bayar",array("bayar/detailTunggakan","id"=>$data[id_penghuni]))',
			// // 'value'=>'$data[id_pelanggan]',
// `		    'htmlOptions'=>array('data-title'=>'Heading', 'data-content'=>'Content ...', 'rel'=>'popover'),
		// ),
		// // array(
			// // 'class'=>'CButtonColumn',
		// // ),
	// ),
// )); ?>
</div>