<?php 
use \mill\html\Url;
use \mill\core\App;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $this->title ?> | <?php echo App::$bin->getSetting('app')['name'] ?></title>
        <meta name="csrf-token" content="<?php echo App::$bin->getSetting('app')['_csrf'] ?>">
        <link rel="icon" href="/assets/mill/system/icon.png">
        
        <?php $this->scripts->styles() ?>
    </head>
    <body>
        <nav class="container-fluid navbar navbar-default navbar-inverse">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= Url::$baseUrl ?>">
                    <?php echo App::$bin->getSetting('app')['name'] ?>
                </a>
            </div>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="<?= Url::$baseUrl ?>"><?php __('home') ?></a>
                    </li>
                    <li>
                        <a href="<?= Url::to('/pages/about') ?>"><?php __('about') ?></a>
                    </li>
                    <li>
                        <a href="<?= Url::to('/pages/contacts') ?>"><?php __('contacts') ?></a>
                    </li>
                    <li>
                        <a href="" onclick="return false;"><?php new mill\widgets\language\Language() ?></a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php if (\Mill::$user->isGuest()): ?>
                        <li><a href="<?= Url::to('/pages/signup') ?>"><span class="glyphicon glyphicon-user"></span> <?php __('signup') ?> </a></li>
                        <li><a href="<?= Url::to('/pages/login') ?>"><span class="glyphicon glyphicon-log-in"></span> <?php __('login') ?> </a></li>
                    <?php else: ?>
                        <li><a href="<?= Url::to('/pages/logout') ?>"><span class="glyphicon glyphicon-log-out"></span> <?php __('logout') ?> </a></li>
                    <?php endif; ?>
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
    
    <?php $this->scripts->scripts() ?>
    
</html>
