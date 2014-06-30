<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'article_search_form',
    'type' => 'POST',
    //'action' => Yii::app()->createUrl('cars/searchCar'), 
)); ?>

    <div id="article_search_fields">
        <?php
            echo $form->dropDownList($model, 'articleCategory', Adminhelper::article_category(), array(
                'empty' => 'Выберите категорию',
            ));
        ?>
    </div>   

    <div class="search-submit">
        <?php echo CHtml::submitButton(
            "Найти",
            array(
                'id' => 'article_filter_submit',
                'class' => 'btn',
                )
            ); 
        ?>
    </div>
    
<?php $this->endWidget(); ?>
<div class="articles">
    <div class="item-title">
        <h3>Статьи</h3>
    </div>
    <div id="articles_search_items">
        <div class="item item-titles">
            <span class="articleName"> Имя </span>
            <span class="articleImage">Картинка</span>
            <span class="articleCategory">Категория</span>
            <span class="articleText">Текст</span>
            <span class="articleCreateDate">Дата создания</span>
            <span class="articleActive">Видимость</span>
            <span class="articleDelete">Удалить</span>
        </div>
        <?php  $this->widget('zii.widgets.CListView', array(
                'dataProvider'=>$dataProvider,
                'itemView'=>'_articles',
                'pagerCssClass'=>'pagination',
                'template'=>"{items}\n{pager}",
                //'beforeAjaxUpdate' => 'js:function(id, data) {scroll_to_top();}',
                'ajaxUpdate'=>false,
                'summaryText'=>'',
                'pager'=>array(
                    'header'=>'',
                    'cssFile'=>false,
                    'maxButtonCount'=>10,
                    'selectedPageCssClass'=>'active',
                    //'firstPageCssClass'=>'hidden',
                    //'lastPageCssClass'=>'hidden',
                    'prevPageLabel'=>'<<',
                    'nextPageLabel'=>'>>',
                    'htmlOptions'=>array('class'=>'paging', 'id'=>'article')
                ),
        )); ?>
    </div>
</div>
