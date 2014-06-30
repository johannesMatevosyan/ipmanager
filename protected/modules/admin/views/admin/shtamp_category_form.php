<div style = "margin-left:450px">
	<h1>Добавление Категории</h1>
  

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
 <div style = "margin-left:100px;">
        <div class ="row">
        	<?php echo $form->label($shtampCategory, 'name'); ?>
            <?php echo $form->textField($shtampCategory, 'name', array('placeholder'=>'Название Страницы')); ?>      
            <?php echo $form->error($shtampCategory,'name'); ?>
        </div>
        <div class ="row">
        	<?php echo $form->label($shtampCategory, 'link'); ?>
            <?php echo $form->textField($shtampCategory, 'link', array('placeholder'=>'Ссылка Страницы',)); ?>
            <?php echo $form->error($shtampCategory,'link'); ?>
        </div>
   </div>
   <div style = "margin-left:-120px">
   	Описание
        <?php 
			$this->Widget('ext.filemanager.widgets.FManager', 
				array(
				'name'=>'ShtampCategoryModel[description]'
			));    
		?>
	</div>

           <div class = "btn-line" style = "margin-left:150px;margin-top:15px;">
                <?php echo CHtml::submitButton('СОХРАНИТЬ', array('class'=>'btn btn-info')) ;?>
           </div>
        <?php $this->endWidget(); ?>        

  </div>
