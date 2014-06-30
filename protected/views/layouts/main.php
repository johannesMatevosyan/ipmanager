<?php header('Content-Type: text/html; charset=utf-8');?>
<!doctype html>
<html>
<head>
   <link href="<?php echo Yii::app()->request->baseUrl.'/themes/frontend/img/favicon.ico';?>" rel="shortcut icon" type="image/x-icon" />
    <meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <?php // Yii::app()->clientScript->registerCoreScript('jquery');?> 
    <link type="text/css" rel="stylesheet"  href="<?php echo Yii::app()->request->baseUrl; ?>/themes/frontend/css/bootstrap.css">
   	<link type="text/css" rel="stylesheet/less" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/frontend/css/screen.less">
   	<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/frontend/css/mystyle.css">

    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/frontend/js/jquery-latest.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/frontend/js/bootstrap.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/frontend/js/scripts.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/frontend/js/myscript.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/frontend/js/less-1.3.0.min.js"></script>

    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/backend/fancybox-plugin/source/jquery.fancybox.js?v=2.1.5"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/backend/fancybox-plugin/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/backend/fancybox-plugin/lib/jquery.mousewheel-3.0.6.pack.js"></script>
    <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/backend/fancybox-plugin/source/helpers/jquery.fancybox-thumbs.css">
    <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/backend/fancybox-plugin/source/jquery.fancybox.css">
    <title><?php 
				if( $this->pageTitle) 
					echo $this->pageTitle; 
				else 
					echo 'Заказ Печатей Онлайн';
				?>
	</title>


<script type="text/javascript">
    (function( $ ) {   
        $(document).ready( function( ) {  
            $("a.fancybox-thumb").fancybox({
               'type':'image',
             'width': 600, //or whatever you want
             'height': 300
            });

        });
    })(jQuery);      
</script>


    <style type="text/css">
        .fancybox-custom .fancybox-skin {
            box-shadow: 0 0 50px #222;
        }
    </style>

</head>
<body>
    <section style = "margin-left:-60px;">
        <header>
            <nav class = "headeri-meji-nav">
                <?php $this->renderPartial('/site/blocks/menu'); ?>
            </nav>

        <div class="container">
            <?php echo $content; ?>
        </div>
    </section>
    <footer>
        <?php $this->renderPartial('/site/blocks/footer'); ?>
    </footer>
    
    <input id="base_url" type="hidden" name="" value="<?php echo Yii::app()->request->baseUrl; ?>">

</body>
</html>
