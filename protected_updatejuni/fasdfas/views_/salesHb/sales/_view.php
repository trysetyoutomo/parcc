<?php
/* @var $this SalesController */
/* @var $data Sales */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customer_id')); ?>:</b>
	<?php echo CHtml::encode($data->customer_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sale_sub_total')); ?>:</b>
	<?php echo CHtml::encode($data->sale_sub_total); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sale_discount')); ?>:</b>
	<?php echo CHtml::encode($data->sale_discount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sale_service')); ?>:</b>
	<?php echo CHtml::encode($data->sale_service); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sale_tax')); ?>:</b>
	<?php echo CHtml::encode($data->sale_tax); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('sale_total_cost')); ?>:</b>
	<?php echo CHtml::encode($data->sale_total_cost); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sale_payment')); ?>:</b>
	<?php echo CHtml::encode($data->sale_payment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('paidwith_id')); ?>:</b>
	<?php echo CHtml::encode($data->paidwith_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_items')); ?>:</b>
	<?php echo CHtml::encode($data->total_items); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('branch')); ?>:</b>
	<?php echo CHtml::encode($data->branch); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('table')); ?>:</b>
	<?php echo CHtml::encode($data->table); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comment')); ?>:</b>
	<?php echo CHtml::encode($data->comment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	*/ ?>

</div>