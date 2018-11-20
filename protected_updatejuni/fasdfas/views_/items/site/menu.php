<style type="text/css">
	.menu-image{
		width:80px;
		height:80px;
		border:1px solid #000;
		float:left;
		margin:2px;
	}
	#submenu{
		width:500px;
		height:100px;
		border:1px solid #000;
		float:right;
	}
	.menu-wrapper{
		width:433px;
		border:1px solid green;
		float:left;
	}
</style>
<script type="text/javascript">
	function submenu(id){
		$.ajax({
			url : '<?php echo $this->createUrl('categories/submenu')?>',
			data : 'id='+id,
			success : function(data)
			{
				$("#submenu").html(data);
			},
			error : function(data)
			{
				alert(data);
			}
		});
	}
</script>
<div class="menu-wrapper">
<?php
//ambil list dari database
$model = Categories::model()->findAll("status=:status",array(":status"=>1));
// $data = CHtml::listData($model, 'table', 'id');
foreach($model as $a){
echo '<div class=menu-image onClick="submenu('.$a->id.')">';
	if($a->image==NULL){
		echo CHtml::image(Yii::app()->request->baseUrl."/images/category.png","").$a->category;
	}else{
		echo CHtml::image(Yii::app()->request->baseUrl.$a->image,"").$a->category;
	}
echo '</div>';
}
?>
</div>
<div id="submenu">
	
</div>