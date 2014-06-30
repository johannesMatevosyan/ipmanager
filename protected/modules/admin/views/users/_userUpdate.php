
<?php echo CHtml::beginForm(); ?>

    <?php
        if($model->hasErrors()){
            //echo CHtml::errorSummary($model);
        }
    ?>

    <label>
        <span>Имя</span>
        <?php echo CHtml::activeTextField($model,'userFName'); ?>
    </label>
    <label>
        <span>Фамилия</span>
        <?php echo CHtml::activeTextField($model,'userLName'); ?>
    </label>
    <label>
        <span>Эл. почта</span>
        <?php echo CHtml::activeEmailField($model,'userEmail', array('disabled'=>'disabled')); ?>
    </label>
   
    <label>
        <span>Телефон</span>
        <?php echo CHtml::activeTextField($model,'userPhone'); ?>
    </label>
    
    <label>
        <span>Новый пароль</span>
        <?php echo CHtml::activePasswordField($model,'userPassword_new'); ?>
    </label>
    <label>
        <span>Повторить пароль</span>
        <?php echo CHtml::activePasswordField($model,'userPassword_confirm'); ?>
    </label>
    <div class="reg-btn">
        <button type="submit" class="btn btn-info">Сохранить изменения</button>
    </div>
<?php echo CHtml::endForm(); ?>