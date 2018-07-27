$.ajaxPrefilter(function(options, originalOptions, jqXHR){
    if (options['type'].toLowerCase() === "post") {
        let csrftoken = $('meta[name="csrf-token"]').attr('content');

        if(originalOptions.data._csrf && csrftoken === originalOptions.data._csrf){
            jqXHR.setRequestHeader('X-CSRFToken', originalOptions.data._csrf);
        }else{
            console.log('Csrf token not found or incorrect')
            jqXHR.abort();
        }
        
    }
});

$.post("/pages/login",{
        name: "Donald Duck",
        city: "Duckburg"
        
    },
    
    function(data){
        console.log("Data: " + data );
    }
);