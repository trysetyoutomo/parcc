<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
//Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');
// Yii::app()->bootstrap->registerAllCss();
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Food Arena Cafe',
//    'theme'=>'bootstrap',
    // preloading 'log' component
    'preload' => array('log'
    // ,'bootstrap'
    ),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
		 'application.models.', 'application.components.', 'ext.yii-mail.YiiMailMessage',
    ),
    'modules' => array(
        // uncomment the following to enable the Gii tool

        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '123',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
            'generatorPaths' => array(
                'bootstrap.gii',
            // 'application.templates',
            // 'application.gii',
            ),
        ),
    ),
    // application components
    'components' => array(
        'file' => array(
            'class' => 'application.extensions.file.CFile',
        ),
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
            'class' => 'EWebUser',
        ),
        'bootstrap' => array(
            'class' => 'ext.bootstrap.components.Bootstrap',
            'responsiveCss' => true,
        ),
        // uncomment the following to enable URLs in path-format
        /*
          'urlManager'=>array(
          'urlFormat'=>'path',
          'rules'=>array(
          '<controller:\w+>/<id:\d+>'=>'<controller>/view',
          '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
          '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
          ),
          ),
         */
        // 'db'=>array(
        // 'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
        // ),
        // uncomment the following to use a MySQL database

        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=postech',
            'emulatePrepare' => true,
            'username' => 'root',
            // 'password' => 'Passw0rD',
            'password' => '',
            'charset' => 'utf8',
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            // uncomment the following to show log messages on web pages
            /*
              array(
              'class'=>'CWebLogRoute',
              ),
             */
            ),
        ),
		'mail' => array(
                'class' => 'ext.yii-mail.YiiMail',
                'transportType'=>'smtp',
                'transportOptions'=>array(
                        'host'=>'smtp.mail.yahoo.com',
                        'username'=>'try.setyoutomo@yahoo.com',
                        'password'=>'@trysetyo',
                        'port'=>'465',                       
                ),
                'viewPath' => 'application.views.mail',             
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',
    ),
);