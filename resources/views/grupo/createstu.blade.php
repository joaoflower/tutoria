@extends('layouts.app17')

@section('title','Nuevo Tutor')

@section('content')

        <div class="row">
            <div class="col-lg-12">
                <div class="portlet">
                    <div class="portlet-heading bg-info">
                        <h3 class="portlet-title">
                            Agregando estudiantes a Docente Tutor
                        </h3>
                        <div class="portlet-widgets">
                            <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="portlet-2" class="panel-collapse collapse in">
                        <div class="portlet-body">

                            {!! Form::open(['route' => ['grupo.storestu', $grupo->id], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
                                <div class="form-group">
                                    {!! Form::label('docente', 'Docente Tutor :', ['class' => 'col-md-2 control-label']) !!}
                                    <div class="col-sm-10">
                                        <p class="form-control-static">{{ $grupo->nameDocente }}</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('num_mat', 'Estudiantes 1er semestre :', ['class' => 'col-md-2 control-label']) !!}
                                    <div class="col-sm-4">
                                        {!! Form::select('num_mat', $estudiantes, null, ['class' => 'form-control select-estudiante', 'required', 'data-placeholder' => 'Seleciones un estudiante para agregarlo']) !!}
                                    </div>
                                    {!! Form::label('num_matRe', 'Estudiantes regulares :', ['class' => 'col-md-2 control-label']) !!}
                                    <div class="col-sm-4">
                                        {!! Form::select('num_matRe', $regulares, null, ['class' => 'form-control select-estudiante', 'required', 'data-placeholder' => 'Seleciones un estudiante para agregarlo']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('num_matRi', 'Estudiantes en Riesgo :', ['class' => 'col-md-2 control-label']) !!}
                                    <div class="col-sm-4">
                                        {!! Form::select('num_matRi', $riesgos, null, ['class' => 'form-control select-estudiante', 'required', 'data-placeholder' => 'Seleciones un estudiante para agregarlo']) !!}
                                    </div>
                                    <div class="col-sm-6">                                        
                                    </div>
                                </div>
                            {!! Form::close() !!}

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12" id="estudiantes">
                                    @include('grupo.createstu-estus')
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group m-b-0">
                                        <div class="col-sm-offset-4 col-sm-8">
                                            <a href="{{ route('grupo.create') }}" class="btn btn-primary btn-rounded btn-custom btn-lg m-b-5">
                                                <i class="fa fa-user-plus "></i><span> Nuevo Tutor</span>
                                            </a>
                                            <a href="{{ route('grupo.index') }}" class="btn btn-primary btn-rounded btn-custom btn-lg m-b-5">
                                                <i class="fa fa-list"></i><span> Lista de Tutores</span>
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
        $('.select-estudiante').chosen({
            allow_single_deselect: true
        });
        $('#num_mat').change(event => {
            $.get(`${event.target.value}/addestudiante`, function(response, state) {
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
        });
        $('#num_matRe').change(event => {
            $.get(`${event.target.value}/addestudiante`, function(response, state) {
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
        });
        $('#num_matRi').change(event => {
            $.get(`${event.target.value}/addestudiante`, function(response, state) {
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
        });
    </script>
@endsection