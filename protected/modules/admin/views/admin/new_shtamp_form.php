<div id = "pages-tabs" class = "add-slider-image">
  <h1 style = "margin-left:-100px">Добавление Печати</h1>
  <br>

      <?php      
           $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
             'method' => 'POST',
            'enableClientValidation'=>true,
            'clientOptions'=>array(
                'validateOnSubmit'=>true,
                ),
            'htmlOptions'=>array('enctype'=>'multipart/form-data')
            )); 
        ?>
        <div class ="row">
          <?php echo $form->label($shtamp, 'name'); ?>
            <?php echo $form->textField($shtamp, 'name', array('placeholder'=>'Alt картинки')); ?>
            <?php echo $form->error($shtamp,'name'); ?>
        </div>
       
        <div class ="row">
          <?php echo $form->label($shtamp, 'alt'); ?>
            <?php echo $form->textField($shtamp, 'alt', array('placeholder'=>'Alt картинки')); ?>
            <?php echo $form->error($shtamp,'alt'); ?>
        </div>
 
        <div class ="row">
          <?php echo $form->label($shtamp, 'title'); ?>
            <?php echo $form->textField($shtamp, 'title', array('placeholder'=>'Title картинки')); ?>      
            <?php echo $form->error($shtamp,'metaDesc'); ?>
        </div>


        <div class ="row">
          <?php echo $form->label($shtamp, 'price'); ?>
            <?php echo $form->textField($shtamp, 'price', array('placeholder'=>'Цена Печати')); ?>      
            <?php echo $form->error($shtamp,'price'); ?>
        </div>

            <div class="row-fluid galleryImage">
        <input id="Articles_ImageClear" type="hidden" value="0" name="ShtampsModel[ImageClear]">
        <div id="empty_image">
            <img style = "width:220px !important;height:191px !important;" src="<?php echo Yii::app()->request->baseUrl.'/themes/backend/img/no_img.jpg'; ?>" alt="no image">
        </div>
        <div id="article_image">
            <img style = "width:220px !important;height:191px !important;" src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo (!empty($model->articleImageName) ? $model->articleImagePath.'/thumb_'.$model->articleImageName:'themes/backend/img/no_img.jpg'); ?>" alt="">
        </div>
        <input type="file" name="ShtampsModel[]" id="gallery_image_input" onchange="js:loadImageFile(this)">
    </div>
           <div class = "btn-line" id = "addImageSubmitButton">
       <input type = "hidden" name = "ShtampsModel[category_id]" value = "<?php echo $category;?>">
                <?php echo CHtml::submitButton('СОХРАНИТЬ', array('class'=>'btn btn-info')) ;?>
            </div>
        <?php $this->endWidget(); ?>        

  </div>



</div>

<script type = "text/javascript">
$(function(){

    oFReader = new FileReader(),
    oFReader.onload = function (oFREvent)
    {
      var a = oFREvent.target.result;
      //alert(a);
      var img = '<img name="" style = "width:220px !important;height:191px !important;" src = '+a+' />';
      $('#article_image').html(img);
    };

    function loadImageFile(object)
    {
      var object_id = object.getAttribute('id');
      //alert(object_id);
      var oFile = document.getElementById(object_id).files[0];
      
      oFReader.readAsDataURL(oFile);
    }
});
</script>