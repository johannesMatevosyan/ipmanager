<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    
    <?php //Yii::app()->bootstrap->register(); ?>
    <title>Pechati</title>
    
    <link type="text/css" rel="stylesheet"  href="<?php echo Yii::app()->request->baseUrl; ?>/themes/frontend/css/bootstrap.css">
   	<link type="text/css" rel="stylesheet/less" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/frontend/css/screen.less">
   	<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/frontend/css/mystyle.css">
    
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/frontend/js/jquery-latest.min.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/frontend/js/less-1.3.0.min.js"></script>
    <!--[if lt IE 10]> <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/frontend/js/ieplaceholder.js"></script> <![endif]-->
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/frontend/js/bootstrap.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/frontend/js/scripts.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/frontend/js/myscript.js"></script>
</head>
<body>
    <section>
        <nav>
            <?php //$this->renderPartial('../site/blocks/menu'); ?>
        </nav>
        <div class="container">
            <?php echo $content; ?>
        </div>
    </section>
    
    
    <input id="base_url" type="hidden" name="" value="<?php echo Yii::app()->request->baseUrl; ?>">
</body>
</html>
