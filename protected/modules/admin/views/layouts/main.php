<?php header('Content-Type: text/html; charset=utf-8'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <?php Yii::app()->bootstrap->register(); ?>  
    <link type="text/css" rel="stylesheet/less" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/backend/css/screen.less" />    
    <link type="text/css" rel="stylesheet/less" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/backend/css/screen-responsive.less" />
    <?php 
        Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/themes/frontend/js/less-1.3.0.min.js');
        Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl.'/themes/backend/css/application.min.css');
        Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl.'/themes/backend/css/mystyle.css');
        Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/themes/backend/js/ajax_functions.js');
        Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/themes/backend/js/myscript.js');

    ?>
    <title>IP Manager</title>
    <style>
        html{
            height: 100%;
        }
        body{
            background:#fdfdfd;
            height: 100%;
        }
        .wrap {
            min-height: 100%;
            height: auto !important;
            height: 100%;
            margin: 0 auto -100px; /* the bottom margin is the negative value of the footer's height */
        }
        .wrap h1, h2{
            color: #000000;
        }
    /* header */
        .navbar-inner{
            padding: 0 20px;
        }
        #options-wrap{
            background: #f4f4f4;
            border-bottom: 1px solid #ededed;
            border-top: 1px solid #ededed;
            line-height: 35px;
            overflow: hidden;
        }
        #options {
            margin: 0 auto;
            width: 550px;
        }
        #searchsite{
            float: right;
            margin: 2px 0 3px 0;
            height: 30px;
        }
        #search{
            color: #999;
            font-family: Verdana, sans-serif;
            font-size: 11px;
            font-style: normal;
            font-variant: normal;
            font-weight: normal;
            line-height: 1em;
            width: 175px;
            height: 9px;
            padding: 5px 3px;
        }
    /* end of header */
    /* Subnet Calculator page*/
        .ip_calculator{
            width: 450px;
            margin: 0 auto;
        }
    /* end of Subnet Calculator page*/
    /* Blog */
        .blog_top{

        }
        .blog_content{
            width: 570px;
            margin: 0 auto;
        }
        .masthead{
            border-bottom: 1px solid #444;
            margin: 15px auto 0 auto;
            padding-bottom: 15px;
            width: 550px;
            text-align: center;
        }
        .masthead h1{
            letter-spacing:2px;
            font-weight: bold;
            font-size: 40px;
            color: #444;
        }
        .masthead_line{
            margin: 2px auto 0px;
            width: 550px;
            border-bottom: 1px solid #444;
        }
        .item{
            border-bottom: 1px dashed #ccc;
            margin: 2px auto 20px;
            padding-bottom: 15px;
            width: 450px;
        }
        .item h1, h2, h3{
            color: black;
            font-family: Georgia, serif;
            font-style: normal;
            font-variant: normal;
            font-weight: normal;
            margin-bottom: .5em;
            text-align: center;
        }
        .item h3 a{
            color: black;
            font-family: Georgia, serif;
            font-style: normal;
            font-variant: normal;
            font-weight: normal;
            line-height: 1.25em;
            text-decoration: none;
        }
        .item p{
            font-size: 12px;
        }
        .item .date_time{
            text-align: center;
        }
        .item .blog_post{
            color: #444;
            font-family: Verdana, sans-serif;
            font-size: 11px;
            font-style: normal;
            font-variant: normal;
            font-weight: normal;
            line-height: 1.75em;
        }
        .item .where{
            margin-right: 5%;
            font-style: italic;
            text-align: right;
        }
        .item .where a{
            color: rgba(14,106,211,.75);
        }
    /* end of Blog */
    /* create blog post page */
        .form{
            background: #f4f4f4;
        }
        #blog-form{
            margin-left: 30px;
        }
        .form_template{
          /*  margin: 0 auto;*/
            width: 700px;
            float: left;
            margin-left: 50px;
            padding-bottom: 20px;
            background: #f4f4f4;
        }
        .form_box h1, h2{
            color: black;
            text-align: left;
            margin-left: 50px;
        }
        .form_box h1, h2{
            color: black;
         /*   text-align: center; */
        }
        .form_sidebar a{
            color: #000000;
        }
        .form_sidebar a:hover{
            text-decoration: none;
            color: blue;
        }
    /* end of blog post page */
        /* Advanced search */
        .wide .row{
            margin:0 0 20px 5px;
            padding: 0 0 5px 0;
        }
        /* end of Advanced search */
        /* footer */
        footer {
            background: #000000;
            color: #fff;
            margin-top: 100px;
            padding: 30px 0;
            width: 100%;
            height: 100px;
            bottom: 0;
        }
        .footer_nav{
            margin: 0 auto;
            width: 550px;
        }
        .footer_nav h4{
            color: #bababa;
        }
        ul.footer_menu li {
            display: inline;
            padding-right: 1.5em;
        }
        footer a{
            color: #bababa;
        }
        footer a:hover{
            color: #ffffff;
        }
    </style>
</head>
<body>
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
            <a class="brand" href="<?php echo Yii::app()->createUrl('/admin/blog/index')?>">Subnet Management Tool</a>
                <?php

                $this->widget('zii.widgets.CMenu',array(
                    'htmlOptions' => array('class'=>"nav", 'padding-left'=>10),
                    'encodeLabel'=>false,
                    'activeCssClass'=>'active',
                    'items'=>array(
                        array('label'=>'<i></i><span>Subnet Calculator</span>', 'url'=>array('/admin/subnet/subnetCalculator')),
                        array('label'=>'<i></i><span>Subnets</span>', 'url'=>array('/admin/subnet/getSubnetList')),
                        array('label'=>'<i></i><span>Blog</span>', 'url'=>array('/admin/blog/index')),
                        array('label'=>'<i></i><span>Users</span>', 'url'=>array('/admin/users/getUserList'), 'visible'=>Yii::app()->user->getState("role") == "admin"),
                        array('label'=>'<i></i><span>Admin</span>', 'url'=>array('/admin/blog/admin'),  'visible'=>Yii::app()->user->getState("role") == "admin"),
                    ),
                ));

                ?>
            <ul class="nav pull-right">
                <li class=""><a href="<?php echo Yii::app()->createUrl('admin/users/logout'); ?>" class="">Log out <i class="icon-signout"></i></a></li>
            </ul>

        </div>
    </div>
   <!-- <div id="options-wrap">
        <div id="options">
            <form id="searchsite" method="POST" action="<?php echo Yii::app()->createUrl('/admin/blog/index')?>">
                <input type="text" id="search" name="searchquery" placeholder="Search in Blog">
            </form>
        </div>
    </div>-->
</header>
<div class="wrap">
   <div class="content container-fluid">

                <?php echo $content; ?>

   </div>
</div><!-- wrap -->
<input type="hidden" id="base_url" value="<?php echo Yii::app()->request->baseUrl; ?>" />
<footer>
    <div class="footer_nav">
<!--        <h4><a class="brand" href="<?php //echo Yii::app()->createUrl('/admin/blog/index')?>">Subnet Management Tool</a></h4>-->

    <?php

    $this->widget('zii.widgets.CMenu',array(
        'htmlOptions' => array('class'=>"footer_menu navbar", 'padding-left'=>10),
        'encodeLabel'=>false,
        'activeCssClass'=>'active',
        'items'=>array(
            array('label'=>'<i></i><span>Subnet Management Tool</span>', 'url'=>array('/admin/blog/index')),
            array('label'=>'<i></i><span>Subnet Calculator</span>', 'url'=>array('/admin/subnet/subnetCalculator')),
            array('label'=>'<i></i><span>Subnets</span>', 'url'=>array('/admin/subnet/getSubnetList')),
            array('label'=>'<i></i><span>Blog</span>', 'url'=>array('/admin/blog/index')),
            array('label'=>'<i></i><span>Users</span>', 'url'=>array('/admin/users/getUserList'), 'visible'=>Yii::app()->user->getState("role") == "admin"),
            array('label'=>'<i></i><span>Admin</span>', 'url'=>array('/admin/blog/admin'),  'visible'=>Yii::app()->user->getState("role") == "admin"),
        ),
    ));

    ?>
    </div><!-- footer_nav -->
</footer>
</body>
</html>
