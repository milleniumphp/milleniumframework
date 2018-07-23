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
    </ul>
</div>
<div class="col-md-10">
    <div id="temp1" class="tab-content col-xs-12 text-center" style="">
        <div class="tab-pane active " id="debug-bar-show-logo">
            <h3>Millenium PHP framework</h3>
            <table class="table">
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
        </div>
        <div class="tab-pane " id="debug-bar-show-php">
            <?=$phpinfo?>
        </div>
        
        <div class="tab-pane  " id="debug-bar-show-requests">
            <?php debug($route['controller'])?>
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


