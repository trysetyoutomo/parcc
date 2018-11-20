<?php
class EWebUser extends CWebUser{
	protected $_model;
	protected $username;
	
	protected function loadUser(){
		// echo "id = ".$this->id;
		if ( $this->_model === null ){
			$this->_model = Users::model()->find('username='."'".$this->id."'");
		}
		return $this->_model;
	}
	
	function getLevel(){
		$user=$this->loadUser();
		if($user){
			return $user->level;
		}else{
			return 100;
		}
	}
	

	
}
?>