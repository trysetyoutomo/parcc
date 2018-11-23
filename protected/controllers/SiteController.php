<?php

class SiteController extends Controller
{
    
    public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('spoile','pajak','waiterhapus','ubahpassword','uservoid','cekpassword','gabungmeja','reloadoptionmeja','reloadMeja','updatetable','getmenutable','waiterkirim','login','logout','setting','hutang'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('laporanpenjualan','setpajak','index','table','waiter','salon'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Declares class-based actions.
	 
         * 
         */

	public function actionspoile()
	{
		$idsi = $_REQUEST['datasiid'];
		$modelsalesitem = SalesItems::model()->findByPk($idsi);
		$modelspoile = new Spoile;
		$modelspoile->id = $modelsalesitem->id;
		$modelspoile->sale_id = $modelsalesitem->sale_id;
		$modelspoile->item_id = $modelsalesitem->item_id;
		$modelspoile->quantity_purchased = $modelsalesitem->quantity_purchased;
		$modelspoile->item_tax = $modelsalesitem->item_tax;
		$modelspoile->item_price = $modelsalesitem->item_price;
		$modelspoile->item_discount = $modelsalesitem->item_discount;
		$modelspoile->item_total_cost = $modelsalesitem->item_total_cost;
		$modelspoile->item_service = $modelsalesitem->item_service;
		if ($modelspoile->save()) {
			$modelsalesitem->delete();
			$a = "Berhasil";
		}else{
			$a = "no";
		}
		print_r($a);
	}

	public function actionLaporanpenjualan(){
		// echo "123";
		$this->layout = "main2";
			if ($_REQUEST['month']){
				$month = $_REQUEST['month'];
				$year = $_REQUEST['year'];
			}else{
				$month = intval(Date('m'));
				$year = intval(Date('Y'));
			}
			$subtotal = "si.item_price*si.quantity_purchased" ; 
			$sale_service = "si.item_service" ; 
			$sql  = "select s.bayar,
			s.table,inserter, s.comment comment, 
			s.id,sum(si.quantity_purchased) as total_items, 
			date,
			s.waiter waiter,

			sum($subtotal) sale_sub_total,
			
			sum($sale_service) sale_service,
			sum(si.item_tax) sale_tax,
			sum( si.item_discount/100 * ($subtotal) )  sale_discount,
			
			sum((

				($subtotal) + $sale_service + (si.item_tax)-  ( si.item_discount/100 * ($subtotal))
				))  
			sale_total_cost,

			 u.username inserter 
			 from 
			 sales s,
			 sales_items si ,
			 users u ,
			 items i,
			 sales_pajak_detail spd,
			 sales_pajak_head sph
			 where 
			  spd.sale_id = s.id
			  and			  
			  sph.id = spd.head_id
			  and
			  i.id = si.item_id  and
			  
			 s.id = si.sale_id and year(s.date)='$year' and month(s.date)='$month'  and s.status=1 and inserter = u.id   group by s.id  ";
			 // echo $sql;


			 //cek jumlah record
			 $count = count(Yii::app()->db->createCommand($sql)->queryAll() );
			 if ($count==0){
			 	
		 	//membuat sebuah filteran
		 	$q = array();
			$q[0] = "DAY(s.date)>=1 AND DAY(s.date)<=7";
			$q[1] = "DAY(s.date)>=8 AND DAY(s.date)<=14";
			$q[2] = "DAY(s.date)>=15 AND DAY(s.date)<=21";
			$q[3] = "DAY(s.date)>=22 AND DAY(s.date)<=31";

			//for 4 minggu
			  $adt_sql1 = " and case  ";
		  	  $adt_sql2 = " ";
		  	  $adt_sql3 = " end   ";
		  	  //masukan ke dalam string
			for ($x=1;$x<5;$x++):
				$param = Yii::app()->db->createCommand("select * from parameter where id = 1")->queryRow();
				$in  = "pajak_$x";
				$xx = $x-1;
				$adt_sql2 = $adt_sql2." when ( $q[$xx] ) then sale_sub_total <= $param[$in]   ";
			endfor;


			$adt_sql4 =  $adt_sql1.$adt_sql2.$adt_sql3;
			// echo $adt_sql4;

			 	
		 			$subtotal = "si.item_price*si.quantity_purchased" ; 
					$sale_service = "si.item_service" ; 
					$sql  = "select s.bayar,
					s.table,inserter, s.comment comment, 
					s.id,sum(si.quantity_purchased) as total_items, 
					date,
					s.waiter waiter,

					sum($subtotal) sale_sub_total,
					
					sum($sale_service) sale_service,
					sum(si.item_tax) sale_tax,
					sum( si.item_discount/100 * ($subtotal) )  sale_discount,
					
					sum((

						($subtotal) + $sale_service + (si.item_tax)-  ( si.item_discount/100 * ($subtotal))
						))  
					sale_total_cost,

					 u.username inserter 
				 from 
					 sales s,
					 sales_items si ,
					 users u ,
					 items i
				 where 
					i.id = si.item_id  and

					s.id = si.sale_id and year(s.date)='$year' and month(s.date)='$month'  
					and s.status=1 
					and inserter = u.id
					$adt_sql4  
					 group by s.id
					 order by s.date desc
					  ";
					  // echo $sql;

			 }


			 $dataProvider = new CSqlDataProvider($sql, array(
				'totalItemCount'=>$count,
				'sort'=>array(
				'attributes'=>array(
				'desc'=>array('s.id'),
				),
				),
				'pagination'=>array(
				'pageSize'=>100000,
			),
			));


	   $this->render('laporanpajak', array(
            'dataProvider' => $dataProvider,
            // 'summary' => $summary,
			'year' => $year,
			'month' => $month,
			// 'model'=>$model,
        ));
	}
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
	// public function actionAuth(){
	// 	echo "123";
	// }

	// public function actionPajak(){
	// 	$this->layout = "main2";
	// 	// echo "<pre>";
	// 	// print_r($_REQUEST[minimal]);
	// 	// echo "</pre>";
	// 	$model = array();
	// 	$min_bill = $_REQUEST[minimal];
	// 	if (isset($_REQUEST[bulan]) || isset($_REQUEST[tahun]) ){
	// 		$bulan = $_REQUEST[bulan];
	// 		$tahun = $_REQUEST[tahun];
	// 	}else{
	// 		$bulan = date("m");
	// 		$tahun = date("Y");		
	// 	}
 //  	  $adt_sql1 = " case  ";
 //  	  $adt_sql2 = " ";
 //  	  $adt_sql3 = " end  ";

 //  	  if (isset($_REQUEST[minimal]) ):
	//   foreach ($_REQUEST[minimal] as $key => $value) {
	// 	  $adt_sql2 = $adt_sql2." when ( (FLOOR((DayOfMonth(s.date)-1)/7)+1 )  = $key ) then sale_sub_total <= $value  ";
	//   }
	//   $adt_sql4 =  $adt_sql1.$adt_sql2.$adt_sql3;

	// 	// $min_bill = $_REQUEST[minimal];
	// 	$subtotal = "si.item_price*si.quantity_purchased" ; 
	// 	$sale_service = "si.item_service" ; 
	// 	$sql  = "select s.bayar,s.table,inserter, s.comment comment, 
	// 	s.id id,sum(si.quantity_purchased) as total_items, 
	// 	date,
	// 	s.waiter waiter,

	// 	sum($subtotal) sale_sub_total,
		
	// 	sum($sale_service) sale_service,
	// 	sum(si.item_tax) sale_tax,
	// 	sum( si.item_discount/100 * ($subtotal) )  sale_discount,
		
	// 	sum((

	// 		($subtotal) + $sale_service + (si.item_tax)-  ( si.item_discount/100 * ($subtotal))
	// 		))  
	// 	sale_total_cost,

	// 	 u.username inserter 
	// 	 from sales s,sales_items si , users u , items i
	// 	 where 
		  
	// 	  i.id = si.item_id  and
		  
	// 	 s.id = si.sale_id and 
	// 	 year(s.date)='$tahun' and 
	// 	 month(s.date)='$bulan' 



	// 	  and s.status=1 and inserter = u.id  group by s.id 
	// 	  having
	// 	  sale_tax != 0 
	// 	  and
	// 	  $adt_sql4
	// 	  ";
	// 	  // if (isset($_REQUEST[minimal])){
		 
	// 	  // }else{
	// 	  // 	echo "123";
	// 	  // }
	// 	 // echo $sql;
	// 	 $model = Yii::app()->db->createCommand($sql)->queryAll();
	// 	  endif;
	// 	 $this->render("pajak",array(
	//  	 	'model' => $model
	//  	 ));


	// }
	public function actionSetpajak(){
		// echo "123";
		$persen_jb = $_REQUEST['persen_jb'];
		$persen_jp = $_REQUEST['persen_jp'];
		$tahun = $_REQUEST['tahun'];
		$bulan = $_REQUEST['bulan'];
		$detail = $_REQUEST['detail'];
		$detail1 = $_REQUEST['detail1'];
		$model = SalesPajakHead::model()->findAll("bulan='$bulan' and tahun='$tahun' ");
		if (count($model)==0){
			$head = new SalesPajakHead;
			$head->bulan = $bulan;
			$head->tahun = $tahun;
			$head->persen_jb = $persen_jb;
			$head->persen_jp = $persen_jp;
			if ($head->save()){
				$inno = 0;
				foreach ($detail as $d) {
					$detail = new SalesPajakDetail;
					$detail->head_id = $head->id;
					$detail->sale_id = $d;
					$detail->no_bill = $detail1[$inno];
					if($detail->save()){
						echo "Sukses";
					}else{
						print_r($detail->getErrors());	
					}
					$inno = $inno + 1;
				}
			}else{
				print_r($head->getErrors());
			}
			
		}else{
			echo "Tahun dan Bulan tersebut telah di Set";
		}
		// echo "sukses";
	}
	public function actionPajak(){
		$this->layout = "main2";
		// echo "<pre>";
		// print_r($_REQUEST[minimal]);
		// echo "</pre>";
		$model = array();
		$min_bill = $_REQUEST[minimal];
		if (isset($_REQUEST[bulan]) || isset($_REQUEST[tahun]) ){
			$bulan = $_REQUEST[bulan];
			$tahun = $_REQUEST[tahun];
		}else{
			$bulan = date("m");
			$tahun = date("Y");		
		}
  	  $adt_sql1 = " case  ";
  	  $adt_sql2 = " ";
  	  $adt_sql3 = " end order by s.date asc  ";

  	  if (isset($_REQUEST[minimal]) ):
	  foreach ($_REQUEST[minimal] as $key => $value) {
	  	  if ($key==1){
	  	  	$q = "DAY(s.date)>=1 AND DAY(s.date)<=7";
	  	  }elseif ($key==2) {
	  	  	$q = "DAY(s.date)>=8 AND DAY(s.date)<=14";
  	  	  }elseif ($key==3) {
	  	  	$q = "DAY(s.date)>=15 AND DAY(s.date)<=21";
  	  	  }elseif ($key==4) {
	  	  	$q = "DAY(s.date)>=22 AND DAY(s.date)<=31";
	  	  }


		  $adt_sql2 = $adt_sql2." when ( $q ) then sale_dis_vouc <= $value  ";
		  // $adt_sql2 = $adt_sql2." when ( $q ) then sale_sub_total <= $value  ";
	  }
	  $adt_sql4 =  $adt_sql1.$adt_sql2.$adt_sql3;

		// $min_bill = $_REQUEST[minimal];
		$subtotal = "si.item_price*si.quantity_purchased" ; 
		$angka_diskon = "( si.item_discount/100 * ($subtotal) )";
		$sale_service = "(sum($subtotal-$angka_diskon)-sp.voucher)* 0.05" ; 
		$sale_tax = "(sum($subtotal-$angka_diskon)-sp.voucher)* 0.1" ; 
		$sale_dis_vouc = "( sum($subtotal)-sum($angka_diskon)-sp.voucher )";
		$sql  = "select fid,s.bayar,s.table,inserter, s.comment comment, 
		s.id id,sum(si.quantity_purchased) as total_items, 
		date,
		s.waiter waiter,

		sum($subtotal) sale_sub_total,
		$sale_dis_vouc sale_dis_vouc,
	

		$sale_service sale_service,
		$sale_tax sale_tax,
		sp.voucher voucher,
		sum( si.item_discount/100 * ($subtotal) )  sale_discount,
		
		($sale_dis_vouc) + ($sale_tax)  + ($sale_service)
		sale_total_cost,

		 u.username inserter 
		 from sales s,sales_items si , users u , items i, sales_payment sp
		 where 
		 
		 sp.id = s.id and 
		 i.id = si.item_id  and
		 s.status = 1 and
		 s.id = si.sale_id and 
		 year(s.date)='$tahun' and 
		 month(s.date)='$bulan' 



		  and s.status=1 and inserter = u.id  group by s.id 
		  having
		  sale_tax != 0 
		  and
		  $adt_sql4
		  ";



		  $sql2  = "select s.bayar,s.table,inserter, s.comment comment, 
		s.id id,sum(si.quantity_purchased) as total_items, 
		date,
		s.waiter waiter,

		sum($subtotal) sale_sub_total,
		$sale_dis_vouc sale_dis_vouc,
	

		$sale_service sale_service,
		$sale_tax sale_tax,
		sp.voucher voucher,
		sum( si.item_discount/100 * ($subtotal) )  sale_discount,
		
		($sale_dis_vouc) + ($sale_tax)  + ($sale_service)  
		sale_total_cost,

		 u.username inserter 
		 from sales s,sales_items si , users u , items i, sales_payment sp
		 where 
		  
		 sp.id = s.id and 
		 i.id = si.item_id  and
		 s.id = si.sale_id and 
		 year(s.date)='$tahun' and 
		 month(s.date)='$bulan' 



		  and s.status=1 and inserter = u.id  group by s.id 
		  having
		  sale_tax != 0 
		  ";

		  // if (isset($_REQUEST[minimal])){
		 
		  // }else{
		  // 	echo "123";
		  // }
		 // echo $sql;
		 $model = Yii::app()->db->createCommand($sql)->queryAll();
		 $model2 = Yii::app()->db->createCommand($sql2)->queryAll();
		  endif;
		 $this->render("pajak",array(
	 	 	'model' => $model,
	 	 	'model2' => $model2,
	 	 	'bulan' => $bulan,
	 	 	'tahun' => $tahun
	 	 ));


	}
	public function actionUbahpassword(){
	 	$this->layout = "main2";
		$user = Yii::app()->user->id;
		// echo $user;
		$model = Users::model()->find("username = '$user'");
		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
			if ($model->validate()){	
				$model->password = $_POST['Users']['new_password'];
				if ($model->update()){	
					$this->redirect(array('site/logout'));
				}
			}

	 	}

	 	// $this->menu = "account";
	 	$this->render("account",array(
	 		'model'=>$model
 		));

	}
	public function actionGabungmeja($mjl,$mjb){
		$id_sales_lama = Sales::model()->find("t.table = '$mjl' and status = 0")->id;
		$id_sales_baru = Sales::model()->find("t.table = '$mjb' and status = 0")->id;
		$sales_lamaitems = SalesItems::model()->findAll("sale_id = '$id_sales_lama' ");
		foreach ($sales_lamaitems as $sli) {
			$sli->sale_id = $id_sales_baru;
			$sli->update();
            // =================================================================================================================================
            // $msg =  "[{$query}]".mysql_error($this->Conn);
			$author = Yii::app()->user->id;
			$ip_addrs = $_SERVER['REMOTE_ADDR'];
            $msg =  "[{$author} ({$ip_addrs}) | Gabung meja dari {$mjl} ke {$mjb}]";
            $log  = "Scc [".date("Y-m-d H:i:s")." / SiteController(503)(actionGabungmeja)]: ".$msg.PHP_EOL;
            file_put_contents('logs/log_site_'.$author.'_'.date("Y-m-d").'.txt', $log, FILE_APPEND);
            // =================================================================================================================================
		}
		$model = Sales::model()->find("t.table = '$mjl' and status = 0");
		if ($model->delete()){
			echo "sukses dele";
		}

		
	}
	public function actionCekpassword($username,$password){
		$user = Users::model()->find("username = '$username' and password = '$password' ");
		if (count($user)==0){
			echo false;
		}else{
			// echo "true";
			Yii::app()->user->logout();
			$model=new LoginForm;
			$model->username = $username;
			$model->password = $password;
			if ($model->login())
				echo  true;
			else
				echo "login gagal";
		}		
	}
	public function actionReloadmeja(){
		$this->renderPartial('reloadmeja');
	}
	public function actionReloadOptionMeja(){
		$this->renderPartial('reloadoptionmeja');
	}
	public function actionUpdatetable($mjl,$mjb){
		$sales = Sales::model()->find("t.table = '$mjl' and status = 0");
		$sales->table = $mjb;
		if ($sales->update())
            // =================================================================================================================================
            // $msg =  "[{$query}]".mysql_error($this->Conn);
			$author = Yii::app()->user->id;
			$ip_addrs = $_SERVER['REMOTE_ADDR'];
            $msg =  "[{$author} ({$ip_addrs}) | Pindah meja dari {$mjl} ke {$mjb}]";
            $log  = "Scc [".date("Y-m-d H:i:s")." / SiteController(538)(actionUpdatetable)]: ".$msg.PHP_EOL;
            file_put_contents('logs/log_site_'.$author.'_'.date("Y-m-d").'.txt', $log, FILE_APPEND);
            // =================================================================================================================================
			echo "meja telah terpindahkan";

	}
	public function actionGetmenutable($table){
		$this->renderPartial('getmenutable',array('table'=>$table));
	}
	public function actionWaiter(){
		// $this->layout = "waiter";
		// echo "masuk";
		$this->renderPartial('waiter');
	}
	public function actionSalon(){
		// $this->layout = "waiter";
		// echo "masuk";
		$this->renderPartial('salon');
	}
	public function actionWaiterkirim(){
			date_default_timezone_set("Asia/Jakarta"); 
			$nilai = $_REQUEST['jsonObj'];
			$head = $_REQUEST['head'];
			$namapel = $_REQUEST['namapel'];
			$namapeg = $_REQUEST['namapeg'];

			$mj = $_REQUEST['head']['meja'];
	
			$jml = Sales::model()->count(" t.table = '$mj' and status = 0 ");
			if ($jml==0)
				$modelh = new Sales;
			else
				$modelh = Sales::model()->find(" t.table = '$mj' and status = 0 ");
			
			if ($namapeg=="")
				$simpanwaiter = Yii::app()->user->id;
			else
				$simpanwaiter = $namapeg;

			// $modelh->date = $_REQUEST['head']['tanggal'];
			$modelh->date = date('Y-m-d H:i:s');
			$modelh->inserter = Yii::app()->user->id;
			$modelh->customer_id = 0;
			$modelh->nama = $namapel;
			$modelh->sale_sub_total = 0;
			$modelh->sale_discount = 0;
			$modelh->sale_service = 0;
			$modelh->sale_tax = 0;
			$modelh->sale_total_cost = 0;
			$modelh->paidwith_id = 0;
			$modelh->total_items = 0;
			$modelh->sale_payment = 0;
			$modelh->branch = 1;
			$modelh->user_id = 0;
			$modelh->status = 0;
			if (Yii::app()->user->getLevel()==7){
				//$modelh->waiter = Yii::app()->user->id;
				$modelh->waiter = $simpanwaiter;
			}else{
				$modelh->waiter = $simpanwaiter;
			}
			
			$modelh->table = $_REQUEST['head']['meja'];


			$pajak = Parameter::model()->findByPk(1)->pajak/100;
			$service = Parameter::model()->findByPk(1)->service/100;
			// $modelh->pemasok_id = $_REQUEST['head']['pemasok'];
			if ($modelh->save()){

				// if (
				// echo $modelh->nama;

				#di comment karena skrng yang insert hanya yang statusnya cetak = 0 jadi tidak usah lagi menghapus isi sales item yang sebelumnya
				// SalesItems::model()->deleteAll("sale_id = '$modelh->id' ");

				foreach ($nilai as $n){
					if ($n['cetak'] == "0") {
						# insert ke table sales item yang cetak sama dengan 0 atau belum di cetak
		                // =================================================================================================================================
		                // $msg =  "[{$query}]".mysql_error($this->Conn);
						$author = Yii::app()->user->id;
						$ip_addrs = $_SERVER['REMOTE_ADDR'];
		                $msg =  "[{$author} ({$ip_addrs}) | add {$n['idb']} to {$modelh->id}]";
		                $log  = "Scc [".date("Y-m-d H:i:s")." / SiteController(607)(actionWaiterkirim)]: ".$msg.PHP_EOL;
		                file_put_contents('logs/log_site_'.$author.'_'.date("Y-m-d").'.txt', $log, FILE_APPEND);
		                // =================================================================================================================================
						$model = new SalesItems;
						$model->item_id = $n['idb'];
						
						$items = Items::model()->findByPk($n['idb']);

						$model->quantity_purchased = $n['jml'];
						$model->item_tax = ($items->unit_price*$n['jml']) * $pajak ;
						$model->item_service = ($items->unit_price*$n['jml']) * $service ;
						$model->item_price = $items->unit_price;
						$model->item_discount = 0;
						$model->cetak = 1;
						$model->item_total_cost =  ($items->unit_price * $n['jml']) + ( ($items->unit_price*$n['jml']) * $pajak ) + (($items->unit_price*$n['jml']) * $service)  ;
						$model->permintaan = $n['permintaan'];
						$model->author_add = $author;
						$model->datetime_add = date("Y-m-d H:i:s");
						// $model->harga = Barang::model()->findByPk($n['idb'])->harga;
						$model->sale_id = $modelh->id;
						if ($model->save()){
							echo "sukses bro";
							// $barang = Barang::model()->findByPk($n['idb']);
							// $barang->stok = $barang->stok + $n['jml'];
							// if ($barang->save()){
							// 	echo "sukses update ";
							// }
						}
						else{
							echo "<pre>";
							print_r($model->getErrors());
							echo "</pre>";
							// echo "gagal bro";			
						}
					}
				}

				// }else{
				// 	echo "gagal deleteAll";
				// }
			}else{
				echo "<pre>";
				print_r($modelh->getErrors());
				echo "</pre>";
			}

	}	
	public function actionWaiterhapus(){
			$nilai = $_REQUEST['jsonObj'];
			$head = $_REQUEST['head'];
			$namapel = $_REQUEST['namapel'];

			$mj = $_REQUEST['head']['meja'];
	
			$jml = Sales::model()->count(" t.table = '$mj' and status = 0 ");
			if ($jml==0)
				$modelh = new Sales;
			else
				$modelh = Sales::model()->find(" t.table = '$mj' and status = 0 ");
			

			// $modelh->date = $_REQUEST['head']['tanggal'];
			$modelh->date = date('Y-m-d H:i:s');
			$modelh->inserter = Yii::app()->user->id;
			$modelh->customer_id = 0;
			$modelh->nama = $namapel;
			$modelh->sale_sub_total = 0;
			$modelh->sale_discount = 0;
			$modelh->sale_service = 0;
			$modelh->sale_tax = 0;
			$modelh->sale_total_cost = 0;
			$modelh->paidwith_id = 0;
			$modelh->total_items = 0;
			$modelh->sale_payment = 0;
			$modelh->branch = 1;
			$modelh->user_id = 0;
			$modelh->status = 1;
			$modelh->inserter = 33;
			$modelh->comment  = "Di hapus pada POS";
			if (Yii::app()->user->getLevel()==7){
				$modelh->waiter = Yii::app()->user->id;
			}
			
			$modelh->table = $_REQUEST['head']['meja'];


			$pajak = Parameter::model()->findByPk(1)->pajak/100;
			$service = Parameter::model()->findByPk(1)->service/100;
			// $modelh->pemasok_id = $_REQUEST['head']['pemasok'];
			if ($modelh->save()){

				// if (
				// echo $modelh->nama;
				SalesItems::model()->deleteAll("sale_id = '$modelh->id' ");

				foreach ($nilai as $n){
					$model = new SalesItems;
					$model->item_id = $n['idb'];
					
					$items = Items::model()->findByPk($n['idb']);

					$model->quantity_purchased = 0;
					$model->item_tax = 0 ;
					$model->item_service = 0 ;
					$model->item_price = 0;
					$model->item_discount = 0;
					$model->cetak = 1;
					$model->item_total_cost =  0;
					$model->permintaan = $n['permintaan'];
					// $model->harga = Barang::model()->findByPk($n['idb'])->harga;
					$model->sale_id = $modelh->id;
					if ($model->save()){
			            // =================================================================================================================================
			            // $msg =  "[{$query}]".mysql_error($this->Conn);
						$author = Yii::app()->user->id;
						$ip_addrs = $_SERVER['REMOTE_ADDR'];
			            $msg =  "[{$author} ({$ip_addrs}) | Hapus isi meja table {$_REQUEST['head']['meja']}]";
			            $log  = "Scc [".date("Y-m-d H:i:s")." / SiteController(742)(actionWaiterhapus)]: ".$msg.PHP_EOL;
			            file_put_contents('logs/log_site_'.$author.'_'.date("Y-m-d").'.txt', $log, FILE_APPEND);
			            // =================================================================================================================================
						echo "sukses bro";
						// $barang = Barang::model()->findByPk($n['idb']);
						// $barang->stok = $barang->stok + $n['jml'];
						// if ($barang->save()){
						// 	echo "sukses update ";
						// }
					}
					else{
						echo "<pre>";
						print_r($model->getErrors());
						echo "</pre>";
						// echo "gagal bro";			
					}
				}

				// }else{
				// 	echo "gagal deleteAll";
				// }
			}else{
				echo "<pre>";
				print_r($modelh->getErrors());
				echo "</pre>";
			}

	}	
	public function actionUservoid(){
		if (isset($_REQUEST['username'])) {
			$un = $_REQUEST['username'];
			$pass = $_REQUEST['password'];
			$siid = $_REQUEST['siid'];
			$ip_addrs = $_SERVER['REMOTE_ADDR'];
			//cari dari database yg usename & passwordnya dikirim
			$user = Users::model()->find("username=:un AND  password=:pass",array(":un"=>$un, ":pass"=>$pass));
			$userLevel = $user['level'];
			//echo "<br>".$username = $user->name;
			if(isset($userLevel)){
				if($userLevel<5){
					//jika userlevel < 5 maka eksekusi void_bayar
					$m = new LogAktivitas;
					$m->username = $un;
					$m->controller = 'site';
					$m->action = 'hmppos';
					$m->tanggal_akses = date("Y-m-d h:i:s");
					if ($m->save()) {
						$modelsalesitem = SalesItems::model()->findByPk($siid);
						$sih = new SalesItemsHapus;
						$sih->siid = $modelsalesitem->id;
						$sih->sale_id = $modelsalesitem->sale_id;
						$sih->item_id = $modelsalesitem->item_id;
						$sih->quantity_purchased = $modelsalesitem->quantity_purchased;
						$sih->item_tax = $modelsalesitem->item_tax;
						$sih->item_price = $modelsalesitem->item_price;
						$sih->item_discount = $modelsalesitem->item_discount;
						$sih->item_total_cost = $modelsalesitem->item_total_cost;
						$sih->item_service = $modelsalesitem->item_service;
						$sih->author_add = $un;
						$sih->datetime_add = date("Y-m-d H:i:s");
						if ($sih->save()) {
			                // =================================================================================================================================
			                // $msg =  "[{$query}]".mysql_error($this->Conn);
			                $msg =  "[{$un} ({$ip_addrs}) | add sih {$siid}]";
			                $log  = "Scc [".date("Y-m-d H:i:s")." / SiteController(811)(actionUservoid)]: ".$msg.PHP_EOL;
			                file_put_contents('logs/log_site_'.$un.'_'.date("Y-m-d").'.txt', $log, FILE_APPEND);
			                // =================================================================================================================================
							$modelsalesitem->delete();
			                // =================================================================================================================================
			                // $msg =  "[{$query}]".mysql_error($this->Conn);
			                $msg =  "[{$un} ({$ip_addrs}) | delete item {$siid}]";
			                $log  = "Scc [".date("Y-m-d H:i:s")." / SiteController(818)(actionUservoid)]: ".$msg.PHP_EOL;
			                file_put_contents('logs/log_site_'.$un.'_'.date("Y-m-d").'.txt', $log, FILE_APPEND);
			                // =================================================================================================================================
						}
						echo "authorized";
					}
				}else{
					echo "unauthorized";
				}
			}else{
				echo "unauthorized";
			}
		}
	}
	
	public function actionSetting(){
	echo "nama saya try setyo utomo";
	$this->render('contact');
	}
	
	public function actionUservoidform(){
		$model = new Users;
		
		$this->renderPartial('user_void',array(
			'model'=>$model,
		));
	} 
	
	public function actionTable(){
		$this->renderPartial('table');
	}
	
	public function actionMenu(){
		$this->render('menu');
	}
	
	public function actionCategoryform(){
		$model = new Items;
		$this->render('/items/create',array(
			'model'=>$model,
		));
	}
	
	

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	
	 
	public function actionIndex()
	{
		// $this->layout = "main";
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
         // echo "haha";
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		// $this->layout = '//layouts/admin';
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			// if($model->validate() && $model->login())
			// 	$this->redirect(Yii::app()->user->returnUrl);
			if($model->validate() && $model->login()){

				$level = Yii::app()->user->getLevel(); 
				if ($level==2 || $level==3 || $level==4 || $level==1)
					$this->redirect(array('sales/index'));
				if ($level==6)
					$this->redirect(array('site/index'));
				if ($level==7)
					$this->redirect(array('site/waiter'));
				if ($level==9)
					$this->redirect(array('site/salon'));
				if ($level==99)
					$this->redirect(array('site/laporanpenjualan'));
			}
		}
		// display the login form
		$this->renderPartial('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}