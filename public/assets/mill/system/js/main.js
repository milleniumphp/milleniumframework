$(function(){
    $('#lang').change(function(){
        window.location = '/language/default/change?lang=' + $(this).val();
    });
});