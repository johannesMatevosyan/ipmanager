<?php
/* @var $this ArticlesController */
/* @var $model Articles */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'IdArticles'); ?>
		<?php echo $form->textField($model,'IdArticles'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'articleName'); ?>
		<?php echo $form->textField($model,'articleName',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'articleAlias'); ?>
		<?php echo $form->textField($model,'articleAlias',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'articleCategory'); ?>
		<?php echo $form->textField($model,'articleCategory'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'articleImageName'); ?>
		<?php echo $form->textArea($model,'articleImageName',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'articleImagePath'); ?>
		<?php echo $form->textArea($model,'articleImagePath',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'articleText'); ?>
		<?php echo $form->textArea($model,'articleText',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'articleDesc'); ?>
		<?php echo $form->textArea($model,'articleDesc',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'articleActive'); ?>
		<?php echo $form->textField($model,'articleActive'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->