<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'categories-grid',
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		'id',
		'categories.category',
		'item_name',
		'status',
	),
)); ?>