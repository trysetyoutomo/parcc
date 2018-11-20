<?php

class SalesItemsController extends Controller
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
				'actions'=>array('hapus','index','view','update','admin'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','list'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(''),
				'users'=>array(''),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionAdmin()
	{
		$model=new Salesitems('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Salesitems']))
			$model->attributes=$_GET['Salesitems'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}


	public function actionList($page, $limit, $query = NULL) {

        $crit = new CDbCriteria();
		if ($query != NULL) {
$crit->compare('id', $query,true,"or");
$crit->compare('sale_id', $query,true,"or");
$crit->compare('item_id', $query,true,"or");
$crit->compare('quantity_purchased', $query,true,"or");
$crit->compare('item_tax', $query,true,"or");
$crit->compare('item_price', $query,true,"or");
$crit->compare('item_discount', $query,true,"or");
$crit->compare('item_total_cost', $query,true,"or");
		}
        if ($page > 0)
            $page--;

        $model = new CActiveDataProvider('SalesItems',
                        array(
                            'criteria' => $crit,
                            'pagination' => array('pageSize' => $limit, 'currentPage' => $page),
                        )
        );
        $return = array();

        if (!$model == null) {
            $temp = CJSON::encode($model->getData());
            echo '{"success":true,"data":' . $temp . ',"totalCount":' . $model->getTotalItemCount() . '}';
        }
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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new SalesItems;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST))
		{
			$model->attributes=$_POST;
			if($model->save())
				echo '{"success":true}';
			else {
                $temp = CJSON::encode($model->getErrors());
                echo '{"success":false,"msg":' . $temp . '}';
			}
            
		}
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	// public function actionUpdate($id)
	// {
		// $model=$this->loadModel($id);
		// $temp='';

		// // Uncomment the following line if AJAX validation is needed
		// // $this->performAjaxValidation($model);

		// if(isset($_POST))
		// {
			// $model->attributes=$_POST;
			// if($model->save())
				// echo '{"success:true"}';
			// else
			// {
                // $temp = CJSON::encode($model->getErrors());
                // echo '{"success":false,"msg":' . $temp . '}';
            // }
				
		// }
	// }

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['SalesItems']))
		{
			$model->attributes=$_POST['SalesItems'];
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
	public function actionHapus($id)
	{
		// if(Yii::app()->request->isPostRequest)
		// {
			// we only allow deletion via POST request
			// $m = Salesitems::model()->findByPk($id);
			// $model->delete();
			$sale_id = Salesitems::model()->findByPk($id)->sale_id;
			$model=SalesItems::model()->deleteByPk($id);
			// echo 'ahha'.$sale_id;
			$data = Yii::app()->db->createCommand()
			->select('
				sum(((si.item_price*si.quantity_purchased)+(si.item_tax)-(si.item_discount*(si.item_price*si.quantity_purchased)/100))) stt
					')
			->from('sales s, sales_items si')
			->where("s.status=1  and s.id = si.sale_id and s.id = $sale_id ")
			->group("s.id")
			->queryRow();
			// // echo 'test'.$data['stt'];
				$payment = Salespayment::model()->updateByPk($sale_id,array("cash" => $data['stt']));
			// // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
				// // if(!isset($_GET['ajax']))
					// // $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
				$this->redirect(array('sales/index'));
		// }
		// else
			// throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('SalesItems');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=SalesItems::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='sales-items-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
