<?php 
	$form = $this->beginWidget('bootstrap.widgets.TbActiveForm',array(
		'id'=>'network-form',
	)); 
?>
	<?php echo $form->textFieldRow($ipAddress,'ip'); ?>

	<?php echo $form->numberFieldRow($ipAddress,'root_subnet'); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>@$network->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget();?>