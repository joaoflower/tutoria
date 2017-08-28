@extends('layouts.app17')

@section('title','Plan de tutoría')

@section('content')

        <div class="row">
            <div class="col-lg-12">
                <div class="portlet">
                    <div class="portlet-heading bg-success">
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

                        {!! Form::open(['route' => 'plan.store', 'method' => 'POST', 'class' => 'form-horizontal plan']) !!}    
                            <div class="form-group">                                
                                <div class="col-sm-12">
                                    <p class="form-control-static"><strong>1. Progreso académico semestral de todas y todos los estudiantes de la Universidad.</strong></p>
                                </div>
                            </div>
                            <div class="form-group">                                
                                <div class="col-sm-7">
                                    <p class="form-control-static">a. Porcentaje de estudiantes que aprueban el semestre académico.</p>
                                </div>   
                                <div class="col-sm-1">
                                    {!! Form::input('text','peasa_data', $plan->peasa_data, ['class' => 'form-control', 'required', 'placeholder' => 'Data']) !!}
                                </div>                             
                                <div class="col-sm-1">
                                    {!! Form::input('text','peasa_meta', $plan->peasa_meta, ['class' => 'form-control', 'required', 'placeholder' => 'Meta']) !!}
                                </div>                             
                            </div>
                            <div class="form-group">                                
                                <div class="col-sm-3">
                                    {!! Form::textarea('peasa_pro', $plan->peasa_pro, ['class' => 'form-control', 'placeholder' => 'Problemas', 'required', 'rows' => '2']) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::textarea('peasa_cau', $plan->peasa_cau, ['class' => 'form-control', 'placeholder' => 'Causas', 'required', 'rows' => '2']) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::textarea('peasa_alt', $plan->peasa_alt, ['class' => 'form-control', 'placeholder' => 'Alternativas de solución', 'required', 'rows' => '2']) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::textarea('peasa_obj', $plan->peasa_obj, ['class' => 'form-control', 'placeholder' => 'Objetivos', 'required', 'rows' => '2']) !!}
                                </div>
                            </div>

                            <div class="form-group">                                
                                <div class="col-sm-7">
                                    <p class="form-control-static">b. Número de estudiantes en riesgo académico.</p>
                                </div>   
                                <div class="col-sm-1">
                                    {!! Form::input('text','nera_data', $plan->nera_data, ['class' => 'form-control', 'required', 'placeholder' => 'Data']) !!}
                                </div>                             
                                <div class="col-sm-1">
                                    {!! Form::input('text','nera_meta', $plan->nera_meta, ['class' => 'form-control', 'required', 'placeholder' => 'Meta']) !!}
                                </div>                             
                            </div>
                            <div class="form-group">                                
                                <div class="col-sm-3">
                                    {!! Form::textarea('nera_pro', $plan->nera_pro, ['class' => 'form-control', 'placeholder' => 'Problemas', 'required', 'rows' => '2']) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::textarea('nera_cau', $plan->nera_cau, ['class' => 'form-control', 'placeholder' => 'Causas', 'required', 'rows' => '2']) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::textarea('nera_alt', $plan->nera_alt, ['class' => 'form-control', 'placeholder' => 'Alternativas de solución', 'required', 'rows' => '2']) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::textarea('nera_obj', $plan->nera_obj, ['class' => 'form-control', 'placeholder' => 'Objetivos', 'required', 'rows' => '2']) !!}
                                </div>
                            </div>

                            <div class="form-group">                                
                                <div class="col-sm-7">
                                    <p class="form-control-static">c. Número y tipo de acciones de mejora  académica realizadas en el semestre anterior.</p>
                                </div>   
                                <div class="col-sm-1">
                                    {!! Form::input('text','ntama_data', $plan->ntama_data, ['class' => 'form-control', 'required', 'placeholder' => 'Data']) !!}
                                </div>                             
                                <div class="col-sm-1">
                                    {!! Form::input('text','ntama_meta', $plan->ntama_meta, ['class' => 'form-control', 'required', 'placeholder' => 'Meta']) !!}
                                </div>                             
                            </div>
                            <div class="form-group">                                
                                <div class="col-sm-3">
                                    {!! Form::textarea('ntama_pro', $plan->ntama_pro, ['class' => 'form-control', 'placeholder' => 'Problemas', 'required', 'rows' => '2']) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::textarea('ntama_cau', $plan->ntama_cau, ['class' => 'form-control', 'placeholder' => 'Causas', 'required', 'rows' => '2']) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::textarea('ntama_alt', $plan->ntama_alt, ['class' => 'form-control', 'placeholder' => 'Alternativas de solución', 'required', 'rows' => '2']) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::textarea('ntama_obj', $plan->ntama_obj, ['class' => 'form-control', 'placeholder' => 'Objetivos', 'required', 'rows' => '2']) !!}
                                </div>
                            </div>

                            <div class="form-group">                                
                                <div class="col-sm-1">
                                    <p class="form-control-static">Fortalezas: </p>
                                </div> 
                                <div class="col-sm-8">
                                    {!! Form::textarea('paste_for', $plan->paste_for, ['class' => 'form-control', 'placeholder' => 'Fortalezas', 'required', 'rows' => '2']) !!}
                                </div>
                            </div>

                            <div class="form-group m-b-0">
                                <div class="col-sm-offset-5 col-sm-7">                                        
                                    <a href="{{ route('plan.index') }}" class="btn btn-danger btn-rounded btn-custom btn-lg m-b-5">
                                        <i class="fa fa-times"></i> <span>Cancelar</span>
                                    </a>
                                    {!! Form::button('<i class="fa fa-arrow-right"></i> <span>Siguiente</span>', ['type' => 'submit', 'class' => 'btn btn-success btn-rounded btn-custom btn-lg m-b-5']) !!}  
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

    </script>
@endsection