<style>
    .wrap{
        margin:0px !important;
    }
    .nav.pull-right{
        display: none;
    }
</style>
<div class="row-fluid">
    <div id="massage">
        <?php
            if(@$ok == 1){Yii::app()->user->setFlash('success', @$massage);}
            elseif(@$ok == 2) {Yii::app()->user->setFlash('error', @$massage);}
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
        <div class="offset2 register-form login-form">
        <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id'=>'login-form',
                //'type'=>'horizontal',
                'enableClientValidation'=>true,
//                'clientOptions'=>array(
//                        'validateOnSubmit'=>true,
//                ),
        )); ?>

            <div class="modal show" role="dialog">
                <div class="modal-header">
                    <h3>Log in</h3>
                    <p>Please log in using your credentials</p>
                </div><!--modal-header-->
                <div class="modal-body">
            <table>
                <tr>
                    <td>Email</td>
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