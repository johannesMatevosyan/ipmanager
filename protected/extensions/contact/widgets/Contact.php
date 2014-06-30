<?php
class Contact extends CWidget
{
    public $admin_mode   = FALSE;
    
    public $form_email   = TRUE;
    public $form_phone   = TRUE; 
    public $form_topic   = TRUE;
    public $errors       = '';
    
    public $assets;
    
    public function init()
    {  
      
         $this->assets = Yii::app()->baseUrl.'/protected/extensions/contact/assets';    
         Yii::app()->clientScript->registerCssFile($this->assets.'/css/font-awesome.css');
         
         if ($this->admin_mode === TRUE){
             Yii::app()->clientScript->registerCssFile($this->assets.'/css/contact.css');
         }
    }
    
    public function run()
    {       
        $map_config   = ContMapConfig::model()->findAll();
        $our_contacts = ContOurContacts::model()->find();
        if ($this->admin_mode === FALSE){
            $model = new ContContacts(); 
        $this->renderInternal(dirname(__FILE__).'/views/form.php',array('model'=>$model));   
  
        } else {
                Yii::app()->clientScript->registerScriptFile($this->assets.'/js/admin.js');
                $our_contacts = new ContOurContacts();
                $mails = ContContacts::model()->findAll();
            $this->renderInternal(dirname(__FILE__).'/views/admin.php',array('mails'=>$mails));         
        }
    }
}
