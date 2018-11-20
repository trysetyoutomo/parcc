<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sales-items-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row" style="display:none" >
		<?php echo $form->labelEx($model,'sale_id'); ?>
		<?php echo $form->textField($model,'sale_id'); ?>
		<?php echo $form->error($model,'sale_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Nama Item'); ?>
		<?php echo $form->textField($model,'item_id'); ?>
		<?php echo $form->error($model,'item_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Jumlah '); ?>
		<?php echo $form->textField($model,'quantity_purchased'); ?>
		<?php echo $form->error($model,'quantity_purchased'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Pajak'); ?>
		<?php echo $form->textField($model,'item_tax'); ?>
		<?php echo $form->error($model,'item_tax'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Harga'); ?>
		<?php echo $form->textField($model,'item_price'); ?>
		<?php echo $form->error($model,'item_price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Diskon'); ?>
		<?php echo $form->textField($model,'item_discount'); ?>
		<?php echo $form->error($model,'item_discount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Total'); ?>
		<?php echo $form->textField($model,'item_total_cost'); ?>
		<?php echo $form->error($model,'item_total_cost'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Servis'); ?>
		<?php echo $form->textField($model,'item_service'); ?>
		<?php echo $form->error($model,'item_service'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->