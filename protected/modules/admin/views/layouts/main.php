<?php header('Content-Type: text/html; charset=utf-8'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <?php Yii::app()->bootstrap->register(); ?>  
    <link type="text/css" rel="stylesheet/less" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/backend/css/screen.less" />    
    <link type="text/css" rel="stylesheet/less" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/backend/css/screen-responsive.less" />
        <!--[if IE]> <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/frontend/js/ieplaceholder.js"></script> <![endif]-->
    <?php 
            Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/themes/frontend/js/less-1.3.0.min.js');
            Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl.'/themes/backend/css/application.min.css');
            Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl.'/themes/backend/css/mystyle.css');
            Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/themes/backend/js/ajax_functions.js');
            Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/themes/backend/js/myscript.js');
            //BackofficeActionClass::getCurrentScripts();

    ?>
    <title>Pechati</title>
   
</head>
<body style="background:white;">
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
<a href="#myModal" role="button" class="btn" data-toggle="modal" id="universalPopup" style=" display:none;"><?php echo Yii::t("Launch_demo_modal","Launch demo modal"); ?></a>
<div id="beforSend"></div>
<?php
    if(!Yii::app()->user->isGuest)
        $this->renderPartial('/layouts/left_section');
?>
<header class="">
    <div class="navbar navbar-static-top navbar-inverse">
        <div class="navbar-inner">
            <a class="brand" href="#">IP Management Tool</a>
            <ul class="nav">
                <li class="active"><a href="<?php echo Yii::app()->createUrl('/admin/admin/orders'); ?>">Main</a></li>
                <li><a href="#">Users</a></li>

                <!--    <ul class="nav pull-right">-->
                <li class=""><a href="<?php echo Yii::app()->createUrl('users/logout'); ?>">Log out <i class="icon-signout"></i></a></li>
                <!--    </ul> -->
            </ul>
        </div>
    </div>
</header>
<div class="wrap">

   <div class="content container-fluid">

                <?php echo $content; ?>


   </div>
</div>
<input type="hidden" id="base_url" value="<?php echo Yii::app()->request->baseUrl; ?>" />
</body>
</html>
