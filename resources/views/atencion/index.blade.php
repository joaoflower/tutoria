@extends('layouts.app17')

@section('title','Referidos')

@section('content')

                            <div id="oficina-atencion" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="">
                                <div class="modal-dialog"> 
                                    <div class="modal-content"> 
                                        
                                        <div class="modal-header"> 
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                                            <h4 class="modal-title">Atención a referidos</h4> 
                                        </div> 
                                        
                                        <div class="modal-body"> 
                                            {!! Form::hidden('atencion-id', null, ['id' => 'atencion-id']) !!}

                                            <div class="row"> 
                                                <div class="col-md-6"> 
                                                    <div class="form-group no-margin"> 
                                                        {!! Form::select('atendido', $atendido, null, ['class' => 'form-control', 'required', 'data-placeholder' => 'Selecione Atención', 'id' => 'atendido']) !!}
                                                    </div> 
                                                </div> 
                                                <div class="col-md-6"> 
                                                    <div class="form-group no-margin"> 
                                                         {!! Form::input('date','fecha', null, ['class' => 'form-control fechas', 'required', 'placeholder' => 'Fecha', 'id' => 'fecha']) !!}
                                                    </div> 
                                                </div> 
                                            </div>
                                            <div class="row"> 
                                                <div class="col-md-12"> 
                                                    <div class="form-group no-margin"> 
                                                        {!! Form::textarea('recomendacion', null, ['class' => 'form-control', 'placeholder' => 'Ingrese recomendación', 'style' => 'display: none;', 'id' => 'recomendacion']) !!}
                                                        <div id="div-recomendacion" class="summernote"></div>
                                                    </div> 
                                                </div> 
                                            </div>

                                        </div> 
                                        <div class="modal-footer"> 
                                            {!! Form::button('<i class="fa fa-times"></i> <span>Cancelar</span>', ['type' => 'button', 'class' => 'btn btn-danger btn-rounded btn-custom btn-lg m-b-5', 'data-dismiss' => 'modal']) !!} 
                                            {!! Form::button('<i class="fa fa-floppy-o"></i> <span>Guardar</span>', ['type' => 'button', 'class' => 'btn btn-success btn-rounded btn-custom btn-lg m-b-5', 'data-dismiss' => 'modal', 'id' => 'store-atencion']) !!} 
                                            {!! Form::button('<i class="fa fa-floppy-o"></i> <span>Actualizar</span>', ['type' => 'button', 'class' => 'btn btn-warning btn-rounded btn-custom btn-lg m-b-5', 'data-dismiss' => 'modal', 'id' => 'update-atencion']) !!}  
                                        </div> 
                                    </div> 
                                </div>
                            </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="portlet">
                    <div class="portlet-heading bg-primary">
                        <h3 class="portlet-title">
                            Atenciones realizadas a tutorados referidos
                        </h3>
                        <div class="portlet-widgets">
                            <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="portlet-2" class="panel-collapse collapse in">
                        <div class="portlet-body">

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12" id="atendidos">
                                    @include('atencion.index-atencion')
                                </div>
                            </div>

                        </div>
                    </div>
                </div> 
            </div> 
        </div> 
  
@endsection
@section('js')
<script src="{{ asset('assets/tutoria17/js/atencion.js') }}"></script>
@endsection