$(function(){
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // Chosen
	$('#cod_car').chosen({
		allow_single_deselect: true
	});
	$("#cod_car_chosen").css("width", "530px");

	$('#para').chosen({
		allow_single_deselect: true
	});
	$("#para_chosen").css("width", "530px");
    // summernote
	$('#div-mensaje').summernote({
        placeholder: 'Ingrese el comunicado.',
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
    $('#div-mensaje').on('summernote.blur', function() {
        $("#mensaje").val($(this).summernote("code"));    
    });

    $('#datatable').on( "click", ".edit-comunicado", editComunicado );
    $('#datatable').on( "click", ".drop-comunicado", dropComunicado );

    function newComunicado( event ) {
        $('#cod_car').val("").trigger("chosen:updated");
        $('#para').val("").trigger("chosen:updated");
        $("#asunto").val("");
        $("#mensaje").val("");
        $('#div-mensaje').summernote("code", "");

		$("#store-comunicado").css("display","inline-block");
        $("#update-comunicado").css("display","none");

        $("#head-comunicado").modal();        		
    }
    function storeComunicado( event ) {
        var data = { 'cod_car': $("#cod_car").val(), 'para': $("#para").val(), 'asunto': $("#asunto").val(), 'mensaje': $("#mensaje").val()};
        $.post("comunica/storecomunicado", data)
            .done( function(response, status) {                    
                $('#comunicados').html(response);
                $('#datatable').dataTable();
                $('#datatable').on( "click", ".edit-comunicado", editComunicado );
                $('#datatable').on( "click", ".drop-comunicado", dropComunicado );
            })
            .fail(function( jqXHR, textStatus, errorThrown ) {
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
            })
            .always(function() { });
        //console.log(data);
    }
    function editComunicado( event ) {
        $("#comunicado-id").val( $(this).data('comunicado-id') );
        var data = { 'comunicado_id': $(this).data('comunicado-id') };
        $.post("/comunica/getcomunicado", data, 'json')
            .done(function(response, status) {
                $('#cod_car').val(response.cod_car).trigger("chosen:updated");
                $('#para').val(response.para).trigger("chosen:updated");
                $("#asunto").val(response.asunto);
                $("#mensaje").val(response.mensaje);
                $('#div-mensaje').summernote("code", response.mensaje);
            }); 

        $("#store-comunicado").css("display","none");
        $("#update-comunicado").css("display","inline-block");

        $("#head-comunicado").modal();
    }
    function updateComunicado( event ) {
        var data = { 'comunicado_id': $('#comunicado-id').val(), 'cod_car': $("#cod_car").val(), 'para': $("#para").val(), 'asunto': $("#asunto").val(), 'mensaje': $("#mensaje").val()};
        $.post("/comunica/updatecomunicado", data)
            .done( function(response, status) { 
                $('#tr-' + $('#comunicado-id').val() ).html(response);
                $('#datatable').on( "click", ".edit-comunicado", editComunicado );
                $('#datatable').on( "click", ".drop-comunicado", dropComunicado );
            })
            .fail(function( jqXHR, textStatus, errorThrown ) {
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
            })
            .always(function() { });
    }
    function dropComunicado( event ) {
        var data = { 'comunicado_id': $(this).data('comunicado-id') };
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
                $.post("/comunica/dropcomunicado", data)
                    .done( function(response, status) {                    
                        $('#comunicados').html(response);
                        $('#datatable').dataTable();
                        $('#datatable').on( "click", ".edit-comunicado", editComunicado );
                        $('#datatable').on( "click", ".drop-comunicado", dropComunicado );
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
    $("#new-comunicado").on( "click", newComunicado );
    $("#store-comunicado").on( "click", storeComunicado );
    $(".edit-comunicado").on( "click", editComunicado );
    $("#update-comunicado").on( "click", updateComunicado);
    $(".drop-comunicado").on( "click", dropComunicado );
});