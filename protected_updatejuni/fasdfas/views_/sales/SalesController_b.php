<?php

class SalesController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/admin';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'bayar', 'load', 'void','Getsaleid','hanyacetak','cashreport','CetakReport','Pindahmeja','sessid','Uservoid','Cetakrekap','Export','Salesmonthly'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
	
	public function actionSalesmonthly(){
	
		if ($_POST['month']){
			$month = $_POST['month'];
			$year = $_POST['year'];
		}else{
			$month = intval(Date('m'));
			$year = intval(Date('Y'));
		}
		// exit;
		// $month = Date('m');
		$model = new sales;
		
		
		$cabang = Yii::app()->user->id;
		$user = Users::model()->find('username=:un',array(':un'=>$cabang));
		$cabang_id = $user->branch_id;
		
		$tot = Yii::app()->db->createCommand()
			->select('date(s.date) as tgl, 
					s.paidwith_id, 
					s.branch, 
					sum(s.sale_sub_total) as sst, 
					sum(s.sale_discount) as sd, 
					sum(s.sale_service) as service, 
					sum(s.sale_tax) as tax,
					sum(s.sale_total_cost) as stt')
			->from('sales s')
			->where("month(date) =  '$month' and year(date)='$year' and branch='$cabang_id' and status=1")
			->group('date(s.date), s.branch')
			->order('date(s.date) asc, branch')
			->queryAll();
			
			$this->render('monthlysum',array(
				'model'=>$model,
				'tot'=>$tot,
				'month'=>$month,
				'year'=>$year,
			));
		
		
	}
	
	public function actionCashmonthly(){
	
		if ($_POST['month']){
			$month = $_POST['month'];
			$year = $_POST['year'];
		}else{
			$month = intval(Date('m'));
			$year = intval(Date('Y'));
		}
		// exit;
		// $month = Date('m');
		$model = new sales;
		
		
		$cabang = Yii::app()->user->id;
		$user = Users::model()->find('username=:un',array(':un'=>$cabang));
		$cabang_id = $user->branch_id;
		
		$row = Yii::app()->db->createCommand()
		->select('
		sales.date ,
		sum( sales.sale_total_cost ) as total_cost, 
		if( paidwith_id =12,sum( sales.sale_total_cost ),0 ) as compliment,
		if( paidwith_id =1,sum( sales.sale_total_cost ),0 ) as netcash,
		if( paidwith_id =3,sum( sales.sale_total_cost ),0 ) as BCA, 
		if( paidwith_id =4,sum( sales.sale_total_cost ),0 ) as mandiri, 
		if( paidwith_id =5,sum( sales.sale_total_cost ),0 ) as niaga
		
		')
		->from('sales')
		->where('month(date)=:m and year(date)=:y', array(':m' => $month , ':y'=> $year))
		->group('sales.date')
		->queryAll();

			
			$this->render('monthlysum',array(
				'model'=>$model,
				'tot'=>$tot,
				'month'=>$month,
				'year'=>$year,
			));
		
		
	}
	
	public function actionExport(){
		Yii::import('ext.ECSVExport');
		
		$cabang = Yii::app()->user->id;
		$user = Users::model()->find('username=:un',array(':un'=>$cabang));
		$cabang_id = $user->branch_id;
		
		$date = $_GET['tanggal'];
		// $date = '2013-03-14';
		
		$fileDir="C:/Users/Admin/Dropbox/penjualan/";
		$filename = $date."_sales_".$cabang.".csv";
		$file = $fileDir.$filename;
		
		// $tot = Yii::app()->db->createCommand()
			// ->select('date(s.date) as tgl, paidwith_id, s.branch, sum(si.quantity_purchased*si.item_price) as sst, 
					// sum(si.item_discount) as sd, sum(s.sale_service) as service, 
					// sum((si.quantity_purchased*si.item_price)-si.item_discount) as net, sum(si.item_total_cost) as stc, sum(si.item_tax) as tax')
			// ->from('sales s')
			// ->join('sales_items si','si.sale_id=s.id')
			// ->where("date(date) =  '$date' and branch='$cabang_id' and status=1")
			// ->group('paidwith_id, date(s.date), s.branch')
			// ->order('date(s.date) desc, branch')
			// ->queryAll();
			
		$tot = Yii::app()->db->createCommand()
			->select('date(s.date) as tgl, 
					s.paidwith_id, 
					s.branch, 
					sum(s.sale_sub_total) as sst, 
					sum(s.sale_discount) as sd, 
					sum(s.sale_service) as service, 
					sum(s.sale_tax) as tax,
					sum(s.sale_total_cost) as stt')
			->from('sales s')
			->where("date(date) =  '$date' and branch='$cabang_id' and status=1")
			->group('paidwith_id, date(s.date), s.branch')
			->order('date(s.date) desc, branch')
			->queryAll();
			
		$arr = array();
		foreach($tot as $a){
			$field['tanggal'] = $a['tgl'];
			$field['paidwith_id'] = $a['paidwith_id'];
			$field['branch'] = $cabang_id;
			$field['sale_sub_total'] = $a['sst'];
			$field['sale_discount'] = $a['sd'];
			$field['sale_service'] = $a['service'];
			$field['sale_tax'] = $a['tax'];
			$field['net'] = $a['sst']-$a['sd']+$a['service'];
			$field['sale_total_cost'] = $a['sst']-$a['sd']+$a['service']+$a['tax'];
			// $field['sale_total_cost'] = $a['sst']-$a['sd'];
			$arr[] = $field;
		}
		
		// echo "<pre>";
		// print_r($arr);
		// echo "</pre>";
		
		// exit;
		$csv = new ECSVExport($arr);
		// $csv = new ECSVExport(Sales::model()->findAll(
			// "Date(date)='$date' AND status=1"
			// ));
		// $csv->setOutputFile();
		$content = $csv->toCSV($file);
		//Yii::app()->getRequest()->sendFile($filename, $content, "text/csv", false);

		
		$filename2 = $date."_sales_items_".$cabang.".csv";
		$file2 = $fileDir.$filename2;
		
		$q = Yii::app()->db->createCommand()
			->select('si.sale_id, i.item_name, b.branch_name, sum(si.quantity_purchased) as qp, sum(si.item_tax) as it, sum(si.item_price) as ip, sum(si.item_discount) as sid, sum(si.item_total_cost) as itc, date(s.date) as sd')
			->from('sales_items si')
			->join('sales s', 's.id=si.sale_id')
			->join('items i', 'i.id=si.item_id')
			->join('branch b', 'b.id=s.branch')
			->where("date(date) =  '$date' and branch='$cabang_id'")
			->group('date(s.date), branch, i.item_name')
			->order('date(s.date) desc, branch')
			->queryAll();
		
		// $q = SalesItems::model()
				// ->with(array(
					// 'sales'=>array('select'=>'date, branch','together'=>true),
					// 'items'=> array('select'=>'item_name','together'=>true)
					// ))
				// ->findAll("sales.status=1 AND date(sales.date) = '$date'");

		$data = array();
		foreach($q as $val){
			// $result['id'] = $val->id;
			$result['sale_id'] = $val['sale_id'];
			$result['item_id'] = $val['item_id'];
			$result['item_name'] = $val['item_name'];
			$result['quantity_purchased'] = $val['qp'];
			$result['item_tax'] = $val['it'];
			$result['item_price'] = $val['ip'];
			$result['item_discount'] = $val['sid'];
			$result['item_total_cost'] = $val['itc'];
			$result['branch'] = $val['branch_name'];
			$result['date'] = $val['sd'];
			$data[] = $result;
		}
		
		$csv2 = new ECSVExport($data);
		$csv2->toCSV($file2);
		
		exit();
	}
	
	public function actionPindahmeja($meja){
		echo "success : ".$_SESSION['temp_sale_id'];
		
		$id = $_SESSION['temp_sale_id'];
		//update sales
		$model = Sales::model()->findByPk($id);
		$model->table = $meja;
		$model->save();
		// Sales::model()->updateByPk($id, 'table = :meja', array(':meja'=>$meja));
		
		
		$_SESSION['temp_sale_id'] = '';
		unset($_SESSION['temp_sale_id']);
	}
	
	public function actionSessid($id){
		$_SESSION['temp_sale_id'] = $id;
		echo $_SESSION['temp_sale_id'];
	}
	
	public function actionUservoid(){
		if (isset($_POST['Users'])) {
			$un = $_POST['Users']['username'];
			$pass = $_POST['Users']['password'];
			//cari dari database yg usename & passwordnya dikirim
			$user = Users::model()->find("username=:un AND  password=:pass",array(":un"=>$un, ":pass"=>$pass));
			$userLevel = $user['level'];
			//echo "<br>".$username = $user->name;
			if(isset($userLevel)){
				if($userLevel<5){
					//jika userlevel < 5 maka eksekusi void_bayar
					echo "authorized";
				}else{
					echo "unauthorized";
				}
			}else{
				echo "unauthorized";
			}
		}
	}
	
    public function actionVoid() {
        $data = $_GET['data'];


        if (isset($_GET['data'])) {
            $sales = new Sales();
            $sales->customer_id = 1;
            $sales->sale_sub_total = $data['subtotal'] * -1;
            $sales->sale_discount = $data['discount'] * -1;
            $sales->sale_service = $data['service'] * -1;
            $sales->sale_tax = $data['tax'] * -1;
            $sales->sale_total_cost = $data['total_cost'] * -1;
            $sales->sale_payment = $data['payment'] * -1;
            $sales->paidwith_id = $data['paidwith'];
            $sales->total_items = 1;
            $sales->branch = 3;
            $sales->user_id = 1;
            $sales->table = $data['table'];
            $sales->status = $data['status'];
            if ($sales->save()) {

                SalesItems::model()->deleteAllByAttributes(array('sale_id' => $sales->id));
                $data_detail = $_GET['data_detail'];


                foreach ($data_detail as $detail) {
                    $di = new SalesItems();
                    $di->sale_id = $sales->id;
                    $di->item_id = $detail['item_id'];
                    $di->quantity_purchased = $detail['quantity_purchased'] * -1;
                    $di->item_tax = $detail['item_tax'] * -1;
                    $di->item_discount = $detail['item_discount'] * -1;
                    $di->item_price = $detail['item_price'] * -1;
                    $di->item_total_cost = $detail['item_total_cost'] * -1;
                    $di->save();
                }
                echo "success";
            } else {
                print_r($sales->getErrors());
                ;
            }
        }
    }

    public function actionLoad($id) {
        $data = array();
        $sales = Sales::model()->findByPk($id);
        $si = SalesItems::model()->with('items')->findAllByAttributes(array('sale_id' => $id));
        $data['sales'] = $sales;
//        $data['si'] = $si;
        $temps = array();
        foreach ($si as $val) {
            $temp = array();
            $temp['id'] = $val->id;
            $temp['sale_id'] = $val->sale_id;
            $temp['item_id'] = $val->item_id;
            $temp['item_name'] = $val->items->item_name;
            $temp['quantity_purchased'] = $val->quantity_purchased;
            $temp['item_tax'] = $val->item_tax;
            $temp['item_price'] = $val->item_price;
            $temp['item_discount'] = $val->item_discount;
            $temp['item_total_cost'] = $val->item_total_cost;
            $temps[] = $temp;
        }
		$_SESSION['sale_id'] = $id;
        $data['si'] = $temps;
        echo CJSON::encode($data);
    }
	
	public function actionGetsaleid(){
		echo $_SESSION['sale_id'];
		$_SESSION['sale_id'] = "";		
		unset($_SESSION['sale_id']);
	}

    public function actionBayar() {
        $data = $_GET['data'];


        if (isset($_GET['data'])) {

            if (isset($data['sale_id']))
                $sales = $this->load_model($data['sale_id']);
            else
                $sales = new Sales();

            $sales->customer_id = 1;//$data['custype'];
            $sales->sale_sub_total = $data['subtotal'];
            $sales->sale_discount = $data['discount'];
            $sales->sale_service = round($data['service']);
            $sales->sale_tax = round($data['tax']);
            $sales->sale_total_cost = round($data['total_cost']);
            
            if (isset($_data['payment']))   
                $sales->sale_payment = $data['payment'];
            else
                $sales->sale_payment = 0;
                
            $sales->paidwith_id = $data['paidwith'];
            $sales->total_items = 1;
			
			//ambil data dari user yg login
			$username = Yii::app()->user->name;
			$user = Users::model()->find('username=:un',array(':un'=>$username));
			
            $sales->branch = $user->branch_id;
            $sales->user_id = 1;
            $sales->table = $data['table'];
            $sales->status = $data['status'];
            $hit=0;
            if ($sales->save()) {
            $sales->table = $data['table'];
            $sales->status = $data['status'];

                SalesItems::model()->deleteAllByAttributes(array('sale_id' => $sales->id));
                $data_detail = $_GET['data_detail'];


                foreach ($data_detail as $detail) {
                    $di = new SalesItems();
                    $di->sale_id = $sales->id;
                    $di->item_id = $detail['item_id'];
                    $di->quantity_purchased = $detail['quantity_purchased'];
                    $di->item_tax = $detail['item_tax'];
                    $di->item_discount = $detail['item_discount'];
                    $di->item_price = $detail['item_price'];
                    $di->item_total_cost = $detail['item_total_cost'];
                    $di->save();
                    
                    $hit++;
                }
                if ($sales->status==1)
                    $this->cetak($_GET['data'],$_GET['data_detail'],$hit, $sales->id);
                else {
                    $return['sale_id'] = $sales->id;
                    $return['status'] = 0;
                    echo json_encode($return);
                }
                
            }else{
                print_r($sales->getErrors());
            }
        }
    }
    
    private function spasi($banyak, $karakter) {
        $kar = "";
        for ($idx1 = 0; $idx1 < $banyak; $idx1++) {
            $kar = $kar . $karakter;
        }
        return $kar;
    }

    private function spacebar($banyak) {
        $kar = "";
        for ($idx1 = 0; $idx1 < $banyak; $idx1++) {
            $kar = $kar . " ";
        }
        return $kar;
    }

    private function set_spasi($kalimat, $param0, $param1) {
        $penulisan = "";
        if (strlen($kalimat) < $param0) {
            $sisa_spasi = $param0 - strlen($kalimat);
            switch ($param1) {
                case "kanan" :
                    $penulisan = $this->spasi($sisa_spasi, "&nbsp;") . $kalimat;
                    break;
                case "tengah" :
                    $penulisan = $this->spasi(round($sisa_spasi / 2), "&nbsp;") . $kalimat;
                    break;
            }
        }
        return $penulisan;
    }

    private function set_spacebar($kalimat, $param0, $param1) {
        $penulisan = "";
        if (strlen($kalimat) < $param0) {
            $sisa_spasi = $param0 - strlen($kalimat);
            switch ($param1) {
                case "kanan" :
                    $penulisan = $this->spasi($sisa_spasi, " ") . $kalimat;
                    break;
                case "tengah" :
                    $penulisan = $this->spasi(round($sisa_spasi / 2), " ") . $kalimat;
                    break;
            }
        }
        return $penulisan;
    }

    private function cetak($data,$detail,$hit, $id) {
// echo "<pre>";
       // print_r($detail);
// echo "</pre>";
	   // echo $detail[0]['item_id'];
        // exit;
        $model = Sales::model()->findByPk($id);

        $total_margin = 40;
        $pembatas = 10;
        // $myFile = "c:\\epson\\cetakbarujual.txt";
        // $fh = fopen($myFile, 'w') or die("can't open file");
        $temp_data = array();
        
        $temp_data['logo'] = $this->set_spacebar("Pak Chi Met", $total_margin, "tengah");
        $temp_data['sale_id'] = $id;
        $temp_data['status'] = 1;
		$temp_data['alamat'] = $this->set_spacebar("Festival Citylink Jl.Peta no. 241, Bdg", $total_margin, "tengah");
        $temp_data['hit'] = $hit;
        $temp_data['id'] = $id;
        $temp_data['no_telp'] = $this->set_spacebar("Telp. (022)61483055", $total_margin, "tengah");
        // $kota = set_spacebar ("Bandung", $total_margin, "tengah");
        // $temp_data['no_telp'] = $this->set_spacebar("Telp. (022)6042148/6042147", $total_margin, "tengah");
        $temp_data['no_nota'] = $this->set_spacebar("No Nota : " . $id, $total_margin, "tengah");
        $temp_data['trx_tgl'] = $this->set_spacebar(date('d M Y', strtotime($model['date'])), $total_margin, "tengah");

        $pjg_ket = $total_margin - 13;
        // fwrite($fh, "" . "\r \n");
        // fwrite($fh, "Meja   : " . $this->set_spacebar($model['table'], $pjg_ket, "tengah") . "\r\n");
//		fwrite($fh, ""."\r\n");
        $temp_data['no_meja'] = "Meja   : " . $this->set_spacebar($model['table'], $pjg_ket, "tengah") . "\r";
        $temp_data['pembatas'] = $this->spasi($total_margin, "-");
		//$detail = $detail;
     //   $hit = count($data_detail['quantity_purchased']);
		$temp2 = array();
		
			$z=0;
		
		asort($detail);
		foreach ($detail as $val_det) {
			$detail2[$z] = $val_det; 
			$z++;
		}
		
		
        for ($a = 0; $a < $hit; $a++) {
            $nama_item = Items::model()->find("id=:id", array(':id' => $detail2[$a]['item_id']));
            
			$panjang1 = strlen($nama_item['item_name']);
            $panjang2 = strlen(number_format($detail2[$a]['item_total_cost']));
			$panjang3 = strlen($tot_qty) + strlen($detail2[$a]['quantity_purchased']) + strlen($detail2[$a]['item_price']) + strlen($detail2[$a]['item_discount']) + strlen("% disc")+5;
			
            $banyakspasi = $total_margin - $panjang3 - $panjang2;
			$temp = array();
			//------begin-----
			//cek apakah ID yg sedang di proses sama dengan ID yg sebelumnya masuk ke dalam array
				if($detail2[$a]['item_id']==$detail2[$a-1]['item_id']){
					$panjang3 = strlen($tot_qty) + strlen($detail2[$a]['item_price']) + strlen($detail2[$a]['item_discount']) + strlen("% disc")+6;
					$banyakspasi = $total_margin - $panjang3 - $panjang2;
					
					$curr_price = $detail2[$a]['quantity_purchased']*$detail2[$a]['item_price'];
					$last_price += $detail2[$a-1]['quantity_purchased']*$detail2[$a-1]['item_price'];
					$tot_price = $curr_price+$last_price;
					
					$qty_last += $detail2[$a-1]['quantity_purchased'];
					$tot_qty = $qty_last+$detail2[$a]['quantity_purchased'];
					
					$temp['nama_item'] = $nama_item['item_name'];
					$temp['quantity'] = $tot_qty . " x " . $detail2[$a]['item_price'] . " - " . $detail2[$a]['item_discount'] . "% disc". " " . $this->spacebar($banyakspasi - 1) . number_format($tot_price);
					//hapus nilai array yg sebelumnya agar tidak ada item name double
					unset($temp2[$a-1]);
					
				}else{
					$panjang3 = strlen($detail2[$a]['quantity_purchased']) + strlen($detail2[$a]['item_price']) + strlen($detail2[$a]['item_discount']) + strlen("% disc")+6;
					$banyakspasi = $total_margin - $panjang3 - $panjang2;
					
					$last_price = $tot_price = $tot_qty = $qty_last = 0;
					// $temp['nama_item'] = $nama_item['item_name'] . " " . $this->spacebar($banyakspasi - 1) . number_format($detail2[$a]['quantity_purchased']*$detail2[$a]['item_price']);
					$temp['nama_item'] = $nama_item['item_name'];
					$temp['quantity'] = $detail2[$a]['quantity_purchased'] . " x " . $detail2[$a]['item_price'] . " - " . $detail2[$a]['item_discount'] . "% disc" . " " . $this->spacebar($banyakspasi - 1) . number_format($detail2[$a]['quantity_purchased']*$detail2[$a]['item_price']);
				}
			//------end------
			
			$baris2 = $nama_item['item_name'] . " " . $this->spasi($banyakspasi, "&nbsp;") . number_format($detail2[$a]['item_total_cost']);
            $data['baris2a'] = $nama_item['item_name'] . " " . $this->spacebar($banyakspasi - 1) . number_format($detail2[$a]['item_total_cost']);

			$temp2[] = $temp;        }
		$temp_data['detail'] = $temp2;

        // fwrite($fh, $pembatas . "\r \n");
        $subtotal = number_format($data['subtotal']);
        $discount = number_format($data['discount']);
        // $sblmpajak = number_format(300000);
        $pajak = number_format($data['tax']);
        $service = number_format($data['service']);
        $total = number_format($data['total_cost']);
        $bayar = number_format($data['payment']); //number_format($_GET['Sales']['payment']);
        $kembali = number_format($data['payment'] - $data['total_cost']); //number_format($_GET['Sales']['payment']-$_GET['Sales']['sale_total_cost']);
        $pjg_ket = $total_margin - 13;


        // fwrite($fh, "SubTotal   : " . $this->set_spacebar($subtotal, $pjg_ket, "kanan") . "\r\n");
        $temp_data['subtotal'] = "SubTotal   : " . $this->set_spacebar($subtotal, $pjg_ket, "kanan") . "\r\n";
        // fwrite($fh, "Discount   : " . $this->set_spacebar($discount, $pjg_ket, "kanan") . "\r\n");
        $temp_data['discount'] = "Discount   : " . $this->set_spacebar($discount, $pjg_ket, "kanan") . "\r\n";
        // fwrite($fh, "Service 5% : " . $this->set_spacebar($sblmpajak, $pjg_ket, "kanan") . "\r\n");
        // fwrite($fh, "Ppn 10%    : " . $this->set_spacebar($pajak, $pjg_ket, "kanan") . "\r\n");
        $temp_data['ppn'] = "Ppn 10%    : " . $this->set_spacebar($pajak, $pjg_ket, "kanan") . "\r\n";
        $temp_data['service'] = "srvc 2.5%  : " . $this->set_spacebar($service, $pjg_ket, "kanan") . "\r\n";
        // fwrite($fh, $pembatas . "\r\n");
        $temp_data['pembatas2'] = $pembatas . "\r\n";
        // fwrite($fh, "Total      : " . $this->set_spacebar($total, $pjg_ket, "kanan") . "\r\n");
        $temp_data['total'] = "Total      : " . $this->set_spacebar($total, $pjg_ket, "kanan") . "\r\n";
        // fwrite($fh, "Bayar      : " . $this->set_spacebar($bayar, $pjg_ket, "kanan") . "\r\n");
        $temp_data['bayar'] = "Bayar      : " . $this->set_spacebar($bayar, $pjg_ket, "kanan") . "\r\n";
        // fwrite($fh, "Kembali    : " . $this->set_spacebar($kembali, $pjg_ket, "kanan") . "\r\n");
        $temp_data['kembali'] = "Kembali    : " . $this->set_spacebar($kembali, $pjg_ket, "kanan") . "\r\n";
        // fwrite($fh, "" . "\r\n");
        $temp_data['line_bawah'] = "" . "\r\n";

        // fwrite($fh, $this->set_spacebar("Jagonya Ikan Bakar", $total_margin, "tengah") . "\r\n");
        $temp_data['slogan'] = $this->set_spacebar("Jagonya Ikan Bakar", $total_margin, "tengah") . "\r\n";
        // fwrite($fh, $this->set_spacebar("(c) Pak Chi Met - 2012", $total_margin, "tengah") . "\r\n");
        $temp_data['pcm'] = $this->set_spacebar("(c) Pak Chi Met - 2013", $total_margin, "tengah") . "\r\n";
        // fclose($fh);
        echo json_encode($temp_data);
		// echo "<pre>";
			// print_r($temp_data);
		// echo "</pre>";
    }
	
	public function actionCetakReport(){
		$saleid = Sales::model()->findByPk($_GET['id']);
		$arr_sales = array();
		$arr_detail = array();
		
		$arr_sales['subtotal'] = $saleid->sale_sub_total;
		$arr_sales['discount'] = $saleid->sale_discount;
		$arr_sales['tax'] = $saleid->sale_tax;
		$arr_sales['service'] = $saleid->sale_service;
		$arr_sales['total_cost'] = $saleid->sale_total_cost;
		$arr_sales['payment'] = $saleid->sale_payment;
		
		$hit = 0;
		$itemdata = SalesItems::model()->findAll('sale_id=:id',array(':id'=>$_GET['id']));
		foreach($itemdata as $row){
			// echo '<br>'.$row['id'];
			$arr_detail[$hit]['item_id']=$row['item_id'];
			$arr_detail[$hit]['quantity_purchased']=$row['quantity_purchased'];
			$arr_detail[$hit]['item_tax']=$row['item_tax'];
			$arr_detail[$hit]['item_price']=$row['item_price'];
			$arr_detail[$hit]['item_total_cost']=$row['item_total_cost'];
			$hit++;
		}
		// echo '<pre>';
		// print_r($arr_detail);
		// echo '</pre>';
		// echo $hit;
		
		$this->cetak($arr_sales,$arr_detail,$hit, $_GET['id']);
		// print_r($rowid);
	}
	
	public function actionHanyacetak(){
	   // echo $detail[0]['item_id'];
        // exit;
		
        // $model = Sales::model()->findByPk($id);
        $pembatas = 20;
		$model = $_GET['data'];
		$detail = $_GET['data_detail'];
// echo "<pre>";
       // print_r($detail);
// echo "</pre>";
		
        $total_margin = 40;

        $myFile = "c:\\epson\\cetakbarujual.txt";
        $fh = fopen($myFile, 'w') or die("can't open file");
        $temp_data = array();
        $temp_data['logo'] = $this->set_spacebar("Pak Chi Met", $total_margin, "tengah");
        // $temp_data['sale_id'] = $id;
        $temp_data['alamat'] = $this->set_spacebar("Festival Citylink Jl.Peta no. 241, Bdg", $total_margin, "tengah");
		
        // $temp_data['hit'] = $hit;
        // $temp_data['id'] = $id;
        // $kota = set_spacebar ("Bandung", $total_margin, "tengah");
		$temp_data['no_telp'] = $this->set_spacebar("Telp. (022)61483055", $total_margin, "tengah");
        $temp_data['no_nota'] = $this->set_spacebar("No Nota : Belum Bayar", "", "tengah");
        $temp_data['trx_tgl'] = $this->set_spacebar(date('d M Y'), $total_margin, "tengah");

        $pjg_ket = $total_margin - 13;
        fwrite($fh, "" . "\r \n");
        fwrite($fh, "Meja   : " . $this->set_spacebar($model['table'], $pjg_ket, "tengah") . "\r\n");
//		fwrite($fh, ""."\r\n");
        $temp_data['no_meja'] = "Meja   : " . $this->set_spacebar($model['table'], $pjg_ket, "tengah") . "\r";
        $temp_data['pembatas'] = $this->spasi($total_margin, "-");
		//$detail = $detail;
     //   $hit = count($data_detail['quantity_purchased']);
		$temp2 = array();
                $subtotal = 0;
				
					//------begin-----
		//untuk mengurutkan data array secara ascending berdasarkan ID
		$z=0;
		
		asort($detail);
		foreach ($detail as $val_det) {
			$detail2[$z] = $val_det; 
			$z++;
		}
		//------end------		
				
      for ($a = 0; $a < count($detail); $a++) {
            $nama_item = Items::model()->find("id=:id", array(':id' => $detail2[$a]['item_id']));
            
			$panjang1 = strlen($nama_item['item_name']);
            $panjang2 = strlen(number_format($detail2[$a]['item_total_cost']));
			$temp = array();
			//------begin-----
			//cek apakah ID yg sedang di proses sama dengan ID yg sebelumnya masuk ke dalam array
				if($detail2[$a]['item_id']==$detail2[$a-1]['item_id']){
					$panjang3 = strlen($tot_qty) + strlen($detail2[$a]['item_price']) + strlen($detail2[$a]['item_discount']) + strlen("% disc")+6;
					$banyakspasi = $total_margin - $panjang3 - $panjang2;
					
					$curr_price = $detail2[$a]['quantity_purchased']*$detail2[$a]['item_price'];
					$last_price += $detail2[$a-1]['quantity_purchased']*$detail2[$a-1]['item_price'];
					$tot_price = $curr_price+$last_price;
					
					$qty_last += $detail2[$a-1]['quantity_purchased'];
					$tot_qty = $qty_last+$detail2[$a]['quantity_purchased'];
					
					$temp['nama_item'] = $nama_item['item_name'];
					$temp['quantity'] = $tot_qty . " x " . $detail2[$a]['item_price'] . " - " . $detail2[$a]['item_discount'] . "% disc". " " . $this->spacebar($banyakspasi - 1) . number_format($tot_price);
					//hapus nilai array yg sebelumnya agar tidak ada item name double
					unset($temp2[$a-1]);
					
				}else{
					$panjang3 = strlen($detail2[$a]['quantity_purchased']) + strlen($detail2[$a]['item_price']) + strlen($detail2[$a]['item_discount']) + strlen("% disc")+6;
					$banyakspasi = $total_margin - $panjang3 - $panjang2;
					
					$last_price = $tot_price = $tot_qty = $qty_last = 0;
					// $temp['nama_item'] = $nama_item['item_name'] . " " . $this->spacebar($banyakspasi - 1) . number_format($detail2[$a]['quantity_purchased']*$detail2[$a]['item_price']);
					$temp['nama_item'] = $nama_item['item_name'];
					$temp['quantity'] = $detail2[$a]['quantity_purchased'] . " x " . $detail2[$a]['item_price'] . " - " . $detail2[$a]['item_discount'] . "% disc" . " " . $this->spacebar($banyakspasi - 1) . number_format($detail2[$a]['quantity_purchased']*$detail2[$a]['item_price']);
				}
			//------end------
			
			$baris2 = $nama_item['item_name'] . " " . $this->spasi($banyakspasi, "&nbsp;") . number_format($detail2[$a]['item_total_cost']);
            $data['baris2a'] = $nama_item['item_name'] . " " . $this->spacebar($banyakspasi - 1) . number_format($detail2[$a]['item_total_cost']);

			$temp2[] = $temp;        }
		$temp_data['detail'] = $temp2;

        fwrite($fh, $pembatas . "\r \n");
        $subtotal = number_format($model['subtotal']);
        $discount = number_format($model['discount']);
        $service = number_format($model['service']);
        // $sblmpajak = number_format(300000);
        $pajak = number_format($model['tax']);
        $total = number_format($model['total_cost']);
        
        $bayar = "";
        $kembali = ""; //number_format($_GET['Sales']['payment']-$_GET['Sales']['sale_total_cost']);
        $pjg_ket = $total_margin - 13;


        // fwrite($fh, "SubTotal   : " . $this->set_spacebar($subtotal, $pjg_ket, "kanan") . "\r\n");
        $temp_data['subtotal'] = "SubTotal   : " . $this->set_spacebar($subtotal, $pjg_ket, "kanan") . "\r\n";
        // fwrite($fh, "Discount   : " . $this->set_spacebar($discount, $pjg_ket, "kanan") . "\r\n");
        $temp_data['discount'] = "Discount   : " . $this->set_spacebar($discount, $pjg_ket, "kanan") . "\r\n";
        $temp_data['service'] = "Srvc 2.5%  : " . $this->set_spacebar($service, $pjg_ket, "kanan") . "\r\n";
        // fwrite($fh, "Service 5% : " . $this->set_spacebar($sblmpajak, $pjg_ket, "kanan") . "\r\n");
        // fwrite($fh, "Ppn 10%    : " . $this->set_spacebar($pajak, $pjg_ket, "kanan") . "\r\n");
        $temp_data['ppn'] = "Ppn 10%    : " . $this->set_spacebar($pajak, $pjg_ket, "kanan") . "\r\n";
        // fwrite($fh, $pembatas . "\r\n");
        $temp_data['pembatas2'] = $pembatas . "\r\n";
        // fwrite($fh, "Total      : " . $this->set_spacebar($total, $pjg_ket, "kanan") . "\r\n");
        $temp_data['total'] = "Total      : " . $this->set_spacebar($total, $pjg_ket, "kanan") . "\r\n";
        // fwrite($fh, "Bayar      : " . $this->set_spacebar($bayar, $pjg_ket, "kanan") . "\r\n");
        $temp_data['bayar'] = "Bayar      : " . $this->set_spacebar($bayar, $pjg_ket, "kanan") . "\r\n";
        // fwrite($fh, "Kembali    : " . $this->set_spacebar($kembali, $pjg_ket, "kanan") . "\r\n");
        $temp_data['kembali'] = "Kembali    : " . $this->set_spacebar($kembali, $pjg_ket, "kanan") . "\r\n";
        // fwrite($fh, "" . "\r\n");
        $temp_data['line_bawah'] = "" . "\r\n";

        // fwrite($fh, $this->set_spacebar("Jagonya Ikan Bakar", $total_margin, "tengah") . "\r\n");
        $temp_data['slogan'] = $this->set_spacebar("Jagonya Ikan Bakar", $total_margin, "tengah") . "\r\n";
        // fwrite($fh, $this->set_spacebar("(c) Pak Chi Met - 2012", $total_margin, "tengah") . "\r\n");
        $temp_data['pcm'] = $this->set_spacebar("(c) Pak Chi Met - 2013", $total_margin, "tengah") . "\r\n";
        // fclose($fh);
        echo json_encode($temp_data);
		// echo "<pre>";
			// print_r($temp_data);
		// echo "</pre>";
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Sales;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Sales'])) {
            $model->attributes = $_POST['Sales'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Sales'])) {
            $model->attributes = $_POST['Sales'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
	 
	public function actionCashReport(){
					

		if (isset($_GET['Sales']['date'])) {
			$row = Yii::app()->db->createCommand()
					->select('sales.date ,sum( sales.sale_total_cost ) as total_cost, if( paidwith_id =12,sum( sales.sale_total_cost ),0 ) as compliment,if( paidwith_id =1,sum( sales.sale_total_cost ),0 ) as netcash,if( paidwith_id =3,sum( sales.sale_total_cost ),0 ) as BCA, if( paidwith_id =4,sum( sales.sale_total_cost ),0 ) as mandiri, if( paidwith_id =5,sum( sales.sale_total_cost ),0 ) as niaga')
					->from('sales')
					->where('date(date)=:date', array(':date' => $_GET['Sales']['date']))
					->group('sales.date')
					->queryAll();
					
			$summary = Yii::app()->db->createCommand()
					->select(' sales.date ,sum( sales.sale_total_cost ) as total_cost, sum( if( paidwith_id =12,sales.sale_total_cost ,0 )) as compliment,sum( if( paidwith_id =1,sales.sale_total_cost ,0 )) as netcash,sum( if( paidwith_id =3,sales.sale_total_cost ,0 )) as BCA, sum( if( paidwith_id =4,sales.sale_total_cost ,0 )) as mandiri, sum( if( paidwith_id =5,sales.sale_total_cost ,0 )) as niaga')
					->from('sales')
					->where('date(date)=:date', array(':date' => $_GET['Sales']['date']))
					->queryRow();
		}else{
			$row = Yii::app()->db->createCommand()
					->select('sales.id, sales.date ,sum( sales.sale_total_cost ) as total_cost, if( paidwith_id =12,sum( sales.sale_total_cost ),0 ) as compliment, if( paidwith_id =1,sum( sales.sale_total_cost ),0 ) as netcash,if( paidwith_id =3,sum( sales.sale_total_cost ),0 ) as BCA, if( paidwith_id =4,sum( sales.sale_total_cost ),0 ) as mandiri, if( paidwith_id =5,sum( sales.sale_total_cost ),0 ) as niaga')
					->from('sales')
					->where('date(date)=:date', array(':date' => date('Y-m-d')))
					->group('sales.date')
					->queryAll();
			
			$summary = Yii::app()->db->createCommand()
					->select(' sales.date ,sum( sales.sale_total_cost ) as total_cost, sum( if( paidwith_id =12,sales.sale_total_cost ,0 )) as compliment,sum( if( paidwith_id =1,sales.sale_total_cost ,0 )) as netcash,sum( if( paidwith_id =3,sales.sale_total_cost ,0 )) as BCA, sum( if( paidwith_id =4,sales.sale_total_cost ,0 )) as mandiri, sum( if( paidwith_id =5,sales.sale_total_cost ,0 )) as niaga')
					->from('sales')
					->where('date(date)=:date', array(':date' => date('Y-m-d')))
					->queryRow();
		}		
		
		$tgl = $_GET['Sales']['date'];
		if(empty($_GET['Sales']['date'])){
			$tgl = date('Y-m-d');
		}
		
		$cash = new CArrayDataProvider($row);//dikonfersi ke CArrayDataProvider
		$this->render('cash', array(
			'datacash' => $cash,
			'cashsum' => $summary,
			'tgl' => $tgl,
		));
	}
	 
    public function actionIndex() {
        // $dataProvider=new CActiveDataProvider('Sales');
		// echo "<pre>";
		// print_r($summary);
		// echo "</pre>"; 
        
        if (isset($_GET['Sales']['date'])) {
			//echo $_GET['Sales']['date'];
			//get yii user
			$username = Yii::app()->user->name;
			$user = Users::model()->find('username=:un',array(':un'=>$username));
			$user->id;
			
			$data = new Sales;
			$date = addcslashes($_GET['Sales']['date'], '%_');
			
            $data->date = $_GET['Sales']['date'];
            // $dataProvider = $data->search();
			
			$dataProvider=new CActiveDataProvider('Sales', array(
						'criteria'=>array(
							'condition'=>'date(date) = :date and status = :stat and branch=:branch',
							'params'=>array(':date'=>"$date", "stat"=>1, ":branch"=>$user->branch_id),
						),
						'pagination'=>array(
							'pageSize'=>100,
						),
					));
			
//			echo "dani";
            $summary = Yii::app()->db->createCommand()
                    ->select('sum(sale_total_cost) stc, sum(sale_discount) sd , sum(sale_sub_total) sst, sum(sale_tax) t, sum(sale_service) svc')
                    ->from('sales u')
                    ->where('date(date)=:date AND status=:status and branch=:branch', array(':date' => $_GET['Sales']['date'], ':status' => 1, ":branch"=>$user->branch_id))
                    // ->where('date(date)=:date AND status=:status', array(':date' => $_GET['Sales']['date'], ':status' => 1))
                    // ->where("date='".$_GET['Sales']['date']."'")
                    ->queryRow();
        } else {
			$summary = Yii::app()->db->createCommand()
                ->select('sum(sale_total_cost) stc, sum(sale_discount) sd , sum(sale_sub_total) sst, sum(sale_tax) t, sum(sale_service) svc')
                ->from('sales u')
                ->where('date(date)=:date AND status=:status and branch=:branch', array(':date' => date('Y-m-d'), ':status' => 1, ":branch"=>$user->branch_id))
                ->queryRow();
				
            $dataProvider=new CActiveDataProvider('Sales', array(
						'criteria'=>array(
							'condition'=>'date(date) = :date and status = :stat and branch=:branch',
							'params'=>array(':date'=>date('Y-m-d'), "stat"=>1, ":branch"=>$user->branch_id),
						),
						'pagination'=>array(
							'pageSize'=>20,
						),
					));
            // $dataProvider = $data->search();
        }
		
		$tgl = $_GET['Sales']['date'];
		if(empty($_GET['Sales']['date'])){
			$tgl = date('Y-m-d');
		}
		
        $model = new Sales;
        // $dataProvider = $data->search();
        $this->render('index', array(
            'dataProvider' => $dataProvider,
            'summary' => $summary,
			'tgl' => $tgl,
			// 'model'=>$model,
        ));
    }

	public function actionCetakrekap(){
		$date = $_GET['tanggal_rekap'];
		
		$data1 = Yii::app()->db->createCommand()
		->select('SUM( sales_items.quantity_purchased ) as qty, sum( sales_items.item_total_cost ) as cost, sum( sales_items.item_discount ) as tot_disc, sum(sales_items.item_tax) as tax')
		->from('sales_items')
		->join('sales', 'sales.id=sales_items.sale_id')
		->where("date(date) = '".$date."'")
		->queryAll();
	
		$data = Yii::app()->db->createCommand()
		->select('categories.category category,items.item_name item_name,sales_items.item_price * sum(quantity_purchased) price,sum(quantity_purchased) qp')
		->from('sales_items')
		->join('sales', 'sales.id=sales_items.sale_id')
		->join('items', 'items.id=sales_items.item_id')
		->join('categories', 'categories.id = items.category_id')
		// ->where('date(date=:date)', array(':date'=>date('2013-03-05')))
		->where("date(date) = '".$date."'")
		->group('item_id')
		->order('categories.category')
		->queryAll();
		
		
		$pembatas = 20;
		$model = $_GET['data'];
		$detail = $_GET['data_detail'];
		
        $total_margin = 40;

        // $myFile = "c:\\epson\\cetakbarujual.txt";
        $temp_data = array();
        $temp_data['logo'] = $this->set_spacebar("Pak Chi Met", $total_margin, "tengah");
        $temp_data['alamat'] = $this->set_spacebar("Festival Citylink Jl.Peta no. 241, Bdg", $total_margin, "tengah");
        $temp_data['no_telp'] = $this->set_spacebar("Telp. (022)61483055", $total_margin, "tengah");
        // $temp_data['no_nota'] = $this->set_spacebar("No Nota : Belum Bayar", "", "tengah");
        $temp_data['trx_tgl'] = $this->set_spacebar(date('d M Y'), $total_margin, "tengah");

        $pjg_ket = $total_margin - 13;
        // $temp_data['no_meja'] = "Meja   : " . $this->set_spacebar($model['table'], $pjg_ket, "tengah") . "\r";
        $temp_data['pembatas'] = $this->spasi($total_margin, "-");

		$tmp = array();
		foreach($data1 as $dt1){
			//gross sales
			$net_sales = $dt1['cost'] - $dt1['tot_disc']-$dt1['tax'];
			$tmp['gross'] = "Gross Sales\tDisc\tNet Sales";
			$tmp['grossvalue'] = "\r\n".number_format($dt1['cost'])."\t".number_format($dt1['tot_disc'])."\t".number_format($net_sales)."\r\n";
			$tmp2 = $tmp;
		}
		$temp_data['detail'] = $tmp2;
		
		$pjg_ket = $total_margin - 20;
				
		$jml_item = 18;
		
		//for($c=0;$c<$jml_item;$c++)
		$temp = array();
		foreach ($data as $rows)
		{
			// $ctgr = "";
			// echo $rows['category']." - ".$ctgr."<BR>";
			
			if($rows['category']!=$ctgr){
				$ctgr = $rows['category'];
				$wCtgr = "DEPT: ".strtoupper($rows['category'])."\r\n";
				$tmp4['dept'] = $wCtgr;
				$tmp4['pembatas'] = $this->spasi($total_margin, "-");
			}else{
				$tmp4['dept'] = "";
				$tmp4['pembatas'] = "";
			}
			$tmp3 = $tmp4;
			$tmp4 = array();
			$table = "- ".strtoupper($rows['item_name']). "\r\n";
			$table .= "\t ".strtoupper($rows['qp'])." Item ".$this->set_spacebar(number_format($rows['price']),$pjg_ket, "kanan"). "\r\n";
			
			$totalItems += $rows['qp'];
			$totalPrice += $rows['price'];
			
			$tmp3['table'] = $table;
			$temp[] = $tmp3;
		}
		
		$temp_data['detail2'] = $temp;
		
		$temp_data['pembatas'] = $this->spasi($total_margin, "-");
		
		
		$temp_data['total'] = "\t ".$totalItems." ITEMS\t\t ".number_format($totalPrice)."\r\n";
		$temp_data['footer'] = $this->set_spacebar("Jagonya Ikan Bakar", $total_margin, "tengah") . "\r\n";
		$temp_data['footer2'] =  $this->set_spacebar("(c) Pak Chi Met - 2012", $total_margin, "tengah") . "\r\n";
		
		
		echo json_encode($temp_data);
		// echo "<pre>";
		// print_r($temp_data);
		// echo "</pre>";
		
		
	}
	
	public function actionPrintrekap(){
	
		// $pembatas = 20;
		// // $model = $_GET['data'];
		// $detail = $_GET['data_detail'];
		// $hit = 2;
		
        // $total_margin = 40;

        // for ($a = 0; $a < count($detail); $a++) {
            // $nama_item = Items::model()->find("id=:id", array(':id' => $detail[$a]['item_id']));
            
			// $panjang1 = strlen($nama_item['item_name']);
            // $panjang2 = strlen(number_format($detail[$a]['item_total_cost']));
            // $banyakspasi = $total_margin - $panjang1 - $panjang2;
			
			// $temp = array();
            // $temp['quantity'] = $detail[$a]['quantity_purchased'] . " x " . $detail[$a]['item_price'] . " - " . $detail[$a]['item_discount'] . "% disc";
            // // fwrite($fh, $baris1 . "\r\n");
			// $temp['nama_item'] = $nama_item['item_name'] . " " . $this->spacebar($banyakspasi - 1) . number_format($detail[$a]['item_total_cost']);

            // // echo "---->".$banyakspasi."=".$total_margin."-".$panjang1."-".$panjang2."<BR>";
            // $baris2 = $nama_item['item_name'] . " " . $this->spasi($banyakspasi, "&nbsp;") . number_format($detail[$a]['item_total_cost']);
            // $data['baris2a'] = $nama_item['item_name'] . " " . $this->spacebar($banyakspasi - 1) . number_format($detail[$a]['item_total_cost']);

          // //  $subtotal += $detail[$a]['item_total_cost'];
			// $temp2[] = $temp;
        // }
		// $temp_data['detail'] = $temp2;
        // echo json_encode($temp_data);
	}
	
    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Sales('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Sales']))
            $model->attributes = $_GET['Sales'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Sales the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Sales::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function load_model($id) {
        $model = Sales::model()->findByPk($id);
        if ($model === null)
            return new Sales();
        else
            return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Sales $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'sales-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
