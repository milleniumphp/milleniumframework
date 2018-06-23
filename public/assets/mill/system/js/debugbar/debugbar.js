if(typeof Jquery === undefined) console.log('Mill scripts needs jquery');

window.onload = function() {
    
    var loadTime = window.performance.timing.domContentLoadedEventEnd-window.performance.timing.navigationStart;
    var href = location.href;
    var route = href.substring(href.indexOf('/', 9));
    
    $.ajax({
        url: '/debug/default/', 
        data:{
            'time':loadTime
        },
        success: function (result) {
            $('body').append(result);
    }});

    $.ajax({
        url: '/debug/default/view',
        data: {
            'route':route,
            'time':loadTime
        },
        success: function (result) {
            $('.debugbar .mill-debug-bar.content').html(result);
        }
    });

    
};

function hidedebugbarmenu(){
    $('div.mill-bar.icons').css('background-color','transparent');
    $($('.debug-item')).fadeOut(200, function () {
        $('.debug-item').hide();
        $('.show-item').show();
    });
}

function showdebugbarmenu(){
    $('.show-item').hide();
    $('div.mill-bar.icons').css('background-color','#e6f2ff');
    $($('.debug-item')).fadeIn(200, function () {
        $('.debug-item').show(); 
    });
}

function getdebugbarbody(elem){
    if($('.debugbar .mill-debug-bar.content').attr('data-opened') === 'true'){
        $('.debugbar .mill-debug-bar.content').hide();
    }else{
        $('.debugbar .mill-debug-bar.content').slideToggle('slow'); 
        $('a#debug-bar-'+$(elem).attr('data-page')).trigger('click');
    }
    console.log(location.href);
}