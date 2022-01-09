$(document).ready(function() {
    $("#entry_data_form").submit(function(e) {
        e.preventDefault();

        const form = $(this);
        const actionUrl = form.attr('action');

        console.log(actionUrl);

        $.ajax({
            type: "POST",
            url: actionUrl,
            data: form.serialize(),
            success: function(response)
            {
                console.log(response);
            }
        });
    });
});