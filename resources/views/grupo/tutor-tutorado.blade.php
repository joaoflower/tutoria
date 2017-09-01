@extends('layouts.app17')

@section('title','Tutor y tutorado')

@section('content')

        <div class="row">
            <div class="col-lg-12">
                <div class="portlet">
                    <div class="portlet-heading bg-primary">
                        <h3 class="portlet-title">
                            Lista de docentes tutores y sus tutorados
                        </h3>
                        <div class="portlet-widgets">
                            <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="portlet-2" class="panel-collapse collapse in">
                        <div class="portlet-body">

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">

                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Código</th>
                                                <th>Docente tutor</th>
                                                <th>Num.Mat.</th>
                                                <th>Tutorado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($grupos as $grupo)
                                            @foreach ($grupo->estugrupos as $estugrupo)
                                            <tr>
                                                <td>{{ $grupo->id }}</td>
                                                <td>{{ $grupo->cod_prf }}</td>
                                                <td>{{ ucwords(strtolower($grupo->docente)) }}</td>
                                                <td>{{ $estugrupo->num_mat }}</td>
                                                <td>{{ ucwords(strtolower($estugrupo->estudiante)) }}</td>
                                            </tr>
                                            @endforeach
                                        @endforeach                                            
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

@endsection