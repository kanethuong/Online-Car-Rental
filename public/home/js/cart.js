$(document).ready(function () {
    $(".add-to-cart-btn").click(function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        var product_id = $(this)
            .closest(".product_data")
            .find(".product_id")
            .val();
        var quantity = $(this)
            .closest(".product_data")
            .find(".qty-input")
            .val();

        $.ajax({
            url: "/add-cart",
            method: "POST",
            data: {
                quantity: quantity,
                product_id: product_id,
            },
            success: function (response) {
                cartload();
                alertify.set("notifier", "position", "top-right");
                alertify.success(response.status);
            },
        });
    });
});

$(document).ready(function () {
    cartload();
});

function cartload() {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: "/load-cart-data",
        method: "GET",
        success: function (response) {
            $(".basket-item-count").html("");
            var parsed = jQuery.parseJSON(response);
            var value = parsed; //Single Data Viewing
            $(".basket-item-count").append(
                $(
                    '<span class="badge badge-pill badge-danger">' +
                        value["totalcart"] +
                        "</span>"
                )
            );
        },
    });
}

$(document).ready(function () {
    $(".increment-btn").click(function (e) {
        e.preventDefault();
        var incre_value = $(this).parents(".quantity").find(".qty-input").val();
        var value = parseInt(incre_value, 10);
        value = isNaN(value) ? 0 : value;
        if (value < 10) {
            value++;
            $(this).parents(".quantity").find(".qty-input").val(value);
        }
    });

    $(".decrement-btn").click(function (e) {
        e.preventDefault();
        var decre_value = $(this).parents(".quantity").find(".qty-input").val();
        var value = parseInt(decre_value, 10);
        value = isNaN(value) ? 0 : value;
        if (value > 1) {
            value--;
            $(this).parents(".quantity").find(".qty-input").val(value);
        }
    });
});

$(document).ready(function () {
    $(".changeQuantity").click(function (e) {
        e.preventDefault();

        var quantity = $(this).closest(".cartpage").find(".qty-input").val();
        var row_id = $(this).closest(".cartpage").find(".row_id").val();
        var product_price = $(this)
            .closest(".cartpage")
            .find(".product_price")
            .val();

        var data = {
            quantity: quantity,
            row_id: row_id,
        };

        $.ajax({
            url: "/update-cart",
            type: "POST",
            data: data,
            success: function (response) {
                $(".cart-grand-price-viewajax").text(response.newSubtotal);
                cartload();
                alertify.set("notifier", "position", "top-right");
                alertify.success(response.status);
            },
        });

        document.getElementById(row_id).innerHTML = (
            quantity * product_price
        ).toFixed(2);
    });
});

$(document).ready(function () {
    $(".clear_cart").click(function (e) {
        e.preventDefault();

        $.ajax({
            url: "/clear-cart",
            type: "POST",
            success: function (response) {
                cartload();
                window.location.reload();
                alertify.set("notifier", "position", "top-right");
                alertify.success(response.status);
            },
        });
    });
});

$(document).ready(function () {
    $(".delete_cart_data").click(function (e) {
        e.preventDefault();

        var row_id = $(this).closest(".cartpage").find(".row_id").val();

        $.ajax({
            url: "/remove-cart-item",
            type: "POST",
            data: {
                row_id: row_id,
            },
            success: function (response) {
                cartload();
                alertify.set("notifier", "position", "top-right");
                alertify.success(response.status);
                window.location.reload();
            },
        });
    });
});
