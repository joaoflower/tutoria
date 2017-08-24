@extends('layouts.app17')

@section('title','Sin tutor')

@section('content')

        <div class="row">
            <div class="col-lg-12">
                <div class="portlet">
                    <div class="portlet-heading bg-primary">
                        <h3 class="portlet-title">
                            Tutor para el estudiante
                        </h3>
                        <div class="portlet-widgets">
                            <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="portlet-2" class="panel-collapse collapse in">
                        <div class="portlet-body">

                        	<div class="alert alert-info alert-dismissible" role="alert">
							  	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							  	El tutor que tiene asigando para el siguiente semestre es: <br>
					            Docente <strong>{{ $docente->name }}</strong> de la escuela profesional de <strong>{{ $docente->car_des }}</strong>.
							</div>

                        </div>
                    </div>
                </div> 
            </div> 
        </div> 
  
@endsection