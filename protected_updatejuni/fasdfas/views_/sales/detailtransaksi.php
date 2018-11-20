<h1 class="well"> Detail penjualan <?php echo ' Faktur '.$_GET['id']; ?></h1>


<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php 
?></div><!-- search-form -->


<div class="well">
 
<?php 
// $this->widget('zii.widgets.grid.CGridView', array(
	// 'dataProvider'=>$detailtransaksi,
    // 'filter'=>$model,
	// //'htmlOptions'=>('class'=>'well'),
	 // //'template'=>"{items}",
	 // 'itemsCssClass'=>'gridtablecss',
	 // 'emptyText'=>'Pelanggan masih tidak ada',


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
			'name'=>'id',
			'header'=>	'id',
			'visible'=>true,
		)
		,
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
		array( 
		'class'=>'CButtonColumn',
		'template'=>'{hapus}',
		'visible'=>$a,
		
			'buttons' => array(
			
				'hapus' => array(
							// 'label'=> 'Bayar',
							// 'hint'=>'Bayar',
							'url'=>'Yii::app()->createUrl("Salesitems/hapus", array("id"=>$data[id]))',      //A PHP expression for generating the URL of the button.
							//'imageUrl'=>Yii::app()->request->baseUrl.'/images/money.png',
							 // 'visible'=>$a,
							// 'options'=>array(
								// 'class'=>'btn btn-small update'
							// ),
				
				),
				
				'update' => array(
							// 'label'=> 'Bayar',
							// 'hint'=>'Bayar',
							'url'=>'Yii::app()->createUrl("Salesitems/update", array("id"=>$data[id]))',      //A PHP expression for generating the URL of the button.
							//'imageUrl'=>Yii::app()->request->baseUrl.'/images/money.png',
							 // 'visible'=>$a,
							// 'options'=>array(
								// 'class'=>'btn btn-small update'
							// ),
				
				),
				
				
			),
		), 	
		
				

	),
)); ?>

</div>