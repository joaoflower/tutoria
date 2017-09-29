@extends('layouts.app17')

@section('title','Plan de tutoría')

@section('content')

                            <div id="plan-evaluacion" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog"> 
                                    <div class="modal-content"> 
                                        
                                        <div class="modal-header"> 
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                                            <h4 class="modal-title">Evaluación</h4> 
                                        </div> 
                                        
                                        <div class="modal-body"> 
                                            
                                            <div class="row"> 
                                                <div class="col-md-12"> 
                                                    <div class="form-group no-margin"> 
                                                        {!! Form::textarea('evaluacion', $plan->evaluacion, ['class' => 'form-control autogrow', 'placeholder' => 'Ingrese la estrategia de evaluación del plan', 'style' => 'overflow: hidden; word-wrap: break-word; resize: horizontal; height: 100px;', 'id' => 'evaluacion']) !!}                                                        
                                                    </div> 
                                                </div> 
                                            </div>
                                            <div class="row"> 
                                                <div class="col-md-12"> 
                                                    <div class="form-group no-margin"> 
                                                        {!! Form::textarea('asistentes', $plan->asistentes, ['class' => 'form-control autogrow', 'placeholder' => 'Ingrese la lista de asistencia de los participantes en el proceso de planificación', 'style' => 'overflow: hidden; word-wrap: break-word; resize: horizontal; height: 100px;', 'id' => 'asistentes']) !!}                                                        
                                                    </div> 
                                                </div> 
                                            </div> 

                                        </div> 
                                        <div class="modal-footer"> 
                                            {!! Form::button('<i class="fa fa-times"></i> <span>Cancelar</span>', ['type' => 'button', 'class' => 'btn btn-danger btn-rounded btn-custom btn-lg m-b-5', 'data-dismiss' => 'modal']) !!} 
                                            {!! Form::button('<i class="fa fa-floppy-o"></i> <span>Guardar</span>', ['type' => 'button', 'class' => 'btn btn-success btn-rounded btn-custom btn-lg m-b-5', 'data-dismiss' => 'modal', 'id' => 'store-evaluacion']) !!} 
                                        </div> 
                                    </div> 
                                </div>
                            </div>


        <div class="row">
            <div class="col-lg-12">
                <div class="portlet">
                    <div class="portlet-heading bg-primary">
                        <h3 class="portlet-title">
                            PLAN DE TUTORÍA Y ACOMPAÑAMIENTO UNIVERSITARIO - III. DIAGNÓSTICO
                        </h3>
                        <div class="portlet-widgets">
                            <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="portlet-2" class="panel-collapse collapse in">
                        <div class="portlet-body">

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12" id="sesindi17s">
                                    <table class="table table-striped table-bordered">

                                        <thead>
                                            <tr>
                                                <th>INDICADORES</th>
                                                <th>Data</th>
                                                <th>Meta</th>
                                                <th>PROBLEMAS</th>
                                                <th>CAUSAS</th>
                                                <th>ALTERNATIVAS DE SOLUCIÓN</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($planfactores as $planfactor)
                                            <tr>
                                                <th colspan="7">FACTOR: {{$planfactor->itemfactor->name}}</th>
                                            </tr>
                                            @foreach ($planfactor->itemindicadores as $itemindicador)
                                            <tr>
                                                <td>{{$itemindicador->name}}</td>
                                                <td>{{$itemindicador->pivot->data}}</td>
                                                <td>{{$itemindicador->pivot->meta}}</td>
                                                <td>{{$itemindicador->pivot->problema}}</td>
                                                <td>{{$itemindicador->pivot->causa}}</td>
                                                <td>{{$itemindicador->pivot->alternativa}}</td>
                                            </tr>                                            
                                            @endforeach 
                                            <tr>
                                                <td colspan="7">OBJETIVOS: {{$planfactor->objetivo}}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7">FORTALEZAS: {{$planfactor->fortaleza}}</td>
                                            </tr>
                                        @endforeach 
                                        </tbody>

                                    </table>
                                </div>
                            </div> 
                            @if(Auth::user()->type == 'head') 
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group m-b-0">
                                        <div class="col-sm-offset-5 col-sm-7">
                                            <a href="{{ route('plan.edit', '112358') }}" class="btn btn-info btn-rounded btn-custom btn-lg m-b-5">
                                                <i class="fa fa-pencil-square-o"></i> <span>Elaborar/Modificar Diagnóstico</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>                                  
                            @endif
                        </div>
                    </div>
                </div> 
            </div> 
        </div> 

        <div class="row">
            <div class="col-lg-12">
                <div class="portlet">
                    <div class="portlet-heading bg-primary">
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
                                <div class="col-md-12 col-sm-12 col-xs-12" id="sesindi17s">
                                    <table class="table table-striped table-bordered">

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
                                            </tr>
                                        </thead>
                                        @foreach ($planfactores as $planobjetivo)
                                        <tbody>
                                            <tr>
                                                <th colspan="9">OBJETIVO: {{$planobjetivo->objetivo}}</th>
                                            </tr>    
                                            @foreach ($planobjetivo->actividades as $planactividad)
                                            <tr>
                                                <td>{{$planactividad->actividad}}</td>
                                                <td>{{$planactividad->uni_med}}</td>
                                                <td>{{$planactividad->meta}}</td>
                                                <td>{{$planactividad->mes1}}</td>
                                                <td>{{$planactividad->mes2}}</td>
                                                <td>{{$planactividad->mes3}}</td>
                                                <td>{{$planactividad->mes4}}</td>
                                                <td>{{$planactividad->mes5}}</td>
                                                <td>{{$planactividad->responsable}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        @endforeach 

                                    </table>
                                </div>
                            </div> 
                            @if(Auth::user()->type == 'head') 
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group m-b-0">
                                        <div class="col-sm-offset-5 col-sm-7">
                                            <a href="{{ route('plan.cronograma') }}" class="btn btn-info btn-rounded btn-custom btn-lg m-b-5">
                                                <i class="fa fa-pencil-square-o"></i> <span>Elaborar/Modificar Cronograma</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>                                  
                            @endif
                        </div>
                    </div>
                </div> 
            </div> 
        </div> 

        <div class="row">
            <div class="col-lg-12">
                <div class="portlet">
                    <div class="portlet-heading bg-primary">
                        <h3 class="portlet-title">
                            PLAN DE TUTORÍA Y ACOMPAÑAMIENTO UNIVERSITARIO - V. EVALUACIÓN
                        </h3>
                        <div class="portlet-widgets">
                            <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="portlet-2" class="panel-collapse collapse in">
                        <div class="portlet-body">

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12" id="sesindi17s">
                                    <table class="table table-striped table-bordered">

                                        <tbody>
                                            <tr>
                                                <th>Estrategia de evaluación del plan por parte de la escuela profesional.</th>
                                            </tr>    
                                            <tr>
                                                <td id="td-evaluacion">{{$plan->evaluacion}}</td>
                                            </tr>
                                            <tr>
                                                <th>Lista de asistencia de los participantes en el proceso de planificación.</th>
                                            </tr>    
                                            <tr>
                                                <td id="td-asistentes">{{$plan->asistentes}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>  
                            @if(Auth::user()->type == 'head')
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group m-b-0">
                                        <div class="col-sm-offset-5 col-sm-7">
                                            {!! Form::button('<i class="fa fa-pencil-square-o"></i> <span>Elaborar/Modificar Evaluación</span>', ['type' => 'button', 'class' => 'btn btn-info btn-rounded btn-custom btn-lg m-b-5', 'id' => 'edit-evaluacion']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>                                  
                            @endif
                        </div>
                    </div>
                </div> 
            </div> 
        </div> 
  
@endsection
@section('js')
<script src="{{ asset('assets/tutoria17/js/evaluacion.js') }}"></script>
@endsection