<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode_voucher')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->kode_voucher), array('view', 'id'=>$data->kode_voucher)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jenis')); ?>:</b>
	<?php echo CHtml::encode($data->jenis); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nominal')); ?>:</b>
	<?php echo CHtml::encode($data->nominal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('masa_berlaku')); ?>:</b>
	<?php echo CHtml::encode($data->masa_berlaku); ?>
	<br />


</div>