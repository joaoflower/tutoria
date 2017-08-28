@extends('layouts.app17')

@section('title','Perfil')

@section('content')

        <div class="row">
            <div class="col-lg-12">
                <div class="portlet">
                    <div class="portlet-heading bg-success">
                        <h3 class="portlet-title">
                            PERFIL - Información básica del estudiante
                        </h3>
                        <div class="portlet-widgets">
                            <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="portlet-2" class="panel-collapse collapse in">
                        <div class="portlet-body">

                        {!! Form::open(['route' => 'perfile.store2', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
                            
                            <div class="form-group">                                
                                {!! Form::label('email', 'Correo electrónico :', ['class' => 'col-md-2 control-label']) !!}
                                <div class="col-sm-4">
                                    {!! Form::email('email', $tutorado->email, ['class' => 'form-control', 'required', 'placeholder' => 'aaa@bbb.ccc', 'maxlength' => '45']) !!}
                                </div>
                                {!! Form::label('celular', 'Celular :', ['class' => 'col-md-1 control-label']) !!}
                                <div class="col-sm-2">
                                    {!! Form::text('celular', $tutorado->celular, ['class' => 'form-control', 'required', 'placeholder' => '999999999', 'maxlength' => '9' ]) !!}
                                </div>
                            </div>
                            <div class="form-group">                                
                                {!! Form::label('url', 'Página web :', ['class' => 'col-md-2 control-label']) !!}
                                <div class="col-sm-4">
                                    {!! Form::text('url', $tutorado->url, ['class' => 'form-control', 'placeholder' => 'http://www.mipagina.com', 'size' => '10', 'maxlength' => '100']) !!}
                                </div>
                                {!! Form::label('facebook', 'Facebook :', ['class' => 'col-md-1 control-label']) !!}
                                <div class="col-sm-4">
                                    {!! Form::text('facebook', $tutorado->facebook, ['class' => 'form-control', 'placeholder' => 'https://www.facebook.com/micuenta', 'maxlength' => '150' ]) !!}
                                </div>
                            </div>
                            <div class="form-group">                                
                                {!! Form::label('twitter', 'Twitter :', ['class' => 'col-md-2 control-label']) !!}
                                <div class="col-sm-4">
                                    {!! Form::text('twitter', $tutorado->twitter, ['class' => 'form-control', 'placeholder' => '@micuenta', 'maxlength' => '50']) !!}
                                </div>
                                {!! Form::label('linkedin', 'LinkedIn :', ['class' => 'col-md-1 control-label']) !!}
                                <div class="col-sm-4">
                                    {!! Form::text('linkedin', $tutorado->linkedin, ['class' => 'form-control', 'placeholder' => 'https://www.linkedin.com/in/micuenta/', 'maxlength' => '50' ]) !!}
                                </div>
                            </div>
                            <div class="form-group">   
                                {!! Form::label('item', 'En los siguientes cuadros marcar cada frase si es afirmativa :', ['class' => 'col-md-2 control-label']) !!}                            
                                <div class="col-sm-5">
                                    <table class="table table-striped table-bordered table-hover ">
                                        <thead>
                                            <tr class="success">
                                                <th colspan="2"><strong>Hábitos de estudio:</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($itemhabitos as $itemhabito)
                                            <tr>
                                                <td>{{ $itemhabito->name }}</td>
                                                <td>
                                                @if ($tutorado_hab[$itemhabito->id])
                                                    {!! Form::checkbox('tutorado_hab['.$itemhabito->id.']', 1, true) !!}
                                                @else
                                                    {!! Form::checkbox('tutorado_hab['.$itemhabito->id.']') !!}
                                                @endif                                                      
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-sm-4">
                                    <table class="table table-striped table-bordered table-hover ">
                                        <thead>
                                            <tr class="success">
                                                <th colspan="2"><strong>Principales pasatiempos, hobbies y otros:</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($itemhobbies as $itemhobby)
                                            <tr>
                                                <td>{{ $itemhobby->name }}</td>
                                                <td>
                                                @if ($tutorado_hob[$itemhobby->id])
                                                    {!! Form::checkbox('tutorado_hob['.$itemhobby->id.']', 1, true) !!}
                                                @else
                                                    {!! Form::checkbox('tutorado_hob['.$itemhobby->id.']') !!}
                                                @endif  
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>


                            <div class="form-group m-b-0">
                                <div class="col-sm-offset-5 col-sm-7">                                        
                                    <a href="{{ route('perfile.index') }}" class="btn btn-danger btn-rounded btn-custom btn-lg m-b-5">
                                        <i class="fa fa-times"></i> <span>Cancelar</span>
                                    </a>
                                    {!! Form::button('<i class="fa fa-floppy-o"></i> <span>Finalizar</span>', ['type' => 'submit', 'class' => 'btn btn-success btn-rounded btn-custom btn-lg m-b-5']) !!}  
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
     
    });
    $(document).on('ready', function(){

    });
</script>
@endsection