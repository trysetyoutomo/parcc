<script type="text/javascript">
	function itemnumber(){
		id_category = $('#Items_category_id').val();
		$.ajax({
			url : '<?php echo $this->createUrl('site/itemnumber')?>',
			data : 'id='+id_category,
				success : function(data)
				{
					$("#Items_item_number").val(data);
				},
		});
	}
	
	function unitprice(){
		id = $('#itemnumber').val();
		$.ajax({
			url : '<?php echo $this->createUrl('site/unitprice')?>',
			data : 'id='+id,
				success : function(data)
				{
					var total = (parseInt(data)+data/10);
					$('#Items_unit_Price').val(data);
					$('#Items_tax_percent').val(data/10);
					$('#Items_total_cost').val(total);
				},
		});
	}
	
	$(document).ready(function(){
		$("#Items_unit_Price").keyup(function(){
			nilai = $('#Items_unit_Price').val();
			total = (parseInt(nilai)+nilai/10);
			$('#Items_tax_percent').val(nilai/10);
			$('#Items_total_cost').val(total);
		});
	});
</script>
<?php
	$model = Categories::model()->findAll();
	$data = CHtml::listData($model,'id','category');
	echo "<table>";
		echo "<tr>";
			echo "<td>category : </td>";
			echo "<td>".CHtml::dropDownList('Items_category_id', $category, $data, array('empty' => '(Select a category', 'onChange'=>'itemnumber()'))."</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>Item Number </td>";
			echo "<td>".CHtml::textField('Items_item_number','')."</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>Unit Price </td>";
			echo "<td>".CHtml::textField('Items_unit_Price','')."</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>Tax :</td>";
			echo "<td>".CHtml::textField('Items_tax_percent','')."</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>Unit Total Cost : </td>";
			echo "<td>".CHtml::textField('Items_total_cost','')."</td>";
		echo "</tr>";
	echo "</table>";
?>