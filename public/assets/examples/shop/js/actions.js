function opencart() {
    $.ajax({url: "/examples/shop/cart", success: function (result) {
        $("body").append(result);
        $("#CartModalWindow").modal('show');
    }});
}

function closecart(m) {
    $('#CartModalWindow').remove();
    $('.modal-backdrop').remove();
    $('body').removeClass("modal-open");
}

function addtocart(product_id) {
    $.ajax({
        url: "/examples/shop/addtocart",
        data: {id: product_id},
        method: "POST",
        success: function (result) {
            console.log(result);
    }});
}

