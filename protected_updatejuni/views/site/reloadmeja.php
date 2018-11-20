<h1 class="judul">PILIH MEJA</h1>
	<center>	
		<ul class="sheet">
			<?php

			// Koding Triana##buka
			if (Yii::app()->user->getLevel() == 6){
				$sheet = 5;
				for($z=1;$z<=$sheet;$z++): ?>
					<?php
						if($z==1){
							$ket = "Cafe";
						}elseif($z==2){
							$ket = "Cowork";
						}elseif($z==3){
							$ket = "Take Away";
						}elseif($z==4){
							$ket = "Owner";
						}elseif($z==5){
							$ket = "Salon";
						}
					?>
					<li class="sheet-meja" <?php if ($z==1) echo "style='background:red'" ?> val="<?php echo $z ?>"><?php echo $ket; ?></li><!--Area--> 
				<?php endfor; ?>
			<?php }else{

				$sheet = 3;
				for($z=1;$z<=$sheet;$z++): ?>
					<?php
						if($z==1){
							$ket = "Cafe";
						}elseif($z==2){
							$ket = "Take Away";
						}elseif($z==3){
							$ket = "Owner";
						}
						// elseif($z==2){
						// 	$ket = "Cowork";
						// }elseif($z==5){
						// 	$ket = "Salon";
						// }
					?>
					<li class="sheet-meja" <?php if ($z==1) echo "style='background:red'" ?> val="<?php echo $z ?>"><?php echo $ket; ?></li><!--Area--> 
				<?php endfor; 
				} ?>
		</ul>
	</center>
	<!-- <center> -->
	
	<ul>
	<?php 
		$model = Sales::model()->findAllByAttributes(array('status' => 0));
		$data = CHtml::listData($model, 'table', 'table');
		$waiter = CHtml::listData($model, 'table', 'waiter');
		$pulang = CHtml::listData($model, 'table', 'pulang');

		// echo "<pre>";
		// print_r($pulang);
		// echo "</pre>";

	?>
	<?php
	// $nomor = 1 ; 
	 for($z=1;$z<=$sheet;$z++): ?>
		<li class="hide sheet<?php echo $z ?>
		 <?php
			 if ($z==1){
			 	echo "active";
			 }
		 ?>
		">
			<?php
			if (Yii::app()->user->getLevel() == 6){
				if ($z==1){
					$a1 = 1;
					$a2 = 20;
				}elseif($z==2){
					$a1 = 21;
					$a2 = 40;
				}elseif($z==3){
					$a1 = 41;
					$a2 = 60;
				}elseif($z==4){
					$a1 = 61;
					$a2 = 80;
				}elseif($z==5){
					$a1 = 81;
					$a2 = 90;
				}
			}else{
				if ($z==1){
					$a1 = 1;
					$a2 = 20;
				}elseif($z==2){
					$a1 = 41;
					$a2 = 60;
				}elseif($z==3){
					$a1 = 61;
					$a2 = 80;
				}
				// elseif($z==2){
				// 	$a1 = 21;
				// 	$a2 = 40;
				// }elseif($z==5){
				// 	$a1 = 81;
				// 	$a2 = 90;
				// }
			}
			$sqlno_meja = "
				select no_meja from meja where no_meja between '$a1' and '$a2'
			";
			$valno_meja = Yii::app()->db->createCommand($sqlno_meja)->queryAll();
			// echo $valno_meja;
			foreach($valno_meja as $test){
				$nomor = $test['no_meja'];
				// echo $nomor;
			// for($x=1;$x<=20;$x++):
				// echo $z;
				 // if ($z==1)
				 // 	 $warna = "style='background:red' "; 
			 	//  if ($z==2)
				 // 	 $warna = "style='background:yellow' "; 
			 	//  if ($z==3)
				 // 	 $warna = "style='background:green' "; 
			 	//  if ($z==4)
				 // 	 $warna = "style='background:blue' "; 
			 	//  if ($z==5)
				 // 	 $warna = "style='background:gray' "; 
			 		$tipe_meja = Meja::model()->findByPk($nomor)->status;
					$tipe_meja = MejaName::model()->findByPk($tipe_meja)->name;
			?>

				<div tipe_meja="<?php echo $tipe_meja ?>" value="<?php echo $nomor; ?>" <?php echo $warna ?>  class="no-meja
				<?php
					if (isset($data[$nomor])){
						echo "blink_me terisi ";
					}

					if (isset($pulang[$nomor])){
						// echo " belum-pulang";
						if ($pulang[$nomor]==0){
							echo " belum-pulang";
						}
						// else{

						// }
					}


				?>">
				<div class="waiter-name">
				<?php
					if (isset($waiter[$nomor])){
						echo $waiter[$nomor];
					}
				?>
					
				</div>
				<div class="angka-meja">
					<?php echo $nomor;  ?></div>
				</div>
			<?php 
			// $nomor++;
			} 
			// endfor; ?>
		</li>
	<?php endfor; ?>
	</ul>
	<!-- </center> -->