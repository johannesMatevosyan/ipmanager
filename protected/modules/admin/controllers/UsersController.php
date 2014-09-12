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
				'actions'=>array('userUpdate', 'getuserlist', 'userform', 'deleteuser', 'changeuserrole'),
				'users'=>array('@'),
                'expression'=>'isset($user->role) && ($user->role==="admin")',
			),
			
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

    public function actionChangeUserRole()
    {
        if (isset($_POST['userId'], $_POST['userRole'])) {
            $userId   = $_POST['userId'];
            $userRole = $_POST['userRole'];
            Yii::app()->db->createCommand('UPDATE tbl_users SET userRole = :userRole WHERE IdUsers = :userId')
                          ->bindValues(array(':userRole' => $userRole, ':userId' => $userId))
                          ->execute();
            echo 'User Role Changed To - ' . $userRole;                   
        }
    }

    public function actionDeleteUser($userId)
    {
        if ( $userId )
            Users::model()->deleteByPk($userId);
        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionGetUserList()
    {
        $userList = new CActiveDataProvider('Users', array(
            'criteria' => array(
                'condition'=>'IdUsers<>1',
                )
        ));
        $this->render('user_list', array('userList' => $userList));
    }

    public function actionUserForm($userId = NULL)
    {
        Yii::app()->language = 'en';
        $user = new Users();
        if ($userId) {
                $user = Users::model()->findByPk($userId);
        }
        if (isset($_POST['Users'])) {
            if (isset($_POST['Users']['IdUsers'])) {
                $user->setIsNewRecord(false);
            }
            $user->attributes = $_POST['Users'];
            $user->userRole   = 'user';
            $user->userActive = 1;
            if ($user->save())
                $this->redirect(Yii::app()->createUrl('/admin/users/getuserlist'));
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
          //  print_r($_POST['LoginForm']);

            $userActive = Yii::app()->db->createCommand()
                ->select('userEmail, userActive, userBanned, userLastVisit')
                ->from('tbl_users')
                ->where('userFName=:userFname', array(':userFname'=>$_POST['LoginForm']['username']))
                ->queryRow();
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
                    
                        // Yii::app()->user->setState('firstVisit', 'true');
                    if(empty($userActive['userLastVisit']))
                        Yii::app()->user->setState('firstVisit', 'true');

                    $this->redirect(Yii::app()->createUrl('admin/index'));
                }
                else
                {
                    $ok = 2;
                    $massage = 'Incorrect e-mail or password';
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
                $massage = 'Incorrect e-mail or password';
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
