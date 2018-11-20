<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	
	protected function afterAction($action){
		$c =  Yii::app()->controller->id;
 		$a =  Yii::app()->controller->action->id;
 		$id = Yii::app()->user->id;
 		if ($a != "reloadmeja") {
			$m = new LogAktivitas;
			$m->username = $id;
			$m->controller = $c;
			$m->action = $a;
			$m->tanggal_akses = date("Y-m-d h:i:s");
			$m->save();
 		}
	}
	
}