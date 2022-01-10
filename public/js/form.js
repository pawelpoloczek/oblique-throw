$(document).ready(function() {
    $('#entry_data_form').submit(function(e) {
        e.preventDefault();

        const form = $(this);
        const actionUrl = form.attr('action');

        $.ajax({
            type: 'POST',
            url: actionUrl,
            data: form.serialize(),
            success: function(response)
            {
                if (response.errors) {
                    $('#errors').empty();
                    $.each(response.errors, function (index, error){
                        $('#errors').append('<div class="error">' + index + ': ' + error + '</div>');
                    });
                }
                console.log(response);
            }
        });
    });
});