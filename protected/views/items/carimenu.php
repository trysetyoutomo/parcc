<div id="isimenu" >
	<?php
	foreach (Items::model()->findAll("  item_name like '%$query%' and hapus = 0 ") as $i):
	 ?>
	<div class="wrap-menu">
	<center>
		<img class="menu" src="<?php echo Yii::app()->request->baseUrl; ?>/menu/1.jpg">
	</center>
		
		<div class="menu-name">
			<p>
			<?php echo $i->item_name ?>
			</p>
		</div>
		<!-- <div class="price">
			<?php echo "Rp. ".number_format($i->unit_price) ?>
		</div> -->
		<div class="add" value="<?php echo $i->id ?>">
				TAMBAH
		</div>
	</div>
	<?php endforeach; ?>
</div>
