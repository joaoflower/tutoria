@extends('layouts.app17')

@section('title','Referidos')

@section('content')

        <div class="row">
            <div class="col-lg-12">
                <div class="portlet">
                    <div class="portlet-heading bg-primary">
                        <h3 class="portlet-title">
                            Estadísticas del Sistema de Tutoría 2018-I
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
                                Haga click sobre una <strong>Escuela profesional</strong> para ver información más detallada. <br>
                                Haga click sobre <strong>Plan</strong> para ver información más detallada del Plan de Tutoría.
                            </div>

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Cód.</th>
                                            <th>Escuela Profesional</th>
                                            <th>Plan</th>
                                            <th>Tutores</th>
                                            <th>Datos Tutor</th>
                                            <th>Tutorados</th>
                                            <th>Ficha Tutorado</th>
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
                                    @php $count = 0; $gru = 0; $fichad = 0; $estu = 0; $fichae = 0; $sesgru1 = 0; $sesgru2 = 0; $sesgru3 = 0; $sesindi = 0; $refe = 0; $aten = 0; $segui = 0; @endphp
                                    @foreach($grupos as $grupo)  @php $count++; $gru+=$grupo->canti_gru; $fichad+=$grupo->canti_fichad; $estu+=$grupo->canti_estu; $fichae+=$grupo->canti_fichae; $sesgru1+=$grupo->canti_sesgru171; $sesgru2+=$grupo->canti_sesgru172; $sesgru3+=$grupo->canti_sesgru173; $sesindi+=$grupo->canti_sesindi17; $refe+=$grupo->canti_referido; $aten+=$grupo->canti_atencion; $segui+=$grupo->canti_seguimiento;  @endphp
                                        <tr>
                                            <td>{{ $count }}</td>
                                            <td>{{ $grupo->cod_car }}</td>
                                            <td>{{ link_to_asset( route('estadistica.grupos', $grupo->cod_car), ucwords(strtolower($grupo->car_des))) }}</td>
                                            <td>{{ link_to_asset( route('estadistica.plan', $grupo->cod_car), 'Plan') }}</td>
                                            <td class="td-esta">{{ $grupo->canti_gru }}</td>
                                            <td class="td-esta @if( $grupo->canti_fichad/$grupo->canti_gru <= 0.5 ) td-red @elseif( $grupo->canti_fichad/$grupo->canti_gru < 0.75 ) td-orange @else td-green @endif">{{ $grupo->canti_fichad }}</td>
                                            <td class="td-esta">{{ $grupo->canti_estu }}</td>
                                            <td class="td-esta @if( $grupo->canti_fichae/$grupo->canti_estu <= 0.5 ) td-red @elseif( $grupo->canti_fichae/$grupo->canti_estu < 0.75 ) td-orange @else td-green @endif">{{ $grupo->canti_fichae }}</td>
                                            <td class="td-esta @if( $grupo->canti_sesgru171/$grupo->canti_gru <= 0.5 ) td-red @elseif( $grupo->canti_sesgru171/$grupo->canti_gru < 0.75 ) td-orange @else td-green @endif">{{ $grupo->canti_sesgru171 }}</td>
                                            <td class="td-esta @if( $grupo->canti_sesgru172/$grupo->canti_gru <= 0.5 ) td-red @elseif( $grupo->canti_sesgru172/$grupo->canti_gru < 0.75 ) td-orange @else td-green @endif">{{ $grupo->canti_sesgru172 }}</td>
                                            <td class="td-esta @if( $grupo->canti_sesgru173/$grupo->canti_gru <= 0.5 ) td-red @elseif( $grupo->canti_sesgru173/$grupo->canti_gru < 0.75 ) td-orange @else td-green @endif">{{ $grupo->canti_sesgru173 }}</td>
                                            <td class="td-esta @if( $grupo->canti_sesindi17/$grupo->canti_estu <= 0.5 ) td-red @elseif( $grupo->canti_sesindi17/$grupo->canti_estu < 0.75 ) td-orange @else td-green @endif">{{ $grupo->canti_sesindi17 }}</td>
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
                                            <th class="td-esta">{{ $gru }}</th>
                                            <th class="td-esta">{{ $fichad }}</th>
                                            <th class="td-esta">{{ $estu }}</th>
                                            <th class="td-esta">{{ $fichae }}</th>
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

        <div class="row">
            <div class="col-lg-12">
                <div class="portlet">
                    <div class="portlet-heading bg-primary">
                        <h3 class="portlet-title">
                            Tutores y Tutorados
                        </h3>
                        <div class="portlet-widgets">
                            <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="portlet-2" class="panel-collapse collapse in">
                        <div class="portlet-body chartJS">

                            <canvas id="lineChart" data-type="Line" width="520" height="250"></canvas>  

                        </div>
                    </div>
                </div> 
            </div> 
        </div> 

        <div class="row">
            <div class="col-lg-12">
                <div class="portlet">
                    <div class="portlet-heading bg-primary">
                        <h3 class="portlet-title">
                            Tutorados y Sesión Individual
                        </h3>
                        <div class="portlet-widgets">
                            <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="portlet-2" class="panel-collapse collapse in">
                        <div class="portlet-body chartJS">

                            <canvas id="lineChartTS" data-type="Line" width="520" height="250"></canvas>  

                        </div>
                    </div>
                </div> 
            </div> 
        </div> 
  
@endsection
@section('js')
<script src="{{ asset('assets/chart/js/Chart.min.js') }}"></script>
<script type="text/javascript">
$(document).on('ready', function(){ 
    var options = {
        legend: {
            display: true,
            labels: {
                fontColor: '#337ab7'
            }
        }
    };
    function drawChart(selector, type, data, options) {
        var ctx = selector.get(0).getContext("2d");
        var container = $(selector).parent();
        $(window).resize( generateChart );
        function generateChart(){
            var ww = selector.attr('width', $(container).width() );
            var myChart = new Chart(ctx, {type, data, options});
        };
        generateChart();
    }

    // Tutores y Tutorados
    var data = {!! $data !!};    
    drawChart( $("#lineChart"), 'line', data, options );

    // Tutorados y Sesión Individual
    var dataTS = {!! $dataTS !!};    
    drawChart( $("#lineChartTS"), 'line', dataTS, options );    
}); 
</script>

@endsection