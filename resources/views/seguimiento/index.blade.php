@extends('layouts.app17')

@section('title','Seguimiento Individual')

@section('content')

                            <div id="teacher-seguimiento" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="">
                                <div class="modal-dialog"> 
                                    <div class="modal-content"> 
                                        
                                        <div class="modal-header"> 
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                                            <h4 class="modal-title">Seguimiento a referidos</h4> 
                                        </div> 
                                        
                                        <div class="modal-body"> 
                                            {!! Form::hidden('atencionref-id', null, ['id' => 'atencionref-id']) !!}
                                            {!! Form::hidden('seguimiento-id', null, ['id' => 'seguimiento-id']) !!}
                                            <div class="row"> 
                                                <div class="col-md-6"> 
                                                    <div class="form-group no-margin"> 
                                                        <strong>Atendido: </strong> <span id="a-atendido"></span>
                                                    </div> 
                                                </div> 
                                                <div class="col-md-6"> 
                                                    <div class="form-group no-margin">
                                                        <strong>Fecha: </strong> <span id="a-fecha"></span>
                                                    </div> 
                                                </div> 
                                            </div>
                                            <div class="row"> 
                                                <div class="col-md-12"> 
                                                    <div class="form-group no-margin">
                                                        <strong>Recomendación de la atención: </strong> <span id="a-recomendacion"></span>
                                                    </div> 
                                                </div> 
                                            </div>
                                            <div class="row"> 
                                                <div class="col-md-3"> 
                                                    <div class="form-group no-margin">
                                                        {!! Form::select('asi_est', ['ASISTIO' => 'Asistio', 'NO ASISTIO' => 'No asistio'], null, ['class' => 'form-control', 'required', 'id' => 'asi_est']) !!}
                                                        {!! Form::input('date','fecha', null, ['class' => 'form-control fechas', 'required', 'placeholder' => 'Fecha', 'id' => 'fecha']) !!}
                                                    </div> 
                                                </div> 
                                                <div class="col-md-9"> 
                                                    <div class="form-group no-margin"> 
                                                        {!! Form::textarea('recomendacion', null, ['class' => 'form-control', 'placeholder' => 'Ingrese recomendación', 'style' => 'display: none;', 'id' => 'recomendacion']) !!}
                                                        <div id="div-recomendacion" class="summernote"></div>
                                                    </div> 
                                                </div> 
                                            </div>

                                        </div> 
                                        <div class="modal-footer"> 
                                            {!! Form::button('<i class="fa fa-times"></i> <span>Cancelar</span>', ['type' => 'button', 'class' => 'btn btn-danger btn-rounded btn-custom btn-lg m-b-5', 'data-dismiss' => 'modal']) !!} 
                                            {!! Form::button('<i class="fa fa-floppy-o"></i> <span>Guardar</span>', ['type' => 'button', 'class' => 'btn btn-success btn-rounded btn-custom btn-lg m-b-5', 'data-dismiss' => 'modal', 'id' => 'store-seguimiento']) !!} 
                                            {!! Form::button('<i class="fa fa-floppy-o"></i> <span>Actualizar</span>', ['type' => 'button', 'class' => 'btn btn-warning btn-rounded btn-custom btn-lg m-b-5', 'data-dismiss' => 'modal', 'id' => 'update-seguimiento']) !!}  
                                        </div> 
                                    </div> 
                                </div>
                            </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="portlet">
                    <div class="portlet-heading bg-primary">
                        <h3 class="portlet-title">
                            Seguimiento Individual a tutorados referidos
                        </h3>
                        <div class="portlet-widgets">
                            <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="portlet-2" class="panel-collapse collapse in">
                        <div class="portlet-body">

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12" id="grupos">

                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Num. Mat.</th>
                                                <th>Apellidos y Nombres</th>
                                                <th>Referido a </th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @if($estugrupos->count() > 0)
                                        @foreach ($estugrupos as $estugrupo)
                                            @foreach ($estugrupo->sesindi17s as $sesindi17)
                                                @foreach ($sesindi17->sesindi17refs as $sesindi17ref)
                                            <tr>
                                                <td>{{ $estugrupo->num_mat }}</td>
                                                <td>{{ ucwords(strtolower($estugrupo->estudiante)) }}</td>
                                                <td>{{ ucwords(strtolower($sesindi17ref->itemreferido->name)) }}</td>
                                            @if($sesindi17ref->atencionref == null) 
                                                <td><span class="text-danger">Tutorado referido no atendido</span></td>
                                                <td></td>
                                            @elseif($sesindi17ref->atencionref->seguimientoref == null)
                                                <td id="tdt-{{ $sesindi17ref->atencionref->id }}">
                                                    <span class="text-warning">Atendido, pero sin seguimiento</span>
                                                </td>
                                                <td id="tdb-{{ $sesindi17ref->atencionref->id }}">
                                                    {!! Form::button('<i class="fa fa-check-square-o fa-lg" aria-hidden="true"></i> <span>Seguimiento</span>', ['type' => 'button', 'class' => 'icon-new btn-icon-table new-seguimiento', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => 'Realizar seguimiento', 'data-atencionref-id' => $sesindi17ref->atencionref->id]) !!}
                                                </td>
                                            @else
                                                <td id="tdt-{{ $sesindi17ref->atencionref->id }}">
                                                    <span class="text-success">Atendido y con seguimiento</span>
                                                </td>
                                                <td id="tdb-{{ $sesindi17ref->atencionref->id }}">
                                                    {!! Form::button('<i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i> <span>Modificar</span>', ['type' => 'button', 'class' => 'icon-edit btn-icon-table edit-seguimiento', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => 'Modificar seguimiento', 'data-seguimiento-id' => $sesindi17ref->atencionref->seguimientoref->id, 'data-atencionref-id' => $sesindi17ref->atencionref->id]) !!}
                                                    {!! Form::button('<i class="fa fa-trash-o fa-lg" aria-hidden="true"></i> <span>Borrar</span>', ['type' => 'button', 'class' => 'icon-drop btn-icon-table drop-seguimiento', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => 'Borrar seguimiento', 'data-seguimiento-id' => $sesindi17ref->atencionref->seguimientoref->id, 'data-atencionref-id' => $sesindi17ref->atencionref->id]) !!}
                                                </td>
                                            @endif
                                            </tr>
                                                @endforeach
                                            @endforeach
                                        @endforeach                                            
                                        @endif
                                        </tbody>
                                    </table>

                                </div>
                            </div>

                        </div>
                    </div>
                </div> 
            </div> 
        </div> 
  
@endsection
@section('js')
<script src="{{ asset('assets/tutoria17/js/seguimiento.js') }}"></script> 
@endsection