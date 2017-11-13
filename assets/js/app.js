$(document).ready(function () {
    $("img").click(function () {
        $.post("/banner.php", function (data) {
            console.log(data);
            location.reload();
        });
    });
});