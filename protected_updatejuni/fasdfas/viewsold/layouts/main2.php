<?php /* @var $this Controller */ ?>
<style type="text/css">
/*#page{
	background:#fff;
}*/
</style>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />

        <!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
        <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>


        <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
        <![endif]-->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
        <?php //Yii::app()->clientScript->registerCoreScript('jquery'); ?>
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    </head>

    <body>


        <!-- page specific -->
        <style type="text/css">
            /* styles for iconCls */
            .x-icon-tickets {
                background-image: url('images/tickets.png');
            }
            .x-icon-subscriptions {
                background-image: url('images/subscriptions.png');
            }
            .x-icon-users {
                background-image: url('images/group.png');
            }
            .x-icon-templates {
                background-image: url('images/templates.png');
            }
        </style>
		<a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php"><img  style="height:50px;width:50px;float:right;" src="<?php echo Yii::app()->request->baseUrl; ?>/images/home-logo.png"/></a>
		<div id="header">

        	<!--div id="logo" style="color:#fff"><?php //echo CHtml::encode(Yii::app()->name); ?></div-->
            <!--<div id="header-in">-->
			<center>
          
             	<!--ul>
                	<li><a href="#">Category</a></li>
                    <li><a href="#">Items</a></li>
                    <li><a href="#">Sales</a></li>
                </ul-->
				<?
				$userlevel = Yii::app()->user->getLevel();
				$a = true;
				if($userlevel < 5)
				$a = true;
				else
				$a = false;
				?>
				 <?php $this->widget('application.extensions.mbmenu.MbMenu',array( 
            'items'=>array( 
                array('label'=>'Laporan harian', 'visible' => !Yii::app()->user->isGuest,
                  'items'=>array( 
                    array('label'=>'Penjualan', 'url'=>array('/sales/index')), 
                    array('label'=>'Pembayaran','url'=>array('/sales/cashreport')), 
                    array('label'=>'Outlet','url'=>array('/sales/outletreport')), 
                  ), 
                ), 
                array('label'=>'Laporan Bulanan', 'visible' => !Yii::app()->user->isGuest,
                  'items'=>array( 
                    array('label'=>'Penjualan', 'url'=>array('/sales/salesmonthly','view'=>'sub1')), 
                    array('label'=>'Pembayaran', 'url'=>array('/sales/salescashmonthly','view'=>'sub1')), 
                    array('label'=>'Outlet','url'=>array('/sales/salesoutletmonthly')), 
                    ), 
                  ), 
				  // array('label'=>'Data Master', 'visible' => !Yii::app()->user->isGuest!Yii::app()->user->isGuest,
				  array('label'=>'Data Master', 'visible' => $a,
                  'items'=>array( 
                    array('label'=>'Menu', 'url'=>array('/items/index','view'=>'sub1')), 
                    array('label'=>'Kategori','url'=>array('/categories/index','view'=>'sub1')), 
                    array('label'=>'Outlet','url'=>array('/Outlet/admin','view'=>'sub1')), 
                    ), 
                  ), array('label'=>'Setting', 'visible' => !Yii::app()->user->isGuest,
				  'items'=>array(
                    array('label'=>'service','url'=>array('/service/service','view'=>'sub1')), 
                    array('label'=>'Print','url'=>array('/setting/index','view'=>'sub1')), 
				  
				  )
               
                  ), 
				 array('label' => 'Login', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                 array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest),

                 
            ), 
    )); ?> 
	<?
				/*
                $this->widget('zii.widgets.CMenu', array(
                    'items' => array(
                        //array('label' => 'Category', 'url' => array('/categories/index'), 'visible' => !Yii::app()->user->isGuest),
                        array('label' => 'Menu', 'url' => array('/items/index'), 'visible' => !Yii::app()->user->isGuest),
						
                        array('label' => 'Laporan Penjualan', 'url' => array('/sales/index'), 'visible' => !Yii::app()->user->isGuest),
                        array('label' => 'Laporan Pembayaran', 'url' => array('/sales/cashreport'), 'visible' => !Yii::app()->user->isGuest),
                        array('label' => 'Laporan Outlet', 'url' => array('/sales/outletreport'), 'visible' => !Yii::app()->user->isGuest),
                        array('label' => 'Laporan Bulanan Penjualan', 'url' => array('/sales/Salesmonthly'), 'visible' => !Yii::app()->user->isGuest),
                        array('label' => 'Laporan Bulanan outlet', 'url' => array('/sales/Salesoutletmonthly'), 'visible' => !Yii::app()->user->isGuest),
                        array('label' => 'Login', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                        array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest),
                        //array('label' => '<i class="icon-key"></i> Log Out', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest),
						
                    ),
                ));
				*/
                ?>
          <!-- mainmenu --></center>
            </div>
        <!--</div> header -->
        

        <div class="container" id="page">

            
           

           <?php echo $content; ?>

            <div class="clear"></div>

            

        </div><!-- page -->
        <div id="footer">
            Copyright &copy; <?php //echo date('Y'); ?> CV. SURYAFOKUS.<br/>
            All Rights Reserved. <?=date('Y')?><br/>
            <?php //echo Yii::powered(); ?>
        </div><!-- footer -->

    </body>
</html>
