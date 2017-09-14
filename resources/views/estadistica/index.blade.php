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

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Cód.</th>
                                            <th>Escuela Profesional</th>
                                            <th>Tutores</th>
                                            <th>Tutorados</th>
                                            <th>Sesiones individuales</th>
                                            <th>Tutorados Referidos</th>
                                            <th>Sesiones grupales</th>
                                            <th>Constancias de tutoría</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php $count = 0; @endphp
                                    @foreach($grupos as $grupo) @php $count++; @endphp
                                        <tr>
                                            <td>{{ $count }}</td>
                                            <td>{{ $grupo->cod_car }}</td>
                                            <td>{{ link_to_asset( route('estadistica.grupos', $grupo->cod_car), ucwords(strtolower($grupo->car_des))) }}</td>
                                            <td>{{ $grupo->canti_gru }}</td>
                                            <td>{{ $grupo->canti_estu }}</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
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