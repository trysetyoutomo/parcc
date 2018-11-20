
<script type="text/javascript">
    
</script>

<style type="text/css">
	table th{
		background: #2eaae6;
	}
	table tr:nth-child(odd){
		background-color: skyblue;
	}
	table tr:nth-child(even){
		background-color: #eaeaea;
	}
</style>

<h1>Laporan Pengunjung Periode</h1>
	</legend>

<b>Kunjungan Tanggal <?php echo $tanggal_awal;?> s/d <?php echo $tanggal_akhir;?></b>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/chart/Chart.js"></script>
<canvas id="kanvasku" height="700" width="1200%"  ></canvas>
<?
// echo $databar[0]["nama_outlet"];
// $z=0;
// // foreach ($databar as $key=>$value)
// {
// echo $databar[$z]["nama_outlet"] . " nilai :".$databar[$z]["persentase_hasil"]."<br>";
// $z++;
// }

// $dataku = 
?> 


<script>
var labelku = new Array();
var dataku = new Array();
</script>
<?php
if ($nsql00['jumlah'] == null){
	$nsql00 = 0;	
}else{
	$nsql00 = $nsql00['jumlah']; 
}

if ($nsql01['jumlah'] == null){
	$nsql01 = 0;	
}else{
	$nsql01 = $nsql01['jumlah']; 
}

if ($nsql02['jumlah'] == null){
	$nsql02 = 0;	
}else{
	$nsql02 = $nsql02['jumlah']; 
}

if ($nsql03['jumlah'] == null){
	$nsql03 = 0;	
}else{
	$nsql03 = $nsql03['jumlah']; 
}

if ($nsql04['jumlah'] == null){
	$nsql04 = 0;	
}else{
	$nsql04 = $nsql04['jumlah']; 
}

if ($nsql05['jumlah'] == null){
	$nsql05 = 0;	
}else{
	$nsql05 = $nsql05['jumlah']; 
}

if ($nsql06['jumlah'] == null){
	$nsql06 = 0;	
}else{
	$nsql06 = $nsql06['jumlah']; 
}

if ($nsql07['jumlah'] == null){
	$nsql07 = 0;	
}else{
	$nsql07 = $nsql07['jumlah']; 
}

if ($nsql08['jumlah'] == null){
	$nsql08 = 0;	
}else{
	$nsql08 = $nsql08['jumlah']; 
}

if ($nsql09['jumlah'] == null){
	$nsql09 = 0;	
}else{
	$nsql09 = $nsql09['jumlah']; 
}

if ($nsql10['jumlah'] == null){
	$nsql10 = 0;	
}else{
	$nsql10 = $nsql10['jumlah']; 
}

if ($nsql11['jumlah'] == null){
	$nsql11 = 0;	
}else{
	$nsql11 = $nsql11['jumlah']; 
}

if ($nsql12['jumlah'] == null){
	$nsql12 = 0;	
}else{
	$nsql12 = $nsql12['jumlah']; 
}

if ($nsql13['jumlah'] == null){
	$nsql13 = 0;	
}else{
	$nsql13 = $nsql13['jumlah']; 
}

if ($nsql14['jumlah'] == null){
	$nsql14 = 0;	
}else{
	$nsql14 = $nsql14['jumlah']; 
}

if ($nsql15['jumlah'] == null){
	$nsql15 = 0;	
}else{
	$nsql15 = $nsql15['jumlah']; 
}

if ($nsql16['jumlah'] == null){
	$nsql16 = 0;	
}else{
	$nsql16 = $nsql16['jumlah']; 
}

if ($nsql17['jumlah'] == null){
	$nsql17 = 0;	
}else{
	$nsql17 = $nsql17['jumlah']; 
}

if ($nsql18['jumlah'] == null){
	$nsql18 = 0;	
}else{
	$nsql18 = $nsql18['jumlah']; 
}

if ($nsql19['jumlah'] == null){
	$nsql19 = 0;	
}else{
	$nsql19 = $nsql19['jumlah']; 
}

if ($nsql20['jumlah'] == null){
	$nsql20 = 0;	
}else{
	$nsql20 = $nsql20['jumlah']; 
}

if ($nsql21['jumlah'] == null){
	$nsql21 = 0;	
}else{
	$nsql21 = $nsql21['jumlah']; 
}

if ($nsql22['jumlah'] == null){
	$nsql22 = 0;	
}else{
	$nsql22 = $nsql22['jumlah']; 
}

if ($nsql23['jumlah'] == null){
	$nsql23 = 0;	
}else{
	$nsql23 = $nsql23['jumlah']; 
}

$data = "";
$label = "";

	
		// $data = $data .""."'".$sqlv[$i][item_name]."'"."," ; 
		// $data = "'".$nsql00[jumlah]."'".","."'".$nsql01[jumlah]."'".","."'".$nsql02[jumlah]."'".","."'".$nsql03[jumlah]."'".","."'".$nsql04[jumlah]."'".","."'".$nsql05[jumlah]."'".","."'".$nsql06[jumlah]."'".","."'".$nsql07[jumlah]."'".","."'".$nsql08[jumlah]."'".","."'".$nsql09[jumlah]."'".","."'".$nsql10[jumlah]."'".","."'".$nsql11[jumlah]."'".","."'".$nsql12[jumlah]."'".","."'".$nsql13[jumlah]."'".","."'".$nsql14[jumlah]."'".","."'".$nsql15[jumlah]."'".","."'".$nsql16[jumlah]."'".","."'".$nsql17[jumlah]."'".","."'".$nsql18[jumlah]."'".","."'".$nsql19[jumlah]."'".","."'".$nsql20[jumlah]."'".","."'".$nsql21[jumlah]."'".","."'".$nsql22[jumlah]."'".","."'".$nsql23[jumlah]."'"."," ; 
		$data = "'00:00', '01:00', '02:00', '03:00', '04:00', '05:00', '06:00', '07:00', '08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00', '22:00', '23:00'" ;
		// $label = $label .""."'".$sqlv[$i][jumlah]."'"."," ;
		// $label = "'".$nsql00[jumlah]."'".","."'".$nsql01[jumlah]."'".","."'".$nsql02[jumlah]."'".","."'".$nsql03[jumlah]."'".","."'".$nsql04[jumlah]."'".","."'".$nsql05[jumlah]."'".","."'".$nsql06[jumlah]."'".","."'".$nsql07[jumlah]."'".","."'".$nsql08[jumlah]."'".","."'".$nsql09[jumlah]."'".","."'".$nsql10[jumlah]."'".","."'".$nsql11[jumlah]."'".","."'".$nsql12[jumlah]."'".","."'".$nsql13[jumlah]."'".","."'".$nsql14[jumlah]."'".","."'".$nsql15[jumlah]."'".","."'".$nsql16[jumlah]."'".","."'".$nsql17[jumlah]."'".","."'".$nsql18[jumlah]."'".","."'".$nsql19[jumlah]."'".","."'".$nsql20[jumlah]."'".","."'".$nsql21[jumlah]."'".","."'".$nsql22[jumlah]."'".","."'".$nsql23[jumlah]."'"."," ;
		$label = "'".$nsql00."'".","."'".$nsql01."'".","."'".$nsql02."'".","."'".$nsql03."'".","."'".$nsql04."'".","."'".$nsql05."'".","."'".$nsql06."'".","."'".$nsql07."'".","."'".$nsql08."'".","."'".$nsql09."'".","."'".$nsql10."'".","."'".$nsql11."'".","."'".$nsql12."'".","."'".$nsql13."'".","."'".$nsql14."'".","."'".$nsql15."'".","."'".$nsql16."'".","."'".$nsql17."'".","."'".$nsql18."'".","."'".$nsql19."'".","."'".$nsql20."'".","."'".$nsql21."'".","."'".$nsql22."'".","."'".$nsql23."'"."," ;
		
	


// echo $data;
?>

<script>

			
		labelku = [<?=$data?>];
		dataku = [<?=$label?>];


        var barData = {
            labels : labelku,
            datasets : [
                {
                    fillColor : "rgba(255, 0, 0, 0.8)",
                    strokeColor : "rgba(220,220,220,1)",
                    data : dataku
                },
            ]
            
        }

    var barKu = new Chart(document.getElementById("kanvasku").getContext("2d")).Bar(barData);
    
</script>

