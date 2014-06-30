<?php $this->pageTitle= $homeData->PageTitle;
	  Yii::app()->clientScript->registerMetaTag($homeData->metaKey, 'keywords');
	  Yii::app()->clientScript->registerMetaTag($homeData->metaDesc, 'description');
?>

             	<div class="span9 homeContent">
            	<h1> <?php echo $homeData->PageName;?></h1>
				<br>
               <?php echo stripslashes($homeData->PageContent);?>
				</div>
    		</div>
        </div>
</section>
       