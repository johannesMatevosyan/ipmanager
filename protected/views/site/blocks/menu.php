    <style type="text/css">
    
#navigation_menu li {
    background-image: url(img/pattern-1.png);
}

#carousel_container {
    margin-left:20px;

}

#navigation_menu {
    border-top:1px solid #BBB;
    border-bottom:1px solid #BBB;
    height:50px;
    width:1050px;
    margin-left:-60px;
}

#navigation_menu li{
    width:148.5px;
}
#navigation_menu li a{
    width:148.5px;
}


#carousel_inner {
    float:left; /* important for inline positioning */
    width:870px; /* important (this width = width of list item(including margin) * items shown */ 
    overflow: hidden;  /* important (hide the items outside the div) */
    /* non-important styling bellow */
    border:1px solid black;
    border-radius:5px;
        height:130px !important;
}

#carousel_ul {
    position:relative;
    left:-110px; /* important (this should be negative number of list items width(including margin) */
    list-style-type: none; /* removing the default styling for unordered list items */
    margin: 0px;
    padding: 0px;
    width:1350px; /* important */
    /* non-important styling bellow */
    padding-bottom:10px;
}

#carousel_ul li{
    float: left; /* important for inline positioning of the list items */                                    
    width:200px;  /* fixed width, important */
    /* just styling bellow*/
    padding:0px;
    height:110px;
    
    margin-top:10px;
    margin-bottom:10px; 
    margin-left:5px; 
    margin-right:5px; 
}

#carousel_ul li img {
    .margin-bottom:-4px; /* IE is making a 4px gap bellow an image inside of an anchor (<a href...>) so this is to fix that*/
    /* styling */
    cursor:pointer;
    cursor: hand; 
    border:0px; 
}
#left_scroll, #right_scroll{
    float:left; 
    height:130px; 
    width:15px; 

}
#carousel_ul li {
    width:115px;
}

#left_scroll img, #right_scroll img{
border:0; /* remove the default border of linked image */
/*styling*/
cursor: pointer;
cursor: hand;

}
</style>



<div class="container">
    <div class="row">
        <div class="span12" id = "header-menu">
            <ul>
                <li class="<?php echo Yii::app()->controller->action->id == 'index'?'active':''; ?>">
                    <a href="<?php echo Yii::app()->createUrl('site/index'); ?>">Главная</a>
                </li>
                
                <li class="<?php echo Yii::app()->controller->action->id == 'about'?'active':''; ?>">
                    <a href="<?php echo Yii::app()->createUrl('site/about'); ?>">О компании</a>
                </li>
                
                <li class="<?php echo Yii::app()->controller->action->id == 'discounts'?'active':''; ?>">
                    <a href="<?php echo Yii::app()->createUrl('site/discounts'); ?>">Скидки</a>
                </li>
                       <li class="<?php echo Yii::app()->controller->action->id == 'delivery'?'active':''; ?>">
                    <a href="<?php echo Yii::app()->createUrl('site/delivery'); ?>">Доставка</a>
                </li>
                
                <li class="<?php echo Yii::app()->controller->action->id == 'contacts'?'active':''; ?>">
                    <a href="<?php echo Yii::app()->createUrl('site/contacts'); ?>">Контакты</a>
                </li>
                
            </ul>
        </div>
    </div>
</div>
</header>
<section>
<div class = "row" style = "width:900px;margin:0 auto">
<div class = "span4" id = "logo-block">
    <a href = "<?php echo Yii::app()->createUrl('site/index');?>"><img src = "<?php echo Yii::app()->baseUrl?>/themes/frontend/img/logo.png" alt = "логотип сайта изготовления печатей"><span id ="logo-absolute"> АБСОЛЮТ <br>ПЕЧАТИ</span></a>
</div>
    <div class = "span3" id = "our-contact" style = "float:right;padding-top:50px">
        Тел:&nbsp;&nbsp;&nbsp;&nbsp; +7 (812) 702 75 02<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+7 (812) 702 75 03<br>Email:cinedrodnov@mail.ru
</div>
</div>
    <nav>
        <div class="container">
            <div class="row">
            </div>
             <div id="carousel_container" style="margin-top:15px;margin-bottom:170px !important;">
      <div id="left_scroll"><a href="javascript:slide('left');"><img class = "slider-arrow-left" style = "margin-left:-15px;max-width:500%;width:30px !important;height:30px !important" src="<?php echo Yii::app()->baseUrl?>/themes/backend/img/arrow-left-passive.png"></a></div>
        <div id="carousel_inner">
            <ul id="carousel_ul" style="left: -135px;">
                <?php 
                $images = SliderImages::model()->findAll();
                    foreach($images as $key => $value) {
                        echo  '<li>
                                <a class="fancybox-thumb" rel="fancybox-thumb" href="'.Yii::app()->baseUrl.'/images/slider/'.$value->imagePath.'">
                                    <img src="'.Yii::app()->baseUrl.'/images/slider/'.$value->imagePath.'" alt="'.$value->alt.'" title="'.$value->title.'"/>
                                </a>
                            </li>';
                    }
                ?>
               
            </ul>
    </div>
      <div id="right_scroll"><a href="javascript:slide('right');"><img class = "slider-arrow-right" style = "max-width:500%;width:30px !important;height:30px !important" src="<?php echo Yii::app()->baseUrl?>/themes/backend/img/arrow-right-passive.png"></a></div>
      <input type="hidden" id="hidden_auto_slide_seconds" value="5000">
      
      </div>
   </div>
           
    </nav>
    
    <div class="container">
        <div class="row">
        
        
        <div class="span2">
                <br>
                <div class="sideBar">
              <?php $shtampCategories = ShtampCategoryModel::model()->findAll();?>
                    <ul>
                        <?php foreach ($shtampCategories as $key => $value) {
                            echo '<li><a href="'.Yii::app()->createUrl('shtamp/getshtampsbycategory', array('category'=>$value->link)).'">'.$value->name.'</a></li>';
                        }?>

                        <li><a href="<?php echo Yii::app()->createUrl('shtamp/recovery');?>">ВОССТАНОВЛЕНИЕ</a></li>
                    </ul>
            </div>
        </div>