<div class="row">
    <div class="span8 homeContent">
        <h2><?php echo $article['articleName']; ?></h2>
        <p><?php echo $article['articleText']; ?></p>
        <?php if(@!empty($article['articleImageName'])): ?>
            <img src="<?php echo Yii::app()->baseUrl.'/'.$article['articleImagePath'].'/'.$article['articleImageName']; ?>">
        <?php endif; ?>
    </div>
    <?php $this->renderPartial('blocks/measurer'); ?>
</div>
<?php $this->renderPartial('blocks/partners'); ?>