<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'sale_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'item_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'quantity_purchased',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'item_tax',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'item_price',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'item_discount',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'item_total_cost',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
