@extends('layouts.app17')

@section('title','Sin tutor')

@section('content')

        <div class="row">
            <div class="col-lg-12">
                <div class="portlet">
                    <div class="portlet-heading bg-danger">
                        <h3 class="portlet-title">
                            Estudiante sin tutor
                        </h3>
                        <div class="portlet-widgets">
                            <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="portlet-2" class="panel-collapse collapse in">
                        <div class="portlet-body">

                        	<div class="alert alert-danger alert-dismissible" role="alert">
							  	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							  	<strong>Estudiante sin tutor: </strong> Usted no tiene Tutor asignado. <br>
					            Comuniquese con el Coordinador de tutoría de su Escuela Profesional para que le asigne su Tutor.
							</div>

                        </div>
                    </div>
                </div> 
            </div> 
        </div> 
  
@endsection