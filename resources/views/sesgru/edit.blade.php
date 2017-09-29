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
                    <div class="portlet-heading bg-info">
                        <h3 class="portlet-title">
                             Modificando la Tutoría grupal por sessión
                        </h3>
                        <div class="portlet-widgets">
                            <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="portlet-2" class="panel-collapse collapse in">
                        <div class="portlet-body">

                        {!! Form::open(['route' => ['sesgru.update', $sesgru], 'method' => 'PUT', 'class' => 'form-horizontal', 'id' => 'sesgru17av']) !!}
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
                                        @foreach ($sesgru17avs as $sesgru17av) @php $count++; @endphp
                                            <tr>
                                                <td>{{ $count }}</td>
                                                <td>{{ ucwords(strtolower($sesgru17av->car_des)) }}</td>
                                                <td>{{ $sesgru17av->num_mat }}</td>
                                                <td>{{ ucwords(strtolower($sesgru17av->paterno.' '.$sesgru17av->materno.', '.$sesgru17av->nombres)) }}</td>
                                                <td>{!! Form::select('asi_ests['.$sesgru17av->id.']', ['ASISTIO' => 'Asistio', 'NO ASISTIO' => 'No asistio'], $sesgru17av->asi_est, ['class' => 'form-control', 'required']) !!}</td>
                                                <td>{!! Form::text('valoraciones['.$sesgru17av->id.']', $sesgru17av->valoracion, ['class' => 'form-control', 'required', 'placeholder' => '0 a 20', 'maxlength' => '2' ]) !!}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-sm-2">
                                    {!! Form::label('fecha', 'Fecha de sesión :', ['class' => 'control-label']) !!}
                                    {!! Form::input('date','fecha', $sesgru->fecha, ['class' => 'form-control fechas', 'required', 'placeholder' => 'aaaa-mm-dd']) !!}
                                </div>
                            </div>
                        {!! Form::close() !!}
                        
                            <div class="form-group">
                                <div class="col-sm-12">
                                    {!! Form::label('img', 'Foto(s) de sesión :', ['class' => 'control-label']) !!}
                                    {!! Form::open(['route' => 'sesgrui.uploadimg', 'method' => 'POST', 'files' => true, 'class' => 'dropzone', 'id' => 'sesgru17img']) !!}
                                        {!! Form::hidden('sesgru_id', $sesgru->id) !!}
                                        <div class="dz-message needsclick">
                                            Arrastre el archivo aquí o Haga click para subir.<br />
                                            <span class="note needsclick">(Suba la(s) foto(s) para demostrar que realizó la sesión)</span>
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
                                    {!! Form::button('<i class="fa fa-floppy-o"></i> <span>Modificar sesión</span>', ['type' => 'submit', 'class' => 'btn btn-info btn-rounded btn-custom btn-lg m-b-5', 'form' => 'sesgru17av']) !!}  
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
    /**/
    $(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        Dropzone.options.sesgru17img = false;
        Dropzone.options.sesgru17img = {
            autoProcessQueue: true,
            //addRemoveLinks: true,
            //dictRemoveFile: 'Borrar foto',
            paramName: "file", 
            maxFilesize: 4, 
            acceptedFiles: "image/*",
            init: function() {
                var myDropzone = this;
                var data = {!! $imgjson !!};
                $.each(data.images, function (key, value) {
                    var mockFile = { name: value.original, size: value.size, accepted: true, kind: 'image', dataURL: value.filename };
                    myDropzone.emit("addedfile", mockFile);                    
                    myDropzone.createThumbnailFromUrl(
                        mockFile,
                        myDropzone.options.thumbnailWidth,
                        myDropzone.options.thumbnailHeight,
                        myDropzone.options.thumbnailMethod,
                        true,
                        function(thumbnail) {
                            myDropzone.emit('thumbnail', mockFile, thumbnail);
                            myDropzone.emit("complete", mockFile);
                        }
                    );
                });
            }
        };

    });
</script>
@endsection