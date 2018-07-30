@extends('layouts.app17')

@section('title','Estadísticas')

@section('content')

        <div class="row">
            <div class="col-lg-12">
                <div class="portlet">
                    <div class="portlet-heading bg-primary">
                        <h3 class="portlet-title">
                            Estadísticas de Tutores por Escuela Profesional 2018-I
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
                                            <th>Sesión grupal 1</th>
                                            <th>Sesión grupal 2</th>
                                            <th>Sesión grupal 3</th>
                                            <th>Sesión indiv.</th>
                                            <th>Refer.</th>
                                            <th>Atendido</th>
                                            <th>Seguim.</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php $count = 0; $estu = 0; $sesgru1 = 0; $sesgru2 = 0; $sesgru3 = 0; $sesindi = 0; $refe = 0; $aten = 0; $segui = 0; @endphp
                                    @foreach($grupos as $grupo) @php $count++; $estu+=$grupo->canti_estu; $sesgru1+=$grupo->canti_sesgru171; $sesgru2+=$grupo->canti_sesgru172; $sesgru3+=$grupo->canti_sesgru173; $sesindi+=$grupo->canti_sesindi17; $refe+=$grupo->canti_referido; $aten+=$grupo->canti_atencion; $segui+=$grupo->canti_seguimiento;  @endphp
                                        <tr>
                                            <td>{{ $count }}</td>
                                            <td>{{ ucwords(strtolower($grupo->car_des)) }}</td>
                                            <td>{{ $grupo->cod_prf }}</td>
                                            <td>{{ link_to_asset( route('estadistica.tutorados', $grupo->id), ucwords(strtolower($grupo->paterno.' '.$grupo->materno.', '.$grupo->nombres))) }}</td>
                                            <td class="td-esta">{{ $grupo->canti_estu }}</td>
                                            <td class="td-esta @if( $grupo->canti_sesgru171 == 1 ) td-green @else td-red @endif">@if( $grupo->canti_sesgru171 == 1 ) Si @else No @endif</td>
                                            <td class="td-esta @if( $grupo->canti_sesgru172 == 1 ) td-green @else td-red @endif">@if( $grupo->canti_sesgru172 == 1 ) Si @else No @endif</td>
                                            <td class="td-esta @if( $grupo->canti_sesgru173 == 1 ) td-green @else td-red @endif">@if( $grupo->canti_sesgru173 == 1 ) Si @else No @endif</td>
                                            <td class="td-esta @if( $grupo->canti_estu > 0) @if( $grupo->canti_sesindi17/$grupo->canti_estu <= 0.5 ) td-red @elseif( $grupo->canti_sesindi17/$grupo->canti_estu < 0.75 ) td-orange @else td-green @endif @endif">{{ $grupo->canti_sesindi17 }}</td>
                                            <td class="td-esta">{{ $grupo->canti_referido }}</td>
                                            <td class="td-esta">{{ $grupo->canti_atencion }}</td>
                                            <td class="td-esta">{{ $grupo->canti_seguimiento }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th>TOTAL :</th>                                            
                                            <th class="td-esta">{{ $estu }}</th>
                                            <th class="td-esta">{{ $sesgru1 }}</th>
                                            <th class="td-esta">{{ $sesgru2 }}</th>
                                            <th class="td-esta">{{ $sesgru3 }}</th>
                                            <th class="td-esta">{{ $sesindi }}</th>
                                            <th class="td-esta">{{ $refe }}</th>
                                            <th class="td-esta">{{ $aten }}</th>
                                            <th class="td-esta">{{ $segui }}</th>
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