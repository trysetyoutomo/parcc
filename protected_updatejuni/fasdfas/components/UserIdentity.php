<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	
	public $username;
	public $password;
	
	public function __construct($username,$password){
		$this->username=$username;
		$this->password=$password;
	}
	
	public function authenticate()
	{

	$users = array();
		// echo $this->username;
		// echo $this->password;
		
	$criteria = new CDbCriteria;
	$criteria->select ='id';
	$criteria->condition ="username='".$this->username."' AND password='".$this->password."'";
	$cek = Users::model()->exists($criteria);
	
	if($cek==1){
		// $this->errorCode=self::ERROR_USERNAME_INVALID
		$users[$this->username] = $this->password;
	}
		

	if(!isset($users[$this->username]))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if($users[$this->username]!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;
		return !$this->errorCode;
	}
}