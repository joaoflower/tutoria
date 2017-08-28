@extends('layouts.app17')

@section('title','Perfil')

@section('content')

        <div class="row">
            <div class="col-lg-12">
                <div class="portlet">
                    <div class="portlet-heading bg-success">
                        <h3 class="portlet-title">
                            PERFIL - Ayudanos a ayudar, actualiza tu información para la Tutoría
                        </h3>
                        <div class="portlet-widgets">
                            <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="portlet-2" class="panel-collapse collapse in">
                        <div class="portlet-body">

                        {!! Form::open(['route' => 'perfild.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
                            
                            <div class="form-group">                                
                                {!! Form::label('email', 'Correo electrónico :', ['class' => 'col-md-2 control-label']) !!}
                                <div class="col-sm-4">
                                    {!! Form::email('email', $tutor->email, ['class' => 'form-control', 'required', 'placeholder' => 'aaa@bbb.ccc', 'maxlength' => '45']) !!}
                                </div>
                                {!! Form::label('celular', 'Celular :', ['class' => 'col-md-1 control-label']) !!}
                                <div class="col-sm-2">
                                    {!! Form::text('celular', $tutor->celular, ['class' => 'form-control', 'required', 'placeholder' => '999999999', 'maxlength' => '9' ]) !!}
                                </div>
                            </div>
                            <div class="form-group">                                
                                {!! Form::label('url', 'Página web :', ['class' => 'col-md-2 control-label']) !!}
                                <div class="col-sm-4">
                                    {!! Form::text('url', $tutor->url, ['class' => 'form-control', 'placeholder' => 'http://www.mipagina.com', 'size' => '10', 'maxlength' => '100']) !!}
                                </div>
                                {!! Form::label('facebook', 'Facebook :', ['class' => 'col-md-1 control-label']) !!}
                                <div class="col-sm-4">
                                    {!! Form::text('facebook', $tutor->facebook, ['class' => 'form-control', 'placeholder' => 'https://www.facebook.com/micuenta', 'maxlength' => '150' ]) !!}
                                </div>
                            </div>
                            <div class="form-group">                                
                                {!! Form::label('twitter', 'Twitter :', ['class' => 'col-md-2 control-label']) !!}
                                <div class="col-sm-4">
                                    {!! Form::text('twitter', $tutor->twitter, ['class' => 'form-control', 'placeholder' => '@micuenta', 'maxlength' => '50']) !!}
                                </div>
                                {!! Form::label('linkedin', 'LinkedIn :', ['class' => 'col-md-1 control-label']) !!}
                                <div class="col-sm-4">
                                    {!! Form::text('linkedin', $tutor->linkedin, ['class' => 'form-control', 'placeholder' => 'https://www.linkedin.com/in/micuenta/', 'maxlength' => '50' ]) !!}
                                </div>
                            </div>
                            
                            <div class="form-group">
                                {!! Form::label('ayu_tutoria', '¿En qué aspecto puedes ayudar en la vida universitaria de un estudiante? :', ['class' => 'col-md-2 control-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::textarea('ayu_tutoria', $tutor->ayu_tutoria, ['class' => 'form-control', 'placeholder' => 'Describe', 'style' => 'display: none;', 'id' => 'ayu_tutoria', 'required']) !!}
                                    <div id="div-ayu_tutoria" class="summernote"></div>
                                </div>
                                <div class="col-sm-8">
                                    
                                </div>
                            </div>

                            <div class="form-group m-b-0">
                                <div class="col-sm-offset-5 col-sm-7">                                        
                                    <a href="{{ route('perfild.index') }}" class="btn btn-danger btn-rounded btn-custom btn-lg m-b-5">
                                        <i class="fa fa-times"></i> <span>Cancelar</span>
                                    </a>
                                    {!! Form::button('<i class="fa fa-floppy-o"></i> <span>Guardar</span>', ['type' => 'submit', 'class' => 'btn btn-success btn-rounded btn-custom btn-lg m-b-5']) !!}  
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
    $( function() {
        $('#div-ayu_tutoria').summernote({
            placeholder: 'Describe toda los aspectos que puedes ayudar',
            disableDragAndDrop: true,
            height: 100, 
            minHeight: 50, 
            maxHeight: 200, 
            lang: 'es-ES',
            disableResizeEditor: false,
            toolbar: [
                ['style', ['bold', 'italic', 'underline']],
                ['color', ['color']],
                ['para', ['paragraph']],
                ['vineta', ['ul', 'ol']],
                ['misc', ['undo', 'redo']]
            ],
        });     
    });
    $(document).on('ready', function(){        
        $('#div-ayu_tutoria').summernote("code", $("#ayu_tutoria").val());
        $('#div-ayu_tutoria').on('summernote.blur', function() {
            $("#ayu_tutoria").val($(this).summernote("code"));    
        });
    });
</script>
@endsection