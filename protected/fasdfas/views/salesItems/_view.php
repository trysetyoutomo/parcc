<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sale_id')); ?>:</b>
	<?php echo CHtml::encode($data->sale_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_id')); ?>:</b>
	<?php echo CHtml::encode($data->item_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('quantity_purchased')); ?>:</b>
	<?php echo CHtml::encode($data->quantity_purchased); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_tax')); ?>:</b>
	<?php echo CHtml::encode($data->item_tax); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_price')); ?>:</b>
	<?php echo CHtml::encode($data->item_price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_discount')); ?>:</b>
	<?php echo CHtml::encode($data->item_discount); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('item_total_cost')); ?>:</b>
	<?php echo CHtml::encode($data->item_total_cost); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_service')); ?>:</b>
	<?php echo CHtml::encode($data->item_service); ?>
	<br />

	*/ ?>

</div>