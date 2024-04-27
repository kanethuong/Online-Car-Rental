$(document).ready(function () {
    $(".dropdown-menu a.dropdown-toggle").on("click", function (e) {
        var $subMenu = $(this).next(".dropdown-menu");
        // If the submenu is open, close it, otherwise close all other submenus and open the clicked one
        if ($subMenu.hasClass("show")) {
            $subMenu.removeClass("show");
        } else {
            $(".dropdown-menu .show").removeClass("show");
            $subMenu.addClass("show");
        }
        return false;
    });

    $(document).on("click", function (e) {
        if (isOutsideClick(e.target, ".dropdown-menu")) {
            $(".dropdown-menu").removeClass("show");
        }
    });
});

function isOutsideClick(target, element) {
    return !$(element).is(target) && $(element).has(target).length === 0;
}
