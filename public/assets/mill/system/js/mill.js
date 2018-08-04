$(function () {
    $.ajaxPrefilter(function (options, originalOptions, jqXHR) {
        if (options['type'].toLowerCase() === "post") {
            if (originalOptions.data._csrf && $('meta[name="csrf-token"]').attr('content') === originalOptions.data._csrf) {
                jqXHR.setRequestHeader('X-CSRFToken', originalOptions.data._csrf);
            } else {
                console.log('Csrf token not found or incorrect')
                jqXHR.abort();
            }

        }
    });
});

class Mill{
    
    static CsrfHeader(){
        return $('meta[name="csrf-token"]').attr('content');
    }
    
}
