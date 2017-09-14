@extends('layouts.app17')

@section('title','Estadísticas')

@section('content')

        <div class="row">
            <div class="col-lg-12">
                <div class="portlet">
                    <div class="portlet-heading bg-primary">
                        <h3 class="portlet-title">
                            Estadísticas de Tutores por Escuela Profesional
                        </h3>
                        <div class="portlet-widgets">
                            <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="portlet-2" class="panel-collapse collapse in">
                        <div class="portlet-body">

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Escuela Profesional</th>
                                            <th>Código</th>
                                            <th>Docente tutor</th>                                            
                                            <th>Tutorados</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php $count = 0; @endphp
                                    @foreach($grupos as $grupo) @php $count++; @endphp
                                        <tr>
                                            <td>{{ $count }}</td>
                                            <td>{{ ucwords(strtolower($grupo->car_des)) }}</td>
                                            <td>{{ $grupo->cod_prf }}</td>
                                            <td>{{ link_to_asset( route('estadistica.tutorados', $grupo->id), ucwords(strtolower($grupo->paterno.' '.$grupo->materno.', '.$grupo->nombres))) }}</td>
                                            <td>{{ $grupo->canti_estu }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
    

                        </div>
                    </div>
                </div> 
            </div> 
        </div> 

@endsection
@section('js')
@endsection