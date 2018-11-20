<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sale_id'); ?>
		<?php echo $form->textField($model,'sale_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'item_id'); ?>
		<?php echo $form->textField($model,'item_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'quantity_purchased'); ?>
		<?php echo $form->textField($model,'quantity_purchased'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'item_tax'); ?>
		<?php echo $form->textField($model,'item_tax'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'item_price'); ?>
		<?php echo $form->textField($model,'item_price'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'item_discount'); ?>
		<?php echo $form->textField($model,'item_discount'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'item_total_cost'); ?>
		<?php echo $form->textField($model,'item_total_cost'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'item_service'); ?>
		<?php echo $form->textField($model,'item_service'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->