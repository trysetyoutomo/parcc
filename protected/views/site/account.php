
<div class="wide form">

<?php //echo Yii::getVersion(); ?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>true,
	// 'enableClientValidation'=>true,
	'focus'=>array($model,'old_password'),


)); ?>

	<!-- <p class="note">Fields with <span class="required">*</span> are required.</p> -->

	<?php //echo $form->errorSummary($model); ?>


	<div class="row">
		<?php echo $form->labelEx($model,'old_password'); ?>
		<?php echo $form->passwordField($model,'old_password',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'old_password'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'new_password'); ?>
		<?php echo $form->passwordField($model,'new_password',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'new_password'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'new_password_repeat'); ?>
		<?php echo $form->passwordField($model,'new_password_repeat',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'new_password_repeat'); ?>
	</div>

	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->