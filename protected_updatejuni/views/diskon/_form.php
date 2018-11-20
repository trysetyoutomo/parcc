
<div class="form wide">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'diskon-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'diskon'); ?>
		<?php echo $form->textField($model,'diskon'); ?>
		<?php echo $form->error($model,'diskon'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'simpan' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->