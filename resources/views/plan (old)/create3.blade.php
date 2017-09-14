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

                        {!! Form::open(['route' => 'plan.store3', 'method' => 'POST', 'class' => 'form-horizontal plan']) !!}    
                            <div class="form-group">                                
                                <div class="col-sm-12">
                                    <p class="form-control-static"><strong>3. Gestión del bienestar de los estudiantes universitarios..</strong></p>
                                </div>
                            </div>
                            <div class="form-group">                                
                                <div class="col-sm-7">
                                    <p class="form-control-static">a. Porcentaje de Sesiones de Tutoría grupal desarrolladas.</p>
                                </div>   
                                <div class="col-sm-1">
                                    {!! Form::input('text','pstgd_data', $plan->pstgd_data, ['class' => 'form-control', 'required', 'placeholder' => 'Data']) !!}
                                </div>                             
                                <div class="col-sm-1">
                                    {!! Form::input('text','pstgd_meta', $plan->pstgd_meta, ['class' => 'form-control', 'required', 'placeholder' => 'Meta']) !!}
                                </div>                             
                            </div>
                            <div class="form-group">                                
                                <div class="col-sm-3">
                                    {!! Form::textarea('pstgd_pro', $plan->pstgd_pro, ['class' => 'form-control', 'placeholder' => 'Problemas', 'required', 'rows' => '2']) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::textarea('pstgd_cau', $plan->pstgd_cau, ['class' => 'form-control', 'placeholder' => 'Causas', 'required', 'rows' => '2']) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::textarea('pstgd_alt', $plan->pstgd_alt, ['class' => 'form-control', 'placeholder' => 'Alternativas de solución', 'required', 'rows' => '2']) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::textarea('pstgd_obj', $plan->pstgd_obj, ['class' => 'form-control', 'placeholder' => 'Objetivos', 'required', 'rows' => '2']) !!}
                                </div>
                            </div>

                            <div class="form-group">                                
                                <div class="col-sm-7">
                                    <p class="form-control-static">b. Porcentaje de Sesiones de tutoría individual desarrolladas (primera sesión).</p>
                                </div>   
                                <div class="col-sm-1">
                                    {!! Form::input('text','pstid1_data', $plan->pstid1_data, ['class' => 'form-control', 'required', 'placeholder' => 'Data']) !!}
                                </div>                             
                                <div class="col-sm-1">
                                    {!! Form::input('text','pstid1_meta', $plan->pstid1_meta, ['class' => 'form-control', 'required', 'placeholder' => 'Meta']) !!}
                                </div>                             
                            </div>
                            <div class="form-group">                                
                                <div class="col-sm-3">
                                    {!! Form::textarea('pstid1_pro', $plan->pstid1_pro, ['class' => 'form-control', 'placeholder' => 'Problemas', 'required', 'rows' => '2']) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::textarea('pstid1_cau', $plan->pstid1_cau, ['class' => 'form-control', 'placeholder' => 'Causas', 'required', 'rows' => '2']) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::textarea('pstid1_alt', $plan->pstid1_alt, ['class' => 'form-control', 'placeholder' => 'Alternativas de solución', 'required', 'rows' => '2']) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::textarea('pstid1_obj', $plan->pstid1_obj, ['class' => 'form-control', 'placeholder' => 'Objetivos', 'required', 'rows' => '2']) !!}
                                </div>
                            </div>

                            <div class="form-group">                                
                                <div class="col-sm-7">
                                    <p class="form-control-static">c. Porcentaje de sesiones de seguimiento individual a estudiantes referidos a las áreas de apoyo.</p>
                                </div>   
                                <div class="col-sm-1">
                                    {!! Form::input('text','pssieraa_data', $plan->pssieraa_data, ['class' => 'form-control', 'required', 'placeholder' => 'Data']) !!}
                                </div>                             
                                <div class="col-sm-1">
                                    {!! Form::input('text','pssieraa_meta', $plan->pssieraa_meta, ['class' => 'form-control', 'required', 'placeholder' => 'Meta']) !!}
                                </div>                             
                            </div>
                            <div class="form-group">                                
                                <div class="col-sm-3">
                                    {!! Form::textarea('pssieraa_pro', $plan->pssieraa_pro, ['class' => 'form-control', 'placeholder' => 'Problemas', 'required', 'rows' => '2']) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::textarea('pssieraa_cau', $plan->pssieraa_cau, ['class' => 'form-control', 'placeholder' => 'Causas', 'required', 'rows' => '2']) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::textarea('pssieraa_alt', $plan->pssieraa_alt, ['class' => 'form-control', 'placeholder' => 'Alternativas de solución', 'required', 'rows' => '2']) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::textarea('pssieraa_obj', $plan->pssieraa_obj, ['class' => 'form-control', 'placeholder' => 'Objetivos', 'required', 'rows' => '2']) !!}
                                </div>
                            </div>

                            <div class="form-group">                                
                                <div class="col-sm-7">
                                    <p class="form-control-static">d. Porcentaje de sesiones de seguimiento individual  a estudiantes en riesgo académico ejecutadas.</p>
                                </div>   
                                <div class="col-sm-1">
                                    {!! Form::input('text','pssierae_data', $plan->pssierae_data, ['class' => 'form-control', 'required', 'placeholder' => 'Data']) !!}
                                </div>                             
                                <div class="col-sm-1">
                                    {!! Form::input('text','pssierae_meta', $plan->pssierae_meta, ['class' => 'form-control', 'required', 'placeholder' => 'Meta']) !!}
                                </div>                             
                            </div>
                            <div class="form-group">                                
                                <div class="col-sm-3">
                                    {!! Form::textarea('pssierae_pro', $plan->pssierae_pro, ['class' => 'form-control', 'placeholder' => 'Problemas', 'required', 'rows' => '2']) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::textarea('pssierae_cau', $plan->pssierae_cau, ['class' => 'form-control', 'placeholder' => 'Causas', 'required', 'rows' => '2']) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::textarea('pssierae_alt', $plan->pssierae_alt, ['class' => 'form-control', 'placeholder' => 'Alternativas de solución', 'required', 'rows' => '2']) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::textarea('pssierae_obj', $plan->pssierae_obj, ['class' => 'form-control', 'placeholder' => 'Objetivos', 'required', 'rows' => '2']) !!}
                                </div>
                            </div>

                            <div class="form-group">                                
                                <div class="col-sm-7">
                                    <p class="form-control-static">e. Porcentaje y Registro de los 3 problemas más frecuentes que afectan a los estudiantes.</p>
                                </div>   
                                <div class="col-sm-1">
                                    {!! Form::input('text','pr3pmf_data', $plan->pr3pmf_data, ['class' => 'form-control', 'required', 'placeholder' => 'Data']) !!}
                                </div>                             
                                <div class="col-sm-1">
                                    {!! Form::input('text','pr3pmf_meta', $plan->pr3pmf_meta, ['class' => 'form-control', 'required', 'placeholder' => 'Meta']) !!}
                                </div>                             
                            </div>
                            <div class="form-group">                                
                                <div class="col-sm-3">
                                    {!! Form::textarea('pr3pmf_pro', $plan->pr3pmf_pro, ['class' => 'form-control', 'placeholder' => 'Problemas', 'required', 'rows' => '2']) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::textarea('pr3pmf_cau', $plan->pr3pmf_cau, ['class' => 'form-control', 'placeholder' => 'Causas', 'required', 'rows' => '2']) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::textarea('pr3pmf_alt', $plan->pr3pmf_alt, ['class' => 'form-control', 'placeholder' => 'Alternativas de solución', 'required', 'rows' => '2']) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::textarea('pr3pmf_obj', $plan->pr3pmf_obj, ['class' => 'form-control', 'placeholder' => 'Objetivos', 'required', 'rows' => '2']) !!}
                                </div>
                            </div>

                            <div class="form-group">                                
                                <div class="col-sm-7">
                                    <p class="form-control-static">f. Porcentaje de acciones de tutoría planteadas a partir de las necesidades de los estudiantes, que han sido ejecutadas.</p>
                                </div>   
                                <div class="col-sm-1">
                                    {!! Form::input('text','patppne_data', $plan->patppne_data, ['class' => 'form-control', 'required', 'placeholder' => 'Data']) !!}
                                </div>                             
                                <div class="col-sm-1">
                                    {!! Form::input('text','patppne_meta', $plan->patppne_meta, ['class' => 'form-control', 'required', 'placeholder' => 'Meta']) !!}
                                </div>                             
                            </div>
                            <div class="form-group">                                
                                <div class="col-sm-3">
                                    {!! Form::textarea('patppne_pro', $plan->patppne_pro, ['class' => 'form-control', 'placeholder' => 'Problemas', 'required', 'rows' => '2']) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::textarea('patppne_cau', $plan->patppne_cau, ['class' => 'form-control', 'placeholder' => 'Causas', 'required', 'rows' => '2']) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::textarea('patppne_alt', $plan->patppne_alt, ['class' => 'form-control', 'placeholder' => 'Alternativas de solución', 'required', 'rows' => '2']) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::textarea('patppne_obj', $plan->patppne_obj, ['class' => 'form-control', 'placeholder' => 'Objetivos', 'required', 'rows' => '2']) !!}
                                </div>
                            </div>

                            <div class="form-group">                                
                                <div class="col-sm-1">
                                    <p class="form-control-static">Fortalezas: </p>
                                </div> 
                                <div class="col-sm-8">
                                    {!! Form::textarea('gbeu_for', $plan->gbeu_for, ['class' => 'form-control', 'placeholder' => 'Fortalezas', 'required', 'rows' => '2']) !!}
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