$(function(){
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // summernote
	$('#div-recomendacion').summernote({
        placeholder: 'Ingrese recomendacion para el docente',
        disableDragAndDrop: true,
        height: 100, 
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

    function setAtendido( atendido ) {
        if(atendido == 'si') {
            $("#fecha").prop('required', true);
            $("#fecha").prop('disabled', false);
            $('#div-recomendacion').summernote("enable");
        } else {
            $("#fecha").prop('required', false);
            $("#fecha").prop('disabled', true);
            $('#div-recomendacion').summernote("disable");
        }
    }
    $("#atendido").change(event => { 
        if($("#atendido").val() == 'no') {
            $("#fecha").val("");
            $("#recomendacion").val("Estudiante no se presentó a la oficina");
            $('#div-recomendacion').summernote("code", "Estudiante no se presentó a la oficina");
        }
        setAtendido($("#atendido").val());
    });

    $('#datatable').on( "click", ".new-atencion", newAtencion );


    function newAtencion( event ) {
        $("#referido-id").val( $(this).data('referido-id') );
        $("#store-atencion").css("display","inline-block");
        $("#update-atencion").css("display","none");

        $("#atendido").val("");
        $("#fecha").val("");
        $("#recomendacion").val("");
        $('#div-recomendacion').summernote("code", "");

        $("#fecha").prop('required', false);
        $("#fecha").prop('disabled', true);
        $('#div-recomendacion').summernote("disable");

        $('.si17-ref').prop('checked', false);
        //$('input[type=checkbox]').prop('cheched', false);

        $("#oficina-atencion").modal();        		
    }
    function storeAtencion( event ) {
        var sesindi17_ref = [];
        $('.si17-ref:checked').each(function(i, e) {
            sesindi17_ref.push($(this).val());
        });

        var data = { 'sesindiref_id': $("#referido-id").val(), 'atendido': $("#atendido").val(), 'fecha': $("#fecha").val(), 'recomendacion': $("#recomendacion").val(), 'sesindi17_ref': sesindi17_ref};
        $.post("atencion/storeatencion", data)
            .done( function(response, status) {   
                swal({
                    title: "Registrado",
                    text: "La atención ha sido registrada.",
                    timer: 2000,
                    type: "success",
                    showConfirmButton: false
                });
                $('#referidos').html(response);
                $('#datatable').dataTable();
                $('#datatable').on( "click", ".new-atencion", newAtencion );
            })
            .fail(function( jqXHR, textStatus, errorThrown ) {
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
            })
            .always(function() { });
    }
    function editAtencion( event ) {
        $("#atencion-id").val( $(this).data('atencion-id') );
        var data = { 'atencion_id': $(this).data('atencion-id') };
        $.post("/atencion/getatencion", data, 'json')
            .done(function(response, status) {
                $("#atendido").val( response.atendido );
                $("#fecha").val( response.fecha );
                $("#recomendacion").val( response.recomendacion );
                $('#div-recomendacion').summernote("code", response.recomendacion);
                setAtendido(response.atendido);
            }); 

        $("#store-atencion").css("display","none");
        $("#update-atencion").css("display","inline-block");

        $("#oficina-atencion").modal(); 
    }
    function updateAtencion( event ) {
        var data = { 'atencion_id': $('#atencion-id').val(), 'atendido': $("#atendido").val(), 'fecha': $("#fecha").val(), 'recomendacion': $("#recomendacion").val()};
        console.log(data);
        $.post("/atencion/updateatencion", data)
            .done( function(response, status) { 
                $('#td-' + $('#atencion-id').val() ).html($("#atendido").val());
                $('#datatable').on( "click", ".edit-atencion", editAtencion );
                $('#datatable').on( "click", ".drop-atencion", dropAtencion );
            })
            .fail(function( jqXHR, textStatus, errorThrown ) {
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
            })
            .always(function() { });
    }
    function dropAtencion( event ) {
        var data = { 'atencion_id': $(this).data('atencion-id') };
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
                $.post("atencion/dropatencion", data)
                    .done( function(response, status) {                    
                        $('#atendidos').html(response);
                        $('#datatable').dataTable();
                        $('#datatable').on( "click", ".edit-atencion", editAtencion );
                        $('#datatable').on( "click", ".drop-atencion", dropAtencion );
                    });
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
    $(".new-atencion").on( "click", newAtencion );
    $("#store-atencion").on( "click", storeAtencion );
    $(".edit-atencion").on( "click", editAtencion );
    $("#update-atencion").on( "click", updateAtencion);
    $(".drop-atencion").on( "click", dropAtencion );
});