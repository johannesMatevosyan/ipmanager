<div class="sitemapButtons">
    <a class="btn btn-info" href="<?php echo Yii::app()->baseUrl.'/sitemap.xml'; ?>">XML формат</a>
    <?php
        echo CHtml::ajaxLink("Обновить sitemap.xml",
            Yii::app()->createUrl('admin/updateSitemap' ),
            array(
                'type'=> 'GET',
                'beforeSend'=>'js:loader("#updateMessage")',
                'success'=>'function(data){
                    if(data == 1){
                        $("#updateMessage").html("sitemap.xml обновлен!");
                    }
                    else{
                        $("#updateMessage").html("Ошыбка! sitemap.xml ne обновлен!");
                    }
                }',
            ),
            array(
                'class'=>'btn btn-success',
            )
        );
    ?>
    <span id="updateMessage"></span>
</div>
<div class="sitemapLinks">
    <?php
        //(Yii::getPathOfAlias('webroot').'/sitemap.xml');

        if($xml = simplexml_load_file(Yii::getPathOfAlias('webroot').'/sitemap.xml')){
        //var_dump($xml->children());die;
            echo '<ul>';
            foreach($xml->children() as $child) {
                $role = $child->attributes();
                echo '<li><a target="_blank" href="'.$child->loc.'">'.$child->loc.'</a> <span>обновлен '.$child->lastmod.'</span></li>';
            }
            echo '</ul>';
        }

    ?>
</div>