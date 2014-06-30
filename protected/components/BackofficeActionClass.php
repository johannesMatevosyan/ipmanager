<?php

class BackofficeActionClass extends CActiveRecord
{
    
    
    static public function getCurrentScripts()
    {
        $CurrentPageLess = dirname(Yii::app()->request->scriptFile).'/themes/backoffice/css/'.Yii::app()->controller->id.".".Yii::app()->controller->action->id.'.less';
//       var_dump($CurrentPageCss);die;
        if(file_exists($CurrentPageLess))
        {
            echo "<link type='text/css' rel='stylesheet/less' href=".Yii::app()->request->baseUrl.'/themes/backoffice/css/'.Yii::app()->controller->id.".".Yii::app()->controller->action->id.".less />";
//            Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl.'/themes/frontend/css/'.Yii::app()->controller->id.".".Yii::app()->controller->action->id.'.less');                
        }
        
        $CurrentPageJs  = dirname(Yii::app()->request->scriptFile).'/themes/backoffice/js/'.Yii::app()->controller->id.".".Yii::app()->controller->action->id.'.js';
        $CurrentPageCss = dirname(Yii::app()->request->scriptFile).'/themes/backoffice/css/'.Yii::app()->controller->id.".".Yii::app()->controller->action->id.'.css';
        
        if (file_exists($CurrentPageJs)){
            Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/themes/backoffice/js/'.Yii::app()->controller->id.".".Yii::app()->controller->action->id.'.js');}
        if(file_exists($CurrentPageCss)){
            Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl.'/themes/backoffice/css/'.Yii::app()->controller->id.".".Yii::app()->controller->action->id.'.css');} 
    }
    
    static public function ImageUpload($CtPath = 'img', $name)
     {       
        if(isset($_POST))
        {         
            if(!isset($_FILES[$name]) || !is_uploaded_file($_FILES[$name]['tmp_name']))
            {                                
                    return 0; 
            }

            $ImageName      = str_replace(' ','-',strtolower($_FILES[$name]['name']));
            $ranNum=rand(0,99999999);
            $type=  strrchr($ImageName, ".");
            $newNam=  str_ireplace($type, "", $ImageName);
            $ImageName=$newNam."-".$ranNum.$type;
            
            copy($_FILES[$name]["tmp_name"], Yii::getPathOfAlias('webroot.images')."/upload_ads/". $ImageName);
            unset($_FILES[$name]["tmp_name"]);
            
            return $ImageName;
        }
    }
    
    static public function getTodayCounts($model)
    {
        $count=array();
        $total_count=0;
        for ($i=0; $i<date('d'); $i++)
        {
            $count[$i]=0;            
            foreach ($model as $value)
            {
                $time = strtotime($value['registration_date']);
                if ((int)(date('d', $time))==($i+1) && date('m', $time)==date('m') && date('Y', $time)==date('Y'))
                {
                    $count[$i]++;
                    $total_count++;
                }
            }
        }        
//        $this->total=$total_count;
        return $count;
    }
    
    // TEACHERS
    
    static public function getMemberInfo($model)
    {
        $model=json_encode($model);
        echo CHtml::ajaxLink(
                "Information",
                array('service/userinfomodal'),
                array(
                    'type' =>'POST',
                    'data' =>array('model'=>$model),
    //                      'beforeSend'=>'function(){ console.log("send") }',
                    'success'=> 'function(data){showPopUp(data,"");}',
//                        'update'=>'#website_list_result_tab' 
                    ),
                array('href'=>'#myModal',
                      'class'=>'btn btn-primary', 
                                //'id'=>'view_adspace_cenerated_code'.$ID,  
                               // "role"=>"button",
                               //'data-toggle'=>"tooltip", 
                     )
            );
    }
    
    static public function getMemberLastActivity($la)
    {
        $la_time=strtotime($la);
        $today=strtotime('today');
        $yesterday=strtotime('yesterday');
        $week_1=strtotime('-1 week');
        $month_1=strtotime('-1 month');
        $month_2=strtotime('-2 month');
        $month_3=strtotime('-3 month');
        $month_4=strtotime('-4 month');
        $month_5=strtotime('-5 month');
        $month_6=strtotime('-6 month');
        $month_7=strtotime('-7 month');
        $month_8=strtotime('-8 month');
        $month_9=strtotime('-9 month');
        $month_10=strtotime('-10 month');
        $month_11=strtotime('-11 month');
        
        switch ($la)
        {
            case $la_time>$today:
                echo "Today";
                break;
            case $la_time>$yesterday:
                echo "Yesterday";
                break;
            case $la_time>$week_1:
                echo "Last week";
                break;
            case $la_time>$month_1:
                echo "Last month";
                break;
            case $la_time>$month_2:
                echo "2 month ago";
                break;
            case $la_time>$month_3:
                echo "3 month ago";
                break;
            case $la_time>$month_4:
                echo "4 month ago";
                break;
            case $la_time>$month_5:
                echo "5 month ago";
                break;
            case $la_time>$month_6:
                echo "6 month ago";
                break;
            case $la_time>$month_7:
                echo "7 month ago";
                break;
            case $la_time>$month_8:
                echo "8 month ago";
                break;
            case $la_time>$month_9:
                echo "9 month ago";
                break;
            case $la_time>$month_10:
                echo "10 month ago";
                break;
            case $la_time>$month_11:
                echo "11 month ago";
                break;
            default:
                echo $la;    
                break;
        }
    }
    
    static public function getEmailActivationStatus($model)
    {
        if ($model['email_confirm']=="1")
        {
            echo "<span id='email_status_".$model['id']."' class='badge badge-success'>Activated</span>";
        }
        else
        {
            echo "<span id='email_status_".$model['id']."' class='badge badge-important'>Not Activated</span>";
        }
    }
    
    static public function getMemberAction($id, $email)
    {
        echo "<button onclick='showUser(".$id.")' data-original-title='.btn .btn-success' data-placement='top' class='btn btn-success' type='button'>Profile</button>
            ";
        echo CHtml::ajaxLink(
                    "Mail",
                    array('service/mailusermodal'),
                    array(
                        'type' =>'POST',
                        'data' =>array('email'=>$email),
        //                      'beforeSend'=>'function(){ console.log("send") }',
                        'success'=> 'function(data){showPopUp(data,"");}',
//                        'update'=>'#website_list_result_tab' 
                        ),
                    array('href'=>'#myModal',
                          'class'=>'btn btn-primary', 
                                    //'id'=>'view_adspace_cenerated_code'.$ID,  
                                   // "role"=>"button",
                                   //'data-toggle'=>"tooltip", 
                         )
                );
              echo "
                  <button onclick='deleteUser(".$id.")' data-original-title='.btn .btn-danger' data-placement='top' class='btn btn-danger' type='button'>Delete</button>";
    }
    
    // END TEACHERS
    
    // TUTORS
    
    static public function getTutorInfo($model)
    {
        $model=json_encode($model);
        echo CHtml::ajaxLink(
                "Information",
                array('service/tutorinfomodal'),
                array(
                    'type' =>'POST',
                    'data' =>array('model'=>$model),
    //                      'beforeSend'=>'function(){ console.log("send") }',
                    'success'=> 'function(data){showPopUp(data,"");}',
//                        'update'=>'#website_list_result_tab' 
                    ),
                array('href'=>'#myModal',
                      'class'=>'btn btn-primary', 
                                //'id'=>'view_adspace_cenerated_code'.$ID,  
                               // "role"=>"button",
                               //'data-toggle'=>"tooltip", 
                     )
            );
    }
    
    static public function getTutorAction($id, $email)
    {
        echo CHtml::ajaxLink(
                    "Mail",
                    array('service/mailusermodal'),
                    array(
                        'type' =>'POST',
                        'data' =>array('email'=>$email),
        //                      'beforeSend'=>'function(){ console.log("send") }',
                        'success'=> 'function(data){showPopUp(data,"");}',
//                        'update'=>'#website_list_result_tab' 
                        ),
                    array('href'=>'#myModal',
                          'class'=>'btn btn-primary', 
                                    //'id'=>'view_adspace_cenerated_code'.$ID,  
                                   // "role"=>"button",
                                   //'data-toggle'=>"tooltip", 
                         )
                );
              echo "
                  <button onclick='deleteUser(".$id.")' data-original-title='.btn .btn-danger' data-placement='top' class='btn btn-danger' type='button'>Delete</button>";
    }
    
    // END TUTORS
    
    // Static Data
    
    static public function getStaticDataAction($id, $type, $name)
    {                
        echo CHtml::ajaxLink(
                    "Edit",
                    array('service/editstaticdatamodal'),
                    array(
                        'type' =>'POST',
                        'data' =>array('sd_id'=>$id, 'sd_type'=>$type, 'sd_name'=>$name),
        //                      'beforeSend'=>'function(){ console.log("send") }',
                        'success'=> 'function(data){showPopUp(data,"");}',
//                        'update'=>'#website_list_result_tab' 
                        ),
                    array('href'=>'#myModal',
                          'class'=>'btn btn-primary action-btn', 
                          'data-original-title'=>'.btn .btn-primary', 
                          'data-placement'=>'top', 
                          'id'=>$type."_".$id,
                          'type'=>'button',
                        
                                    //'id'=>'view_adspace_cenerated_code'.$ID,  
                                   // "role"=>"button",
                                   //'data-toggle'=>"tooltip", 
                         )
                );
        echo CHtml::ajaxLink(
                    "Delete",
                    array('service/deletestaticdata'),
                    array(
                        'type' =>'POST',
                        'data' =>array('sd_id'=>$id, 'sd_type'=>$type),
        //                      'beforeSend'=>'function(){ console.log("send") }',
                        'success'=> 'function(data){
                            document.getElementById("'.$type.'_'.$id.'").parentNode.parentNode.style.display = "none";
                        }',                        
                        'error'=>'function(data){alert("Cannot delete this data, becouse this data are used")}'
//                        'update'=>'#website_list_result_tab' 
                        ),
                    array(
                          'class'=>'btn btn-danger action-btn', 
                          'data-original-title'=>'.btn .btn-danger', 
                          'data-placement'=>'top',                           
                          'type'=>'button',
                        
                                    //'id'=>'view_adspace_cenerated_code'.$ID,  
                                   // "role"=>"button",
                                   //'data-toggle'=>"tooltip", 
                         )
                );
    } 
    
    // End Static Data
    
    
}   
?>
