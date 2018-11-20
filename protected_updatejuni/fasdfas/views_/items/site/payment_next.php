
<script>
function getKembalian(){
	var bayar = $("#bayar").val();
	var total = $("#tb2").html();
	var kembalian = parseFloat(bayar)-parseFloat(total);
	$("#kembali").val(kembalian);
	
}

</script>
<body onload="getData()">
<div class="konten-bayar">
		   <div class="line" style="font-size:14px;font-weight:bold">Total Bayar : <label id="tb2">0</label></div>
 
		<div class="line"><label><input id="bayar" type="text" placeholder="Bayar" onkeyup="getKembalian()" class="myinput" style="width:200px"></input></label></div>
		<div class="line"><label><input id="kembali" value="0" type="text" placeholder="kembalian" onkeyup="getKembalian()" class="myinput" style="width:200px"></input></label></div>
    <!--div style="clear:both"></div-->
    <input id="btnbayar" type="button" value="Bayar" onClick="getSaleID()" class="mybutton">
    <!--input  type="button" value="Baru" onClick="baru()" class="mybutton"-->
    <?php 
		$userlevel = Yii::app()->user->getLevel();
		if($userlevel < 5){
	?>
		<input  type="button" value="Void" id="btnvoid" onClick="void_bayar(1,2,sale_id)" class="mybutton" style="margin-left:10px;">
	<?php }else{?>
		<!--input  type="button" value="Void" onClick="void_cek()" class="mybutton" style="margin-left:10px;"-->
		<input type="button" value="Void" onclick='$("#void_cek").dialog("open"); return false;' class="mybutton">
	<?php	
	}
	?>
</div>
</body>