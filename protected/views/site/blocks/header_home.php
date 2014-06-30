<header>
	<h1><a  href="<?php echo Yii::app()->request->baseUrl; ?>">Stavni Vam</a></h1>
    <div id="myCarousel" class="carousel slide">
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active">
            	<img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/frontend/img/big-slider/control1.jpg" alt="">
            </li>
            <li data-target="#myCarousel" data-slide-to="1">
            	<img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/frontend/img/big-slider/control2.jpg" alt="">
            </li>
            <li data-target="#myCarousel" data-slide-to="2">
            	<img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/frontend/img/big-slider/control3.jpg" alt="">
            </li>
            <li data-target="#myCarousel" data-slide-to="3">
            	<img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/frontend/img/big-slider/control4.jpg" alt="">
            </li>
            <li data-target="#myCarousel" data-slide-to="4">
            	<img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/frontend/img/big-slider/control5.jpg" alt="">
            </li>
        </ol>
        <!-- Carousel items -->
        <div class="carousel-inner bigSlide">
        	<div class="active item">
            	<span>Маркизы <br><strong>навесы</strong></span>
            </div>
            <div class="item">
            	<span>Раздвижная пластиковая<br><strong>дверь гармошка</strong></span>
            </div>
            <div class="item">
            	<span>Рулонные<br><strong>жалюзи</strong></span>
            </div>
            <div class="item">
            	<span>Вертикальные<br><strong>жалюзи</strong></span>
            </div>
            <div class="item">
           		<span>Горизонтальные<br><strong>деревянные жалюзи</strong></span>
            </div>
        </div>
        
        <div class="shadow"></div>
        <!-- Carousel nav -->
        <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
        <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
    </div>
</header>