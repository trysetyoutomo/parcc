<fieldset>
<a href="#" onclick="window.history.back()" style="">
kembali
</a>
<legend>
	
<h1 class="well"> Detail penjualan <?php echo ' Faktur '.$_GET['id']; ?></h1>
</legend>	


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
		'name'=>'subtotal',
		'header'=>'Sub total ',
		'footer'=>true,
		'class'=>'ext.gridcolumns.TotalColumn',
		'type'=>'number',
		'htmlOptions'=>array('style'=>'text-align:right'),
		//'footerHtmloptions'=>array('style'=>'text-align:right'),
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
		'name'=>'service',
		'header'=>'service',
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
		'template'=>'{update}{hapus}',
		// 'visible'=>$a,
		
			'buttons' => array(
			
				'hapus' => array(
							// 'label'=> 'Bayar',
							// 'hint'=>'Bayar',
							'url'=>'Yii::app()->createUrl("Salesitems/hapus", array("id"=>$data[id]))',      //A PHP expression for generating the URL of the button.
							'imageUrl'=>Yii::app()->request->baseUrl.'/assets/9d933b95/gridview/delete.png',
							// /voila/
							 // 'visible'=>$a,
							'options'=>array(
								'class'=>'delete'
							),
				
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

</div></fieldset>

<script type="text/javascript">
	$(document).ready(function(){
	// 	$(document).on("click",".delete",function(e){
	// 		e.preventDefault();
	// 		var c = confirm("yakin ? ");
	// 		if(!c){exit;}

	// 		$.ajax({
	// 			url : "<?php echo Yii::app()->createUrl("Salesitems/hapus") ?>",
	// 			data 
	// 		});

	// 	});
		jQuery('#yw0 a.delete').live('click',function() {
			if(!confirm('Are you sure you want to delete this item?')) return false;
			var th=this;
			var afterDelete=function(){};
			$.fn.yiiGridView.update('yw0', {
				type:'POST',
				url:$(this).attr('href'),
				success:function(data) {
					// alert(data);
					if (!data=="sukses"){
						alert(data);
					}
					$.fn.yiiGridView.update('yw0');
					afterDelete(th,true,data);
				},
				error:function(XHR) {
					return afterDelete(th,false,XHR);
				}
			});
			return false;
		});
	});

</script>
