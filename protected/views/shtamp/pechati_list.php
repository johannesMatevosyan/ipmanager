 <?php
	$this->pageTitle =  $pageInfo->title;
	Yii::app()->clientScript->registerMetaTag($pageInfo->metaDesc, 'description');
	Yii::app()->clientScript->registerMetaTag($pageInfo->metaKey, 'keywords');
 ?>

 <div id="message" style = "border-radius:0px;" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
    <div id="message_body" style = "height:70px" class="modal-body"><div id="mail_massage"></div>
        <h4 style = "margin-top:30px;">Спасибо, ваш заказ успешнo отправлен !!!</h4>
         
    </div>
    <div class="modal-footer" id="message_footer">
        <button class="btn-info" data-dismiss="modal" aria-hidden="true">Close</button>
    </div>
    </div>
</div> 
  <?php 
    $errors = '';
    if($message == 1) {
      echo '<script type = "text/javascript">
        $("#message").modal("show");
      </script>';
    } elseif($message != NULL) {
      $errors = $message;
    }
    ?>

<div class="span8 homeContent order">
	<h1><?php echo $pageInfo->name;?></h1>
	<div class = "description"><?php echo $pageInfo->description;?></div>
	<br>
        <?php 
        if($errors)
        foreach ($errors as $key => $value) {
                       echo '<span style = "color:red"><i>';
                       print_r($value[0]); 
                       echo '</i></span>';
                       echo '<br>';
                }
        ?>
<h2 class = "item-header">Выберите Печать:</h2>

<form method = "POST" enctype="multipart/form-data">
	<div class = "shtamps">
		<?php 
			foreach ($shtamps as $key => $value) {
				echo '<div class = "item">';
        echo '<a class="fancybox-thumb-shtamp" rel="fancybox-thumb" href="'.Yii::app()->baseUrl.'/images/pechati/'.$value->image_path.'">';
				  echo '<img width = "100px" height = "100px" src = "'.Yii::app()->baseUrl.'/images/pechati/'.$value->image_path.'" alt = "'.$value->alt.'" title = "'.$value->title.'">';
        echo '</a>';
				echo '<input type = "radio" name = "OrderModel[pechat_id]" value = "'.$value->Id.'">';
				echo '</div>';
			}
		?>
	</div>
<div class = "new-line"></div>
<h2 class = "item-header">Выберите Оснастку:</h2>
	<div class = "osnastki">
		<?php 
			foreach ($osnastki as $key => $value) {
				echo '<div class = "item">';

        echo '<a class="fancybox-thumb-osnastka" rel="fancybox-thumb" href="'.Yii::app()->baseUrl.'/images/osnastki/'.$value->image_path.'">';
			   	echo '<img width = "100px" height = "100px" src = "'.Yii::app()->baseUrl.'/images/osnastki/'.$value->image_path.'" alt = "'.$value->alt.'" title = "'.$value->title.'">';
        echo '</a>';
        
				echo '<input type = "radio" name = "OrderModel[osnastka_id]" value = "'.$value->Id.'"><br>';
				echo '<span>'.$value->name.'</span><br>';
				echo '<span><i>'.$value->price.'</i></span><br>';
				echo '</div>';
			}
		?>
	</div>
	<div class = "new-line" style = "height:30px !important;"></div>
<h2 class = "item-header">Заполните поля формы заказа:</h2>


    <table class = "order-form-table"  style = "margin-left:0px;">
       	<tr>
       		<td><label for = "fullname">Полное наименование юр. лица с указанием организационно-правовой формы *</label></td>
       		<td><input type = "text" id = "fullname" name = "OrderModel[fullname]"></td>
       	</tr>
		<tr>
       			<td><label for = "place">Местонахождение юр.лица</label></td>
       		<td><input type = "text" id = "place" name = "OrderModel[place]"></td>
       	</tr>
       	<tr>
       			<td><label for = "oggrn">ОГРН</label></td>
       		<td><input type = "text" id = "oggrn" name = "OrderModel[oggrn]"></td>
       	</tr>
       	<tr>
       			<td><label for = "inn">ИНН</label></td>
       		<td><input type = "text" id = "inn" name = "OrderModel[inn]"></td>
       	</tr>

      	<tr>
       		<td><label for = "fio">Ваше ФИО *</label></td>
       		<td><input type = "text" id = "fio" name = "OrderModel[fio]"></td>
       	</tr>
  		<tr>
  			<td><label for = "phone">Контактный телефон</label></td>
       		<td><input type = "text" id = "phone" name = "OrderModel[phone]"></td>
      	</tr>


  		<tr>
  			<td><label for = "info">Дополнительная информация</label></td>
       		<td><textarea id = "info" name = "OrderModel[info]"></textarea></td>
      	</tr>

  		<tr>
  			<td>Прикрепить файл</td>
       		<td><input type = "file" name = "OrderModel[mainfile_path]"  accept="image/gif, image/jpeg,  image/png, text/plain, application/pdf, application/vnd.ms-excel, application/msword"></td>
      	</tr>

  		<tr>
  			<td>Прикрепить дополнительный файл</td>
       		<td><input type = "file" name = "OrderModel[file_path]"  accept="image/gif, image/jpeg,  image/png, text/plain, application/pdf, application/vnd.ms-excel, application/msword"></td>
      	</tr>

  		<tr>
  			<td>Выберите способ оплаты *</td>
       		<td>
       			<input type = "radio" id = "payment_cash" name = "OrderModel[payment_method]" value = "1"><label for = "payment_cash" style = "display:inline-block; margin-top:6px;margin-left:6px;">Наличными (при получении заказа)</label><br>
       			<input type = "radio" id = "payment_rekvizite" name = "OrderModel[payment_method]" value = "0"><label for = "payment_rekvizite"  style = "display:inline-block; margin-top:6px;margin-left:6px;">Безналичный расчёт (необходимо указать реквизиты)</label>
       		</td>
      	</tr>

       </table>
       <input type = "hidden" name = "OrderModel[category_id]" value = "<?php echo $pageInfo->name;?>">
       <div class = "btn-line">
       		<input type = "submit">
       </div>

</form>

</div>

<script type="text/javascript">
    (function( $ ) {   
        $(document).ready( function( ) {  
          $("a.fancybox-thumb-osnastka").fancybox({
               'type':'image',
             'width': 600, //or whatever you want
             'height': 300
            });

            $("a.fancybox-thumb-shtamp").fancybox({
               'type':'image',
             'width': 600, //or whatever you want
             'height': 300
            });

        });
    })(jQuery);      
</script>
