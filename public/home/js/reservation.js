$(document).ready(function () {
    var today = new Date().toISOString().split("T")[0];
    $("#start_date").val(today);
    $("#end_date").val(today);

    $(".rent-btn").click(function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        var car_id = $(this).closest(".car_data").find(".car_id").val();

        $.ajax({
            url: "/add-reservation",
            method: "POST",
            data: {
                car_id: car_id,
                quantity: 1,
            },
            success: function (response) {
                //redirect user to reservation page
                window.location.href = "/reservation";
                alertify.set("notifier", "position", "top-right");
                alertify.success(response);
            },
        });
    });

    $("#start_date, #end_date, #quantity").change(function () {
        calculateTotalCost();
    });

    function validateName() {
        var name = $("#name").val();
        var nameRegex = /^[a-zA-Z\s]{2,50}$/;
        if (!nameRegex.test(name)) {
            $("#name").addClass("is-invalid");
            $("#name_error").show();
            return false;
        } else {
            $("#name").removeClass("is-invalid");
            $("#name_error").hide();
            return true;
        }
    }

    function validateMobile() {
        var mobile = $("#phone").val();
        var mobileRegex = /^\d{10}$/;
        if (!mobileRegex.test(mobile)) {
            $("#phone").addClass("is-invalid");
            $("#phone_error").show();
            return false;
        } else {
            $("#phone").removeClass("is-invalid");
            $("#phone_error").hide();
            return true;
        }
    }

    function validateEmail() {
        var email = $("#email").val();
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            $("#email").addClass("is-invalid");
            $("#email_error").show();
            return false;
        } else {
            $("#email").removeClass("is-invalid");
            $("#email_error").hide();
            return true;
        }
    }

    function validateDriverLicense() {
        var driverLicense = $("#driver_license").val();
        if (driverLicense === null) {
            $("#driver_license").addClass("is-invalid");
            $("#driver_license_error").show();
            return false;
        } else {
            $("#driver_license").removeClass("is-invalid");
            $("#driver_license_error").hide();
            return true;
        }
    }

    $("#name").on("input", validateName);
    $("#phone").on("input", validateMobile);
    $("#email").on("input", validateEmail);
    $("#driver_license").on("change", validateDriverLicense);

    $("#validationForm").on("submit", function (e) {
        var isNameValid = validateName();
        var isMobileValid = validateMobile();
        var isEmailValid = validateEmail();
        var isDriverLicenseValid = validateDriverLicense();
        var isValid =
            isNameValid &&
            isMobileValid &&
            isEmailValid &&
            isDriverLicenseValid;

        if (!isValid) {
            e.preventDefault();
            if (!isNameValid) {
                $("#name").focus();
            } else if (!isMobileValid) {
                $("#phone").focus();
            } else if (!isEmailValid) {
                $("#email").focus();
            } else if (!isDriverLicenseValid) {
                $("#driver_license").focus();
            }
        }
    });
});

function calculateTotalCost() {
    var startDate = new Date($("#start_date").val());
    var endDate = new Date($("#end_date").val());
    var quantity = parseInt($("#quantity").val());
    var pricePerDay = parseFloat($("#price_per_day").val());

    if (startDate > endDate) {
        alert("Start date cannot be later than end date.");
        var today = new Date().toISOString().split("T")[0];
        $("#start_date").val(today);
        $("#end_date").val(today);
        startDate = new Date(today);
        endDate = new Date(today);
    }

    var timeDiff = endDate - startDate;
    var numberOfDays = timeDiff / (1000 * 3600 * 24) + 1;

    var totalCost = pricePerDay * quantity * numberOfDays;
    $("#rental_cost").text(totalCost);
}
