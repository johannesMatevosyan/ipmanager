<?php 
	$this->pageTitle = "контакты";
?>
<div id="image_view_popup" style = "border-radius:0px;" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
    <div id="message_body" style = "height:70px" class="modal-body"><div id="mail_massage"></div>
        <h4 style = "margin-top:30px;">Спасибо, ваше сообщение успешно отправлено !!!</h4>
         
    </div>
    <div class="modal-footer" id="message_footer">
        <button class="btn-info" data-dismiss="modal" aria-hidden="true">Close</button>
    </div>
    </div>
</div>

<div class="row">
	<div class = "span8 homeContent">
		<?php 
		$errors = '';
		if(Yii::app()->user->getState('ok') == 1) {

			echo '<script type = "text/javascript">
				$("#image_view_popup").modal("show");
			</script>';
		} elseif(Yii::app()->user->getState('ok') != NULL) {
			$errors = Yii::app()->user->getState('ok');
		}

		?>
    <?php
        $this->Widget('ext.contact.widgets.Contact', 
            array(
            		'errors'=>$errors,
                ));
    ?>
    <div id = "ymaps" width = "1000px;">
        <script type="text/javascript" charset="utf-8" src="//api-maps.yandex.ru/services/constructor/1.0/js/?sid=u0tNWzi4xt-ZgFJAEDKjBV8p9X8jWcrW&width=670&height=450"></script>
    </div>
</div>
</div>
<?php // $this->renderPartial('blocks/partners'); ?>

