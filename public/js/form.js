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
                } else {
                    $('#data').empty();
                    $('#data').append(
                        '<div>Prędkość początkowa: ' + response.data.initialSpeed + ' m/s</div>'
                        + '<div>Składowa Y prędkości początkowej: ' + response.data.initialSpeedVertical + ' m/s</div>'
                        + '<div>Składowa X prędkości początkowej: ' + response.data.initialSpeedHorizontal + ' m/s</div>'
                        + '<div>Kąt rzutu: ' + response.data.throwAngle + '</div>'
                        + '<div>Maksymalna wysokość: ' + response.data.maximumHeight + ' m</div>'
                        + '<div>Zasięg: ' + response.data.range + ' m</div>'
                        + '<div>Całkowity czas: ' + response.data.totalTime + ' s</div>'
                    );

                    google.charts.load('current', {'packages':['corechart']});
                    google.charts.setOnLoadCallback(drawChart);

                    console.log(response.data.coordinates);
                    function drawChart() {
                        const data = google.visualization.arrayToDataTable(response.data.coordinates);

                        const options = {
                            title: 'Tor rzutu ukośnego',
                            curveType: 'function',
                            legend: {position: 'bottom'}
                        };

                        const chart = new google.visualization.LineChart(document.getElementById('chart'));

                        chart.draw(data, options);
                    }
                }
                console.log(response);
            }
        });
    });
});