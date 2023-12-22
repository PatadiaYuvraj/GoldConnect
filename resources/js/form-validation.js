$(document).ready(function () {
    $("#submit_form").validate({
        rules: {
            name: {
                required: true,
            },
        },
    });
});
