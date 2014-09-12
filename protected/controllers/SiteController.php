<?php

class SiteController extends Controller
{
	
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
    
    public function filters()
	{
		return array(
			//'accessControl', // perform access control for CRUD operations
		);
	}

	public function accessRules()
	{
	    return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('call','index','aboutCompany','products','gallery','articles','contacts','readMore','contact'),
                'users'=>array('*'),
            ),

            array('deny',  // deny all users
                'users'=>array('*'),
            ),
	    );
	}
	
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			var_dump($error); die();
			// if(Yii::app()->request->isAjaxRequest)
			// 	echo $error['message'];
			// else
			// 	$this->render('error', $error);
		}
	}
}