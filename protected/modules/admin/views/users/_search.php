<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'IdUsers',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'userRole',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'userFName',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'userLName',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'userEmail',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'userPhone',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'userPassword',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'userRegDate',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'userBallance',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
