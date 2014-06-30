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
    
	public function actionIndex()
	{
		$homeData = Pages::model()->findByPk(1);
		$this->render('index', array('homeData'=>$homeData));
	}
	public function actionAbout()
	{
		$aboutData = Pages::model()->findByPk(2);
        
		$this->render('about_company',array(
                'aboutData'=>$aboutData,
            ));
	}
	
    public function actionDiscounts($page = 1)
	{
		$discountData = Pages::model()->findByPk(3);
		$this->render('discounts', array('discountData'=>$discountData));
	}
	
    public function actionGallery()
	{
        $galleryDir = Yii::getPathOfAlias('webroot.images.gallery');
        $galleryItems = scandir($galleryDir,1);
        
        function getBigImages($var)
        {
            if(strpos($var, 'thumb_') === false && $var != '.' && $var != '..')
                return true;
            else
                return false;
        }
        $galleryImages = array_filter($galleryItems, "getBigImages");
        //var_dump($galleryImages); die;
        
        $imgCount = 9;
        $imgStart = 0;
        $pageCount = ceil(count($galleryImages)/$imgCount)==1?0:(int)(ceil(count($galleryImages)/$imgCount));
        if(isset($_GET['page']) && !empty($_GET['page']) && $_GET['page']>=1 && $_GET['page']<=$pageCount)
        {
            $imgStart = ($_GET['page']-1) * $imgCount;
        }
        $imgEnd = $imgStart + $imgCount;
        if($imgStart + $imgCount >= count($galleryImages))
        {
            $imgEnd = count($galleryImages);
        }
        //var_dump($pageCount1);die;
        $this->render('gallery',array(
            'galleryImages'=>$galleryImages,
            'imgStart'=>$imgStart,
            'imgEnd'=>$imgEnd,
            'pageCount'=>$pageCount,
        ));
	}
	public function actionDelivery($page = 1)
	{
        $deliveryData = Pages::model()->findByPk(4);
		$this->render('delivery', array('deliveryData'=>$deliveryData));
	}
	public function actionContacts()
	{
		$this->render('contacts');
	}
	public function actionReadMore($id)
	{
        $connection = Yii::app()->db;
        $article = $connection->createCommand()
            ->select('*')
            ->from('stbl_articles')
            ->where('IdArticles=:articleId AND articleActive=1', array(':articleId'=>$id))
            ->limit(1)
            ->queryRow();
		$this->render('read_more',array(
                'article'=>$article,
            ));
	}

	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact_yii',array('model'=>$model));
	}

    public function actionCall()
    {
        $ok = 0;
        $massage = '';
        if(isset($_POST['Call']))
        {
            $model=new Call;
            $callerInfo = $_POST['Call'];
            $model->attributes=$callerInfo;
            if($model->validate())
            {
                $replyTo = '';
                if($callerInfo['copy'] == 1)
                {
                    $replyTo = "Reply-To: {$model->email}\r\n";
                }
                $name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode('Вызов замерщика - stavnivam.ru').'?=';
                $body = 'Телефон '.$model->phone. '\r\n'.$model->body;
				$headers="From: $name <{$model->email}>\r\n".
                    $replyTo.
					"MIME-Version: 1.0\r\n".
					"Content-type: text/html; charset=UTF-8";

				if(mail(Yii::app()->params['infoEmail'],$subject,$body,$headers))
                {
                    $ok = 1;
                    $massage = 'Ваше писмо удачно отправлено!';
                }
                else
                {
                    $ok = 2;
                    $massage = 'Ошибка! Ваше писмо не отправлено.';
                }
            }
            else
            {
                $ok = 2;
                $massage = 'Ошибка! Заполните все поля корректно!';
            }
            $massageArray = array('ok'=>$ok, 'massage'=>$massage);
            echo json_encode($massageArray); die;
        }
    }
	/**
	 * Displays the login page
	 */
	public function actionLogin_yii()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout_yii()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

}