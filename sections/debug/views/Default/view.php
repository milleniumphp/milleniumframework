<div id="temp2" class="tabs row col-md-2 col-xs-12" style="">
    <ul class="nav nav-pills nav-stacked" id="myTabs">
        <li class="active">
            <a id="debug-bar-php" href="#debug-bar-show-php" data-toggle="pill">PHP</a>
        </li>
        <li>
            <a id="debug-bar-route" href="#debug-bar-show-route" data-toggle="pill">Route</a>
        </li>
        <li>
            <a id="debug-bar-time" href="#debug-bar-show-time" data-toggle="pill">Time</a>
        </li>
    </ul>
</div>
<div class="col-md-10">
    <div id="temp1" class="tab-content col-xs-12 text-center" style="">
        <div class="tab-pane active " id="debug-bar-show-php">
            <?=$phpinfo?>
        </div>
        <div class="tab-pane" id="debug-bar-show-route">
            <div class="text-center">
                <h2>Real route</h2>
                <?php debug(mill\core\Router::matchRoute(isset($_GET['route']) ? ltrim($_GET['route'], '/') : '/')) ?>
                
                <h2>All routes</h2>
                <?php debug(mill\core\Router::getRoutes()) ?>     
            </div>
            
        </div>
        <div class="tab-pane" id="debug-bar-show-time">
            <div class="text-center">
                <h2>
                    Time: <?=$_GET['time']?>    
                </h2>  
            </div>
            
        </div>
    </div>
</div>


