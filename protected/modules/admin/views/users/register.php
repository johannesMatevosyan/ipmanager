<div class="row user-register">
    <div id="massage">
        <?php
        if($ok == 1)
        {
            Yii::app()->user->setFlash('success', $massage);
            echo '<meta http-equiv="refresh" content="8;URL=/">';
        }
        elseif($ok == 2) { Yii::app()->user->setFlash('error', $massage);}
        ?>
        <?php $this->widget('bootstrap.widgets.TbAlert', array(
            //'block'=>true, // display a larger alert block?
            'fade'=>true, // use transitions?
            'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
            'alerts'=>array( // configurations per alert type
                'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
                'error'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
                ),
            ));
        ?>
    </div>

    <div class="span6 register-form">
        <?php echo CHtml::beginForm(); ?>

                <?php
                    if($model->hasErrors()){
                        //Yii::app()->user->setFlash('error', $massage);//echo CHtml::errorSummary($model);
                    }
                ?>
                    <label>
                        <span><?php echo Yii::t("Անուն", "Անուն"); ?></span>
                        <?php echo CHtml::activeTextField($model,'userFName'); ?>
                        <?php //echo CHtml::error($model, 'userFName'); ?>
                    </label>
                    <label>
                        <span><?php echo Yii::t("Ազգանուն", "Ազգանուն"); ?></span>
                        <?php echo CHtml::activeTextField($model,'userLName'); ?>
                    </label>
                    <label>
                        <span><?php echo Yii::t("Էլ_փոստ", "Էլ. փոստ"); ?></span>
                        <?php echo CHtml::activeEmailField($model,'userEmail'); ?>
                    </label>
                    <label>
                        <span><?php echo Yii::t("Կրկնել_Էլ_փոստը", "Կրկնել Էլ. փոստը"); ?></span>
                        <?php echo CHtml::activeEmailField($model,'userEmail_confirm'); ?>
                    </label>
                    <label>
                        <span><?php echo Yii::t("Հեռախոս", "Հեռախոս"); ?></span>
                        <?php echo CHtml::activeTextField($model,'userPhone'); ?>
                    </label>
                    <label>
                        <span><?php echo Yii::t("Գաղտնաբառ", "Գաղտնաբառ"); ?></span>
                        <?php echo CHtml::activePasswordField($model,'userPassword'); ?>
                    </label>
                    <label>
                        <span><?php echo Yii::t("Կրկնել_Գաղտնաբառը", "Կրկնել Գաղտնաբառը"); ?></span>
                        <?php echo CHtml::activePasswordField($model,'userPassword_confirm'); ?>
                    </label>
                    <div class="reg-btn">
                        <button type="submit"><?php echo Yii::t("Գրանցվել", "Գրանցվել"); ?></button>
                    </div>
                <?php echo CHtml::endForm(); ?>

    </div>
    <div class="span6 register-img">
        <img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/cars/frontend/img/green-car.jpg">
    </div>
</div>