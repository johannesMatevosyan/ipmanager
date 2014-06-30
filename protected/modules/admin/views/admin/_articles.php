<div class="item" id="<?php echo 'article_item_'.$data->IdArticles; ?>">
    <span class="articleName"><a href="<?php echo Yii::app()->createUrl('admin/updateArticle/'.$data->IdArticles.''); ?>"><?php echo $data->articleName; ?></a></span>
    <span class="articleImage">
        <a href="<?php echo Yii::app()->createUrl('admin/updateArticle/'.$data->IdArticles.''); ?>">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo (!empty($data->articleImageName) ? $data->articleImagePath.'/thumb_'.$data->articleImageName:'themes/backend/img/no_img.jpg'); ?>" alt="">
        </a>
    </span>
    <span class="articleCategory"><?php echo Adminhelper::article_category($data->articleCategory); ?></span>
    <span class="articleText"><?php echo Adminhelper::text_crop($data->articleText).'...'; ?></span>
    <span class="articleCreateDate"><?php echo $data->articleCreateDate; ?></span>
    
    <span class="articleActive" id="<?php echo 'active_link'.$data->IdArticles; ?>">
       
        <?php 
            echo CHtml::ajaxLink('changeActive', Yii::app()->createUrl('admin/activateArticle'),
            array(
                'type' => 'GET',
                'data' =>array('update'=>TRUE, 'id'=>$data->IdArticles),
                'beforeSend'    => 'function(){globalvar = $("#active_link'.$data->IdArticles.'").html(); loader("#active_link'.$data->IdArticles.'"); }',
                'success' => 'function( data )
                    {
                        //console.log(data);
                        var a = JSON.parse(data);
                        if(a.ok == 1){
                            $("#active_link'.$data->IdArticles.'").html(globalvar);
                            if($("#active_'.$data->IdArticles.'").hasClass("prompt"))
                            {
                                $("#active_'.$data->IdArticles.'").removeClass("prompt");
                            }
                            else
                            {
                                $("#active_'.$data->IdArticles.'").addClass("prompt");
                            }
                        }
                        else if(a.ok == 2){
                            alert(a.massage);
                            $("#active_link'.$data->IdArticles.'").html(globalvar);
                        }
                    }'
            ),
           array(
                'id' => 'active_'.$data->IdArticles,
                'class' => $data->articleActive == 1 ? 'no-prompt prompt block': 'no-prompt block',
                'confirm'=>'Изменить видимость?',
             ));
        ?>
    </span>
    <span class="articleDelete" id="<?php echo 'delete_article_span_'.$data->IdArticles; ?>">
        
        <?php
        echo CHtml::ajaxLink(
            'delete',
            array('admin/deleteArticle'),
            array(
                'type'          => 'GET',
                'beforeSend'    => 'function(){globalvar = $("#delete_article_span_'.$data->IdArticles.'").html(); loader("#delete_article_span_'.$data->IdArticles.'"); }',
                'data'          => array('update'=>TRUE, 'id'=>$data->IdArticles),
                'success'       => 'function( data )
                    {
                        //console.log(data);
                        var a = JSON.parse(data);
                        if(a.ok == 1){
                            $("#article_item_'.$data->IdArticles.'").html("");
                        }
                        else if(a.ok == 2){
                            alert(a.massage);
                            $("#delete_article_span_'.$data->IdArticles.'").html(globalvar);
                        }
                    }',
            ),
            array(
                'class' => 'delete block',
                'id' => 'delete_article_'.$data->IdArticles,
                'confirm'=>'Удалить статью?',
            ));
        ?>

    </span>
</div>