$(function(){
    $('#lang').change(function(){
        window.location = '/language/change?lang=' + $(this).val();
    })
});