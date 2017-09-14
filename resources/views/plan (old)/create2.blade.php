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

                        {!! Form::open(['route' => 'plan.store2', 'method' => 'POST', 'class' => 'form-horizontal plan']) !!}    
                            <div class="form-group">                                
                                <div class="col-sm-12">
                                    <p class="form-control-static"><strong>2. Permanencia semestral  de los estudiantes en  la Universidad.</strong></p>
                                </div>
                            </div>
                            <div class="form-group">                                
                                <div class="col-sm-7">
                                    <p class="form-control-static">a. Porcentaje de estudiantes que permanecen matriculados en el semestre lectivo, con respecto al semestre anterior.</p>
                                </div>   
                                <div class="col-sm-1">
                                    {!! Form::input('text','pepmsl_data', $plan->pepmsl_data, ['class' => 'form-control', 'required', 'placeholder' => 'Data']) !!}
                                </div>                             
                                <div class="col-sm-1">
                                    {!! Form::input('text','pepmsl_meta', $plan->pepmsl_meta, ['class' => 'form-control', 'required', 'placeholder' => 'Meta']) !!}
                                </div>                             
                            </div>
                            <div class="form-group">                                
                                <div class="col-sm-3">
                                    {!! Form::textarea('pepmsl_pro', $plan->pepmsl_pro, ['class' => 'form-control', 'placeholder' => 'Problemas', 'required', 'rows' => '2']) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::textarea('pepmsl_cau', $plan->pepmsl_cau, ['class' => 'form-control', 'placeholder' => 'Causas', 'required', 'rows' => '2']) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::textarea('pepmsl_alt', $plan->pepmsl_alt, ['class' => 'form-control', 'placeholder' => 'Alternativas de solución', 'required', 'rows' => '2']) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::textarea('pepmsl_obj', $plan->pepmsl_obj, ['class' => 'form-control', 'placeholder' => 'Objetivos', 'required', 'rows' => '2']) !!}
                                </div>
                            </div>

                            <div class="form-group">                                
                                <div class="col-sm-7">
                                    <p class="form-control-static">b. Porcentaje de estudiantes matriculados que concluyen el semestre académico.</p>
                                </div>   
                                <div class="col-sm-1">
                                    {!! Form::input('text','pemcsa_data', $plan->pemcsa_data, ['class' => 'form-control', 'required', 'placeholder' => 'Data']) !!}
                                </div>                             
                                <div class="col-sm-1">
                                    {!! Form::input('text','pemcsa_meta', $plan->pemcsa_meta, ['class' => 'form-control', 'required', 'placeholder' => 'Meta']) !!}
                                </div>                             
                            </div>
                            <div class="form-group">                                
                                <div class="col-sm-3">
                                    {!! Form::textarea('pemcsa_pro', $plan->pemcsa_pro, ['class' => 'form-control', 'placeholder' => 'Problemas', 'required', 'rows' => '2']) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::textarea('pemcsa_cau', $plan->pemcsa_cau, ['class' => 'form-control', 'placeholder' => 'Causas', 'required', 'rows' => '2']) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::textarea('pemcsa_alt', $plan->pemcsa_alt, ['class' => 'form-control', 'placeholder' => 'Alternativas de solución', 'required', 'rows' => '2']) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::textarea('pemcsa_obj', $plan->pemcsa_obj, ['class' => 'form-control', 'placeholder' => 'Objetivos', 'required', 'rows' => '2']) !!}
                                </div>
                            </div>

                            <div class="form-group">                                
                                <div class="col-sm-7">
                                    <p class="form-control-static">c. Número de estudiantes reportados por inasistencia al finalizar la 5ta semana, por los docentes de curso.</p>
                                </div>   
                                <div class="col-sm-1">
                                    {!! Form::input('text','nerif5_data', $plan->nerif5_data, ['class' => 'form-control', 'required', 'placeholder' => 'Data']) !!}
                                </div>                             
                                <div class="col-sm-1">
                                    {!! Form::input('text','nerif5_meta', $plan->nerif5_meta, ['class' => 'form-control', 'required', 'placeholder' => 'Meta']) !!}
                                </div>                             
                            </div>
                            <div class="form-group">                                
                                <div class="col-sm-3">
                                    {!! Form::textarea('nerif5_pro', $plan->nerif5_pro, ['class' => 'form-control', 'placeholder' => 'Problemas', 'required', 'rows' => '2']) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::textarea('nerif5_cau', $plan->nerif5_cau, ['class' => 'form-control', 'placeholder' => 'Causas', 'required', 'rows' => '2']) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::textarea('nerif5_alt', $plan->nerif5_alt, ['class' => 'form-control', 'placeholder' => 'Alternativas de solución', 'required', 'rows' => '2']) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::textarea('nerif5_obj', $plan->nerif5_obj, ['class' => 'form-control', 'placeholder' => 'Objetivos', 'required', 'rows' => '2']) !!}
                                </div>
                            </div>

                            <div class="form-group">                                
                                <div class="col-sm-1">
                                    <p class="form-control-static">Fortalezas: </p>
                                </div> 
                                <div class="col-sm-8">
                                    {!! Form::textarea('pseuna_for', $plan->pseuna_for, ['class' => 'form-control', 'placeholder' => 'Fortalezas', 'required', 'rows' => '2']) !!}
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