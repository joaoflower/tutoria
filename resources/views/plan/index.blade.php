@extends('layouts.app17')

@section('title','Plan de tutoría')

@section('content')

        <div class="row">
            <div class="col-lg-12">
                <div class="portlet">
                    <div class="portlet-heading bg-primary">
                        <h3 class="portlet-title">
                            PLAN DE TUTORÍA Y ACOMPAÑAMIENTO UNIVERSITARIO
                        </h3>
                        <div class="portlet-widgets">
                            <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="portlet-2" class="panel-collapse collapse in">
                        <div class="portlet-body">

                        {!! Form::open(['route' => 'plan.store', 'method' => 'POST', 'class' => 'form-horizontal plan']) !!}    
                            <div class="form-group">                                
                                <div class="col-sm-12">
                                    <p class="form-control-static"><strong>III. DIAGNÓSTICO</strong></p>
                                </div>
                            </div>
                            <div class="form-group">                                
                                <div class="col-sm-12">
                                    <p class="form-control-static"><strong>Progreso académico semestral de todas y todos los estudiantes de la Universidad.</strong></p>
                                </div>
                            </div>
                            <div class="form-group">                                
                                <div class="col-sm-4">
                                    <p class="form-control-static">Porcentaje de estudiantes que aprueban el semestre académico.</p>
                                </div>
                                <div class="col-sm-4">
                                    {!! Form::input('text','peasa-data', null, ['class' => 'form-control', 'required', 'placeholder' => 'Data']) !!}
                                    {!! Form::input('text','peasa-meta', null, ['class' => 'form-control', 'required', 'placeholder' => 'Meta']) !!}
                                </div>
                                <div class="col-sm-4">
                                    {!! Form::textarea('peasa-pro', null, ['class' => 'form-control', 'placeholder' => '', 'required', 'style' => 'display: none;']) !!}
                                    <div id="peasa-pro-div" class="summernote problemas"></div>
                                </div>
                            </div>
                            <div class="form-group">                                
                                <div class="col-sm-4">
                                    {!! Form::textarea('peasa-cau', null, ['class' => 'form-control', 'placeholder' => '', 'required', 'style' => 'display: none;']) !!}
                                    <div id="peasa-cau-div" class="summernote causas"></div>
                                </div>
                                <div class="col-sm-4">
                                    {!! Form::textarea('peasa-alt', null, ['class' => 'form-control', 'placeholder' => '', 'required', 'style' => 'display: none;']) !!}
                                    <div id="peasa-alt-div" class="summernote alternativas"></div>
                                </div>
                                <div class="col-sm-4">
                                    {!! Form::textarea('peasa-obj', null, ['class' => 'form-control', 'placeholder' => '', 'required', 'style' => 'display: none;']) !!}
                                    <div id="peasa-obj-div" class="summernote objetivos"></div>
                                </div>
                            </div>

                            <div class="form-group">                                
                                <div class="col-sm-4">
                                    <p class="form-control-static">Número de estudiantes en riesgo académico.</p>
                                </div>
                                <div class="col-sm-4">
                                    {!! Form::input('text','nera-data', null, ['class' => 'form-control', 'required', 'placeholder' => 'Data']) !!}
                                    {!! Form::input('text','nera-meta', null, ['class' => 'form-control', 'required', 'placeholder' => 'Meta']) !!}
                                </div>
                                <div class="col-sm-4">
                                    {!! Form::textarea('nera-pro', null, ['class' => 'form-control', 'placeholder' => '', 'required', 'style' => 'display: none;']) !!}
                                    <div id="nera-pro-div" class="summernote problemas"></div>
                                </div>
                            </div>
                            <div class="form-group">                                
                                <div class="col-sm-4">
                                    {!! Form::textarea('nera-cau', null, ['class' => 'form-control', 'placeholder' => '', 'required', 'style' => 'display: none;']) !!}
                                    <div id="nera-cau-div" class="summernote causas"></div>
                                </div>
                                <div class="col-sm-4">
                                    {!! Form::textarea('nera-alt', null, ['class' => 'form-control', 'placeholder' => '', 'required', 'style' => 'display: none;']) !!}
                                    <div id="nera-alt-div" class="summernote alternativas"></div>
                                </div>
                                <div class="col-sm-4">
                                    {!! Form::textarea('nera-obj', null, ['class' => 'form-control', 'placeholder' => '', 'required', 'style' => 'display: none;']) !!}
                                    <div id="nera-obj-div" class="summernote objetivos"></div>
                                </div>
                            </div>

                            <div class="form-group">                                
                                <div class="col-sm-4">
                                    <p class="form-control-static">Número y tipo de acciones de mejora académica realizadas en el semestre anterior.</p>
                                </div>
                                <div class="col-sm-4">
                                    {!! Form::input('text','ntama-data', null, ['class' => 'form-control', 'required', 'placeholder' => 'Data']) !!}
                                    {!! Form::input('text','ntama-meta', null, ['class' => 'form-control', 'required', 'placeholder' => 'Meta']) !!}
                                </div>
                                <div class="col-sm-4">
                                    {!! Form::textarea('ntama-pro', null, ['class' => 'form-control', 'placeholder' => '', 'required', 'style' => 'display: none;']) !!}
                                    <div id="ntama-pro-div" class="summernote problemas"></div>
                                </div>
                            </div>
                            <div class="form-group">                                
                                <div class="col-sm-4">
                                    {!! Form::textarea('ntama-cau', null, ['class' => 'form-control', 'placeholder' => '', 'required', 'style' => 'display: none;']) !!}
                                    <div id="ntama-cau-div" class="summernote causas"></div>
                                </div>
                                <div class="col-sm-4">
                                    {!! Form::textarea('ntama-alt', null, ['class' => 'form-control', 'placeholder' => '', 'required', 'style' => 'display: none;']) !!}
                                    <div id="ntama-alt-div" class="summernote alternativas"></div>
                                </div>
                                <div class="col-sm-4">
                                    {!! Form::textarea('ntama-obj', null, ['class' => 'form-control', 'placeholder' => '', 'required', 'style' => 'display: none;']) !!}
                                    <div id="ntama-obj-div" class="summernote objetivos"></div>
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
        $('.select-estudiante').chosen({
            allow_single_deselect: true
        });
        $('.problemas').summernote({
            placeholder: 'Ingrese los problemas',
            height: 80, 
            toolbar: false,
        });
        $('.causas').summernote({
            placeholder: 'Ingrese las causas',
            height: 80, 
            toolbar: false,
        });
        $('.alternativas').summernote({
            placeholder: 'Ingrese las alternativas de solución',
            height: 80, 
            toolbar: false,
        });
        $('.objetivos').summernote({
            placeholder: 'Ingrese las objetivos',
            height: 80, 
            toolbar: false,
        });
        $('#peasa-pro-div').on('summernote.blur', function() {
            $("#peasa-pro").val($(this).summernote("code"));            
        });
        $('#peasa-cau-div').on('summernote.blur', function() {
            $("#peasa-cau").val($(this).summernote("code"));            
        });
        $('#peasa-alt-div').on('summernote.blur', function() {
            $("#peasa-alt").val($(this).summernote("code"));            
        });
        $('#peasa-obj-div').on('summernote.blur', function() {
            $("#peasa-obj").val($(this).summernote("code"));            
        });
    </script>
@endsection