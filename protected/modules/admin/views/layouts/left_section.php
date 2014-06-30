<nav id="sidebar" class="sidebar nav-collapse collapse">
    <?php $this->widget('zii.widgets.CMenu',array(
        'htmlOptions' => array( 'class' => 'side-nav','id'=>"side-nav"),
        'encodeLabel'=>false,
        'activeCssClass'=>'active',
        'items'=>array(
            array('label'=>'<i ></i><span>Заказы Печатей</span>', 'url'=>array('/admin/admin/orders'), 'visible'=>!Yii::app()->user->isGuest),
            array('label'=>'<i ></i><span>Страницы</span>', 'url'=>array('/admin/admin/pages'), 'visible'=>!Yii::app()->user->isGuest),
        //    array('label'=>'<i ></i><span>Статьи</span>', 'url'=>array('/admin/articles'), 'visible'=>!Yii::app()->user->isGuest),
        //    array('label'=>'<i ></i><span>Добавить статью</span>', 'url'=>array('/admin/createArticle'), 'visible'=>!Yii::app()->user->isGuest),
            array('label'=>'<i ></i><span>Меню Печатей</span>', 'url'=>array('/admin/admin/shtamps'), 'visible'=>!Yii::app()->user->isGuest),
            array('label'=>'<i ></i><span>Картинки Слайдера</span>', 'url'=>array('/admin/admin/viewGallery'), 'visible'=>!Yii::app()->user->isGuest),
            array('label'=>'<i ></i><span>Контактная информация</span>', 'url'=>array('/admin/admin/contacts'), 'visible'=>!Yii::app()->user->isGuest),
            array('label'=>'<i ></i><span>Карта сайта</span>', 'url'=>array('/admin/admin/viewSitemap'), 'visible'=>!Yii::app()->user->isGuest),
         //   array('label'=>'<i ></i><span>Администратор/пароль</span>', 'url'=>array('/users/userUpdate'), 'visible'=>!Yii::app()->user->isGuest),
                        
         ),
     )); ?>
</nav>