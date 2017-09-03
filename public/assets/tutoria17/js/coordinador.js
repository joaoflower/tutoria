$(function(){
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
	$('#cod_car').chosen({
		allow_single_deselect: true
	});
	$("#cod_car_chosen").css("width", "530px");

	$('#cod_prf').chosen({
		allow_single_deselect: true
	});
	$("#cod_prf_chosen").css("width", "530px");

	$('#cod_car').change(event => {
		$.get(`usutut/${event.target.value}/docentes`, function(response, state) {
			$('#cod_prf').empty();
			$('#cod_prf').append(`<option value=""> </option> `);
			response.forEach(element => {
				$('#cod_prf').append(`<option value="${element.cod_prf}">${element.paterno} ${element.materno} ${element.nombres} </option> `);
			});
			$('#cod_prf').trigger("chosen:updated");
		});
	});

	$('#datatable').on( "click", ".drop-coordinador", dropCoordinador ); 
	$('#datatable').on( "click", ".edit-coordinador", editCoordinador ); 
		
	function newCoordinador( event ) {
		$("#store-coordinador").css("display","inline-block");
        $("#update-coordinador").css("display","none");
        $("#div-cod_car").css("display","inline-block");
		$("#div-cod_prf").css("display","inline-block");
        $("#div-name").css("display","none");

        $("#email").val( "" );
        $('#username').val("");
        $('#password').val("");
        $('#cod_car').val("").trigger("chosen:updated");
        $('#cod_prf').empty();
        $('#cod_prf').val("").trigger("chosen:updated");

        $("#usutut-coordinador").modal();        		
    }
	$("#new-coordinador").on( "click", newCoordinador );
	$("#store-coordinador").on( "click", function() {        
        var data = { 'cod_car': $("#cod_car").val(), 'codigo': $("#cod_prf").val(), 'email': $("#email").val(), 'username': $("#username").val(), 'password': $("#password").val()};
        $.post("/usututc/storecoordinador", data)
            .done( function(response, status) {                    
                $('#coordinadores').html(response);
                $('#datatable').dataTable();
                $('#datatable').on( "click", ".drop-coordinador", dropCoordinador );
                $('#datatable').on( "click", ".edit-coordinador", editCoordinador );
            })
            .fail(function( jqXHR, textStatus, errorThrown ) {
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
            })
            .always(function() { });
    });

	function dropCoordinador( event ) {
        var data = { 'coordinador_id': $(this).data('coordinador-id') };
        swal({   
	        title: "Estás seguro?",   
	        text: "El coordinador ya no podrá ingresar al sistema",   
	        type: "warning",   
	        showCancelButton: true,   
	        confirmButtonColor: "#c9302c", 
	        confirmButtonText: "Si, borrarlo!",
	        closeOnConfirm: false,
	        closeOnCancel: false
	    }, function(isConfirm){
	        if (isConfirm) {	            
	            console.log(data);
	            $.post("/usututc/dropcoordinador", data)
		            .done( function(response, status) {                    
		                $('#coordinadores').html(response);
		                $('#datatable').dataTable();
		                $('#datatable').on( "click", ".drop-coordinador", dropCoordinador );
		                $('#datatable').on( "click", ".edit-coordinador", editCoordinador );
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
    
	$(".drop-coordinador").on( "click", dropCoordinador );  

	function editCoordinador( event ) {
		$("#coordinador-id").val( $(this).data('coordinador-id') );
		var data = { 'coordinador_id': $(this).data('coordinador-id') };
		$.post("/usututc/getcoordinador", data, 'json')
            .done(function(response, status) {
                $("#name").text(response.name);
                $("#email").val(response.email);
                $("#username").val(response.username);
                $('#password').val("");
            }); 

        $("#store-coordinador").css("display","none");
        $("#update-coordinador").css("display","inline-block");
		$("#div-cod_car").css("display","none");
		$("#div-cod_prf").css("display","none");
        $("#div-name").css("display","inline-block");
        $("#usutut-coordinador").modal();
    }
	$(".edit-coordinador").on( "click", editCoordinador ); 

	$("#update-coordinador").on( "click", function() {        
        var data = { 'coordinador_id': $("#coordinador-id").val(), 'email': $("#email").val(), 'username': $("#username").val(), 'password': $("#password").val()};
        $.post("/usututc/updatecoordinador", data)
            .done( function(response, status) { 
            	swal({
	                title: "Actualizado",
	                text: "El registro ha sido actualizado.",
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
    });
});