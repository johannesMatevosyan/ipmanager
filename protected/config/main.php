<?php
define('CATEGORY_ABOUT_US', 1);
define('CATEGORY_ABOUT_COMPANY', 2);
define('CATEGORY_PRODUCTS', 3);
define('CATEGORY_ARTICLES', 4);
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');
Yii::setPathOfAlias('partners', dirname(__FILE__).'/../extensions/partners');
Yii::setPathOfAlias('contact', dirname(__FILE__).'/../extensions/contact');
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'IpManager',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
        'application.modules.admin.components',
        'ext.partners.model.*',
        'ext.partners.widgets.*',
        'ext.contact.model.*',
        'ext.contact.widgets.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'admin',
		'Filemanager',
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'1234',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
            //'generatorPaths'=>array('bootstrap.gii'),
		),
		/**/
	),

	// application components
	'components'=>array(
        'authManager' => array(
            'class' => 'PhpAuthManager',
            'defaultRoles' => array('guest'),
        ),
		'user'=>array(
            'class' => 'WebUser',
			'allowAutoLogin'=>true,
            'loginUrl' => array('users/login'),
		),
		// uncomment the following to enable URLs in path-format
		'bootstrap' => array(
            'class' => 'bootstrap.components.Bootstrap',
            //'responsiveCss' => true,
        ),
		'urlManager'=>array(
			'urlFormat'=>'path',
            'showScriptName'=>false,
			'rules'=>array(
                  'gii'=>'gii',
               	  'gii/<controller:\w+>'=>'gii/<controller>',
                  'gii/<controller:\w+>/<action:\w+>'=>'gii/<controller>/<action>',
                
                  '' => 'admin/users/login',
                  '/admin' => 'admin/users/login',
               	  '/admin/<action:\w+>/<id:\d+>' => 'admin/admin/<action>',
                  '/admin/<action:\w+>' => 'admin/admin/<action>',
                  '/users' => 'admin/users/index',
                  '/users/<action:\w+>/<id:\d+>' => 'admin/users/<action>',
                  '/users/<action:\w+>' => 'admin/users/<action>',
			),
		),
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
         */
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=ipmanager',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

    'language' => 'ru',
    'sourceLanguage' => 'ru',
	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'admin@stavnivam.ru',
		'infoEmail'=>'info@stavnivam.ru',
	),
);