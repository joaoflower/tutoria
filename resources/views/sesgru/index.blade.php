@extends('layouts.app17')

@section('title','Seguimiento Individual')

@section('content')

        <div class="row">
            <div class="col-lg-12">
                <div class="portlet">
                    <div class="portlet-heading bg-primary">
                        <h3 class="portlet-title">
                            Tutoría grupal por sessión
                        </h3>
                        <div class="portlet-widgets">
                            <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="portlet-2" class="panel-collapse collapse in">
                        <div class="portlet-body">

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12" id="sesgrus">
                                    @include('sesgru.index-sesgru')
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group m-b-0">
                                        <div class="col-sm-offset-5 col-sm-7">
                                            <a href="{{ route('sesgru.create') }}" class="btn btn-primary btn-rounded btn-custom btn-lg m-b-5">
                                                <i class="fa fa-user-plus"></i><span> Nueva sesión grupal</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                    </div>
                </div> 
            </div> 
        </div> 
  
@endsection
@section('js')
<script type="text/javascript">
function dropSesgru(id) {
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
            $.get(`sesgru/${id}/drop`, function(response, state) {
                $('#sesgrus').html(response);
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
</script>
@endsection