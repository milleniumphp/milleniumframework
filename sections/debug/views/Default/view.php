<div id="temp2" class="tabs row col-md-2 col-xs-12" style="">
    <ul class="nav nav-pills nav-stacked" id="myTabs" style="margin: 1em 0 1em 0;">
        <li class="active">
            <a id="debug-bar-logo" href="#debug-bar-show-logo" data-toggle="pill">Millenium</a>
        </li>
        <li>
            <a id="debug-bar-php" href="#debug-bar-show-php" data-toggle="pill">PHP</a>
        </li>
        <li>
            <a id="debug-bar-route" href="#debug-bar-show-route" data-toggle="pill">Route</a>
        </li>
        <li>
            <a id="debug-bar-time" href="#debug-bar-show-time" data-toggle="pill">Time</a>
        </li>
        <li>
            <a id="debug-bar-requests" href="#debug-bar-show-requests" data-toggle="pill">Requests</a>
        </li>
        <li>
            <a id="debug-bar-db" href="#debug-bar-show-db" data-toggle="pill">Database</a>
        </li>
    </ul>
</div>
<div class="col-md-10">
    <div id="temp1" class="tab-content container-fluid col-xs-12 text-center" style="">
        <div class="tab-pane active " id="debug-bar-show-logo">
            <h3>Millenium PHP framework</h3>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>Version</td>
                        <td>v0.0.01</td>
                    </tr>
                    <tr>
                        <td>Site</td>
                        <td><a href="http://milleniumphp.herokuapp.com">Link</a></td>
                    </tr>
                    
                </tbody>
            </table>
            
            <h3>SERVER settings</h3>
            <div class="server">
                <table class="table table-bordered" style="table-layout: fixed;width: 100%;">
                    <tbody>
                        <?php foreach ($log['debug_server'] as $k => $v): ?>
                            <tr>
                                <td class="col-md-4"><?=$k?></td>
                                <td class="col-md-8"><?php print_r($v) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
        </div>
        
        <div class="tab-pane " id="debug-bar-show-db" style="margin:1em 0;">
            <?php debug(array_pop($log['debug_db'])) ?>
            <?php foreach($log['debug_db'] as $k => $v): ?>
                <?php debug($k+1 . ' => ' . $v) ?>
            <?php endforeach; ?>
        </div>
        
        <div class="tab-pane " id="debug-bar-show-php">
            <?php echo $phpinfo ?>
        </div>
        
        <div class="tab-pane  " id="debug-bar-show-requests">
<!--            <ul class="nav nav-tabs nav-justified">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#">Menu 1</a></li>
                <li><a href="#">Menu 2</a></li>
                <li><a href="#">Menu 3</a></li>
            </ul>-->
            
            <div class="row">
                <h4>$_GET</h4>
                <p><?php debug($log['debug_get'] ?: '$_GET empty') ?></p>
            </div>
            <div class="row">
                <h4>$_POST</h4>
                <p><?php debug($log['debug_post'] ?: '$_POST empty') ?></p>
            </div>
            <div class="row">
                <h4>$_REQUESTS</h4>
                <p><?php debug($log['debug_requests'] ?: '$_REQUESTS empty') ?></p>
            </div>

        </div>
        
        <div class="tab-pane" id="debug-bar-show-route">
            <div class="text-center">
                <h2>Real route</h2>
                <?php debug($route) ?>
                
                <h2>All routes</h2>
                <?php debug(mill\core\Router::getRoutes()) ?>     
            </div>
            
        </div>
        <div class="tab-pane" id="debug-bar-show-time" data-page="time">
            <div class="text-center">
                <h2>
                    Time: <?=$_GET['time']?>    
                </h2>  
            </div>
            
        </div>
    </div>
</div>


