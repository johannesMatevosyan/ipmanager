<?php 
    class ContactController extends Controller 
    {        
       

        function __construct() 
        {
            $this->redirect_url = Yii::app()->createUrl($this->redirect_path);
            //echo $redirect_url;
        }

        private $redirect_path = 'admin/contacts';       
        /* path to controller, action which should be redirected аfter each actions*/
        
        private $redirect_url;
 
        public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
                            //how many times should the same CAPTCHA be displayed.
                                'testLimit'=>1, //
                            //background color 0xFFFFFF  - transparent
				'backColor'=>0,
                            //letters interval
                                'offset'   =>1,
                            //letters color
                                'foreColor'=>0xFFFFFF,
                                
			),
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
        public function actionSaveourcontact()
        {
             if(isset($_POST['ContOurContacts'])){
                   $contacts = new ContOurContacts();
                   $contacts = ContOurContacts::model()->find();
                   $contacts->attributes = $_POST['ContOurContacts'];
                   $contacts->save();
                   $this->redirect($this->redirect_url);
               }
        }
        
        public function actionSaveouremail()
        {
            if(isset($_POST['ContEmailConfig'])){   
               $mail = new ContEmailConfig();
               $mail = ContEmailConfig::model()->find();
               $mail->attributes = $_POST['ContEmailConfig'];
               $mail->save();
               $this->redirect($this->redirect_url);
            }
        }
        
        public function actionDeletemessage($message)
        {
              $Id = $message;
              ContContacts::model()->deleteByPk($Id);
              $this->redirect($this->redirect_url);
        }
       
        public function actionSavemaplocation()
        {
             if(isset($_POST['config'])){
                $config_arr =  ContMapConfig::model()->find();
                $post_array = $_POST['config'];

                foreach($post_array as $key=>$value){
                    if($value)
                        $config_arr[$key] = $value;    
                }
               if($config_arr->save()) die;
            }
        }
        
        public function actionSendmessage() 
        {
            $ok = 0;
            $massage = '';
            if (isset($_POST['ContContacts']))
            {
                $model_contact = new ContContacts();
                $model_contact->attributes = $_POST['ContContacts'];
                $mail = ContEmailConfig::model()->find();
                              
                if ($model_contact->validate())
                {
                    $model_contact->save();
                    //mail($mail->mail_to,$mail->mail_subject,$model_contact->firstname.'<br>'.$mail->mail_message.'<br>'.$model_contact->message,$headers);
                    $ok = 1;
                    //$massage = 'Спасибо! Ваше писмо отправлено.';
                }
                else
                {
                    $ok = $model_contact->getErrors();
                    //$massage = 'Ошибка! Ваше писмо не отправлено.';
                }
                Yii::app()->user->setState('ok',$ok);
                $this->redirect(Yii::app()->createUrl('site/contacts'));
            }
        }
    }