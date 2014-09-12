<style>
    .wrap{
        margin:0px !important;
    }
    .nav.pull-right{
        display: none;
    }
    .login_content{
        min-height: 700px;
        height: auto !important;
        height: 700px;
        margin: 0 auto;
    }
</style>
<div class="login_content">
<div class="row-fluid">
    <div id="massage" style = "text-align:center;">
        <?php
            if(@$ok == 1){Yii::app()->user->setFlash('success', @$massage);}
            elseif(@$ok == 2) {Yii::app()->user->setFlash('error', @$massage);}
        ?>
        <?php $this->widget('bootstrap.widgets.TbAlert', array(
            'block'=>true,
            'fade'=>true,
            'closeText'=>'&times;',
            'alerts'=>array(
                'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
                'error'=>array( 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
                ),
            ));
        ?>
    </div>
        <div class="offset2 register-form login-form">
        <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id'=>'login-form',
                'enableClientValidation'=>true,
                'action'=>Yii::app()->createUrl('/admin/users/login'),
        )); ?>

            <div class="modal show" role="dialog" style = "margin-top:60px;">
                <div class="modal-header">
                    <h3>Log in</h3>
                    <p>Please log in using your credentials</p>
                </div><!--modal-header-->
                <div class="modal-body">
            <table>
                <tr>
                    <td>Username</td>
                    <td><?php echo $form->textField($model,'username'); ?></td>
                    <?php //echo $form->error($model,'username'); ?>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><?php echo $form->passwordField($model,'password'); ?></td>
                    <?php //echo $form->error($model,'password'); ?>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <div class="reg-btn">
                            <button type="submit" class="btn btn-primary">Log in</button>
                        </div>
                    </td>
                </tr>
            </div><!--.modal-body-->
            </table>
                <div class="modal-footer">
                    IP Management Tool
                </div><!--modal-footer-->
            </div>

        <?php $this->endWidget(); ?>
    </div>
</div>
</div><!--.login_content-->