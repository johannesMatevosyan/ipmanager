<?php

class UsersController extends Controller
{

	public $layout='main';

	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}
    public function actions()
	{
		return array(
			'read'=>array(
				'class'=>'CViewAction',
			),
		);
	}


	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('login','logout'),
                                'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('userUpdate', 'getuserlist', 'userform'),
				'users'=>array('@'),
                'expression'=>'isset($user->role) && ($user->role==="admin")',
			),
			
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

    public function actionGetUserList()
    {
        $this->render('user_list');
    }

    public function actionUserForm()
    {
        $user = new Users();
        if (isset($_POST['Users'])) {
            if (isset($_POST['Users']['IdUsers'])) {
                $user = Users::model()->findByPk($_POST['Users']['IdUsers']);
                $user->setIsNewRecord(false);
            }
            $user->attributes = $_POST['Users'];
            $user->userRole = 'user';
            if (!$user->save())
                print_r($user->getErrors()); die;
        }
        $this->render('_form', compact('user'));

    }

    /**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new Users;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->IdUsers));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUserUpdate()
	{
        if(isset($_GET['userId']) && Yii::app()->user->name=='admin@stavnivam.ru')
            $model=$this->loadModel($_GET['userId']);
        else
            $model=$this->loadModel(Yii::app()->user->id);
        
        $massage = '';
        $ok = 0;
        
		if(isset($_POST['Users']))
		{
            $userArray = $_POST['Users'];
            
            $userArray['userEmail'] = $model->userEmail;

            if(!empty($userArray['userPassword_new']) || !empty($userArray['userPassword_confirm']))
            {
                if(($userArray['userPassword_new'] == $userArray['userPassword_confirm']))
                {
                    $userArray['userPassword'] = $userArray['userPassword_new'];
                    $model->attributes=$userArray;
                    //var_dump($userArray); die;
                    if($model->update())
                    {
                        $ok = 1;
                        $massage = $massage.' Изменения сохранены!<br>';
                        if(Yii::app()->user->name=='admin@stavnivam.ru')
                        {
                            Yii::app()->user->setState( 'FName', $userArray['userFName']);
                            Yii::app()->user->setState( 'LName', $userArray['userLName']);
                            Yii::app()->user->setState( 'Phone', $userArray['userPhone']);
                        }
                    }
                    else
                    {
                        $ok = 2;
                        $massage = $massage.' Ошибка! Изменения не сохранены<br>';

                    }
                }
                else
                {
                    $ok = 2;
                    $massage = $massage.' Поле <strong>Новый пароль</strong> и <strong>Повторить пароль</strong> не совпадают<br>';

                }
            }
            else
            {
                $model->attributes=$userArray;
                if($model->update())
                {
                    $ok = 1;
                    $massage = $massage.' Изменения сохранены!<br>';
                    if(Yii::app()->user->name=='admin@stavnivam.ru')
                    {
                        Yii::app()->user->setState( 'FName', $userArray['userFName']);
                        Yii::app()->user->setState( 'LName', $userArray['userLName']);
                        Yii::app()->user->setState( 'Phone', $userArray['userPhone']);
                    }
                }
            }
                    
		}

		$this->render('userUpdate',array(
                    'model'=>$model,
                    'massage'=>$massage,
                    'ok'=>$ok,
		));
	}
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Users');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Users('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Users']))
			$model->attributes=$_GET['Users'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
        
        public function actionRegister()
        {
            if(!Yii::app()->user->isGuest)
            {
                throw new CHttpException(403,'Դուք արդեն գրանցված եք:');
            }
            $model = new Users;
            // collect user input data
            $massage = '';
            $ok = 0;
            // $this->performAjaxValidation($model);
            if(isset($_POST['Users']))
            {
                $usersArray = $_POST['Users'];
                //var_dump($model->findAll(array('condition'=>'userEmail=:x', 'params'=>array(':x'=>$usersArray['userEmail'])))); die;
                if(count($model->findAll(array('condition'=>'userEmail=:x', 'params'=>array(':x'=>$usersArray['userEmail'])))) != 0)
                {
                $ok = 2;
                $massage = 'Նշված էլեկտրոնային հասցեով գրանցում արդեն եղել է:';
                //$this->render('register',array('model'=>$model,'massage'=>$massage, 'ok'=>$ok));
                }
                else
                {
                $usersArray['userRole'] = 'seller';
                $usersArray['userActiveKey'] = sha1(mt_rand(10000, 99999).time().$usersArray['userEmail']);

                $model->attributes = $usersArray;
                //var_dump($model->attributes); die;

                if($model->validate())
                {      
                    $massage_to = $usersArray['userEmail'];
                    $massage_sub = 'Հաստատեք գրանցումը imauto.am -ում';
                    //$massage_body = 'Գրանցումը հաստատելու համար գնացեք հետևյալ հղումով '.Yii::app()->createAbsoluteUrl('users/registerActivate', array('aktivation_key' => $usersArray['userActiveKey']));
                    $massage_body = 'Հարգելի ընկեր <br> Շնորհակալություն ImAuto.am կայքում գրանցվելու համար: <br> Սեղմելով հետևյալ հղմանը դուք կավարտեք Ձեր գրանցումն  ImAuto.am կայքում. <br> '.Yii::app()->createAbsoluteUrl('users/registerActivate', array('aktivation_key' => $usersArray['userActiveKey'])).' <br> Լավագույն մաղթանքներով. <br> ImAuto.am սպասարկման բաժին:';
                    $massage_header =   "From: register@imauto.am\r\n".
                            "MIME-Version: 1.0\r\n".
                            "Content-type: text/html; charset=UTF-8\r\n";
                    if($model->save() && $m = mail($massage_to, $massage_sub, $massage_body, $massage_header))
                    {
                    $ok = 1;
                    $massage = 'Ձեր նշած էլ. հասցեին՝ <strong>'.$usersArray['userEmail'].'</strong> ուղարկվել է գրանցումը հաստատող հաղորդագրություն, գրանցումը հաստատելու համար <strong>ստուգեք նշված էլեկտրոնային հասցեն</strong>:';
                    }
                    else
                    {
                    $ok = 2;
                    $massage = 'Գրանցման սխալ, խնդրում ենք փորձեք ավելի ուշ, կամ կապնվեք կայքի ադմինիստրացիայի հետ:';
                    }
                }
                else
                {
                    $ok = 2;
                    $massage = 'Խնդրում ենք ճիշտ լրացնել բոլոր դաշտերը:';
                }
		    }
		}
                
                // display the registration form
                $this->render('register',array('model'=>$model,'massage'=>$massage, 'ok'=>$ok));
        }
        
        public function actionRegisterActivate()
        {
            $massage = '';
            $ok = 0;
            if(isset($_GET['aktivation_key']) && $_GET['aktivation_key'] != '')
            {
                $userId = Yii::app()->db->createCommand()
                    ->select('IdUsers, userActive')
                    ->from('tbl_users')
                    ->where('userActiveKey=:key', array(':key'=>$_GET['aktivation_key']))
                    ->queryRow();
            //var_dump($userId); die;
                if($userId !== FALSE && $userId['userActive'] != 1)
                {
                    $sql = 'UPDATE tbl_users SET userActive=1 WHERE IdUsers="'.$userId['IdUsers'].'"';
                    $command = Yii::app()->db->createCommand($sql)->execute();
                    $massage = 'Գրանցումը հաջողությամբ ավարտված է, կարող եք մուտք գործել համակարգ:';
                    $ok = 1;
                    $this->redirect( array('users/login','massage'=>$massage, 'ok'=>$ok));
                }
                else
                {
                    throw new CHttpException(403,'Ձեր գրանցման կոդը սխալ է, կամ արդեն օգտագործված է !!!');
                }
            }
            else
            {
                throw new CHttpException(404,'Անհայտ էջ:');
            }
        }
        
    public function actionLogin()
	{
        //$this->layout = 'login';
		$model = new LoginForm;
        $massage = '';
        $ok = 0;
        if(isset($_GET['massage'])) $massage = $_GET['massage'];
        if(isset($_GET['ok'])) $ok = $_GET['ok'];

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
            $userActive = Yii::app()->db->createCommand()
                ->select('userEmail, userActive, userBanned, userLastVisit')
                ->from('tbl_users')
                ->where('userEmail=:email', array(':email'=>$_POST['LoginForm']['username']))
                ->queryRow();
        //var_dump($userActive); die;
            if((int)$userActive['userBanned'] == 1)
            {
                throw new CHttpException(403,'Ваш профиль заблокирован!');
            }
            if($userActive['userEmail'] !=FALSE && $userActive['userActive'] == 1)
            {
                //var_dump($model->IdUsers); die;
                $model->attributes=$_POST['LoginForm'];
                // validate user input and redirect to the previous page if valid
                if($model->validate() && $model->login())
                {
                    date_default_timezone_set ('Asia/Yerevan');
                    $date = date('Y-m-d H:i:s');

                    $connection = Yii::app()->db;
                    $sql = "UPDATE `tbl_users` SET `userLastVisit`='".$date."' WHERE `IdUsers`='".Yii::app()->user->id."'";
                    $connection->createCommand($sql)->execute();
                    
                    if(empty($userActive['userLastVisit']))
                        Yii::app()->user->setState('firstVisit', 'true');

                    $this->redirect(Yii::app()->createUrl('admin/index'));
                }
                else
                {
                    $ok = 2;
                    $massage = 'Неправильный адрес эл. почты или пароль';
                }
            }
            elseif($userActive['userEmail'] !=FALSE && $userActive['userActive'] == 0)
            {
                $ok = 2;
                $massage = 'Ваш профиль не активирован';
                //throw new CHttpException('Ակտիվացրեք ձեր պրոֆիլը','Ձեր պրոֆիլը դեռ ակտիվացված չէ, ակտիվացնելու համար ստուգեք Ձեր էլ.հասցեն:');
            }
            else
            {
                $ok = 2;
                $massage = 'Неправильный адрес эл. почты или пароль';
            }
		}
		// display the login form
		$this->render('login',array('model'=>$model, 'massage'=>$massage, 'ok'=>$ok));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Users::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='users-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
