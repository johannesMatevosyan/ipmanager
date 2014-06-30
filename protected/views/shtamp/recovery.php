 <?php
	$this->pageTitle =  'Восстановление Печатей';
 ?>

<div class="span8 homeContent order">

 	<h1>ВОССТАНОВЛЕНИЕ ПЕЧАТИ</h1>
	<br>
<div id="message" style = "border-radius:0px;" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
    <div id="message_body" style = "height:70px" class="modal-body"><div id="mail_massage"></div>
        <h4 style = "margin-top:30px;">Спасибо, ваше сообщение успешно отправлено !!!</h4>
         
    </div>
    <div class="modal-footer" id="message_footer">
        <button class="btn-info" data-dismiss="modal" aria-hidden="true">Close</button>
    </div>
    </div>
</div>

  <div class = "span8 homeContent">
    <?php 
    $errors = '';
    if($message == 1) {
      echo '<script type = "text/javascript">
        $("#message").modal("show");
      </script>';
    } elseif($message != NULL) {
      $errors = $message;
    }

     
           $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
             'method' => 'POST',
            'clientOptions'=>array(
                'validateOnSubmit'=>true,
                ),
            'htmlOptions'=>array('enctype'=>'multipart/form-data')
            )); 
        ?>

	    <div class="row-fluid galleryImage" style = "margin-left:-70px;">
        <?php 
        if($errors)
        foreach ($errors as $key => $value) {
                     echo '<span style = "color:red"><i>';
                     print_r($value[0]); 
                     echo '</i></span>';
                     echo '<br>';
                }
        ?>
	        
	    </div>
       <table>

		<tr>
       		<td>Прикрепите файл с оттисками</td>
       		<td><input type = "file" name = "RecoveryModel[mainfile_path]" accept="image/gif, image/jpeg,  image/png, text/plain, application/pdf, application/vnd.ms-excel, application/msword"></td>
       	</tr>


       	<tr>
       		<td>Продублировать нечитаемые<br> элементы печати или штампа</td>
       		<td><?php echo $form->textArea($model, 'info'); ?></td>
       	</tr>
		<tr>
       		<td><?php echo $form->label($model, 'phone'); ?></td>
       		<td><?php echo $form->textField($model, 'phone'); ?>      </td>
       	</tr>
       	<tr>
       		<td><?php echo $form->label($model, 'fio'); ?></td>
       		<td><?php echo $form->textField($model, 'fio'); ?></td>
       	</tr>
       	<tr>
       		<td><?php echo $form->label($model, 'email'); ?></td>
       		<td> <?php echo $form->textField($model, 'email'); ?>      </td>
       	</tr>

      	<tr>
       		<td>Приложите копию свидетельства<br> о регистрации</td>
       		<td><input type = "file" name = "RecoveryModel[certificate_path]"  accept="image/gif, image/jpeg,  image/png, text/plain, application/pdf, application/vnd.ms-excel, application/msword"></td>
       	</tr>
  		<tr>
  			<td><?php echo $form->label($model, 'wishes'); ?></td>
            <td><?php echo $form->textArea($model, 'wishes'); ?></td>
      	</tr>
       </table>
           <div class = "btn-line">
                <input type = "submit" value = "ОТПРАВИТЬ" class = "send-contact">
            </div>
        <?php $this->endWidget(); ?>        

  </div>
</div >

