<script>
function reloadGrid(data) {
    $.fn.yiiGridView.update('penghuni-grid');
}

function gagal(data){
alert('eror '+data);
}
</script>
<?php
$this->breadcrumbs=array(
	'Setting',
);?>

<?
$model = Branch::model()->findByPk(1);
//echo $model->branch_name;
?>



<fieldset style="width:250px;border:1px solid #888;padding:10px;"><legend>Cetak</legend>
<table >
<tr>
<td> Cafe :</td>
<td><?echo  CHtml::textField('try',$model->branch_name,array('style'=>'width:150px','maxlength'=>40,'id'=>'cafe'))?></td>
</tr>
<tr>
<td>Alamat :</td>
<td><?echo  CHtml::textField('try',$model->address,array('style'=>'width:150px','maxlength'=>40,'id'=>'alamat'))?></td>
</tr>
<tr>
<td>Telepon :</td>
<td><?echo  CHtml::textField('try',$model->telp,array('style'=>'width:150px','maxlength'=>40,'id'=>'telp'))?></td>
</tr>
<tr>
<td></td>
<td><?php
echo CHtml::ajaxSubmitButton('simpan',Yii::app()->createUrl('Branch/ajaxsave'),
                    array(
                        'type'=>'POST',
                        'data'=> 'js:{"data1":$("#cafe").val(), "data2": $("#alamat").val(),"data3":$("#telp").val() }',                        
                        'success'=>'js:function(string){ alert(string); }',
						'error'=>'js:function(string){ alert("eror"+string); }'
                    ),array('class'=>'someCssClass',));
?></td>
</tr>

</table>

</fieldset>
<!--
<fieldset style="width:250px;border:1px solid #888;padding:10px;"><legend>Service</legend>

<?php
/*
$model = Service::model()->findAll();
 $form=$this->beginWidget('CActiveForm', array(
'id'=>'service-form',
'enableAjaxValidation'=>false,
)); 

$models = Service::model()->findAll(array('order' => 'status desc'));

$list = CHtml::listData($models, 'id', 'service');
  
echo "service : ".$form->dropDownList($model,'service', $list).'%';
echo CHtml::button('Aktifkan', array('submit' => array('service/service')));

$this->endWidget(); */?>


</fieldset>
-->