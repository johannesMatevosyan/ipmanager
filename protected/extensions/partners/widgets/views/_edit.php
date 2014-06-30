<!--View Image Modal-->
   <script>
       $(document).ready(function(){            
             $('#uploadImgLinkEdit').click(
                function()
                {
                    $('#uploadImageEdit').trigger('click');
                }
            );
            var p_edit = $("#uploadPreviewEdit");
            $("#uploadImageEdit").change(function(){
                    // fadeOut or hide preview
                    p_edit.fadeOut();

                    // prepare HTML5 FileReader
                    var oFReader = new FileReader();
                    oFReader.readAsDataURL(document.getElementById("uploadImageEdit").files[0]);

                    oFReader.onload = function (oFREvent) 
                    {
                        p_edit.attr('src', oFREvent.target.result).fadeIn();                
                    };     
            });           
        });
   </script>
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
            <?php echo $form->textFieldRow($model_edit, 'name', array('placeholder'=>'Partner Name')); ?>
            <?php echo $form->textFieldRow($model_edit, 'link', array('placeholder'=>'Example: http://teachpitch.com')); ?>  
            <div>
                <a id="uploadImgLinkEdit" class="btn btn-info">Upload Partner Banner</a>
                <input style="display: none;" id="uploadImageEdit" type="file" accept="image/jpeg" name="Image[files]" />
                <input type="hidden" name="action_type" value="edit" />
                <input type="hidden" name="partner_id" value="<?php echo $model_edit->IdPartner; ?>" />                
            </div>    
        </div>    
        <div class="img-upload img-preview">
            <img id="uploadPreviewEdit" src="<?php echo $this->assets."/upload_logo/".$model_edit->path; ?>" />
        </div>
    </div>
    <div class="modal-footer">
        <input class="btn btn-success" id="save_btn" type="submit" value="Save" />
        <button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo Yii::t("Close","Close"); ?></button>       
    </div>
    <?php $this->endWidget(); ?>

<!--End of Modal-->