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

                        {!! Form::open(['route' => $route, 'method' => 'POST', 'class' => 'form-horizontal plan']) !!}    
                            <div class="form-group">                                
                                <div class="col-sm-12">
                                    <p class="form-control-static"><strong>{{$itemfactor->name}}</strong></p>
                                </div>
                            </div>

                            @foreach ($itemfactor->itemindicadores as $itemindicador)
                            <div class="form-group">                                
                                <div class="col-sm-7">
                                    <p class="form-control-static">{{$itemindicador->name}}</p>
                                </div>   
                                <div class="col-sm-1">
                                    {!! Form::input('text','data['.$itemindicador->id.']', $pfi[$itemindicador->id]['data'], ['class' => 'form-control', 'required', 'placeholder' => 'Data']) !!}
                                </div>                             
                                <div class="col-sm-1">
                                    {!! Form::input('text','meta['.$itemindicador->id.']', $pfi[$itemindicador->id]['meta'], ['class' => 'form-control', 'required', 'placeholder' => 'Meta']) !!}
                                </div>                             
                            </div>
                            <div class="form-group">                                
                                <div class="col-sm-4">
                                    {!! Form::textarea('problema['.$itemindicador->id.']', $pfi[$itemindicador->id]['problema'], ['class' => 'form-control', 'placeholder' => 'Problemas', 'required', 'rows' => '2']) !!}
                                </div>
                                <div class="col-sm-4">
                                    {!! Form::textarea('causa['.$itemindicador->id.']', $pfi[$itemindicador->id]['causa'], ['class' => 'form-control', 'placeholder' => 'Causas', 'required', 'rows' => '2']) !!}
                                </div>
                                <div class="col-sm-4">
                                    {!! Form::textarea('alternativa['.$itemindicador->id.']', $pfi[$itemindicador->id]['alternativa'], ['class' => 'form-control', 'placeholder' => 'Alternativas de solución', 'required', 'rows' => '2']) !!}
                                </div>
                            </div>
                            @endforeach                            

                            <div class="form-group">                                
                                <div class="col-sm-6">
                                    {!! Form::textarea('objetivo', $planfactor->objetivo, ['class' => 'form-control', 'placeholder' => 'Objetivo', 'required', 'rows' => '2']) !!}
                                </div>
                                <div class="col-sm-6">
                                    {!! Form::textarea('fortaleza', $planfactor->fortaleza, ['class' => 'form-control', 'placeholder' => 'Fortaleza', 'required', 'rows' => '2']) !!}
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