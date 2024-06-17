$(document).ready(function () {
    const recentSearchesKey = "recentSearches";

    // Function to get recent searches from local storage
    function getRecentSearches() {
        const searches = localStorage.getItem(recentSearchesKey);
        return searches ? JSON.parse(searches) : [];
    }

    // Function to save a new search term to local storage
    function saveSearchTerm(term) {
        let searches = getRecentSearches();
        // Remove the term if it already exists
        searches = searches.filter((search) => search !== term);
        // Add the term to the beginning of the array
        searches.unshift(term);
        // Limit to 5 recent searches
        if (searches.length > 5) {
            searches.pop();
        }
        localStorage.setItem(recentSearchesKey, JSON.stringify(searches));
    }

    // Function to show recent searches
    function showRecentSearches() {
        const searches = getRecentSearches();
        $("#suggestions-list").empty();
        if (searches.length > 0) {
            if (searches.length > 0) {
                $("#suggestions-list").append(
                    "<p class='text-muted mx-2 mb-0 mt-2'>Recent Searches</p>"
                );
            }
            searches.forEach(function (search) {
                $("#suggestions-list").append("<li>" + search + "</li>");
            });
            $("#suggestions").show();
        }
    }

    $("#search_text").on("input", function () {
        var keyword = $("#search_text").val();

        if (keyword.length > 0) {
            $.ajax({
                url: "/search-suggestions",
                method: "GET",
                data: { search_text: keyword },
                success: function (response) {
                    $("#suggestions-list").empty();
                    if (response.length > 0) {
                        $("#suggestions-list").append(
                            "<p class='text-muted mx-2 mb-0 mt-2'>Suggestions</p>"
                        );
                    }
                    response.forEach(function (item) {
                        $("#suggestions-list").append(
                            "<li>" +
                                item["brand"] +
                                " " +
                                item["model"] +
                                "</li>"
                        );
                    });
                    $("#suggestions").show();
                },
            });
        } else {
            $("#suggestions").hide();
        }
    });

    $("#search_text").on("focus", function () {
        var keyword = $(this).val();
        if (keyword.length === 0) {
            showRecentSearches();
        }
    });

    $(document).on("click", function (e) {
        if (!$(e.target).closest("#search_text").length) {
            $("#suggestions").hide();
        }
    });

    $("#search-form").submit(function (e) {
        e.preventDefault();
        var keyword = $("#search_text").val();
        if (keyword.length > 0) {
            saveSearchTerm(keyword);
            $(this).unbind("submit").submit();
        }
    });

    $("#suggestions-list").on("click", "li", function () {
        var selectedText = $(this).text();
        $("#search_text").val(selectedText);
        $("#suggestions").hide();
        saveSearchTerm(selectedText);
        $("#search-form").submit();
    });
});
