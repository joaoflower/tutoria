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
                            <div class="alert alert-info alert-dismissible" role="alert" style="font-size: 16px;">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                Haga click sobre el nombre de un <strong>Docente tutor</strong> para ver información más detallada.
                            </div>

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Escuela Profesional</th>
                                            <th>Código</th>
                                            <th>Docente tutor</th>                                            
                                            <th>Tutorados</th>
                                            <th>Sesión grupal</th>
                                            <th>Sesión individual</th>
                                            <th>Referencia</th>
                                            <th>Atendido</th>
                                            <th>Seguimiento</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php $count = 0; $estu = 0; $sesgru = 0; $sesindi = 0; $refe = 0; $aten = 0; $segui = 0; @endphp
                                    @foreach($grupos as $grupo) @php $count++; $estu+=$grupo->canti_estu; $sesgru+=$grupo->canti_sesgru17; $sesindi+=$grupo->canti_sesindi17; $refe+=$grupo->canti_referido; $aten+=$grupo->canti_atencion; $segui+=$grupo->canti_seguimiento;  @endphp
                                        <tr>
                                            <td>{{ $count }}</td>
                                            <td>{{ ucwords(strtolower($grupo->car_des)) }}</td>
                                            <td>{{ $grupo->cod_prf }}</td>
                                            <td>{{ link_to_asset( route('estadistica.tutorados', $grupo->id), ucwords(strtolower($grupo->paterno.' '.$grupo->materno.', '.$grupo->nombres))) }}</td>
                                            <td>{{ $grupo->canti_estu }}</td>
                                            <td>{{ $grupo->canti_sesgru17 }}</td>
                                            <td>{{ $grupo->canti_sesindi17 }}</td>
                                            <td>{{ $grupo->canti_referido }}</td>
                                            <td>{{ $grupo->canti_atencion }}</td>
                                            <td>{{ $grupo->canti_seguimiento }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th>TOTAL :</th>                                            
                                            <th>{{ $estu }}</th>
                                            <th>{{ $sesgru }}</th>
                                            <th>{{ $sesindi }}</th>
                                            <th>{{ $refe }}</th>
                                            <th>{{ $aten }}</th>
                                            <th>{{ $segui }}</th>
                                        </tr>
                                    </tfoot>
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