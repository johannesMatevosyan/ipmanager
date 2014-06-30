<div id = "pages-tabs">

<ul class="nav nav-tabs" id="pages">
  <li<?php if($page_id == 1) echo ' class="active"';?>><a href="<?php echo Yii::app()->createUrl('admin/admin/pages', array('page_id'=>1));?>">Главная</a></li>
  <li<?php if($page_id == 2) echo ' class="active"';?>><a href="<?php echo Yii::app()->createUrl('admin/admin/pages', array('page_id'=>2));?>">О Компании</a></li>
  <li<?php if($page_id == 3) echo ' class="active"';?>><a href="<?php echo Yii::app()->createUrl('admin/admin/pages', array('page_id'=>3));?>">Скидки</a></li>
  <li<?php if($page_id == 4) echo ' class="active"';?>><a href="<?php echo Yii::app()->createUrl('admin/admin/pages', array('page_id'=>4));?>">Доставка</a></li>
</ul>
 <div class = "tab-pane">
 	<br>
 	<?php
 	$header = "Главная";
 	 switch($page_id){
 		case 1:
	 		$header = 'Главная';
	 		break;
		case 2:
 			$header = 'О Компании';
 			break;
		case 3:
 			$header = 'Скидки';
 			break;
		case 4:
 			$header = 'Доставка';
 			break;
 	}
 	?>
 	<h1 style = "padding-left:185px"><?php echo $header;?></h1>
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
          <?php echo $form->label($pageModel, 'Название Страницы'); ?>
            <?php echo $form->textField($pageModel, 'PageName', array('placeholder'=>'Заголовок Страницы', 'value'=>$pageData->PageName)); ?>
            <?php echo $form->error($pageModel,'PageName'); ?>
        </div>

        <div class ="row">
          <?php echo $form->label($pageModel, 'Заголовок Страницы'); ?>
            <?php echo $form->textField($pageModel, 'PageTitle', array('placeholder'=>'Заголовок Страницы', 'value'=>$pageData->PageTitle, 'id'=>'page-title-input')); ?>
            <?php echo $form->error($pageModel,'PageTitle'); ?>
        </div>
 
        <div class ="row">
        	<?php echo $form->label($pageModel, 'metaKey'); ?>
            <?php echo $form->textArea($pageModel, 'metaKey', array('placeholder'=>'Мета Ключи', 'value'=>$pageData->metaKey,'rows' => 6, 'cols' => 160, 'class'=>'page-textarea')); ?>
            <?php echo $form->error($pageModel,'metaKey'); ?>
        </div>
 
        <div class ="row">
        	<?php echo $form->label($pageModel, 'metaDesc'); ?>
            <?php echo $form->textArea($pageModel, 'metaDesc', array('placeholder'=>'Мета Описание', 'value'=>$pageData->metaDesc,'rows' => 6, 'cols' => 150, 'class'=>'page-textarea')); ?>      
            <?php echo $form->error($pageModel,'metaDesc'); ?>
        </div>
 
        <div class ="row">
                  <?php // echo $pageData->PageContent; die;
				$this->Widget('ext.filemanager.widgets.FManager', 
					array(
						'editorHtml' => nl2br($pageData->PageContent),
						'name'=>'Pages[PageContent]'
					));    
		?>
        </div>
        <div class ="row">
            <input type = "hidden" value = "<?php echo $page_id?>" name = "Pages[Id]">
        </div>           
           <div class = "btn-line" style = "">
                <?php echo CHtml::submitButton('СОХРАНИТЬ', array('class'=>'btn btn-info')) ;?>
            </div>
        <?php $this->endWidget(); ?>        

  </div>



</div>
