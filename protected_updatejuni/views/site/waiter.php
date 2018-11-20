<html>
<head>
		<title>
		Halaman Waiter
	</title>

	<style type="text/css">
	*{
		font-family: arial;
	}
	.namapel{
		margin-top: 20px;
		height: 30px;
		width: 300px;
		border-radius: 8px;
	}
	.namapeg{
		margin-top: 20px;
		height: 30px;
		width: 300px;
		border-radius: 8px;
	}
	</style>
</head>
<?php
	$this->renderPartial("css");
	$this->renderPartial("js");
	$this->renderPartial('main');
	$this->renderPartial('form-auth');
	$this->renderPartial('form-authS');
 ?>
<applet name="jzebra" code="jzebra.PrintApplet.class" archive="jZebra/jzebra/jzebra.jar" width="0" height="0">
	<param name="printer" value="zebra">
</applet>
<div id="full">
	<div>
		<img src="<?php echo Yii::app()->baseUrl; ?>/img/delete.ico" class="close-full">		
	</div>
</div>
<div id="list-meja">
	<center>
	<H2>PILIH MEJA</H2>
		
		 <br>
		<select id="combo-meja" >
		<?php
		$meja = Sales::model()->findAll("t.status = 0");
		$meja = CHtml::listdata($meja,'table','table');
		// print_r($meja);

		 ?>
		 	<option>Piih Meja</option>
			<?php for($x=1;$x<=75;$x++): ?>
				<?php if (!isset($meja[$x])): ?>
					<option class="option-pindah"><?php echo $x; ?></option>
				<?php endif; ?>
			<?php endfor; ?>
		<!-- </div> -->
		<!-- <div class="option-gabung"> -->
			<?php for($x=1;$x<=75;$x++): ?>
				<?php if (isset($meja[$x])): ?>
					<option class="option-gabung"><?php echo $x; ?></option>
				<?php endif; ?>
			<?php endfor; ?>
<!-- </div> -->
		</select>
	</center>
</div>
<ul id="logout">
	<?php if (Yii::app()->user->getLevel() == 6){ ?>
		<li><a href="<?php echo $this->createUrl('site/index');?>">Kembali</a></li>	
	<?php } else { ?>
	<li>
		<?php $user = Yii::app()->user->id; ?>

		<select id="login-waiter" > 
			<!-- <option>PILIH WAITER</option> -->
			<?php foreach (Users::model()->findAll("level = 7") as $k ): ?>
				<option <?php if ($user==$k->username) echo "selected" ?> value="<?php echo $k->username ?>">
					<?php echo $k->name ?>
				</option>
			<?php endforeach ?>
		</select>
		<!-- <a href="#">WAITER : <?php echo Yii::app()->user->id ?></a> -->

	</li>
	<?php } ?>
	<!-- <li><a  href="<?php echo Yii::app()->createUrl('site/logout') ?>"> | LOGOUT</a></li> -->
</ul>

<div id="wrapper-menu">
<div id="container-menu">
	<!--<div id="isimenu">  
		// <?php
		// foreach (Items::model()->findAll("hapus = 0") as $i):
		 // ?>
		<div class="wrap-menu">
			<center>
				<?php //if ($i->lokasi  == 0){?>
				<img class="menu" src="<?php //echo Yii::app()->request->baseUrl; ?>/menu/2.png">
				<?php //}else{ ?>
				<img class="menu" src="<?php //echo Yii::app()->request->baseUrl; ?>/menu/1.jpg">
				<?php //} ?>
			</center>

			<div class="menu-name">
				<p>
				<?php //echo $i->item_name ?>
				</p>
			</div>
			<!-- <div class="price">
			<?php //echo "Rp. ".number_format($i->unit_price) ?>
			</div> --><!--
			<div class="add" value="<?php //echo $i->id ?>">
			TAMBAH
			</div>
		</div>
		<?php //endforeach; ?>
	</div>-->
	<div id="isimenu">  
		<?php
		// echo $mmm;
		$sqlitemsal = "
			select * from items where hapus = 0 and category_id between 1 and 2
		";
		$valsqlitemsal = Yii::app()->db->CreateCommand($sqlitemsal)->queryAll();
		// foreach (Items::model()->findAll("hapus = 0") as $i):
		foreach ($valsqlitemsal as $i):
		 ?>
		<div class="wrap-menu">
			<center>
				<img class="menu" src="<?php echo Yii::app()->request->baseUrl; ?>/menu/1.jpg">
			</center>

			<div class="menu-name">
				<p>
				<?php echo $i['item_name'] ?>
				</p>
			</div>
			<!-- <div class="price">
			<?php //echo "Rp. ".number_format($i['unit_price']) ?>
			</div> -->
			<div class="add" value="<?php echo $i[id] ?>">
			TAMBAH
			</div>
		</div>
		<?php endforeach; ?>
	</div>
	<div id="isimenu1">  
		<?php
		// echo $mmm;
		$sqlitemsal = "
			select * from items where hapus = 0 and category_id = 12
		";
		$valsqlitemsal = Yii::app()->db->CreateCommand($sqlitemsal)->queryAll();
		// foreach (Items::model()->findAll("hapus = 0") as $i):
		foreach ($valsqlitemsal as $i):
		 ?>
		<div class="wrap-menu">
			<center>
				<img class="menu" src="<?php echo Yii::app()->request->baseUrl; ?>/menu/2.png">
			</center>

			<div class="menu-name">
				<p>
				<?php echo $i['item_name'] ?>
				</p>
			</div>
			<!-- <div class="price">
			<?php echo "Rp. ".number_format($i->unit_price) ?>
			</div> -->
			<div class="add" value="<?php echo $i[id] ?>">
			TAMBAH
			</div>
		</div>
		<?php endforeach; ?>
	</div>
	<div id="isimenu2">  
		<?php
		// echo $mmm;
		$sqlitemsal = "
			select * from items where hapus = 0 and category_id = 14
		";
		$valsqlitemsal = Yii::app()->db->CreateCommand($sqlitemsal)->queryAll();
		// foreach (Items::model()->findAll("hapus = 0") as $i):
		foreach ($valsqlitemsal as $i):
		 ?>
		<div class="wrap-menu">
			<center>
				<img class="menu" src="<?php echo Yii::app()->request->baseUrl; ?>/menu/2.png">
			</center>

			<div class="menu-name">
				<p>
				<?php echo $i['item_name'] ?>
				</p>
			</div>
			<!-- <div class="price">
			<?php echo "Rp. ".number_format($i->unit_price) ?>
			</div> -->
			<div class="add" value="<?php echo $i[id] ?>">
			TAMBAH
			</div>
		</div>
		<?php endforeach; ?>
	</div>

	
	<div id="faktur">
		<img src="<?php echo Yii::app()->baseUrl; ?>/img/delete.ico" class="close">
	
		<!-- <input  type="button" class="btn" value="cetak" >	 -->
		<input  type="button" class="btn kirim " value="PERBAHARUI" >	
		<input  type="button" class="btn onupdate" status="pindah" value="PINDAH MEJA" >
		<input  type="button" class="btn onupdate" status="gabung" value="GABUNG MEJA" >
		<!-- <input  type="button" class="btn onhapus" status="gabung" value="HAPUS ISI MEJA" > -->
		<!-- <input  type="button" onclick="cetakbardapur()" class="btn" status="cetak" value="CETAK" > -->
		<h1 class="judul">	</h1>
		<div class="form">
			<input type="text" class="cari-menu" placeholder="cari menu" >
			<input  type="button" value="cari" class="btn btn-cari-menu">
		</div>
		<div class="form" id="aaaaa">
			<label>
				NAMA TAMU 
				<input class="namapel" type="text" id="namapel" placeholder="   atas nama">
			<label>
		</div>
		<div class="form" id="bbbbb">
			<label>
				NAMA PETUGAS 
				<input class="namapeg" type="text" id="namapeg" placeholder="   nama petugas">
			<label>
		</div>
		<br>
		<style type="text/css">
		#container-tabel{
			height: 500px;
			overflow: scroll;
		}
		</style>
		<div id="container-tabel">
			<table id="items" >
				<thead > 
				<tr>
					<!-- <td>No</td> -->
					<td>Nama</td>
					<td>Jumlah</td>
					<td>permintaan</td>
					<td>Cetak</td>
					<td>Hapus</td>
					<!-- <td>Spoile</td> -->
				</tr>
				</thead>
				<tbody >

				</tbody>

			</table>
		</div>
		
	</div>
</div>
</div>
<div id="meja" ></div>

</html>