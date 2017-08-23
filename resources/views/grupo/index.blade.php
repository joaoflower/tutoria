@extends('layouts.app17')

@section('title','Asignación de Estudiantes')

@section('content')

        <div class="row">
            <div class="col-lg-12">
                <div class="portlet">
                    <div class="portlet-heading bg-primary">
                        <h3 class="portlet-title">
                            Lista de docentes tutores
                        </h3>
                        <div class="portlet-widgets">
                            <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="portlet-2" class="panel-collapse collapse in">
                        <div class="portlet-body">

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12" id="grupos">
                                    @include('grupo.index-grupos')
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group m-b-0">
                                        <div class="col-sm-offset-5 col-sm-7">
                                            <a href="{{ route('grupo.create') }}" class="btn btn-primary btn-rounded btn-custom btn-lg m-b-5">
                                                <i class="fa fa-user-plus "></i><span> Nuevo Tutor</span>
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

@endsection