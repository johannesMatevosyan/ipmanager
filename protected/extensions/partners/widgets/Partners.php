<?php

class Partners extends CWidget
{
    public $admin_mode=FALSE;
    
    public $assets;
    public $img_folder;
    public $htmlOptions=array(
        'class'=>'table table-striped', 
        'id'=>'datatable-table'
        );

    public function init()
    {        
        $this->assets=Yii::app()->baseUrl.'/protected/extensions/partners/assets';        
        $this->img_folder=dirname(__FILE__)."/../assets/upload_logo/";        
        
        Yii::app()->clientScript->registerCssFile($this->assets.'/css/screen.css');
        Yii::app()->clientScript->registerCssFile($this->assets.'/css/jquery.bxslider.css');
        Yii::app()->clientScript->registerScriptFile($this->assets.'/js/jquery.bxslider.js');
        Yii::app()->clientScript->registerScriptFile($this->assets.'/js/scripts.js');
        Yii::app()->clientScript->registerScriptFile($this->assets.'/js/ajax.js');
    }
    
    public function run()
    {   
        if (isset($_POST['show_hide']) && $_POST['show_hide']=="ok")
        {
            $id=$_POST['c_id'];
            $model=PartnersModel::model()->findByPk($id);
            if ($model->aprove=='1')
                $model->aprove='0';
            else
                $model->aprove='1';
            echo $model->save()?"<!-|respons|->ok":"<!-|respons|->none";
            Yii::app()->end();
        }
        if (isset($_POST['show_image']) && $_POST['show_image']=="ok")
        {
            $model=json_decode($_POST['model'], TRUE);            
            echo "<!-|respons|->ok";
            Yii::app()->end();
        }
        if (isset($_POST['edit']) && $_POST['edit']=="ok")
        {
            $model_edit=PartnersModel::model()->findByPk($_POST['id']);
            echo "<!-|respons|->";
            $this->renderInternal(dirname(__FILE__).'/views/_edit.php', array('model_edit'=>$model_edit));
            Yii::app()->end();
        }
        if (isset($_POST['delete']) && $_POST['delete']=="ok")
        {
            PartnersModel::model()->deleteByPk($_POST['id']);
            echo "<!-|respons|->ok";
            Yii::app()->end();
        }
        if (isset($_POST['PartnersModel']))
        {
            if ($_POST['action_type']=="new")
            {
                $model=new PartnersModel();
                $model->attributes=$_POST['PartnersModel'];
                if(!empty($_FILES['Image']) && $UploadFileName = Helper::PhotoUpload($this->img_folder))
                {
                    if($UploadFileName!="")
                    {
                        $model->path=$UploadFileName;         
                    }
                }
                
                if ($model->save())
                {
                    Yii::app()->request->redirect(Yii::app()->request->url);
                }
            }
            else if ($_POST['action_type']=="edit")
            {
                $model_edit=PartnersModel::model()->findByPk($_POST['partner_id']);
                $model_edit->attributes=$_POST['PartnersModel'];
                if(!empty($_FILES['Image']) && $UploadFileName = Helper::PhotoUpload($this->img_folder))
                {
                    Helper::deleteImage($model_edit->path, $this->img_folder);
                    if($UploadFileName!="")
                    {
                        $model_edit->path=$UploadFileName;
                    }
                }
                if ($model_edit->save())
                {
                    Yii::app()->request->redirect(Yii::app()->request->url);
                }
            }
        }
        if ($this->admin_mode===FALSE)
        {
            $model_slider=PartnersModel::model()->findAllByAttributes(array('aprove'=>'1'));
            $this->renderInternal(dirname(__FILE__).'/views/_frontend.php', array('model_slider'=>$model_slider));
        }
        else
        {
            $model_new=new PartnersModel();
            $dataprovider=new CActiveDataProvider('PartnersModel', array(
                'sort'=>array(
                    'defaultOrder'=>'IdPartner DESC',
                     ),
                 'Pagination' => array (
                      'PageSize' =>20
                  ),
            ));
            $this->renderInternal(dirname(__FILE__).'/views/_backend.php', array(
                'dataprovider'=>$dataprovider,
                'model_new'=>$model_new
            ));
        }
    }
}
