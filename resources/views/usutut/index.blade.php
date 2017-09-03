@extends('layouts.app17')

@section('title','Coordinadores de tutoría')

@section('content')


							<div id="usutut-coordinador" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="">
                                <div class="modal-dialog"> 
                                    <div class="modal-content"> 
                                        
                                        <div class="modal-header"> 
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                                            <h4 class="modal-title">Coordinador de tutoría</h4> 
                                        </div> 
                                        
                                        <div class="modal-body"> 

                                            <div class="row" id="div-cod_car"> 
                                                <div class="col-md-12"> 
                                                    <div class="form-group no-margin"> 
                                                        {!! Form::hidden('coordinador-id', null, ['id' => 'coordinador-id']) !!}
                                                        {!! Form::select('cod_car', $carreras, null, ['class' => 'form-control select-carrera', 'required', 'data-placeholder' => 'Selecione la Escuela Profesional', 'id' => 'cod_car']) !!}
                                                    </div> 
                                                </div> 
                                            </div>
                                            <div class="row" id="div-cod_prf"> 
                                                <div class="col-md-12"> 
                                                    <div class="form-group no-margin"> 
                                                        {!! Form::select('cod_prf', [], null, ['class' => 'form-control', 'required', 'data-placeholder' => 'Selecione Docente', 'id' => 'cod_prf']) !!}
                                                    </div> 
                                                </div> 
                                            </div>
                                            <div class="row" id="div-name"> 
                                                <div class="col-md-12"> 
                                                    <div class="form-group no-margin"> 
                                                        {!! Form::label('name', null, ['class' => 'control-label', 'id' => 'name']) !!}
                                                    </div> 
                                                </div> 
                                            </div>
                                            <div class="row"> 
                                                <div class="col-md-12"> 
                                                    <div class="form-group no-margin"> 
                                                        {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'user@mail.com', 'required', 'id' => 'email']) !!}
                                                    </div> 
                                                </div> 
                                            </div>
                                            <div class="row"> 
                                                <div class="col-md-12"> 
                                                    <div class="form-group no-margin"> 
                                                        {!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Usuario', 'required', 'id' => 'username']) !!}
                                                    </div> 
                                                </div> 
                                            </div>
                                            <div class="row"> 
                                                <div class="col-md-12"> 
                                                    <div class="form-group no-margin"> 
                                                        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Contraseña', 'required', 'id' => 'password']) !!}
                                                    </div> 
                                                </div> 
                                            </div>

                                        </div> 
                                        <div class="modal-footer"> 
                                            {!! Form::button('<i class="fa fa-times"></i> <span>Cancelar</span>', ['type' => 'button', 'class' => 'btn btn-danger btn-rounded btn-custom btn-lg m-b-5', 'data-dismiss' => 'modal']) !!} 
                                            {!! Form::button('<i class="fa fa-floppy-o"></i> <span>Guardar</span>', ['type' => 'button', 'class' => 'btn btn-success btn-rounded btn-custom btn-lg m-b-5', 'data-dismiss' => 'modal', 'id' => 'store-coordinador']) !!} 
                                            {!! Form::button('<i class="fa fa-floppy-o"></i> <span>Actualizar</span>', ['type' => 'button', 'class' => 'btn btn-warning btn-rounded btn-custom btn-lg m-b-5', 'data-dismiss' => 'modal', 'id' => 'update-coordinador']) !!} 
                                        </div> 
                                    </div> 
                                </div>
                            </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="portlet">
                    <div class="portlet-heading bg-primary">
                        <h3 class="portlet-title">
                            Lista de coordinadores
                        </h3>
                        <div class="portlet-widgets">
                            <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="portlet-2" class="panel-collapse collapse in">
                        <div class="portlet-body">

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12" id="coordinadores">
                                    @include('usutut.index-coordinador')
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group m-b-0">
                                        <div class="col-sm-offset-5 col-sm-7">
                                            {!! Form::button('<i class="fa fa-user-plus"></i> <span>Nuevo Coordinador</span>', ['type' => 'button', 'class' => 'btn btn-primary btn-rounded btn-custom btn-lg m-t-5', 'id' => 'new-coordinador']) !!}
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
<script src="{{ asset('assets/tutoria17/js/coordinador.js') }}"></script>
@endsection