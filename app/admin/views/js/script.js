$(document).ready(function () {
    $(".menu-item").click(function () {
        var page = $(this).data("page");

        // Load nội dung vào #main-content
        $("#main-content").load("/webbanhang/app/admin/views/product/" + page);
    });
});
