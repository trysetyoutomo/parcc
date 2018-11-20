<?php
/* @var $this SalesController */
/* @var $model Sales */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date'); ?>
		<?php echo $form->textField($model,'date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'customer_id'); ?>
		<?php echo $form->textField($model,'customer_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sale_sub_total'); ?>
		<?php echo $form->textField($model,'sale_sub_total'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sale_discount'); ?>
		<?php echo $form->textField($model,'sale_discount'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sale_service'); ?>
		<?php echo $form->textField($model,'sale_service'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sale_tax'); ?>
		<?php echo $form->textField($model,'sale_tax'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sale_total_cost'); ?>
		<?php echo $form->textField($model,'sale_total_cost'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sale_payment'); ?>
		<?php echo $form->textField($model,'sale_payment'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'paidwith_id'); ?>
		<?php echo $form->textField($model,'paidwith_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'total_items'); ?>
		<?php echo $form->textField($model,'total_items'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'branch'); ?>
		<?php echo $form->textField($model,'branch'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'table'); ?>
		<?php echo $form->textField($model,'table'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comment'); ?>
		<?php echo $form->textField($model,'comment',array('size'=>60,'maxlength'=>200)); ?>
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