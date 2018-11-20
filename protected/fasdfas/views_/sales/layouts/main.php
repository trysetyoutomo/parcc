<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

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

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<?php  
$service =  Service::model()->find('status=:st',array(':st'=>1)); 
$service =  $service->service;
?> 
<input type="text" value="<?=$service?>" style="display:none"/>
<script>
    var sale_id;
//    var	 var_service = <?php	$test =  Yii::app()->file->set('service.txt');  echo $test->contents; ?>;
    var	 var_service = <?=$service;?>;
	//alert(var_service);
</script>
<body>
<?php //echo "user id : ".Yii::app()->user->name; ?>
<div id="header">
	<div id="header-in">
		<div class="admin-bar">
            <ul>
                <li><a href="#"><?php echo Yii::app()->user->name; ?></a></li>
<!--                <li><a href="#">Setting</a></li> -->
				<?php if (!Yii::app()->user->isGuest) {?>
                <li><a href="<?php echo $this->createUrl('site/logout'); ?>">Logout</a></li>		
				<?php } else { ?>
                <li><a href="<?php echo $this->createUrl('site/login');?>">Login</a></li>		
				<?php }?>
				<li><a href="<?php echo $this->createUrl('sales/index');?>">Backend</a></li>
            </ul>
		</div>
        <div id="header-logo"></div-->
<!--		<div id="mainmenu">
           
        </div><!-- mainmenu -->
	</div>
</div>
<div id="navigasi">

</div>
<div id="mid-content">
    <div class="container" id="page">
        
        <style>
        element.style {
        width: 100000px;
    }
        </style>

        <div id="pos-content">
            <div class="title-content"><h3>Point Of Sale</h3></div>    
            <?php echo $content; ?>
        </div>
        <div class="clear"></div>
    </div><!-- page -->
</div><!--mid-content-->
<div id="footer">
	<nav>
		<ul><li>F1 = Bayar </li><li> F2 = Pilih Menu </li><li> F3 = Meja</li><li> F7 = Cetak</li>
		</ul>
	</nav>
    <!--Copyright &copy; <?php //echo date('Y'); ?> by My Company.<br/>-->
    <!--All Rights Reserved.<br/>-->
    <?php // echo Yii::powered(); ?>
</div><!-- footer -->
</body>
</html>
