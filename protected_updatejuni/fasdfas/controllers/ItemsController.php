<?php

class ItemsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/admin';

	/**
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
				'actions'=>array('index','view','check','delete'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('admin','create','update','unitprice','itemnumber','category'),
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
            echo json_encode($model->getAttributes(array('id','item_name','item_number','unit_price','tax_percent','total_cost','discount')));
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
			if($model->save())
				$this->redirect(array('admin'));
		}

		$this->render('create',array(
			'model'=>$model,
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
			$model->attributes=$_POST['Items'];
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
		$this->loadModel($id)->delete();

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
		$model=new Items('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Items']))
			$model->attributes=$_GET['Items'];

		$this->render('admin',array(
			'model'=>$model,
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
