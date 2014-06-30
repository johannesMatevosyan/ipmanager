<?php $this->pageTitle= $aboutData->PageTitle;
	  Yii::app()->clientScript->registerMetaTag($aboutData->metaKey, 'keywords');
	  Yii::app()->clientScript->registerMetaTag($aboutData->metaDesc, 'description');
?>
<div class="row">
    <div class="span8 homeContent">
    	<h1><?php echo $aboutData->PageName;?></h1>
		<?php echo stripslashes($aboutData->PageContent);?>     
      		
    </div>
</div>
<?php //$this->renderPartial('blocks/partners'); ?>