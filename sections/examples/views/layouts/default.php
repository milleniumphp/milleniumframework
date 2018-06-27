<?php

use \mill\html\Url;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <?php mill\web\Scripts::styles() ?>

    </head>
    <body>

        <div class="container" style="margin-top:60px">
            <?= $content ?>
        </div>

        <div class="navbar-fixed-bottom row-fluid">
            <div class="navbar-inner container">
                Millenium Framework &copy;
            </div>
        </div>
    </body>
</html>