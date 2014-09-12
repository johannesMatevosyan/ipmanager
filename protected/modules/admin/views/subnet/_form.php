<?php 
	$form = $this->beginWidget('bootstrap.widgets.TbActiveForm',array(
		'id'=>'network-form',
	)); 
	$subnetList = array_combine(range(8, 30), range(8, 30));
?>
	

	<?php echo $form->textFieldRow($network,'ip', array('class' => 'ip-change-element')); ?>

	<?php echo $form->dropDownListRow($network, 'subnet', $subnetList , array('class' => 'ip-change-element', 'options' => array(24=>array('selected'=>true)))); ?>

	<div id = "available-used" style = "padding-bottom:15px; "></div>
	<?php // echo $form->textFieldRow($network,'hosts'); ?>

	<?php echo $form->textFieldRow($network,'site_id'); ?>

	<?php echo $form->textAreaRow($network,'site_details'); ?>
	
	<?php echo $form->textFieldRow($network,'vlan_id'); ?>
	
	<?php echo $form->textFieldRow($network,'purpose'); ?>


	<?php echo $form->textAreaRow($network,'comments'); ?>


	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$network->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget();?>
