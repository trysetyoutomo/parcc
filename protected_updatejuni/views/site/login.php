<!-- blueprint CSS framework -->
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
<!--[if lt IE 8]>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
<![endif]-->
<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<?php Yii::app()->getClientScript()->registerCoreScript('jquery.ui'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

<?php
/* @var $this SiteController 	*/
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
// $this->breadcrumbs=array(
	// 'Login',
// );
?>
<style type="text/css">
	.errorMessage{
		display: inline;
	}
	body{
		background-image:url('images/back-red.jpg');
		background-color: cover; 
		font-family: "arial narrow";
	}
	#login{
		width:300px;
		height: 280px;
		background-color: white;
		position: absolute;
		top:-100px;
		left:0;
		right:0;
		bottom:0;
		margin:auto;
		padding: 10px;
		border-radius: 10px;

	}
	#login .logo{
		margin:0 auto;
		width:100px;
		height: auto;
	}
	#login input[type="text"],#login input[type="password"]{
		padding:5px;
	}
	#login input[type="submit"]{
		background-image:url('images/back-red.jpg');
		background-color: cover; 
		color:white;
		border: none;
		padding:5px!important;
	}
</style>

<div id="login">
<center>
	<img class="logo" src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png">
</center>
<div class="form" style="">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
</div>
	<div class="row rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Login'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
</div>