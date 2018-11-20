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


        <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
        <![endif]-->
        <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
        <?php //Yii::app()->clientScript->registerCoreScript('jquery'); ?>
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    </head>

    <body><style type="text/css">
    .errorMessage{
        display: inline;
    }
</style>


        <!-- page specific -->
        <style type="text/css">
            /* styles for iconCls */
            @font-face {
                font-family: myFirstFont;
                src: url("font/Raleway-Regular.otf");
            }
            *{
                font-family: myFirstFont!important;
                text-transform: uppercase;
                /*font-size: */
            }
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
            .view{
                display: none;
            }
            #information-company{
                width: 100%;
                height: 150px;
                position: relative;
                background-image:url('images/back-red.jpg')!important;
                top: -20px;
                display: none;
                /*position: */
            }
            #information-company img{

                float: left;
            }
            #information-company .company-name{
                float: left;
                margin-top:15px;
                margin-left:20px;
                color: white!important;
            }
             #information-company .company-addres{
                float: left;
                top: 50px;
                left: 320px;
                /*margin-top:50px;*/
                /*margin-left:-330px;*/
                color: white!important;
                position: absolute;
            }
            .grid-view table.items th{
                background: #a30000!important;
                padding: 8px;

                /*background-image: url()!impornta;*/
            }
            table.items{
                width: 100%;
            }
            .items thead th {
                background: #a30000;
                color:white;
                padding: 10px;
            }
            #footer{
                 background-image:url('images/back-red.jpg')!important;
                 height: 50%;
                 position: relative;
                 bottom: 0px;
                 width: 100%;
            }
            #nav-bar {
                 border-top: 0px solid red!important; 
                border-bottom: 0px solid #2d444f!important;
                /* background: url(nav1_bg.gif) repeat-x 0 100% #666e73; */
                padding: 0 30px;
                /* background: red; */
                /* background-size: 100px 100px; */
            }
            input[type="text"],input[type="password"],select{
                padding:3px;
            }
            .grid-view table.items th, .grid-view table.items td {
                font-size: 0.9em;
                border: 1px white solid;
                /*padding: 0.3em;*/
                padding: 10px!important;
                text-transform: uppercase;
            }
            .grid-view table.items tr.odd {
                background: khaki;
            }
            fieldset{
                margin:20px;
            }
            input[type="submit"],input[type="button"],input[type="reset"],button{
                /*background-image:url('images/back-red.jpg');*/
                background-color: #a30000!important; 
                color:white;
                border: none;
                padding:9px!important;

                cursor: pointer;
            }
            body{
                background-color: white!important;
            }
            #menu-item li{
                list-style: none;
            }
            #nav{
                margin-top:10px; 
            }
        </style>
        <?php if (Yii::app()->user->getLevel()==6): ?>
		<a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php"><img  style="height:50px;width:50px;float:right;" src="<?php echo Yii::app()->request->baseUrl; ?>/images/home-logo.png"/></a>
        <?php endif; ?>
		<div id="information-company">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" style="width:180px;height:auto">      
            <p style="visibility:hidden"> <?php $company = Branch::model()->findByPk(1);  ?>
                <h1  class="company-name"><?php echo $company->branch_name ?></h1>
                <h4  class="company-addres"><?php echo $company->address ?></h1>
            </p>
        </div>
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

				// echo "hahahahaha".$userlevel;
				$a = true;
				if($userlevel < 5)
				$a = true;
				else
				$a = false;
				?>
				 <?php $this->widget('application.extensions.mbmenu.MbMenu',array( 
            'items'=>array(

                array('label'=>'Laporan Periode ', 'visible' => true, //!Yii::app()->user->isGuest
                  'items'=>array( 
                    array('label'=>'Penjualan', 'url'=>array('/sales/index')), 
                    array('label'=>'Penjualan 2 ', 'url'=>array('/sales/periode')), 
                    array('label'=>'Pembayaran','url'=>array('/sales/cashreport')), 
                    array('label'=>'Pengunjung','url'=>array('/sales/pengunjung')), 
                    array('label'=>'Penjualan Terbanyak','url'=>array('/sales/bestseller')), 
                    // array('label'=>'Outlet & Tenant','url'=>array('/sales/outletreport')), 
                    // array('label'=>'Penjualan Paket','url'=>array('/paket/index')), 
                  ), 
                ),

                // array('label'=>'Pendapatan Periode', 'visible' => $userlevel==3 || $userlevel==2  || $userlevel==1,
                //   'items'=>array( 
                //     array('label'=>'Penjualan', 'url'=>array('/sales/periode')), 
                //     // array('label'=>'Pembayaran','url'=>array('/sales/cashreport')), 
                //     // array('label'=>'Outlet & Tenant','url'=>array('/sales/outletreport')), 
                //     // array('label'=>'Penjualan Paket','url'=>array('/paket/index')), 
                //   ), 
                // ),  
				
			//	array('label'=>'Laporan Periode','url'=>array('/sales/salesmonthly'), 'visible' => !Yii::app()->user->isGuest,
             //   ), 
				
				
                // array('label'=>'Pendapatan Mingguan', 'visible' => $userlevel==3 || $userlevel==2  || $userlevel==1 ,
                //   'items'=>array( 
                //     array('label'=>'Penjualan', 'url'=>array('/sales/salesweekly')), 
                //     array('label'=>'Pembayaran', 'url'=>array('/sales/salescashweekly')), 
                //     // array('label'=>'Outlet & Tenant','url'=>array('/sales/salesoutletweekly')), 
                //     // array('label'=>'Penjualan Paket','url'=>array('/sales/salesoutletweekly')), 
                //     ), 
                //   ),
                
                  
                array('label'=>'Laporan Bulanan', 'visible' => $userlevel==3 || $userlevel==2  || $userlevel==1,
                  'items'=>array( 
                    array('label'=>'Penjualan', 'url'=>array('/sales/salesmonthly')), 
                    array('label'=>'Pembayaran', 'url'=>array('/sales/salescashmonthly','view'=>'sub1')), 
                    // array('label'=>'Outlet & Tenant','url'=>array('/sales/salesoutletmonthly')), 
                    // array('label'=>'Penjualan Paket','url'=>array('/sales/salesoutletweekly')), 

                    ), 
                  ),

                // array('label'=>'Grafik','url'=>array('/sales/grafik'), 'visible' => !Yii::app()->user->isGuest,),
				  
				  array('label'=>'Data Master', 'visible' =>$userlevel==3 || $userlevel==2 ,
                      'items'=>array( 
                    array('label'=>'Menu', 'url'=>array('/items/admin','view'=>'sub1')), 
                    array('label'=>'Kategori','url'=>array('/categories/admin','view'=>'sub1')), 
                    // array('label'=>'Tenan','url'=>array('/Outlet/admin','view'=>'sub1')), 
                    array('label'=>'Pengguna','url'=>array('/Users/admin','view'=>'sub1')), 
                    // array('label'=>'Voucher','url'=>array('/Voucher/admin','view'=>'sub1')), 
                    // array('label'=>'Paket','url'=>array('/Items/adminpaket','view'=>'sub1')), 
                    ), 
                  ), 
                  
                  
                  array('label'=>'Pengaturan',  'visible' => $userlevel==3 || $userlevel==2,
                  'items'=>array(
                    // array('label'=>'service','url'=>array('/service/service','view'=>'sub1')), 
                    array('label'=>'Parameter ','url'=>array('/Parameter/update&id=1','view'=>'sub1')), 
                    array('label'=>'Cetak Bill ','url'=>array('/setting/index','view'=>'sub1')), 
				  
				  )), 
				  
				array('label'=>'Grafik', 'visible' => $userlevel==3 || $userlevel==2 || $userlevel==1 ,
				  'items'=>array(
                    array('label'=>'Penghasilan bersih terbaik','url'=>array('/sales/grafik','mode'=>'bersih')), 
                    array('label'=>'Top makanan terlaris','url'=>array('/sales/grafik','mode'=>'top')), 
				  
				  )), 
				  
				// array('label'=>'Piutang','url'=>array('/sales/datahutang','mode'=>'top'), 'visible' => $a), 
	
				 
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
        

        <div class="container" id="page" style="margin-left:30px">
			<div style="float:left">
            <style type="text/css">
            #menu-item {
                display: inline;
                float: left;
                position: relative;
                top:20px;
                padding: 10px;
                background-color: #a30000;
                /*margin-right: -5px;*/
                color: white!important;
            }
            #menu-item ul li a{
                color: white!important;
                text-decoration: none;

            }
            </style>
                <?php
                // echo $this->action->id; 
                if ($this->action->id=='admin'){
                ?>
                    <ul id="menu-item">
                        <li><a style="color:white!important" href="<?php echo Yii::app()->controller->createUrl('create'); ?>">Tambah</a></li>
                        
                    </ul>
                <?php
                } 
                ?>
                
			   <?php echo $content; ?>
			</div>
        </div><!-- page -->
        
		<div id="footer">
            Copyright &copy; <?php //echo date('Y'); ?> 35u & 3Giant.<br/>
            All Rights Reserved. <?=date('Y')?><br/>
            <?php //echo Yii::powered(); ?>
        </div><!-- footer -->

    </body>
</html>