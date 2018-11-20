<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pajak')); ?>:</b>
	<?php echo CHtml::encode($data->pajak); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('meja')); ?>:</b>
	<?php echo CHtml::encode($data->meja); ?>
	<br />


</div>