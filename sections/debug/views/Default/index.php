<style>
    <?php echo file_get_contents('assets/mill/system/css/debugbar.css')?>
</style>
<div>
    <div class="debugbar container">
        <div class="mill-bar icons " style="background-color: #e6f2ff;">
            <div class="debug-item logo" data-page="logo" onclick="getdebugbarbody(this)" data-opened="false">
                <img src="/assets/mill/system/icon.png" style="max-height: 46px;">
            </div>
            <div class="debug-item php text-center" data-page="php" onclick="getdebugbarbody(this)" data-opened="false">
                <div class="vcenter">
                    <h4>PHP</h4>
                </div>
            </div>
            <div class="debug-item php text-center" data-page="route" onclick="getdebugbarbody(this)" data-opened="false">
                <div class="vcenter">
                    <h4>Route</h4>
                </div>
            </div>
            <div class="debug-item php text-center" data-page="user" onclick="getdebugbarbody(this)" data-opened="false">
                <div class="vcenter">
                    <h4>User(<?=!empty($log['user']) ?: '0'?>)</h4>
                </div>
            </div>
            <div class="debug-item php text-center" data-page="time" onclick="getdebugbarbody(this)" data-opened="false">
                <div class="vcenter">
                    <h4><?php echo $_GET['time'];?></h4>
                </div>
            </div>
            
            <div class="debug-item requests text-center" data-page="requests" onclick="getdebugbarbody(this)" data-opened="false">
                <div class="vcenter">
                    <h4>Requests</h4>
                </div>
            </div>
            
            <div class="debug-item db text-center" data-page="db" onclick="getdebugbarbody(this)" data-opened="false">
                <div class="vcenter">
                    <h4>Database</h4>
                </div>
            </div>
            
            <div class="debug-item hidebar" onclick="hidedebugbarmenu()">
                <span class="glyphicon glyphicon-chevron-right vcenter"></span>
            </div>
            <div class="show-item showbar" style="display: none !important;" onclick="showdebugbarmenu()">
                <span class="glyphicon glyphicon-chevron-left vcenter"></span>
            </div>
            
            
        </div>
        <div class="mill-debug-bar content" style="height:600px;background-color: white;display: none;overflow: scroll" data-opened="false">
            
        </div>
    </div> 
</div>