<script type="text/javascript">
 function cek_void_auth()
{
	var data=$("#void_auth").serialize();
	// alert(data);
	$.ajax({
		type: 'POST',
		url: '<?php echo Yii::app()->createAbsoluteUrl("Sales/Uservoid"); ?>',
		data:data,
		success:function(data){
			// alert(data);
			if(data=="authorized"){
				void_bayar(1,2,"sale_id");
				$("#void_cek").dialog("close");
				$("#dialog_bayar").dialog("close");
			}else{
				alert("otentifikasi gagal!");
				// $("#void_cek").dialog("close");
				// $("#dialog_bayar").dialog("close");
			}
		},
		error:function(data){
			alert(data);
		},

		dataType:'html'
	});

}
</script>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'void_auth',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::button('Void',array('onClick'=>'cek_void_auth();')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->