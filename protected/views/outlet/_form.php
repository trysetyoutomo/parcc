<div class="form wide">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'outlet-form',
	'enableAjaxValidation'=>false,
)); ?>

	<!-- <p class="note">Fields with <span class="required">*</span> are required.</p> -->

	<?php //echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nama'); ?>
		<?php echo $form->textField($model,'nama_outlet',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'nama_outlet'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nama_owner'); ?>
		<?php echo $form->textField($model,'nama_owner',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'nama_owner'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'jenis'); ?>
		<?php echo $form->dropdownlist($model,'jenis_outlet',array('makanan'=>'makanan','minuman'=>'minuman','dll'=>'dll')); ?>
		<?php echo $form->error($model,'jenis_outlet'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'persentase_hasil'); ?>
		<?php echo $form->textField($model,'persentase_hasil'); ?>
		<?php echo $form->error($model,'persentase_hasil'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Alias'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'Alias'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Simpan' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->