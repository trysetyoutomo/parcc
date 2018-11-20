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
				'actions'=>array('cekpassword','gabungmeja','reloadoptionmeja','reloadMeja','updatetable','getmenutable','waiterkirim','login','logout','setting','hutang'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','table','waiter'),
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
	
	public function actionGabungmeja($mjl,$mjb){
		$id_sales_lama = Sales::model()->find("t.table = '$mjl' and status = 0")->id;
		$id_sales_baru = Sales::model()->find("t.table = '$mjb' and status = 0")->id;
		$sales_lamaitems = SalesItems::model()->findAll("sale_id = '$id_sales_lama' ");
		foreach ($sales_lamaitems as $sli) {
			$sli->sale_id = $id_sales_baru;
			$sli->update();
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
	public function actionWaiterkirim(){
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
			$modelh->status = 0;
			$modelh->waiter = Yii::app()->user->id;
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

					$model->quantity_purchased = $n['jml'];
					$model->item_tax = $items->unit_price*$pajak ;
					$model->item_service = $items->unit_price*$service ;
					$model->item_price = $items->unit_price;
					$model->item_discount = 0;
					$model->cetak = 1;
					$model->item_total_cost = $items->unit_price * $n['jml'] ;
					$model->permintaan = $n['permintaan'];
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