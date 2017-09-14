@extends('layouts.app17')

@section('title','Comunicados')

@section('content')

                            <div id="head-comunicado" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="">
                                <div class="modal-dialog"> 
                                    <div class="modal-content"> 
                                        
                                        <div class="modal-header"> 
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                                            <h4 class="modal-title">Comunicado</h4> 
                                        </div> 
                                        
                                        <div class="modal-body"> 
                                            {!! Form::hidden('comunicado-id', null, ['id' => 'comunicado-id']) !!}
                                            <div class="row" id="div-cod_car"> 
                                                <div class="col-md-12"> 
                                                    <div class="form-group no-margin">                                                         
                                                        {!! Form::select('cod_car', $carreras, null, ['class' => 'form-control select-carrera', 'required', 'data-placeholder' => 'Selecione la Escuela Profesional', 'id' => 'cod_car']) !!}
                                                    </div> 
                                                </div> 
                                            </div>
                                            <div class="row" id="div-para"> 
                                                <div class="col-md-12"> 
                                                    <div class="form-group no-margin"> 
                                                        {!! Form::select('para', $para, null, ['class' => 'form-control', 'required', 'data-placeholder' => 'Selecione Destinatario', 'id' => 'para']) !!}
                                                    </div> 
                                                </div> 
                                            </div>
                                            <div class="row"> 
                                                <div class="col-md-12"> 
                                                    <div class="form-group no-margin"> 
                                                        {!! Form::text('asunto', null, ['class' => 'form-control', 'placeholder' => 'Asunto', 'required', 'id' => 'asunto']) !!}
                                                    </div> 
                                                </div> 
                                            </div>
                                            <div class="row"> 
                                                <div class="col-md-12"> 
                                                    <div class="form-group no-margin"> 
                                                        {!! Form::textarea('mensaje', null, ['class' => 'form-control', 'placeholder' => 'Ingrese mensaje', 'style' => 'display: none;', 'id' => 'mensaje']) !!}
                                                        <div id="div-mensaje" class="summernote"></div>
                                                    </div> 
                                                </div> 
                                            </div>

                                        </div> 
                                        <div class="modal-footer"> 
                                            {!! Form::button('<i class="fa fa-times"></i> <span>Cancelar</span>', ['type' => 'button', 'class' => 'btn btn-danger btn-rounded btn-custom btn-lg m-b-5', 'data-dismiss' => 'modal']) !!} 
                                            {!! Form::button('<i class="fa fa-floppy-o"></i> <span>Guardar</span>', ['type' => 'button', 'class' => 'btn btn-success btn-rounded btn-custom btn-lg m-b-5', 'data-dismiss' => 'modal', 'id' => 'store-comunicado']) !!} 
                                            {!! Form::button('<i class="fa fa-floppy-o"></i> <span>Actualizar</span>', ['type' => 'button', 'class' => 'btn btn-warning btn-rounded btn-custom btn-lg m-b-5', 'data-dismiss' => 'modal', 'id' => 'update-comunicado']) !!}  
                                        </div> 
                                    </div> 
                                </div>
                            </div>


        <div class="row">
            <div class="col-lg-12">
                <div class="portlet">
                    <div class="portlet-heading bg-primary">
                        <h3 class="portlet-title">
                            Lista de comunicados
                        </h3>
                        <div class="portlet-widgets">
                            <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="portlet-2" class="panel-collapse collapse in">
                        <div class="portlet-body">

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12" id="comunicados">
                                    @include('comunicado.index-comunicado')
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group m-b-0">
                                        <div class="col-sm-offset-5 col-sm-7">
                                            {!! Form::button('<i class="fa fa-bell-o"></i> <span>Nuevo Comunicado</span>', ['type' => 'button', 'class' => 'btn btn-primary btn-rounded btn-custom btn-lg m-t-5', 'id' => 'new-comunicado']) !!}
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
<script src="{{ asset('assets/tutoria17/js/comunicado.js') }}"></script>
@endsection