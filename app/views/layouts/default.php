<?php
use \mill\html\Url;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $this->title ?></title>
        <meta name="description" content="<?= $this->description ?>">
        <meta name="keywords" content="<?= $this->keywords ?>"> 

        <?php $this->styles() ?>

        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?=Url::base()?>">Millenium Framework</a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="<?=Url::$baseUrl?>">Home</a></li>
                    <li class=""><a href="<?=Url::to('/pages/about')?>">About</a></li>
                    <li class=""><a href="<?=Url::to('/pages/contacts')?>">Contacts</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?if(empty(\mill\core\App::$app->user->properties)):?>
                        <li><a href="<?=Url::to('/pages/signup')?>"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                        <li><a href="<?=Url::to('/pages/login')?>"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                    <?endif;?>
                    <li><a href="<?=Url::to('/pages/logout')?>"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                </ul>
            </div>
        </nav>
        
        <div class="container" style="margin-top:60px">
            <? if (isset($_SESSION['key'])): ?>
                <div class="alert alert-danger">
                    <?=$_SESSION['key'];unset($_SESSION['key'])?>
                </div>
            <? endif; ?>

            <? if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <?=$_SESSION['success'];unset($_SESSION['success'])?>
                </div>
            <? endif; ?>

            <?unset($_SESSION['form_data'])?>
        </div>
        
        
        <div class="container" style="margin-top:60px">
            <?= $content ?>
        </div>
        
        <div class="navbar-fixed-bottom row-fluid">
            <div class="navbar-inner container">
                Millenium Framework &copy;
            </div>
        </div>
    </body>
    <?php $this->miniscripts('mini.js') ?>
</html>