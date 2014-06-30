<div class="row">
    <div class="span8 galleryContent">
        <h2>Фотогаллерея</h2>
        <div id="gallery" data-toggle="modal-gallery" data-target="#modal-gallery" data-filter="*" >
            <?php $this->beginWidget('bootstrap.widgets.TbImageGallery'); ?>
                <ul>
                    <?php for($i = $imgStart; $i < $imgEnd; $i++): ?>
                    <li id="<?php echo 'li_image_'.$i; ?>">
                        <a href="<?php echo Yii::app()->baseUrl.'/images/gallery/'.$galleryImages[$i]; ?>" data-gallery="gallery">
                            <img src="<?php echo Yii::app()->baseUrl.'/images/gallery/thumb_'.$galleryImages[$i]; ?>" alt="" id="<?php echo 'link_image_'.$i; ?>" rel="list-gallery">
                        </a>
                    </li>
                    <?php endfor; ?>
                </ul>
            <?php $this->endWidget(); ?>
        </div>
        <div class="paginator">
            <?php for($i = 1; $i <= $pageCount; $i++): ?>
                <?php
                if((!isset($_GET['page']) && $i == 1) || (isset($_GET['page']) && $_GET['page'] == $i))
                    {$pagerClass = 'active';}
                else
                    {$pagerClass = '';}
            ?>
            <a href="<?php echo Yii::app()->createUrl('site/gallery', array('page'=>$i)); ?>" class="<?php echo $pagerClass; ?>" ><?php echo $i; ?></a>
            <?php endfor; ?>
        </div>
    </div>
    <?php $this->renderPartial('blocks/measurer'); ?>
</div>
<?php $this->renderPartial('blocks/partners'); ?>