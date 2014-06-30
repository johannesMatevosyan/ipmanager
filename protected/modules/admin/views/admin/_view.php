<?php
/* @var $this AdminController */
/* @var $data Articles */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('IdArticles')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->IdArticles), array('view', 'id'=>$data->IdArticles)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('articleName')); ?>:</b>
	<?php echo CHtml::encode($data->articleName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('articleAlias')); ?>:</b>
	<?php echo CHtml::encode($data->articleAlias); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('articleCategory')); ?>:</b>
	<?php echo CHtml::encode($data->articleCategory); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('articleImageName')); ?>:</b>
	<?php echo CHtml::encode($data->articleImageName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('articleImagePath')); ?>:</b>
	<?php echo CHtml::encode($data->articleImagePath); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('articleText')); ?>:</b>
	<?php echo CHtml::encode($data->articleText); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('articleDesc')); ?>:</b>
	<?php echo CHtml::encode($data->articleDesc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('articleActive')); ?>:</b>
	<?php echo CHtml::encode($data->articleActive); ?>
	<br />

	*/ ?>

</div>