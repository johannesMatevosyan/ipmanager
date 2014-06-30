<?php

class AdminActions extends CActiveRecord
{
    public static function getActions($model)
    {        
        if ($model["aprove"]=='1')
        {
            echo "<button id='show_hide_".$model["IdPartner"]."' onclick='showHidePartner(".$model["IdPartner"].")' data-original-title='.btn .btn-primary' data-placement='top' class='btn btn-primary' type='button'>Hide</button>";
        }
        else 
        {
            echo "<button id='show_hide_".$model["IdPartner"]."' onclick='showHidePartner(".$model["IdPartner"].")' data-original-title='.btn .btn-success' data-placement='top' class='btn btn-success' type='button'>Show</button>";
        }
        echo "              
              <button id='edit_btn_".$model["IdPartner"]."' onclick='editPartner(".$model["IdPartner"].")' data-original-title='.btn .btn-info' data-placement='top' class='btn btn-info' type='button'>Edit</button>
              <button id='delete_btn_".$model["IdPartner"]."' onclick='deletePartner(".$model["IdPartner"].")' data-original-title='.btn .btn-danger' data-placement='top' class='btn btn-danger' type='button'>Delete</button>
             ";        
    }
        
    public static function getStatus($model)
    {
        if ($model['aprove']=="1")
        {
            echo "<span id='status_".$model["IdPartner"]."' class='badge badge-success'>Show</span>";
        }
        else
        {
            echo "<span id='status_".$model["IdPartner"]."' class='badge badge-important'>Hide</span>";
        }
    }   
    
    public static function getLink($link)
    {
        echo "<a target='_blank' href='".$link."'>".$link."</a>";
    }
    
    public static function getImage($model)
    {
        echo CHtml::ajaxLink(
                "Image view",
                array(''),
                array(
                    'type' =>'POST',
                    'data' =>array('model'=>  json_encode($model), 'show_image'=>'ok'),
    //                      'beforeSend'=>'function(){ console.log("send") }',
                    'success'=> 'function(data)
                        {
                            $("#modal_image").attr("src", "'.Yii::app()->request->baseUrl.'/protected/extensions/partners/assets/upload_logo/'.$model['path'].'");
                            $("#showImageLink").trigger("click");    
                        }',
//                        'update'=>'#website_list_result_tab' 
                    ),
                array('href'=>'#myModal',
                      'class'=>'btn btn-info', 
                                //'id'=>'view_adspace_cenerated_code'.$ID,  
                               // "role"=>"button",
                               //'data-toggle'=>"tooltip", 
                      )
            );
    }
    
    public static function getDate($date)
    {
        $y=substr($date, 0, 4);
        $m=substr($date, 5, 2);
        $day=substr($date, 8, 2);
        
        echo date("d F, Y", mktime(0, 0, 0, $m, $day, $y));
    }
}