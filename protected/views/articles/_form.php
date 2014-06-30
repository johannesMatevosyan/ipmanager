<?php
/* @var $this ArticlesController */
/* @var $model Articles */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'articles-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'articleName'); ?>
		<?php echo $form->textField($model,'articleName',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'articleName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'articleAlias'); ?>
		<?php echo $form->textField($model,'articleAlias',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'articleAlias'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'articleCategory'); ?>
		<?php echo $form->textField($model,'articleCategory'); ?>
		<?php echo $form->error($model,'articleCategory'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'articleImageName'); ?>
		<?php echo $form->textArea($model,'articleImageName',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'articleImageName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'articleImagePath'); ?>
		<?php echo $form->textArea($model,'articleImagePath',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'articleImagePath'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'articleText'); ?>
		<?php echo $form->textArea($model,'articleText',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'articleText'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'articleDesc'); ?>
		<?php echo $form->textArea($model,'articleDesc',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'articleDesc'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'articleActive'); ?>
		<?php echo $form->textField($model,'articleActive'); ?>
		<?php echo $form->error($model,'articleActive'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->