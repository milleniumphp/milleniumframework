<?php use \mill\html\Url; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title><?= $this->title ?> | <?= \mill\core\Props::getSetting('app')['name'] ?></title>
        
        <meta name="description" content="<?= $this->description ?>">
        
        <meta name="keywords" content="<?= $this->keywords ?>"> 
        
        <input type="hidden" name="token" value="<?php echo \mill\core\Props::getSetting('app')['_csrf'] ?>" />

        <?php mill\web\Scripts::styles() ?>

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
                    <li>
                        <a href="<?=Url::$baseUrl?>"><?php __('home') ?></a>
                    </li>
                    <li>
                        <a href="<?=Url::to('/pages/about')?>"><?php __('about') ?></a>
                    </li>
                    <li>
                        <a href="<?=Url::to('/pages/contacts')?>"><?php __('contacts') ?></a>
                    </li>
                    <li>
                        <a href="" onclick="return false;"><?php new mill\widgets\language\Language()?></a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php if(\mill\core\App::$app->user->isGuest()):?>
                        <li><a href="<?=Url::to('/pages/signup')?>"><span class="glyphicon glyphicon-user"></span> <?php __('signup') ?> </a></li>
                        <li><a href="<?=Url::to('/pages/login')?>"><span class="glyphicon glyphicon-log-in"></span> <?php __('login') ?> </a></li>
                    <?php else:?>
                        <li><a href="<?=Url::to('/pages/logout')?>"><span class="glyphicon glyphicon-log-out"></span> <?php __('logout') ?> </a></li>
                    <?php endif;?>
                </ul>
            </div>
        </nav> 
        
        <div class="container" style="margin-top:90px">
            <?php echo $content ?>
        </div>
        
        <div class="navbar-fixed-bottom row-fluid">
            <div class="navbar-inner container">
                Millenium Framework &copy;
            </div>
        </div>
    </body>
    <?php mill\web\Scripts::scripts('mini.js') ?>
</html>