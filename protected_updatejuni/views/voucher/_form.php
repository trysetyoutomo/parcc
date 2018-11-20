<div class="form wide">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'voucher-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'kode_voucher'); ?>
		<?php echo $form->textField($model,'kode_voucher',array('size'=>20,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'kode_voucher'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'kategori'); ?>
		<?php echo $form->dropdownlist($model,'kategori',
		array(
			'BCA'=>'BCA',
			'MANDIRI'=>'MANDIRI',
			'UNDANGAN'=>'UNDANGAN',
			'PROMO'=>'PROMO'
		)); ?>
		<?php echo $form->error($model,'kategori'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'jenis'); ?>
		<?php echo $form->dropdownlist($model,'jenis',
			array('nominal'=>'nominal','persentase'=>'persentase')
		); ?>
		<?php echo $form->error($model,'jenis'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nominal'); ?>
		<?php echo $form->textField($model,'nominal',array('value'=>0)); ?>
		<?php echo $form->error($model,'nominal'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'persentase'); ?>
		<?php echo $form->textField($model,'persentase',array('value'=>0)); ?>
		<?php echo $form->error($model,'persentase'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'masa_berlaku'); ?>
		<?php echo $form->textField($model,'masa_berlaku'); ?>
		<?php echo $form->error($model,'masa_berlaku'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Simpan' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->