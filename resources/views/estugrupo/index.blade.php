@extends('layouts.app17')

@section('title','Tutorados')

@section('content')

        <div class="page-title"> 
            <h3 class="title">Tutorados</h3> 
        </div>

        <div class="row">

        @foreach ($estugrupos as $estugrupo)
            <div class="col-sm-6">
                <div class="panel panel-tutorado">
                    <div class="panel-body p-t-0">
                        <div class="media-main">
                            <a class="pull-left" href="#">
                                <img class="thumb-lg img-circle bx-s" src="/images/avatar.png" alt="">
                            </a>
                            <div class="pull-right btn-group-sm">
                                <a href="{{ route('estugrupo.show', $estugrupo->num_mat) }}" class="btn btn-purple tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Ver">
                                    <i class="fa fa-briefcase"></i> Ver Perfil
                                </a>
                            </div>
                            <div class="info">
                                <h4>{{ ucwords(strtolower($estugrupo->name)) }}</h4>
                                <p class="text-muted">{{ $estugrupo->num_mat }} - {{ ucwords(strtolower($estugrupo->car_des)) }}</p>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <hr class="hr-tutorado" />
                        <ul class="social-links-tutorado list-inline p-b-0">
                            <!--<li>
                                <a title="" data-placement="top" data-toggle="tooltip" class="tooltips facebook" href="#" data-original-title="Facebook"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li>
                                <a title="" data-placement="top" data-toggle="tooltip" class="tooltips twitter" href="#" data-original-title="Twitter"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li>
                                <a title="" data-placement="top" data-toggle="tooltip" class="tooltips linkedin" href="#" data-original-title="LinkedIn"><i class="fa fa-linkedin"></i></a>
                            </li>
                            <li>
                                <a title="" data-placement="top" data-toggle="tooltip" class="tooltips envelope" href="" data-original-title="Message"><i class="fa fa-envelope-o"></i></a>
                            </li>-->
                        </ul>
                    </div> <!-- panel-body -->
                </div> <!-- panel -->
            </div> <!-- end col -->
        @endforeach
        </div> <!-- End row -->
  
@endsection
@section('js')

@endsection