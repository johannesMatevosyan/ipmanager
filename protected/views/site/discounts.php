<?php $this->pageTitle= $discountData->PageTitle;
	  Yii::app()->clientScript->registerMetaTag($discountData->metaKey, 'keywords');
	  Yii::app()->clientScript->registerMetaTag($discountData->metaDesc, 'description');
?>
<div class="row">


    <div class="span8 homeContent">
        <h1> <?php echo $discountData->PageName;?></h1>
        <br>

        <?php echo stripslashes($discountData->PageContent);?>
   </div>
</div>
