@extends('layouts.app17')

@section('title','[2018-I] Encuesta de Satisfacción')
@section('css')
@endsection

@section('content')

        <div class="row">
            <div class="col-lg-12">
                <div class="portlet">
                    <div class="portlet-heading bg-success">
                        <h3 class="portlet-title">
                            [2018-I] Encuesta de Satisfacción
                        </h3>
                        <div class="portlet-widgets">
                            <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="portlet-2" class="panel-collapse collapse in">
                        <div class="portlet-body">

                        {!! Form::open(['route' => 'encusati.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
                            <div class="form-group">                                
                                <div class="col-sm-12">
                                    <p class="form-control-static"><strong>ESTIMADO ESTUDIANTE: </strong> Responde con sinceridad las siguientes preguntas marcando la opción que mejor exprese tu opinión:</p>
                                </div>
                            </div>
                            <div class="form-group">                                
                                @foreach ($areaspectos as $areaspecto)
                                <div class="col-sm-6">
                                    <table class="table table-striped table-bordered table-hover ">
                                        <thead>
                                            <tr class="success">
                                                <th>{{ $areaspecto->name }}</th>
                                                <th>Marque</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($areaspecto->itemaspectos as $itemaspecto)
                                            <tr>
                                                <td>{{ $itemaspecto->name }}</td>
                                                <td>{!! Form::select('encusati_aspecto['.$itemaspecto->id.']', $evalaspectos, null, ['class' => 'form-control', 'required']) !!}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @endforeach
                            </div>
                          
                            <div class="form-group m-b-0">
                                <div class="col-sm-offset-5 col-sm-7">                                        
                                    <a href="{{ route('index') }}" class="btn btn-danger btn-rounded btn-custom btn-lg m-b-5">
                                        <i class="fa fa-times"></i> <span>Cancelar</span>
                                    </a>
                                    {!! Form::button('<i class="fa fa-floppy-o"></i> <span>Generar Constancia</span>', ['type' => 'submit', 'class' => 'btn btn-success btn-rounded btn-custom btn-lg m-b-5']) !!}  
                                </div>
                            </div>
                        {!! Form::close() !!}

                        </div>
                    </div>
                </div> 
            </div> 
        </div> 
  
@endsection
@section('js')

@endsection