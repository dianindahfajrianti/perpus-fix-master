$(document).ready(function () {
    $(".btnNext").click(function () {
        $(".nav-link > .active").next("li").find("a").trigger("click");
    });

    $(".btnPrevious").click(function () {
        $(".nav-link > .active").prev("li").find("a").trigger("click");
    });
});
