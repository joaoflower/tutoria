$(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#edit-evaluacion").on( "click", function() {        
        $("#plan-evaluacion").modal();
    });
    $("#store-evaluacion").on( "click", function() {        
        var evaluacion = $("#evaluacion").val();
        var asistentes = $("#asistentes").val();
        var data = { 'evaluacion': evaluacion, 'asistentes': asistentes };
        $.post("/plane/updateevaluacion", data)
            .done( function(response, status) {                    
                $( "#td-evaluacion" ).text( evaluacion );
                $( "#td-asistentes" ).text( asistentes );
            });
    });
});