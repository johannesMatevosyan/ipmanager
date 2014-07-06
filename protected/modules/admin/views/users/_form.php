<?php 
	$form = $this->beginWidget('bootstrap.widgets.TbActiveForm',array(
		'id'=>'users-form',
	)); 
?>

	<?php echo $form->textFieldRow($user,'userFName',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($user,'userEmail',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($user,'userPassword',array('class'=>'span5','maxlength'=>255)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
