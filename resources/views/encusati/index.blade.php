@extends('layouts.app17')

@section('title','[2018-I] Lista de Constancias de Tutoría')

@section('content')

        <div class="row">
            <div class="col-lg-12">
                <div class="portlet">
                    <div class="portlet-heading bg-primary">
                        <h3 class="portlet-title">
                            [2018-I] Lista de Constancias de Tutoría
                        </h3>
                        <div class="portlet-widgets">
                            <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="portlet-2" class="panel-collapse collapse in">
                        <div class="portlet-body">

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12" id="sesindi17s">

                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Constancia</th>
                                                <th>Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($encusatis as $encusati)
                                            <tr>
                                                <td>Constancia de Tutoría Nro {{ $encusati->id }}-2018-I</td>
                                                <td>
                                                    <a href="{{ route('encusati.show', $encusati->id) }}" class="btn btn-success btn-rounded btn-custom btn-sm m-b-5">
                                                        <i class="fa fa-file-text-o"></i> <span>Generar Constancia</span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach                                            
                                        </tbody>
                                    </table>
                                    
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