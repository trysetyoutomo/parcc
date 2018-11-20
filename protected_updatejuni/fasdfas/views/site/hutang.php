<div>
<input type="button" onclick="test()" value="Silahkan Masukan" />

<script>
function test(){
	var id = prompt("Silahkan Masukan No. Faktur", "");
	if (id!=""){
	   $.ajax({
				type: 'GET',
				url: '<?php echo Yii::app()->createAbsoluteUrl("site/hutang"); ?>',
				data:'id='+id,
				success:function(data){
					alert('ket :'+'<?=Yii::app()->session['ket'];?>');
				<? 
				if (Yii::app()->session['ket']=='kosong')
					echo "alert('tidak ada ID faktur '+id);" ;
				else if (Yii::app()->session['ket']=='sukses') 
					echo "alert('id telah sukses dibayar');";
				else if (Yii::app()->session['ket'] =='already') 
					echo "alert(id+' tersebut sudah dibayar!!');";
				// Yii::app()->session->destroy();
				?>
				},
				dataType:'html'
			});
	}else{
		alert('ID faktur kosong');
	}
}

</script>


</div>
