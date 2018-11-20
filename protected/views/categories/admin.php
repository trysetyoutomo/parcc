

<h1>Kelola kategori</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'categories-grid',
	'dataProvider'=>$model,
	// 'dataProvider'=>$model->search(),
	// 'filter'=> 'filter'=>$filtersForm,,
	 'filter'=>$filtersForm,
	'columns'=>array(
		array(
			'header'=>'No.',
			'value'=>'($this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize) + array_search($data,$this->grid->dataProvider->getData())+1',
		),
		// 'id',
		array(
			'name'=>'category',
			'header'=>'kategori'
		),
		// 'image',
		// 'status',
		// array(
			// 'class'=>'CButtonColumn',
			// 'temp'
			// 'template'=>"{delete}",
			// 'items'=>array(
			// 	'delete'=>arra
			// )
		// ),
	),
)); ?>
