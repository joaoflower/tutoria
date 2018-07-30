$(function(){
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // summernote
	$('#div-recomendacion').summernote({
        placeholder: 'Ingrese recomendación',
        disableDragAndDrop: true,
        height: 150, 
        minHeight: 50, 
        maxHeight: 200, 
        lang: 'es-ES',
        disableResizeEditor: false,
        toolbar: [
            ['style', ['bold', 'italic', 'underline']],
            ['color', ['color']],
            ['para', ['paragraph']],
            ['vineta', ['ul', 'ol']]
        ],
    });
    $('#div-recomendacion').on('summernote.blur', function() {
        $("#recomendacion").val($(this).summernote("code"));    
    });

    $('#datatable').on( "click", ".new-seguimiento", newSeguimiento );
    $('#datatable').on( "click", ".edit-seguimiento", editSeguimiento );
    $('#datatable').on( "click", ".drop-seguimiento", dropSeguimiento );

    function getAtencionref( atencionref_id ) {
        var data = { 'atencion_id': atencionref_id };
        $.post("/atencion/getatencion", data, 'json')
            .done(function(response, status) {
                $("#a-atendido").html( response.atendido );
                $("#a-fecha").html( response.fecha );
                $("#a-recomendacion").html( response.recomendacion );
            });
    }
    function getSeguimiento( seguimiento_id ) {
        var data = { 'seguimiento_id': seguimiento_id };
        $.post("/seguir/getseguimiento", data, 'json')
            .done(function(response, status) {
                $("#fecha").val( response.fecha );
                $("#recomendacion").val( response.recomendacion );
                $('#div-recomendacion').summernote("code", response.recomendacion);
            }); 
    }
    function newSeguimiento( event ) {
        $("#atencionref-id").val( $(this).data('atencionref-id') );
        $("#store-seguimiento").css("display","inline-block");
        $("#update-seguimiento").css("display","none");

        getAtencionref( $(this).data('atencionref-id') );

        $("#asi_est").val("ASISTIO");
        $("#fecha").prop('required', true);
        $("#fecha").prop('disabled', false);
        $("#fecha").val("");
        $("#recomendacion").val("");
        $('#div-recomendacion').summernote("code", "");

        $("#teacher-seguimiento").modal();
    }
    function storeSeguimiento( event ) {
        var data = { 'atencionref_id': $("#atencionref-id").val(), 'fecha': $("#fecha").val(), 'recomendacion': $("#recomendacion").val()};
        $.post("/seguir/storeseguimiento", data)
            .done( function(response, status) {   
                swal({
                    title: "Registrado",
                    text: "El seguimiento ha sido registrado.",
                    timer: 2000,
                    type: "success",
                    showConfirmButton: false
                });
                $('#tdt-' + $("#atencionref-id").val() ).html('<span class="text-success">Atendido y con seguimiento</span>');
                $('#tdb-' + $("#atencionref-id").val() ).html( response );
                $('#datatable').on( "click", ".edit-seguimiento", editSeguimiento );
                $('#datatable').on( "click", ".drop-seguimiento", dropSeguimiento );
            })
            .fail(function( jqXHR, textStatus, errorThrown ) {
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
            })
            .always(function() { });
    }
    function editSeguimiento( event ) {
        $("#atencionref-id").val( $(this).data('atencionref-id') );
        $("#seguimiento-id").val( $(this).data('seguimiento-id') );

        getAtencionref( $(this).data('atencionref-id') );
        getSeguimiento( $(this).data('seguimiento-id') );        

        $("#store-seguimiento").css("display","none");
        $("#update-seguimiento").css("display","inline-block");

        $("#asi_est").val("");
        $("#fecha").prop('required', true);
        $("#fecha").prop('disabled', false);

        $("#teacher-seguimiento").modal();
    }
    function updateSeguimiento( event ) {
        var data = { 'seguimiento_id': $("#seguimiento-id").val(), 'fecha': $("#fecha").val(), 'recomendacion': $("#recomendacion").val()};
        $.post("/seguir/updateseguimiento", data)
            .done( function(response, status) { 
                swal({
                    title: "Actualizado",
                    text: "El seguimiento ha sido actualizado.",
                    timer: 2000,
                    type: "success",
                    showConfirmButton: false
                });
            })
            .fail(function( jqXHR, textStatus, errorThrown ) {
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
            })
            .always(function() { });
    }
    function dropSeguimiento( event ) {
        $("#atencionref-id").val( $(this).data('atencionref-id') );
        var data = { 'seguimiento_id': $(this).data('seguimiento-id') };
        swal({   
            title: "Estás seguro?",   
            text: "Ya no podrás recuperar el registro borrado",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#c9302c", 
            confirmButtonText: "Si, borrarlo!",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm){
            if (isConfirm) {                
                console.log(data);
                $.post("/seguir/dropseguimiento", data)
                    .done( function(response, status) {                    
                        $('#tdt-' + $("#atencionref-id").val() ).html('<span class="text-warning">Atendido, pero sin seguimiento</span>');
                        $('#tdb-' + $("#atencionref-id").val() ).html( response );
                        $('#datatable').on( "click", ".new-seguimiento", newSeguimiento );
                    })
                    .fail(function( jqXHR, textStatus, errorThrown ) {
                        console.log(jqXHR);
                        console.log(textStatus);
                        console.log(errorThrown);
                    })
                    .always(function() { });
                swal({
                    title: "Borrado",
                    text: "El registro ha sido borrado.",
                    timer: 2000,
                    type: "success",
                    showConfirmButton: false
                });
            } else {
                swal({
                    title: "Cancelado",
                    text: "Se cancelo el borrado del registro.",
                    timer: 2000,
                    type: "error",
                    showConfirmButton: false
                });
            }
        });
    }
    $(".new-seguimiento").on( "click", newSeguimiento );
    $("#store-seguimiento").on( "click", storeSeguimiento );
    $(".edit-seguimiento").on( "click", editSeguimiento );
    $("#update-seguimiento").on( "click", updateSeguimiento );
    $(".drop-seguimiento").on( "click", dropSeguimiento );

    // Asistencia
    $("#asi_est").change(event => { 
        if($("#asi_est").val() == 'ASISTIO') {
            $("#fecha").prop('required', true);
            $("#fecha").prop('disabled', false);
            $("#recomendacion").val("");
            $('#div-recomendacion').summernote("code", "");
        } else {
            $("#fecha").val("");
            $("#fecha").prop('required', false);
            $("#fecha").prop('disabled', true);
            $("#recomendacion").val("El estudiante no ASISTIO y las acciones de convocatoria fueron ");
            $('#div-recomendacion').summernote("code", "El estudiante no ASISTIO y las acciones de convocatoria fueron ");
        }
    });
}); 