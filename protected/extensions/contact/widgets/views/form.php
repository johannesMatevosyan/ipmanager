<section>
    <div class="container">
    	<div class="row">
        	<div class="span8 contactsContent homeContent">
            	<h1 style = "margin-left:-5px !important;">Контакты</h1>
                <div class="infoBlock">
           
                    <span>Напишите нам</span>

              <?php 
              if($this->errors)
               foreach ($this->errors as $key => $value) {
                       echo '<span style = "color:red">';
                       print_r($value[0]); 
                       echo '</span>';
                }
            ?>
                </div>
              <?php      
           $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'action'=>Yii::app()->createUrl('contact/sendmessage'),
            'method' => 'POST',
            'enableClientValidation'=>true,
            'clientOptions'=>array(
                'validateOnSubmit'=>true,
                ),
            'htmlOptions'=>array('enctype'=>'multipart/form-data')
            )); 
        ?>
        <div class ="row">
            <?php echo $form->errorSummary($model); ?>
            <?php echo $form->textField($model, 'firstname', array('placeholder'=>'Ваше имя', 'class'=>'span7')); ?>
        </div>
            <?php //echo $form->error($model,'firstname'); ?>
        <div class ="row">
            <?php echo ($this->form_phone === TRUE)?$form->textField($model, 'phone', array('placeholder'=>'Ваш Телефонный номер')):""; ?>
            <?php //echo $form->error($model,'phone'); ?>
        </div>
        <div class ="row">
            <?php echo ($this->form_email === TRUE)?$form->textField($model, 'email', array('placeholder'=>'Ваш e-mail адрес')):""; ?>      
            <?php //echo $form->error($model,'email'); ?>
        </div>
        <div class ="row">
            <?php echo ($this->form_topic === TRUE)?$form->textField($model, 'topic', array('placeholder'=>'Введите тему сообщения')):""; ?>        
            <?php //echo $form->error($model,'topic'); ?>
        </div>
        <div class ="row">
            <?php echo $form->textArea($model, 'message', array('placeholder'=>'Введите текст сообщения')); ?>     
            <?php //echo $form->error($model,'message'); ?>
        </div>           
           <div class = "btn-line">
                <?php echo CHtml::submitButton('ОТПРАВИТЬ', array('class'=>'send-contact')) ;?>
            </div>
     </div>
        <?php $this->endWidget(); Yii::app()->user->setState('ok', '');?>
            <div class = "row">
                <div class = "span8" style = "margin-left:80px;margin-bottom:20px;"><i>Найдите нас на карте</i></div>
            </div>
       </div>       
    </div>
 
</section>
