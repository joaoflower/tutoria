@extends('layouts.app17')

@section('title','Nuevo Tutor')

@section('content')

        <div class="row">
            <div class="col-lg-12">
                <div class="portlet">
                    <div class="portlet-heading bg-success">
                        <h3 class="portlet-title">
                            Seleccione y agregue un docente como tutor
                        </h3>
                        <div class="portlet-widgets">
                            <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="portlet-2" class="panel-collapse collapse in">
                        <div class="portlet-body">

                            {!! Form::open(['route' => 'grupo.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
                                <div class="form-group">
                                    {!! Form::label('cod_prf', 'Docente Tutor :', ['class' => 'col-sm-3 control-label']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::select('cod_prf', $docentes, null, ['class' => 'form-control select-docente', 'required', 'data-placeholder' => 'Selecione el docente']) !!}
                                    </div>
                                    <div class="col-sm-1"></div>
                                </div>
                                <div class="form-group m-b-0">
                                    <div class="col-sm-offset-5 col-sm-7">                                        
                                        <a href="{{ route('grupo.index') }}" class="btn btn-danger btn-rounded btn-custom btn-lg m-b-5">
                                            <i class="fa fa-times"></i> <span>Cancelar</span>
                                        </a>
                                        {!! Form::button('<i class="fa fa-floppy-o"></i> <span>Agregar</span>', ['type' => 'submit', 'class' => 'btn btn-success btn-rounded btn-custom btn-lg m-b-5']) !!}  
                                    </div>
                                </div>
                            </form>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div> 
            </div> 
        </div> 
  
@endsection
@section('js')
    <script type="text/javascript">
        $('.select-docente').chosen({
            allow_single_deselect: true
        });
    </script>
@endsection