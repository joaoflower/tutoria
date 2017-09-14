$(function(){
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /*var data = {
        labels : ["January","February","March","April","May","June","July", "dsds", "ssf"],
        datasets : [
            {
                label: "Tutor",
                backgroundColor : "rgba(235, 193, 66, 0.4)",
                borderColor : "rgba(235, 193, 66, 1)",
                pointBorderColor : "rgba(235, 193, 66, 1)",
                data : [33,52,63,92,50,53,46]
            },
            {
                label: "Tutorado",
                backgroundColor : "rgba(3, 169, 244, 0.4)",
                borderColor : "rgba(3, 169, 244, 1)",
                pointBorderColor : "rgba(3, 169, 244, 1)",
                data : [22,20,30,60,29,25,12]
            }

        ]
    };*/
    /*var options = {
        legend: {
            display: true,
            labels: {
                fontColor: '#337ab7'
            }
        }
    };*/

    //drawChart( $("#lineChart"), 'line', data, options );

    function drawChart(selector, type, data, options) {
        // get selector by context
        var ctx = selector.get(0).getContext("2d");
        // pointing parent container to make chart js inherit its width
        var container = $(selector).parent();

        // enable resizing matter
        $(window).resize( generateChart );

        // this function produce the responsive Chart JS
        function generateChart(){
            // make chart width fit with its container
            var ww = selector.attr('width', $(container).width() );
            var myChart = new Chart(ctx, {type, data, options});
        };
        // run function - render chart at first load
        generateChart();
    }

});