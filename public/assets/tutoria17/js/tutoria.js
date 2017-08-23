$(document).ready(function() {
    // DataTables
    $('#datatable').dataTable();

    // Summernote
    /*$('.summernote').summernote({
        placeholder: 'Ingrese la problemática identificada en la sesión',
        disableDragAndDrop: true,
        height: 200, 
        minHeight: 50, 
        maxHeight: 200, 
        lang: 'es-ES',
        disableResizeEditor: false,
        toolbar: [
            ['style', ['bold', 'italic', 'underline']],
            ['color', ['color']],
            ['para', ['paragraph']],
            ['vineta', ['ul', 'ol']],
            ['misc', ['undo', 'redo']]
        ],
    });
    $('#div-pro_ide').on('summernote.blur', function() {
        $("#pro_ide").val($(this).summernote("code"));
        var plainText = $($(this).summernote("code")).text();
        //console.log($(this).summernote("code").replace(/<\/?[^>]+(>|$)/g, ""));
        console.log(plainText);
    });*/

    // Chosen
    $('.chosen-select').chosen({
        no_results_text: 'No hay resultados para: ',
        placeholder_text_single: 'Seleccione un estudiante'
    });

    
} );

function dropGrupo(id) {
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
            $.get(`grupo/${id}/drop`, function(response, state) {
                $('#grupos').html(response);
                $('#datatable').dataTable();
            })
            .done(function() { })
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

function dropEstudiante(id) {
    swal({   
        title: "Estás seguro?",   
        text: "El estudiantes ya no será tutorando del docente",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#c9302c", 
        confirmButtonText: "Si, borrarlo!",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function(isConfirm){
        if (isConfirm) {
            $.get(`${id}/dropestudiante`, function(response, state) {
                $('#estudiantes').html(response);
                $('#datatable').dataTable();
            })
            .done(function() { })
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

function dropSesindi17(id) {
    swal({   
        title: "Estás seguro?",   
        text: "Ya no podrás recuperar la sesión borrada",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#c9302c", 
        confirmButtonText: "Si, borrarlo!",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function(isConfirm){
        if (isConfirm) {
            $.get(`sesindi17/${id}/drop`, function(response, state) {
                $('#sesindi17s').html(response);
                $('#datatable').dataTable();
            })
            .done(function() { })
            .fail(function( jqXHR, textStatus, errorThrown ) {
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
            })
            .always(function() { });
            swal({
                title: "Borrado",
                text: "La sesión ha sido borrado.",
                timer: 2000,
                type: "success",
                showConfirmButton: false
            });
        } else {
            swal({
                title: "Cancelado",
                text: "Se cancelo el borrado de la sesión.",
                timer: 2000,
                type: "error",
                showConfirmButton: false
            });
        }
    });   
}

// Datepicker ES
$(function(){
    $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '<Ant',
        nextText: 'Sig>',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        weekHeader: 'Sm',
        dateFormat: 'yy-mm-dd',
        firstDay: 0,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['es']);
});
$( function() {
    $(".fechas").datepicker({
        minDate: "2017-03-01",
        maxDate: "2017-12-31"
    });
});