<?php $form=$this->beginWidget('CActiveForm', array(
'id'=>'service-form',
'enableAjaxValidation'=>false,
)); 

$models = Service::model()->findAll(array('order' => 'status desc'));

$list = CHtml::listData($models, 'id', 'service');
  
echo "service : ".$form->dropDownList($model,'service', $list).'%';
echo CHtml::button('Aktifkan', array('submit' => array('service/service')));

$this->endWidget(); ?>


	 
	

