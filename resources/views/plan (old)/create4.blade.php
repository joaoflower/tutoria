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

                        {!! Form::open(['route' => 'plan.store4', 'method' => 'POST', 'class' => 'form-horizontal plan']) !!}    
                            <div class="form-group">                                
                                <div class="col-sm-12">
                                    <p class="form-control-static"><strong>4. Acompañamiento y monitoreo a la práctica tutorial  universitaria.</strong></p>
                                </div>
                            </div>
                            <div class="form-group">                                
                                <div class="col-sm-7">
                                    <p class="form-control-static">a. Porcentaje de reuniones de gestión de la  tutoría, en la escuela profesional han sido ejecutadas.</p>
                                </div>   
                                <div class="col-sm-1">
                                    {!! Form::input('text','prgtep_data', $plan->prgtep_data, ['class' => 'form-control', 'required', 'placeholder' => 'Data']) !!}
                                </div>                             
                                <div class="col-sm-1">
                                    {!! Form::input('text','prgtep_meta', $plan->prgtep_meta, ['class' => 'form-control', 'required', 'placeholder' => 'Meta']) !!}
                                </div>                             
                            </div>
                            <div class="form-group">                                
                                <div class="col-sm-3">
                                    {!! Form::textarea('prgtep_pro', $plan->prgtep_pro, ['class' => 'form-control', 'placeholder' => 'Problemas', 'required', 'rows' => '2']) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::textarea('prgtep_cau', $plan->prgtep_cau, ['class' => 'form-control', 'placeholder' => 'Causas', 'required', 'rows' => '2']) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::textarea('prgtep_alt', $plan->prgtep_alt, ['class' => 'form-control', 'placeholder' => 'Alternativas de solución', 'required', 'rows' => '2']) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::textarea('prgtep_obj', $plan->prgtep_obj, ['class' => 'form-control', 'placeholder' => 'Objetivos', 'required', 'rows' => '2']) !!}
                                </div>
                            </div>

                            <div class="form-group">                                
                                <div class="col-sm-7">
                                    <p class="form-control-static">b. Número de estudiantes derivados a los servicios de apoyo universitario.</p>
                                </div>   
                                <div class="col-sm-1">
                                    {!! Form::input('text','nedsau_data', $plan->nedsau_data, ['class' => 'form-control', 'required', 'placeholder' => 'Data']) !!}
                                </div>                             
                                <div class="col-sm-1">
                                    {!! Form::input('text','nedsau_meta', $plan->nedsau_meta, ['class' => 'form-control', 'required', 'placeholder' => 'Meta']) !!}
                                </div>                             
                            </div>
                            <div class="form-group">                                
                                <div class="col-sm-3">
                                    {!! Form::textarea('nedsau_pro', $plan->nedsau_pro, ['class' => 'form-control', 'placeholder' => 'Problemas', 'required', 'rows' => '2']) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::textarea('nedsau_cau', $plan->nedsau_cau, ['class' => 'form-control', 'placeholder' => 'Causas', 'required', 'rows' => '2']) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::textarea('nedsau_alt', $plan->nedsau_alt, ['class' => 'form-control', 'placeholder' => 'Alternativas de solución', 'required', 'rows' => '2']) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::textarea('nedsau_obj', $plan->nedsau_obj, ['class' => 'form-control', 'placeholder' => 'Objetivos', 'required', 'rows' => '2']) !!}
                                </div>
                            </div>

                            <div class="form-group">                                
                                <div class="col-sm-7">
                                    <p class="form-control-static">c. Número de Estudiantes atendidos por las áreas de Apoyo.</p>
                                </div>   
                                <div class="col-sm-1">
                                    {!! Form::input('text','neapaa_data', $plan->neapaa_data, ['class' => 'form-control', 'required', 'placeholder' => 'Data']) !!}
                                </div>                             
                                <div class="col-sm-1">
                                    {!! Form::input('text','neapaa_meta', $plan->neapaa_meta, ['class' => 'form-control', 'required', 'placeholder' => 'Meta']) !!}
                                </div>                             
                            </div>
                            <div class="form-group">                                
                                <div class="col-sm-3">
                                    {!! Form::textarea('neapaa_pro', $plan->neapaa_pro, ['class' => 'form-control', 'placeholder' => 'Problemas', 'required', 'rows' => '2']) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::textarea('neapaa_cau', $plan->neapaa_cau, ['class' => 'form-control', 'placeholder' => 'Causas', 'required', 'rows' => '2']) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::textarea('neapaa_alt', $plan->neapaa_alt, ['class' => 'form-control', 'placeholder' => 'Alternativas de solución', 'required', 'rows' => '2']) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::textarea('neapaa_obj', $plan->neapaa_obj, ['class' => 'form-control', 'placeholder' => 'Objetivos', 'required', 'rows' => '2']) !!}
                                </div>
                            </div>

                            <div class="form-group">                                
                                <div class="col-sm-7">
                                    <p class="form-control-static">d. Nivel de satisfacción de los estudiantes como consecuencia de la aplicación del sistema de tutoría.</p>
                                </div>   
                                <div class="col-sm-1">
                                    {!! Form::input('text','nsecast_data', $plan->nsecast_data, ['class' => 'form-control', 'required', 'placeholder' => 'Data']) !!}
                                </div>                             
                                <div class="col-sm-1">
                                    {!! Form::input('text','nsecast_meta', $plan->nsecast_meta, ['class' => 'form-control', 'required', 'placeholder' => 'Meta']) !!}
                                </div>                             
                            </div>
                            <div class="form-group">                                
                                <div class="col-sm-3">
                                    {!! Form::textarea('nsecast_pro', $plan->nsecast_pro, ['class' => 'form-control', 'placeholder' => 'Problemas', 'required', 'rows' => '2']) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::textarea('nsecast_cau', $plan->nsecast_cau, ['class' => 'form-control', 'placeholder' => 'Causas', 'required', 'rows' => '2']) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::textarea('nsecast_alt', $plan->nsecast_alt, ['class' => 'form-control', 'placeholder' => 'Alternativas de solución', 'required', 'rows' => '2']) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::textarea('nsecast_obj', $plan->nsecast_obj, ['class' => 'form-control', 'placeholder' => 'Objetivos', 'required', 'rows' => '2']) !!}
                                </div>
                            </div>

                            <div class="form-group">                                
                                <div class="col-sm-1">
                                    <p class="form-control-static">Fortalezas: </p>
                                </div> 
                                <div class="col-sm-8">
                                    {!! Form::textarea('amptu_for', $plan->amptu_for, ['class' => 'form-control', 'placeholder' => 'Fortalezas', 'required', 'rows' => '2']) !!}
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