<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>课本小明的博客<?php if(isset($this->vars['blog'])){echo "--".$this->vars['blog']['title'];}?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Free HTML5 Website Template by FreeHTML5.co" />
    <meta name="keywords" content="free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
    <!-- Facebook and Twitter integration -->
    <meta property="og:title" content=""/>
    <meta property="og:image" content=""/>
    <meta property="og:url" content=""/>
    <meta property="og:site_name" content=""/>
    <meta property="og:description" content=""/>
    <meta name="twitter:title" content="" />
    <meta name="twitter:image" content="" />
    <meta name="twitter:url" content="" />
    <meta name="twitter:card" content="" />

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <link rel="shortcut icon" href="favicon.ico">

    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700,900' rel='stylesheet' type='text/css'>

    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700" rel="stylesheet">

    <!-- Animate.css -->
    <link rel="stylesheet" href="<?php echo config('PUBLIC');?>/Home/css/animate.css">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="<?php echo config('PUBLIC');?>/Home/css/icomoon.css">
    <!-- Simple Line Icons -->
    <link rel="stylesheet" href="<?php echo config('PUBLIC');?>/Home/css/simple-line-icons.css">
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="<?php echo config('PUBLIC');?>/Home/css/bootstrap.css">
    <!-- Theme style  -->
    <link rel="stylesheet" href="<?php echo config('PUBLIC');?>/Home/css/style.css">
    <!-- Modernizr JS -->
    <script src="<?php echo config('PUBLIC');?>/Home/js/modernizr-2.6.2.min.js"></script>
    <!-- FOR IE9 below -->
    <!--[if lt IE 9]>
    <script src="<?php echo config('PUBLIC');?>/Home/js/respond.min.js"></script>
    <![endif]-->

</head>
<body>
<div id="fh5co-page">
    <header id="fh5co-header" role="banner">
        <div class="container">
            <div class="header-inner">
                <h1><i class="sl-icon-energy"></i><a href="<?php echo url("Index/index");?>">MyLife</a></h1>
                <nav role="navigation">
                    <ul>
                        <li><a <?php use \sunny\Router;if(Router::$controller=='Index'){?>class="active"<?php } ?> href="<?php echo url("Index/index");?>">首页</a></li>
                        <li><a <?php if(Router::$controller=='Blog'){?>class="active"<?php } ?>href="<?php echo url("Blog/index");?>">博客</a></li>
                        <li><a href="https://kebenxiaoming.github.io">关于我</a></li>
                        <li><a href="https://github.com/kebenxiaoming">联系我</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>