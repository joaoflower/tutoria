$(function(){
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    function editObjetivo( event ) {
        $("#store-objetivo").css("display","none");
        $("#update-objetivo").css("display","inline-block");
        $("#objetivo-id").val( $(this).data('objetivo-id') );
        $("#objetivo").val( $(this).data('objetivo') );
        $("#plan-objetivo").modal();
    }
    $("#new-objetivo").on( "click", function() {
        $("#store-objetivo").css("display","inline-block");
        $("#update-objetivo").css("display","none");
        $("#objetivo-id").val(0);
        $("#objetivo").val("");
        $("#plan-objetivo").modal();
    });
    $("#store-objetivo").on( "click", function() {
        var objetivo = $("#objetivo").val();
        var data = { 'objetivo': objetivo};
        $.post("/planc/storeobjetivo", data)
            .done( function(response, status) {                    
                $( "#cronograma" ).append( response );
                $(".edit-objetivo").on( "click", editObjetivo );
                $(".new-actividad").on( "click", newActividad );
            });
    });
    $(".edit-objetivo").on( "click", editObjetivo );        
    $("#update-objetivo").on( "click", function() {
        var objetivo = $("#objetivo").val();
        var objetivo_id = $("#objetivo-id").val();
        var data = { 'objetivo_id': objetivo_id, 'objetivo': objetivo };
        $.post("/planc/updateobjetivo", data)
            .done(function(response, status) {
                $( '#objetivo-' + objetivo_id ).text("OBJETIVO: " + objetivo);
                $( '#button-' + objetivo_id ).data('objetivo', objetivo);
            });
    });      

    function newActividad( event ) {
        $("#store-actividad").css("display","inline-block");
        $("#update-actividad").css("display","none");
        $("#objetivo-id").val( $(this).data('objetivo-id') );
        $('textarea').val("");
        $('input[type=text]').val("");
        $('input[type=checkbox]').prop('checked', false);
        $("#plan-actividad").modal();
    }
    $(".new-actividad").on( "click", newActividad );
    $("#store-actividad").on( "click", function() {
        var objetivo_id = $("#objetivo-id").val();
        var actividad = $("#actividad").val();
        var uni_med = $("#uni_med").val();
        var meta = $("#meta").val();
        if($("#mes1").prop('checked')) { var mes1 = 1; } else { var mes1 = 0; }
        if($("#mes2").prop('checked')) { var mes2 = 1; } else { var mes2 = 0; }
        if($("#mes3").prop('checked')) { var mes3 = 1; } else { var mes3 = 0; }
        if($("#mes4").prop('checked')) { var mes4 = 1; } else { var mes4 = 0; }
        if($("#mes5").prop('checked')) { var mes5 = 1; } else { var mes5 = 0; }
        var responsable = $("#responsable").val();
        var data = { 'objetivo_id': objetivo_id, 'actividad': actividad, 'uni_med': uni_med, 'meta': meta, 'mes1': mes1, 'mes2': mes2, 'mes3': mes3, 'mes4': mes4, 'mes5': mes5, 'responsable': responsable };
        $.post("/planc/storeactividad", data)
            .done(function(response, status) {
                $( "#tbody-" + objetivo_id ).append( response );
                $(".edit-actividad").on( "click", editActividad );
            });            
    });
    function editActividad( event ) {
        $("#store-actividad").css("display","none");
        $("#update-actividad").css("display","inline-block");
        $('input[type=checkbox]').prop('checked', false);
        $("#actividad-id").val( $(this).data('actividad-id') );

        var data = { 'actividad_id': $(this).data('actividad-id') };
        $.post("/planc/getactividad", data, 'json')
            .done(function(response, status) {
                $("#actividad").val(response.actividad);
                $("#uni_med").val(response.uni_med);
                $("#meta").val(response.meta);
                if(response.mes1 == '1') { $("#mes1").prop('checked', true); }
                if(response.mes2 == '1') { $("#mes2").prop('checked', true); }
                if(response.mes3 == '1') { $("#mes3").prop('checked', true); }
                if(response.mes4 == '1') { $("#mes4").prop('checked', true); }
                if(response.mes5 == '1') { $("#mes5").prop('checked', true); }
                $("#responsable").val(response.responsable);
            }); 
        $("#plan-actividad").modal();
    }
    $(".edit-actividad").on( "click", editActividad );
    $("#update-actividad").on( "click", function() {
        var actividad_id = $("#actividad-id").val();
        var actividad = $("#actividad").val();
        var uni_med = $("#uni_med").val();
        var meta = $("#meta").val();
        if($("#mes1").prop('checked')) { var mes1 = 1; } else { var mes1 = 0; }
        if($("#mes2").prop('checked')) { var mes2 = 1; } else { var mes2 = 0; }
        if($("#mes3").prop('checked')) { var mes3 = 1; } else { var mes3 = 0; }
        if($("#mes4").prop('checked')) { var mes4 = 1; } else { var mes4 = 0; }
        if($("#mes5").prop('checked')) { var mes5 = 1; } else { var mes5 = 0; }
        var responsable = $("#responsable").val();
        var data = { 'actividad_id': actividad_id, 'actividad': actividad, 'uni_med': uni_med, 'meta': meta, 'mes1': mes1, 'mes2': mes2, 'mes3': mes3, 'mes4': mes4, 'mes5': mes5, 'responsable': responsable };
        $.post("/planc/updateactividad", data)
            .done(function(response, status) {
                $( '#tr-' + actividad_id ).html( response );
                $(".edit-actividad").on( "click", editActividad );
            });
    });
});