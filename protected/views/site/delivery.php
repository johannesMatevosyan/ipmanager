<?php $this->pageTitle= $deliveryData->PageTitle;
	  Yii::app()->clientScript->registerMetaTag($deliveryData->metaKey, 'keywords');
	  Yii::app()->clientScript->registerMetaTag($deliveryData->metaDesc, 'description');
?>
<div class="row">
    <div class="span8 homeContent">
        <h1><?php echo $deliveryData->PageName?></h1>
        <br>
<?php echo stripslashes($deliveryData->PageContent)?>
    </div>
    <?php // $this->renderPartial('blocks/measurer'); ?>
</div>
<?php //$this->renderPartial('blocks/partners'); ?>