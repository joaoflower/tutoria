@extends('layouts.app17')

@section('title','Estadísticas')

@section('content')

        <div class="row">
            <div class="col-lg-12">
                <div class="portlet">
                    <div class="portlet-heading bg-primary">
                        <h3 class="portlet-title">
                            Estadística de Tutorados del Tutor: {{ ucwords(strtolower($docente->paterno.' '.$docente->materno.', '.$docente->nombres)) }}
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
                                            <th>Num.Mat.</th>
                                            <th>Tutorado</th>                                            
                                            <th>Sesión individual</th>
                                            <th>Referencia</th>
                                            <th>Atendido</th>
                                            <th>Seguimiento</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php $count = 0; @endphp
                                    @foreach($estugrupos as $estugrupo) @php $count++; @endphp
                                        <tr>
                                            <td>{{ $count }}</td>
                                            <td>{{ ucwords(strtolower($estugrupo->car_des)) }}</td>
                                            <td>{{ $estugrupo->num_mat }}</td>
                                            <td>{{ ucwords(strtolower($estugrupo->paterno.' '.$estugrupo->materno.', '.$estugrupo->nombres)) }}</td>
                                            <td>{{ $estugrupo->canti_sesindi17 }}</td>
                                            <td>{{ $estugrupo->canti_referido }}</td>
                                            <td>{{ $estugrupo->canti_atencion }}</td>
                                            <td>{{ $estugrupo->canti_seguimiento }}</td>
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