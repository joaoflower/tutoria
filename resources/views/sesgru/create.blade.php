@extends('layouts.app17')

@section('title','Tutoría grupal por sessión')
@section('css')
{{ Html::style('assets/dropzone/css/dropzone.min.css') }}
{{ Html::style('assets/tutoria17/css/sesgru17.css') }}
@endsection

@section('content')

        <div class="row">
            <div class="col-lg-12">
                <div class="portlet">
                    <div class="portlet-heading bg-success">
                        <h3 class="portlet-title">
                            Nueva Tutoría grupal por sessión
                        </h3>
                        <div class="portlet-widgets">
                            <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="portlet-2" class="panel-collapse collapse in">
                        <div class="portlet-body">

                        {!! Form::open(['route' => 'sesgru.store', 'method' => 'POST', 'class' => 'form-horizontal', 'id' => 'sesgru17av']) !!}
                            {!! Form::hidden('nro_ses', $nro_ses) !!}
                            <div class="form-group">                                
                                <div class="col-sm-10">
                                    {!! Form::label('_id', 'Tutorados: ', ['class' => 'control-label']) !!}
                                    <table class="table table-striped table-bordered table-hover ">
                                        <thead>
                                            <tr class="success">
                                                <th>#</th>
                                                <th>Escuela Profesional</th>
                                                <th>Num.Mat.</th>
                                                <th>Tutorado</th> 
                                                <th>Asistencia</th>
                                                <th>Valoración</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @php $count = 0; @endphp
                                        @foreach ($estugrupos as $estugrupo) @php $count++; @endphp
                                            <tr>
                                                <td>{{ $count }}</td>
                                                <td>{{ ucwords(strtolower($estugrupo->car_des)) }}</td>
                                                <td>{{ $estugrupo->num_mat }}</td>
                                                <td>{{ ucwords(strtolower($estugrupo->paterno.' '.$estugrupo->materno.', '.$estugrupo->nombres)) }}</td>
                                                <td>{!! Form::select('asi_ests['.$estugrupo->id.']', ['ASISTIO' => 'Asistio', 'NO ASISTIO' => 'No asistio'], null, ['class' => 'form-control', 'required']) !!}</td>
                                                <td>{!! Form::text('valoraciones['.$estugrupo->id.']', null, ['class' => 'form-control', 'required', 'placeholder' => '0 a 20', 'maxlength' => '2' ]) !!}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-sm-2">
                                    {!! Form::label('fecha', 'Fecha de sesión :', ['class' => 'control-label']) !!}
                                    {!! Form::input('date','fecha', null, ['class' => 'form-control fechas', 'required', 'placeholder' => 'aaaa-mm-dd']) !!}
                                </div>
                            </div>
                        {!! Form::close() !!}
                        
                            <div class="form-group">
                                <div class="col-sm-12">
                                    {!! Form::label('img', 'Foto(s) de sesión :', ['class' => 'control-label']) !!}
                                    {!! Form::open(['route' => 'sesgrui.uploadimg', 'method' => 'POST', 'files' => true, 'class' => 'dropzone', 'id' => 'sesgru17img']) !!}
                                        {!! Form::hidden('nro_ses', $nro_ses) !!}
                                        <div class="dz-message needsclick">
                                            Arrastre aquí la FOTO o Haga click para subirlo.<br />
                                            <span class="note needsclick">(Debe subir la(s) foto(s) para demostrar que realizó la Tutoría grupal por sessión)</span>
                                        </div>    
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        
                        {!! Form::open(['route' => 'sesgru.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}    
                            <div class="form-group m-b-0">
                                <div class="col-sm-offset-5 col-sm-7">                                        
                                    <a href="{{ route('sesgru.index') }}" class="btn btn-danger btn-rounded btn-custom btn-lg m-b-5">
                                        <i class="fa fa-times"></i> <span>Cancelar</span>
                                    </a>
                                    {!! Form::button('<i class="fa fa-floppy-o"></i> <span>Guardar sesión</span>', ['type' => 'submit', 'class' => 'btn btn-success btn-rounded btn-custom btn-lg m-b-5', 'form' => 'sesgru17av']) !!}  
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
{{ Html::script('assets/dropzone/js/dropzone.min.js') }}
<script type="text/javascript">
    Dropzone.options.sesgru17img = {
        autoProcessQueue: true,
        paramName: "file", 
        maxFilesize: 4, 
        acceptedFiles: "image/*"
    };
    $(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
</script>
@endsection