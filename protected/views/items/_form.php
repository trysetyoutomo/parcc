<script type="text/javascript">
	$(document).ready(function(){
		$('#Items_description').html(' - ');
	})
	function itemnumber(){
		// id_category = $('#Items_category_id').val();
		// id_outlet = $('#Items_kode_outlet').val();
		// $.ajax({
		// 	url : '<?php echo $this->createUrl('items/itemnumber')?>',
		// 	data : 'id='+id_category+'&id2='+id_outlet,
		// 		success : function(data)
		// 		{
		// 			$("#Items_item_number").val(data);
		// 		},
		// });
	}
	
	function unitprice(){
		// id = $('#itemnumber').val();
		// $.ajax({
		// 	url : '<?php echo $this->createUrl('site/unitprice')?>',
		// 	data : 'id='+id,
		// 		success : function(data)
		// 		{
		// 			var total = (parseInt(data)+data/10);
		// 			$('#Items_unit_price').val(data);
		// 			$('#Items_tax_percent').val(data/10);
		// 			$('#Items_total_cost').val(total);
		// 		},
		// });
	}
	
	$(document).ready(function(){
		// $("#Items_unit_price").keyup(function(){
		// 	nilai = $('#Items_unit_price').val();
		// 	total = (parseInt(nilai)+nilai/10);
		// 	$('#Items_tax_percent').val(nilai/10);
		// 	$('#Items_total_cost').val(total);
		// });
	});
</script>
<?php
/* @var $this ItemsController */
/* @var $model Items */
/* @var $form CActiveForm */
?>

<div class="mws-panel grid_8">

    <div class="mws-panel-header">


    </div>

    <div class="mws-panel-body no-padding">
        <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'items-form',
	'enableAjaxValidation'=>false,
        'htmlOptions' => array(
                'class' => 'mws-form',
            )
)); ?>
<?php
$nilai = Categories::model()->findAll("t.id!=5");
$data = CHtml::listData($nilai,'id','category');

$nilai2 = Outlet::model()->findAll("t.kode_outlet!=27");
$data2 = CHtml::listData($nilai2,'kode_outlet','nama_outlet');


?>

        <div class="mws-form-inline">
<!--
            <p class="note">Fields with <span class="required">*</span> are required.</p>
-->
            <?php// echo $form->errorSummary($model); ?>
				<table style="border:1px;width:auto">
				<tr>
				<td><label>KATEGORI MENU</label></td>
				<td><?php echo $form->dropDownList($model,'category_id', $data, array('empty' => 'Pilih Kategori','separator'=>'|'))?></td>
				</tr>
				
				
				<tr style="display:none">
				<td ><?php echo $form->labelEx($model,'item_number'); ?></td>
				<td><?php echo $form->textField($model,'item_number',array('size'=>20,'maxlength'=>20)); ?></td>
				<td><?php echo $form->error($model,'item_number'); ?></td>
				</tr>
				
				
                <tr>
				<td><?php echo $form->labelEx($model,'item_name'); ?></td>
                <td><?php echo $form->textField($model,'item_name',array('size'=>20,'maxlength'=>30)); ?></td>
                <td><?php echo $form->error($model,'item_name'); ?></td>
                </tr> 

				<tr>
				<td><?php echo $form->labelEx($model,'description'); ?></td>
                <td><?php echo $form->textarea($model,'description',array('value'=>' - ')); ?></td>
                <td><?php echo $form->error($model,'description'); ?></td>
                </tr>
				<tr>
				<td><?php echo $form->labelEx($model,'unit_price'); ?></td>
                <td><?php echo $form->textField($model,'unit_price'); ?></td>
                <td><?php echo $form->error($model,'unit_price'); ?></td>
                </tr>
		
			
				
                <tr>
					<td><?php echo $form->labelEx($model,'lokasi'); ?></td>
	                <td><?php echo $form->dropDownList($model,'lokasi',array('1'=>'Bar','2'=>'Dapur','3'=>'Salon')); ?></td>
	                <td><?php echo $form->error($model,'lokasi'); ?></td>
                </tr>
                 <tr style="display:none">
					<td><?php echo $form->labelEx($model,'gambar'); ?></td>
	                <td><?php echo $form->filefield($model,'gambar',array('1'=>'Bar','2'=>'Dapur')); ?></td>
	                <td><?php echo $form->error($model,'gambar'); ?></td>
                </tr>
				
                </table>
				
           

              
                  
					<div class="mws-form-row" style="display:none">
                    <?php echo $form->labelEx($model,'image'); ?>
                    <div class="mws-form-item">
                        <?php echo $form->textField($model,'image',array('size'=>60,'maxlength'=>80)); ?>
                    </div>
                    <?php echo $form->error($model,'image'); ?>

                </div>
                    <div class="mws-form-row">
                    <div class="mws-form-item">
                        <?php echo $form->hiddenField($model,'status',array('value'=>1)); ?>
                    </div>
                    <?php echo $form->error($model,'status'); ?>

                </div>
                


            <!-- form -->
        </div>
        <div class="mws-button-row">
            <input type="submit" value="Simpan" class="btn btn-danger">
         </div>
        <?php $this->endWidget(); ?>
    </div>
</div>