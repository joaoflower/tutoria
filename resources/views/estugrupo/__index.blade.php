@extends('layouts.app17')

@section('title','Tutorados')

@section('content')

        <div class="row">
            <div class="col-lg-12">
                <div class="portlet">
                    <div class="portlet-heading bg-primary">
                        <h3 class="portlet-title">
                            Lista de Tutorados
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

                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Num. Mat.</th>
                                                <th>Apellidos y Nombres</th>
                                                <th>Escuela Profesional</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($estugrupos as $estugrupo)
                                            <tr>
                                                <td>{{ $estugrupo->num_mat }}</td>
                                                <td>{{ ucwords(strtolower($estugrupo->name)) }}</td>
                                                <td>{{ ucwords(strtolower($estugrupo->car_des)) }}</td>
                                                <td>
                                                    <a href="{{ route('sesindi17.create') }}" class="icon-edit" data-toggle="tooltip" data-placement="left" title="Nueva Sesión individual">
                                                        <i class="fa fa-user-plus fa-lg" aria-hidden="true"></i>
                                                    </a>                                                    
                                                </td>
                                            </tr>
                                        @endforeach                                            
                                        </tbody>
                                    </table>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group m-b-0">
                                        <div class="col-sm-offset-5 col-sm-7">
                                            <a href="{{ route('sesgru.create') }}" class="btn btn-primary btn-rounded btn-custom btn-lg m-b-5">
                                                <i class="fa fa-users"></i><span> Nueva sesión grupal</span>
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