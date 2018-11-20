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

<h1>Laporan Penjualan Periode</h1>
<h2><b>Pesanan <?php echo $kategori; ?> Terbanyak</b></h2>
<b>Penjualan Tanggal <?php echo $tanggal_awal;?> s/d <?php echo $tanggal_akhir;?></b>

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
$data = "";
$label = "";
$i=0;

	foreach ($sqlv as $key=>$value)
	{
		$data = $data .""."'".$sqlv[$i][item_name]."'"."," ;
		$label = $label .""."'".$sqlv[$i][jumlah]."'"."," ;
		$i++;
	}


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