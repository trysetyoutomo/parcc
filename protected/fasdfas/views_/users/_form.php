<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	'enableAjaxValidation'=>false,
)); ?>

<br>
<br>
<br>
<br>
<h1>&nbsp;&nbsp;Membuat User</h1>
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nama Lengkap'); ?>
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'level'); ?>
		<?php echo $form->dropDownList($model, 'level', array(2=>'super',6=>'kasir'));?>
                    
		<?php// echo $form->textField($model,'level'); ?>
		<?php// echo $form->textField($model,'level'); ?>
		
		<?php echo $form->error($model,'level'); ?>
	</div>

	<div class="row" style="display:none">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status',array('value'=>1)); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row" style="display:none"	>
		<?php echo $form->labelEx($model,'branch_id'); ?>
		<?php echo $form->textField($model,'branch_id',array('value'=>1)); ?>
		<?php echo $form->error($model,'branch_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->