<div id='add_partner'>
    <a href="#newPartner" role="button" class="btn btn-info static-data-add" data-toggle="modal" id="newPartnerLink" >Add New Partner</a>
</div>
<div>&nbsp;</div>
<?php

    $this->widget('bootstrap.widgets.TbGroupGridView', 
        array(
            'enableSorting' => TRUE,
            'dataProvider' => $dataprovider,
            'ajaxUpdate'=>false,
            'template' => "{items}\n{pager}",
            'columns' => array(
                array('name'=>'IdPartner', 'header'=>Yii::t("Id","Id")),
                array('name'=>'name', 'header'=>Yii::t("Partner_name","Partner Name"),'type'=>'html'),                                        
                array('value'=>'AdminActions::getLink($data["link"])', 'header'=>Yii::t("Url_to_partner_site","Url to Partner Site"), 'type'=>'html'),                                                                        
                array('name'=>'path', 'header'=>Yii::t("Image_path","Image Path"), 'type'=>'html'),                                       //                                                               
                array('value'=>'AdminActions::getImage($data)', 'header'=>Yii::t("Image","Image"), 'type'=>'html'),
                array('value'=>'AdminActions::getDate($data["date"])', 'header'=>Yii::t("Add_date","Add Date"), 'type'=>'html'),
                array('value'=>'AdminActions::getStatus($data)', 'header'=>Yii::t("Status","Status"), 'type'=>'html'),
                array('value'=>'AdminActions::getActions($data)', 'header'=>Yii::t("Actions","Actions"), 'type'=>'html'),
                ),
            'pagerCssClass'=>'paging-bottoms',
            'pager'=>array(
                'header'=>'',
                'maxButtonCount'=>5,
                ),
            'htmlOptions'=>array(
            'id'=>$this->htmlOptions['id'],
            'class'=>$this->htmlOptions['class'],
            )
            )
        );

?>
<input type="hidden" id="base-url" value="<?php echo Yii::app()->request->baseUrl?>" />

<!--View Image Modal-->

<a href="#showImage" role="button" class="btn" data-toggle="modal" id="showImageLink" style=" display:none;"></a>
<div id="showImage" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">    
    <div class="modal-header">            
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>            
        <h2>Partner Image</h2>
    </div>
    <div class="modal-body">
        <img src='' id="modal_image" />
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo Yii::t("Close","Close"); ?></button>       
    </div>
</div>

<!--End of Modal-->



<!--New Partner Modal-->

<a href="#newPartner" role="button" class="btn" data-toggle="modal" id="newPartnerLink" style=" display:none;"></a>
<div id="newPartner" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">    
    <div class="modal-header">            
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>            
        <h2>Add New Partner</h2>
    </div>
    <?php 
        $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id'=>'registration-form-teacher',
            'action'=>'',
            'type'=>'vertical',
            'enableClientValidation'=>true,
            'clientOptions'=>array(
            'validateOnSubmit'=>true,            
            ),
            'htmlOptions'=>array('enctype'=>"multipart/form-data")
        ));
    ?>
    <div class="modal-body">      
        <div class="img-upload">
            <?php echo $form->textFieldRow($model_new, 'name', array('placeholder'=>'Partner Name')); ?>
            <?php echo $form->textFieldRow($model_new, 'link', array('placeholder'=>'Example: http://teachpitch.com')); ?>              
            <div>
                <a id="uploadImgLink" class="btn btn-info">Upload Partner Banner</a>
                <?php echo $form->textFieldRow($model_new, 'path', array('class'=>'partner_path', 'style'=>'display:none')); ?>  
                <input style="display: none;" id="uploadImage" type="file" accept="image/jpeg" name="Image[files]" />
                <input type="hidden" name="action_type" value="new" />                
            </div>    
        </div>    
        <div class="img-upload img-preview">
            <img id="uploadPreview" style="display:none;"/>
        </div>
    </div>
    <div class="modal-footer">
        <input class="btn btn-success" id="save_btn" type="submit" value="Save" />
        <button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo Yii::t("Close","Close"); ?></button>       
    </div>
    <?php $this->endWidget(); ?>
</div>

<!--End of Modal-->

<a href="#edit" role="button" class="btn" data-toggle="modal" id="editLink" style=" display:none;"></a>
<div id="edit" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
    
</div>