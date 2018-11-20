<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode_outlet')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->kode_outlet), array('view', 'id'=>$data->kode_outlet)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nama_outlet')); ?>:</b>
	<?php echo CHtml::encode($data->nama_outlet); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nama_owner')); ?>:</b>
	<?php echo CHtml::encode($data->nama_owner); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jenis_outlet')); ?>:</b>
	<?php echo CHtml::encode($data->jenis_outlet); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('persentase_hasil')); ?>:</b>
	<?php echo CHtml::encode($data->persentase_hasil); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />


</div>