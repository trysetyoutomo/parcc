<?php

class ItemsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='main2';

	/**s
	 * @return array action filters
	 */
	public function filters()
	{
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
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('cari','barcode','index','view','check','delete','carisalon'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('detailpaket','adminpaket','admin','create','createpaket','update','unitprice','itemnumber','category'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	
	
	public function actionCari($query){

		$this->renderPartial('carimenu',
			array(
				'query'=>$query
			));
	}
	public function actionCarisalon($query){

		$this->renderPartial('carimenusalon',
			array(
				'query'=>$query
			));
	}
	public function actionBarcode(){
		// Yii::import('application.extensions.barcode.*');
		// include('Barcode.php');
		$this->renderPartial('barcode');

	}
	public function actionDetailpaket(){
		$id = $_REQUEST['id'];
		$filtersForm=new FiltersForm;
		if (isset($_GET['FiltersForm']))
		$filtersForm->filters=$_GET['FiltersForm'];
		$rawData = Yii::app()->db->createCommand()
		->select('p.id_paket, i.item_name, i.unit_price')
		->from('paket p, items i')
		->where("i.id = p.id_item and id_paket = $id")
		// ->group("p.id_paket")
		->queryAll();
		
		$filteredData=$filtersForm->filter($rawData);
		$dataProvider=new CArrayDataProvider($filteredData);
		$this->render('detailpaket', array(
			'filtersForm' => $filtersForm,
			'model' => $dataProvider,
		));
	}
	 
	public function actionAdminpaket(){
		$filtersForm=new FiltersForm;
		if (isset($_GET['FiltersForm']))
		$filtersForm->filters=$_GET['FiltersForm'];
		// $idh = $_REQUEST['id'];
		$rawData = Yii::app()->db->createCommand()
		->select('p.id_paket, i.item_name, i.unit_price')
		->from('paket p, items i')
		->where("i.id = p.id_paket")
		->group("p.id_paket")
		->queryAll();
		
		$filteredData=$filtersForm->filter($rawData);
		$dataProvider=new CArrayDataProvider($filteredData);
		$this->render('adminpaket', array(
			'filtersForm' => $filtersForm,
			'model' => $dataProvider,
		));
	} 
	 
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
        
        public function actionCheck($id)
        {
            $model = Items::model()->findByPk($id);
//            CJSON::encode($model);
//            print_r($model);
            echo json_encode($model->getAttributes(array('lokasi','id','item_name','item_number','unit_price','tax_percent','total_cost','discount')));
        }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Items;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Items']))
		{
			$model->attributes=$_POST['Items'];
			$model->kode_outlet = 1;
			$model->item_number = 1;
			$model->lokasi = $_POST['Items']['lokasi'];
			if($model->save())
				$this->redirect(array('admin'));
			
			else
				print_r($model->getErrors());
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	
	public function actionCreatepaket()
	{
		// $model=new Items;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		// var_dump( $_REQUEST['paket']['menu'])."<br>";
		if ($_REQUEST["status"]=="ubah"){
			$paket = Paket::model()->findAll("id_paket=:i",array(":i"=>$_REQUEST["id"]));
			$array = array();
			foreach($paket as $d){
				$array[$d->id_item] = array('selected' => true,);
			}
			$namapaket = Items::model()->findByPk($_REQUEST["id"])->item_name;
			// echo "nama".$namapaket;
		}
		if(isset($_REQUEST['menu']))
		{
			$menu =  $_REQUEST['menu'];
			$total =  $_REQUEST['total'];
			$mn_new = preg_split('/,/', $menu, -1, PREG_SPLIT_NO_EMPTY);
			// print_r($mn_new);
			 if (isset($_REQUEST["id"])){
				$nama =  $_REQUEST['nama'];
                $item = $this->loadmodel($_REQUEST["id"]);
				
				// $item = new Items;
			 }else{
				$nama =  $_REQUEST['nama'];
				$item = new Items;
			 }
				
			// echo "isi".$nama;
			$item->item_name = $nama;
			$item->item_number = "99999";
			$item->item_number = "99999";
			$item->category_id = 5;
			$item->description = "paket";
			$item->unit_price = $total;
			$item->tax_percent = 0.1 * $total;
			$item->total_cost = $total;
			$item->discount = 0;
			$item->image = "null";
			$item->status = 1;
			$item->kode_outlet = 26;
			
			Paket::model()->deleteAllByAttributes(array('id_paket' => $_REQUEST["id"]));
			    
			if ($item->save()){
				foreach($mn_new as $d){
					$model = new Paket;
					$model->id_paket = $item->id;
					$model->id_item = $d;
					$model->save();
				}
			}else
				print_r($item->getErrors());
			
			// print_r($char);
			// $model->attributes=$_POST['Items'];
			// if($model->save())
				// $this->redirect(array('admin'));
		}

		$this->render('createpaket',array(
			'namapaket'=>$namapaket,
			'array'=>$array,
		));
	}
        
        public function actionItemnumber(){
		$id = $_GET["id"];
		$id2 = $_GET["id2"];
		//select dari table items where category_id = id
		$lastID = Yii::app()->db->createCommand()
		->select('MAX(item_number)')
		->from('Items')
		->where('category_id = '.$id)
		->queryScalar();

		$number = intval(substr($lastID,-5));
		$newNumber = $number+1;
		
		switch(strlen($newNumber)){
			case 1:$newNumber = $id2.$id."0000".$newNumber;break;
			case 2:$newNumber = $id2.$id."000".$newNumber;break;
			case 3:$newNumber = $id2.$id."00".$newNumber;break;
			case 4:$newNumber = $id2.$id."0".$newNumber;break;
			case 5:$newNumber = $id2.$id.$newNumber;break;
		}
		
		echo $newNumber;
		
		
		// echo CHtml::dropDownList('categories', $category, $data, array('empty' => '(Select a category', 'onChange'=>''));
	}
	
	public function actionUnitprice(){
		$id = $_GET["id"];
		//select dari table items where category_id = id
		$model = Items::model()->findByPk($id);
		// echo CHtml::textField('unitPrice',$model->unit_price);
		echo $model->unit_price;
	}
	
	public function actionCategory(){
		$model = Items::model()->with('categories')->findAll();
		
		$dataProvider=new CActiveDataProvider('Items', array(
			'criteria'=>array(
				// 'condition'=>'status=1',
				// 'order'=>'create_time DESC',
				'with'=>array('categories'),
			),
			'pagination'=>array(
				'pageSize'=>20,
			),
		));
		$this->render('category',array(
			'model'=>$model,
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Items']))
		{
			// echo "<pre>";
			// print_r($_POST['Items']);
			// exit();
			$model->attributes=$_POST['Items'];
			$model->lokasi=$_POST['Items']['lokasi'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model = $this->loadModel($id);
		$model->hapus = 1;
		$model->update();
		

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}
	
	public function actionDeletepaket($id)
	{
		// Paket::model()->($id)->delete();
		$connection = Yii::app()->db;
		$que = "delete from paket id_paket = $id";
		Yii::app()->db->createCommand($que)->execute();
	
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}


	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Items');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$filtersForm=new FiltersForm;
		if (isset($_GET['FiltersForm']))
		$filtersForm->filters=$_GET['FiltersForm'];
		// $idh = $_REQUEST['id'];
		$rawData = Yii::app()->db->createCommand()
		->select('o.nama_outlet nmo,lokasi,i.id, item_name, item_number, description, c.category as category, unit_price')
		->from('items  i, categories as c ,outlet o')
		->where("c.id = i.category_id and i.hapus = 0  and o.kode_outlet = i.kode_outlet")
		->group("i.id")
		->queryAll();
		
		$filteredData=$filtersForm->filter($rawData);
		$dataProvider=new CArrayDataProvider($filteredData);
		$this->render('admin', array(
			'filtersForm' => $filtersForm,
			'model' => $dataProvider,
		));

		

	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Items the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Items::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Items $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='items-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
