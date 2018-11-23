
<style type="text/css">
	#form-auth h1{
		text-align: center;
	}
	#fullscreen{
		width: 100vw;
		height: 100vh;
		background-color: rgba(1,1,1,0.4);
		position: absolute;
		z-index: 999;
		display: none;
	}
	#form-auth{
		width: 300px;
		height: 200px;
		position: absolute;
		background-color: white;
		border:3px solid black;
		z-index: 1000;
		margin: auto;
		top:0px;
		bottom:0px;
		left:0px;
		right:0px;
		padding-left: 10px;
		display: none;
		text-transform: lowercase;
	}
</style>

<div id="fullscreen"></div>
<div id="form-auth">
	<h1>AUTORISASI</h1>
  <?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'auth-form',
		'enableAjaxValidation'=>false,
	        'htmlOptions' => array(
	                'class' => 'mws-form',
            )
	)); ?>
	Username <input type="text" name="username" required>
	<br>
	<br>
	
	Password <input type="password" name="password" required>
	<input id="siid" type="hidden" name="siid">
	<input type="submit" value="Login">

   <?php $this->endWidget(); ?>
</div>