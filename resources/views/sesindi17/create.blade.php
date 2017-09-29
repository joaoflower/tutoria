@extends('layouts.app17')

@section('title','Tutoria individual')

@section('content')

        <div class="row">
            <div class="col-lg-12">
                <div class="portlet">
                    <div class="portlet-heading bg-success">
                        <h3 class="portlet-title">
                            Nueva sesión de Tutoria individual
                        </h3>
                        <div class="portlet-widgets">
                            <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="portlet-2" class="panel-collapse collapse in">
                        <div class="portlet-body">

                        {!! Form::open(['route' => 'sesindi17.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
                            <div class="form-group">
                                {!! Form::label('estugrupo_id', 'Tutorado: ', ['class' => 'col-md-1 control-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::select('estugrupo_id', $estudiantes, null, ['class' => 'form-control select-estudiante', 'required', 'data-placeholder' => 'Selecione Tutorado para sessión']) !!}
                                </div>
                                <div class="col-sm-2"></div>
                            </div>
                            <div class="form-group">                                
                                <div class="col-sm-1"></div>
                                <div class="col-sm-11">
                                    <p class="form-control-static"><strong>PROBLEMAS IDENTIFICADOS POR EL ESTUDIANTE</strong></p>
                                </div>
                            </div>
                            <div class="form-group">
                                @foreach ($areaproblemas as $areaproblema)
                                <div class="col-sm-4">
                                    <table class="table table-striped table-bordered table-hover ">
                                        <thead>
                                            <tr class="success">
                                                <th colspan="2"><strong>{{ $areaproblema->name }}</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($areaproblema->itemproblemas as $itemproblema)
                                            <tr>
                                                <td>{{ $itemproblema->name }}</td>
                                                <td>
                                                    <label class="cr-styled">
                                                        {!! Form::checkbox('sesindi17_pro['.$itemproblema->id.']') !!} <i class="fa"></i>
                                                    </label>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <div class="col-sm-4">
                                    {!! Form::textarea('pro_ide', null, ['class' => 'form-control', 'placeholder' => 'Ingrese OTROS problemas identificados por el estudiante', 'style' => 'display: none;', 'id' => 'pro_ide']) !!}
                                    <div id="div-pro_ide" class="summernote"></div>
                                </div>
                                <div class="col-sm-4">
                                    <table class="table table-striped table-bordered table-hover ">
                                        <thead>
                                            <tr class="success">
                                                <th colspan="2"><strong>El estudiante requiere ser referido a:</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($itemreferidos as $itemreferido)
                                            <tr>
                                                <td>{{ $itemreferido->name }}</td>
                                                <td>
                                                    <label class="cr-styled">
                                                        {!! Form::checkbox('sesindi17_ref['.$itemreferido->id.']') !!} <i class="fa"></i>
                                                    </label>                                                     
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                
                                <div class="col-sm-4">
                                    {!! Form::label('fecha', 'Fecha de sesión :', ['class' => 'control-label']) !!}
                                    {!! Form::input('date','fecha', null, ['class' => 'form-control fechas', 'required', 'placeholder' => 'aaaa-mm-dd']) !!}
                                </div>
                            </div>

                            <div class="form-group m-b-0">
                                <div class="col-sm-offset-5 col-sm-7">                                        
                                    <a href="{{ route('sesindi17.index') }}" class="btn btn-danger btn-rounded btn-custom btn-lg m-b-5">
                                        <i class="fa fa-times"></i> <span>Cancelar</span>
                                    </a>
                                    {!! Form::button('<i class="fa fa-floppy-o"></i> <span>Guardar sesión</span>', ['type' => 'submit', 'class' => 'btn btn-success btn-rounded btn-custom btn-lg m-b-5']) !!}  
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
    <script type="text/javascript">
        $(document).on('ready', function(){ 
            $('.select-estudiante').chosen({
                allow_single_deselect: true
            });
            $('#div-pro_ide').summernote({
                placeholder: 'Ingrese OTROS problemas identificados por el estudiante.',
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
                    ['vineta', ['ul', 'ol']]
                ],
            });
            $('#div-pro_ide').on('summernote.blur', function() {
                $("#pro_ide").val($(this).summernote("code"));    
            });
        }); 
    </script>
@endsection