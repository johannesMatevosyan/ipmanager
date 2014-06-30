<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/backend/css/article.edit.css" />
<script type = "text/javascript">
$(function(){
	$('.existPriceListDelete').click(function(){
			var identifier = $(this).data('identifier');
			$('#existedFiles #existPriceListName_'+identifier).remove();
			$('#existedFiles #existPriceListPath_'+identifier).remove();
			$(this).remove();
	});
});
	
	var counter = 0;
	function addTextbox()
	{
		$("#imagepath_wrap input[type='file']").last().attr('data-counter',counter); 
		$(".MultiFile-list .MultiFile-label:last-child").append('<input type = "text" name = "input' + counter + '" >'); 
		counter += 1;
	}
	
	function deleteTextbox(e, v, m)
	{
		alert($(e).data('counter'));
	}
	
</script>
<div class="form">

<?php
    $form=$this->beginWidget('CActiveForm', array(
	'id'=>'articles-form',
    'enableClientValidation'=>true,
        'method'=>'post',
        //'action' => Yii::app()->createUrl('admin/CreateArticle'),
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
            'afterValidate' => 'js:function(form, data, hasError)
                {
                    if(hasError)
                    {
                        alert("заполните все нужные поля!");
                    }
                    else {return true;}
                }',
        ),
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
        )
    ));
?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row-fluid articleName">
		<?php echo $form->labelEx($model,'articleName'); ?>
		<?php echo $form->textField($model,'articleName',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'articleName'); ?>
	</div>
 
	<div class="row-fluid articleCategory">
        <?php echo $form->labelEx($model,'articleCategory'); ?>
        <?php
            echo $form->dropDownList($model, 'articleCategory', Adminhelper::article_category(), array(
                'empty' => 'Выберите категорию',
            ));
        ?>
        <?php echo $form->error($model,'articleCategory'); ?>
	</div>

    <div class="row-fluid articleImage">
        <input id="Articles_ImageClear" type="hidden" value="0" name="Articles[ImageClear]">
        <div id="empty_image">
            <img src="<?php echo Yii::app()->request->baseUrl.'/themes/backend/img/no_img.jpg'; ?>" alt="no image">
        </div>
        <div id="article_image">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo (!empty($model->articleImageName) ? $model->articleImagePath.'/thumb_'.$model->articleImageName:'themes/backend/img/no_img.jpg'); ?>" alt="">
        </div>
        <input type="file" name="Images[files][]" id="article_image_input" onchange="js:loadImageFile(this)">
        <button type="button" id="clear_article_image" class="btn btn-info">Удалить картинку</button>
    </div>
    
	<div class="row-fluid articleText">
		<?php echo $form->labelEx($model,'articleText'); ?>
		<?php echo $form->textArea($model,'articleText',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'articleText'); ?>
	
	</div>
		<div class="row-fluid articleText">
		<?php echo $form->labelEx($model,'metaKey'); ?>
		<?php echo $form->textArea($model,'metaKey',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'metaKey'); ?>
	</div>
	
	<div class="row-fluid articleText">
		<?php echo $form->labelEx($model,'metaDesc'); ?>
		<?php echo $form->textArea($model,'metaDesc',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'metaDesc'); ?>
	</div>

	<div class="row-fluid articleText">
		<?php echo $form->labelEx($model,'articleLink'); ?>
		<?php echo $form->textField($model,'articleLink',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'articleLink'); ?>
	</div>

	<div class="row-fluid articleDesc">
		<?php echo $form->labelEx($model,'articleDesc'); ?>
		<?php // echo $form->textArea($model,'articleDesc',array('rows'=>6, 'cols'=>50)); ?>
		<?php 
				$this->Widget('ext.filemanager.widgets.FManager', 
					array(
						'editorHtml' => $model->articleDesc,
					));    
		?>
		
		<?php echo $form->error($model,'articleDesc'); ?>
	</div>
	

  <div id ="existedFiles" style = "float:right;">

  <?php 
  if($model->articlePricelist && !empty($model->articlePricelist)) {
    echo '<label>Загруженные файлы</label>';
	$existed_price_lists = (unserialize($model->articlePricelist));
	$i = 0;
		foreach ($existed_price_lists as $key => $value) {
				echo '<input type = "text" value = "'.$key.'" id = "existPriceListName_'.$i.'" name = "existPriceListName[]">';
				echo '<input type ="hidden" value = "'.$value.'"  id = "existPriceListPath_'.$i.'" name = "existPriceListPath[]">';
				echo '<span class = "existPriceListDelete" title ="Удалить файл" data-identifier = "'.$i.'" style = "color:red;cursor:pointer;">&nbsp;x</span>';
				echo '<br>';
				$i++;
		}
	}
?>	
</div>
<div class="uploadDiv" id = "uploadDivPriceList">
        <label for="uploadImageCount" id = "choosePriceList">Выберите количество загружаемых прайс-листов</label><input type="text" id="uploadImageCount" value="1">
            <ul class="uploadUl">
                <li>
                    <input type="file" class = "articleFile" name="Articles[priceList][]">
				
                </li>
					<input type = "text" name = "filenameArr[0]" placeholder = "Enter File Name">
            </ul>
         <!--   <button type="button" class="btn btn-info" id = "cancel_file_inputs">Отменить выбор</button>-->
    </div>
	
	
		</div>
	<div class="row-fluid articleActive">
		<?php
            $activeArray = array(1 => 'Виден', 0 => 'Не виден');
            echo $form->dropDownList($model, 'articleActive', $activeArray);
        ?>
	</div>

	<div class="row-fluid buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить изменения', array("class" => "btn btn-info", 'id'=>'submitButton')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->