@extends('layouts.app17')

@section('title','Plan de tutoría')

@section('content')

                            <div id="plan-objetivo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog"> 
                                    <div class="modal-content"> 
                                        
                                        <div class="modal-header"> 
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                                            <h4 class="modal-title">Cronograma de actividades - Objetivo</h4> 
                                        </div> 
                                        
                                        <div class="modal-body"> 
                                            
                                            <div class="row"> 
                                                <div class="col-md-12"> 
                                                    <div class="form-group no-margin"> 
                                                        {!! Form::hidden('objetivo_id', null, ['id' => 'objetivo-id']) !!}
                                                        {!! Form::textarea('objetivo', null, ['class' => 'form-control autogrow', 'placeholder' => 'Ingrese nuevo OBJETIVO', 'style' => 'overflow: hidden; word-wrap: break-word; resize: horizontal; height: 60px;', 'id' => 'objetivo']) !!}                                                        
                                                    </div> 
                                                </div> 
                                            </div> 

                                        </div> 
                                        <div class="modal-footer"> 
                                            {!! Form::button('<i class="fa fa-times"></i> <span>Cancelar</span>', ['type' => 'button', 'class' => 'btn btn-danger btn-rounded btn-custom btn-lg m-b-5', 'data-dismiss' => 'modal']) !!} 
                                            {!! Form::button('<i class="fa fa-floppy-o"></i> <span>Guardar</span>', ['type' => 'button', 'class' => 'btn btn-success btn-rounded btn-custom btn-lg m-b-5', 'data-dismiss' => 'modal', 'id' => 'store-objetivo']) !!} 
                                            {!! Form::button('<i class="fa fa-floppy-o"></i> <span>Actualizar</span>', ['type' => 'button', 'class' => 'btn btn-warning btn-rounded btn-custom btn-lg m-b-5', 'data-dismiss' => 'modal', 'id' => 'update-objetivo']) !!} 
                                        </div> 
                                    </div> 
                                </div>
                            </div>

                            <div id="plan-actividad" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog"> 
                                    <div class="modal-content"> 
                                        
                                        <div class="modal-header"> 
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                                            <h4 class="modal-title">Cronograma de actividades - Actividad</h4> 
                                        </div> 
                                        
                                        <div class="modal-body"> 

                                            <div class="row"> 
                                                <div class="col-md-12"> 
                                                    <div class="form-group no-margin"> 
                                                        {!! Form::hidden('actividad-id', null, ['id' => 'actividad-id']) !!}
                                                        {!! Form::textarea('actividad', null, ['class' => 'form-control autogrow', 'placeholder' => 'ACTIVIDAD', 'style' => 'overflow: hidden; word-wrap: break-word; resize: horizontal; height: 60px;', 'id' => 'actividad']) !!}                                                        
                                                    </div> 
                                                </div> 
                                            </div>
                                            <div class="row"> 
                                                <div class="col-md-6"> 
                                                    <div class="form-group">                                                         
                                                        {!! Form::text('uni_med', null, ['class' => 'form-control', 'required', 'placeholder' => 'UNIDAD DE MEDIDA', 'id' => 'uni_med']) !!}
                                                    </div> 
                                                </div> 
                                                <div class="col-md-6"> 
                                                    <div class="form-group"> 
                                                        {!! Form::text('meta', null, ['class' => 'form-control', 'required', 'placeholder' => 'META', 'id' => 'meta']) !!}
                                                    </div> 
                                                </div> 
                                            </div> 
                                            <div class="row"> 
                                                <div class="col-md-1"> 
                                                    <div class="form-group"></div> 
                                                </div> 
                                                <div class="col-md-2"> 
                                                    <div class="form-group"> 
                                                        <label class="cr-styled">
                                                            {!! Form::checkbox('mes1', 1, false, ['id' => 'mes1']) !!}<i class="fa"></i> Mes 1
                                                        </label>
                                                    </div> 
                                                </div>
                                                <div class="col-md-2"> 
                                                    <div class="form-group"> 
                                                        <label class="cr-styled">
                                                            {!! Form::checkbox('mes2', 1, false, ['id' => 'mes2']) !!}<i class="fa"></i> Mes 2
                                                        </label>
                                                    </div> 
                                                </div>
                                                <div class="col-md-2"> 
                                                    <div class="form-group"> 
                                                        <label class="cr-styled">
                                                            {!! Form::checkbox('mes3', 1, false, ['id' => 'mes3']) !!}<i class="fa"></i> Mes 3
                                                        </label>
                                                    </div> 
                                                </div>
                                                <div class="col-md-2"> 
                                                    <div class="form-group"> 
                                                        <label class="cr-styled">
                                                            {!! Form::checkbox('mes4', 1, false, ['id' => 'mes4']) !!}<i class="fa"></i> Mes 4
                                                        </label>
                                                    </div> 
                                                </div>
                                                <div class="col-md-2"> 
                                                    <div class="form-group"> 
                                                        <label class="cr-styled">
                                                            {!! Form::checkbox('mes5', 1, false, ['id' => 'mes5']) !!}<i class="fa"></i> Mes 5
                                                        </label>
                                                    </div> 
                                                </div>
                                                <div class="col-md-1"> 
                                                    <div class="form-group"></div> 
                                                </div> 
                                            </div>
                                            <div class="row"> 
                                                <div class="col-md-12"> 
                                                    <div class="form-group no-margin"> 
                                                        {!! Form::textarea('responsable', null, ['class' => 'form-control autogrow', 'placeholder' => 'RESPONSABLES', 'style' => 'overflow: hidden; word-wrap: break-word; resize: horizontal; height: 60px;', 'id' => 'responsable']) !!}                                                        
                                                    </div> 
                                                </div> 
                                            </div> 
                                        </div> 
                                        <div class="modal-footer"> 
                                            {!! Form::button('<i class="fa fa-times"></i> <span>Cancelar</span>', ['type' => 'button', 'class' => 'btn btn-danger btn-rounded btn-custom btn-lg m-b-5', 'data-dismiss' => 'modal']) !!} 
                                            {!! Form::button('<i class="fa fa-floppy-o"></i> <span>Guardar</span>', ['type' => 'button', 'class' => 'btn btn-success btn-rounded btn-custom btn-lg m-b-5', 'data-dismiss' => 'modal', 'id' => 'store-actividad']) !!} 
                                            {!! Form::button('<i class="fa fa-floppy-o"></i> <span>Actualizar</span>', ['type' => 'button', 'class' => 'btn btn-warning btn-rounded btn-custom btn-lg m-b-5', 'data-dismiss' => 'modal', 'id' => 'update-actividad']) !!} 
                                        </div> 
                                    </div> 
                                </div>
                            </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="portlet">
                    <div class="portlet-heading bg-success">
                        <h3 class="portlet-title">
                            PLAN DE TUTORÍA Y ACOMPAÑAMIENTO UNIVERSITARIO - IV. CRONOGRAMA DE ACTIVIDADES
                        </h3>
                        <div class="portlet-widgets">
                            <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="portlet-2" class="panel-collapse collapse in">
                        <div class="portlet-body">

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <table id="cronograma" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ACTIVIDADES</th>
                                                <th>UNIDAD DE MEDIDA</th>
                                                <th>META</th>
                                                <th>Mes 1</th>
                                                <th>Mes 2</th>
                                                <th>Mes 3</th>
                                                <th>Mes 4</th>
                                                <th>Mes 5</th>
                                                <th>RESPONSABLES</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        @foreach ($planobjetivos as $planobjetivo)
                                            @php
                                                $buttonid = "button-".$planobjetivo->id;
                                            @endphp
                                        <tbody id="tbody-{{$planobjetivo->id}}">
                                            <tr>
                                                <th colspan="7" id="objetivo-{{$planobjetivo->id}}">OBJETIVO: {{$planobjetivo->objetivo}}</th>
                                                <th colspan="3">
                                                    {!! Form::button('<i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i>', ['type' => 'button', 'class' => 'icon-edit btn-cronograma edit-objetivo',  'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => 'Modificar objetivo', 'data-objetivo-id' => $planobjetivo->id, 'data-objetivo' => $planobjetivo->objetivo, 'id' => $buttonid ]) !!}

                                                    {!! Form::button('<i class="fa fa-tasks fa-lg" aria-hidden="true"></i>', ['type' => 'button', 'class' => 'icon-new btn-cronograma new-actividad',  'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => 'Nueva actividad', 'data-objetivo-id' => $planobjetivo->id, 'id' => $buttonid ]) !!}
                                                </th>
                                            </tr>    
                                            @foreach ($planobjetivo->actividades as $planactividad)
                                                @include('plan.cronograma-actividad')
                                            @endforeach
                                        </tbody>
                                        @endforeach                                        
                                    </table>                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group m-b-0">
                                        <div class="col-sm-offset-5 col-sm-7">
                                            {!! Form::button('<i class="fa fa-calendar-plus-o"></i> <span>Nuevo Objetivo</span>', ['type' => 'button', 'class' => 'btn btn-primary btn-rounded btn-custom btn-lg m-t-5', 'id' => 'new-objetivo']) !!}  
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
<script src="{{ asset('assets/tutoria17/js/cronograma.js') }}"></script>
@endsection