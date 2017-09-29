@extends('layouts.app17')

@section('title','Referidos')

@section('content')

        <div class="row">
            <div class="col-lg-12">
                <div class="portlet">
                    <div class="portlet-heading bg-primary">
                        <h3 class="portlet-title">
                            Estadísticas del Sistema de Tutoría
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
                                            <th>Tutorados</th>
                                            <th>Sesión grupal</th>
                                            <th>Sesión individual</th>
                                            <th>Referencia</th>
                                            <th>Atendido</th>
                                            <th>Seguimiento</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php $count = 0; $gru = 0; $estu = 0; $sesgru = 0; $sesindi = 0; $refe = 0; $aten = 0; $segui = 0; @endphp
                                    @foreach($grupos as $grupo)  @php $count++; $gru+=$grupo->canti_gru; $estu+=$grupo->canti_estu; $sesgru+=$grupo->canti_sesgru17; $sesindi+=$grupo->canti_sesindi17; $refe+=$grupo->canti_referido; $aten+=$grupo->canti_atencion; $segui+=$grupo->canti_seguimiento;  @endphp
                                        <tr>
                                            <td>{{ $count }}</td>
                                            <td>{{ $grupo->cod_car }}</td>
                                            <td>{{ link_to_asset( route('estadistica.grupos', $grupo->cod_car), ucwords(strtolower($grupo->car_des))) }}</td>
                                            <td>{{ link_to_asset( route('estadistica.plan', $grupo->cod_car), 'Plan') }}</td>
                                            <td>{{ $grupo->canti_gru }}</td>
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
                                            <th>{{ $gru }}</th>
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
  
@endsection
@section('js')
<script src="{{ asset('assets/chart/js/Chart.min.js') }}"></script>
<script type="text/javascript">
$(document).on('ready', function(){ 
    var data = {!! $data !!};
    var options = {
        legend: {
            display: true,
            labels: {
                fontColor: '#337ab7'
            }
        }
    };
    drawChart( $("#lineChart"), 'line', data, options );
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
}); 
</script>

@endsection