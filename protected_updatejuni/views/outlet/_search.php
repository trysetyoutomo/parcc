<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'kode_outlet'); ?>
		<?php echo $form->textField($model,'kode_outlet'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nama_outlet'); ?>
		<?php echo $form->textField($model,'nama_outlet',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nama_owner'); ?>
		<?php echo $form->textField($model,'nama_owner',array('size'=>40,'maxlength'=>40)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'jenis_outlet'); ?>
		<?php echo $form->textField($model,'jenis_outlet',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'persentase_hasil'); ?>
		<?php echo $form->textField($model,'persentase_hasil'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->