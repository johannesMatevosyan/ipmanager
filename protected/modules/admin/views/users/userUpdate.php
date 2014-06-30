<div class="row">
    <div id="massage">
        <?php
        if($ok == 1){ Yii::app()->user->setFlash('success', $massage);}
        elseif($ok == 2) { Yii::app()->user->setFlash('error', $massage);}
        ?>
        <?php $this->widget('bootstrap.widgets.TbAlert', array(
            'block'=>true, // display a larger alert block?
            'fade'=>true, // use transitions?
            'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
            'alerts'=>array( // configurations per alert type
                'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
                'error'=>array( 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
                ),
            ));
        ?>
    </div>

    <div class="span12 user-profile  register-form">
        <h2>Моя информация</h2>
        <?php echo $this->renderPartial('_userUpdate',array('model'=>$model)); ?>
    </div>
</div>